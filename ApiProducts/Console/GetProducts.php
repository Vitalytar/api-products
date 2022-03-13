<?php
/**
 * @category    Custom
 * @package     Custom_ApiProducts
 * @author      Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Console;

use Custom\ApiProducts\Model\ApiProductsFactory;
use Custom\ApiProducts\Model\ResourceModel\ApiProducts;
use Magento\Framework\Exception\FileSystemException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\Client\Curl;
use Symfony\Component\Console\Input\InputOption;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class GetProducts
 *
 * @package Custom\ApiProducts\Console
 */
class GetProducts extends Command
{
    public const API_ENDPOINT_CONFIG_PATH = 'general/api_configuration/api_endpoint';
    public const API_KEY_CONFIG_PATH = 'general/api_configuration/api_key';
    public const CLI_COMMAND_SIZE_OPTION = 'size';
    public const CLI_COMMAND_PAGE_OPTION = 'page';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var Curl
     */
    protected $curl;

    /**
     * @var ApiProductsFactory
     */
    protected $apiProductsFactory;

    /**
     * @var ApiProducts
     */
    protected $apiProducts;

    /**
     * @var DirectoryList
     */
    protected $directoryList;

    /**
     * @param ScopeConfigInterface          $scopeConfig
     * @param Curl                          $curl
     * @param ApiProductsFactory            $apiProductsFactory
     * @param ApiProducts                   $apiProducts
     * @param DirectoryList                 $directoryList
     * @param string|null                   $name
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Curl $curl,
        ApiProductsFactory $apiProductsFactory,
        ApiProducts $apiProducts,
        DirectoryList $directoryList,
        string $name = null
    ) {
        parent::__construct($name);
        $this->scopeConfig = $scopeConfig;
        $this->curl = $curl;
        $this->apiProductsFactory = $apiProductsFactory;
        $this->apiProducts = $apiProducts;
        $this->directoryList = $directoryList;
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $options = [
            new InputOption(
                self::CLI_COMMAND_PAGE_OPTION,
                null,
                InputOption::VALUE_OPTIONAL,
                'Page'
            ),
            new InputOption(
                self::CLI_COMMAND_SIZE_OPTION,
                null,
                InputOption::VALUE_OPTIONAL,
                'Size'
            )
        ];

        $this->setName('apiproducts:import')
            ->setDefinition($options)
            ->setDescription('Parse products from the API');

        parent::configure();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $collectionSize = $input->getOption(self::CLI_COMMAND_SIZE_OPTION) ?: 30;
        $collectionPage = $input->getOption(self::CLI_COMMAND_PAGE_OPTION) ?: 1;
        $apiKey = $this->scopeConfig->getValue(self::API_KEY_CONFIG_PATH);
        $apiEndpoint
            = $this->scopeConfig->getValue(self::API_ENDPOINT_CONFIG_PATH)
            . "?page[size]=$collectionSize&page[number]=$collectionPage&api_key=$apiKey";

        $productsData = $this->getApiProductsData($apiEndpoint);

        if ($productsData['success']) {
            foreach ($productsData['result_data']['data'] as $product) {
                $prod = $this->apiProductsFactory->create();
                $prod->setData([
                    'product_uuid' => $product['uuid'],
                    'property_type_id' => $product['property_type_id'],
                    'county' => $product['county'],
                    'country' => $product['country'],
                    'town' => $product['town'],
                    'description' => $product['description'],
                    'address' => $product['address'],
                    'image_full' => $product['image_full'],
                    'image_thumbnail' => $product['image_thumbnail'],
                    'latitude' => $product['latitude'],
                    'longitude' => $product['longitude'],
                    'num_bedrooms' => $product['num_bedrooms'],
                    'num_bathrooms' => $product['num_bathrooms'],
                    'price' => $product['price'],
                    'type' => $product['type'],
                    'created_at' => $product['created_at'],
                    'updated_at' => $product['updated_at'],
                    'property_type_title' => $product['property_type']['title'],
                    'property_type_description' => $product['property_type']['description'],
                    'property_type_created_at' => $product['property_type']['created_at'],
                    'property_type_updated_at' => $product['property_type']['updated_at']
                ]);

                try {
                    $fullImageName = parse_url($product['image_full'])['query'] . '.png';
                    $thumbnailImageName = parse_url($product['image_thumbnail'])['query'] . '.png';
                    $prod->setImageFull($fullImageName);
                    $prod->setImageThumbnail($thumbnailImageName);
                    $this->saveImage($product['image_full'], $fullImageName);
                    $this->saveImage(
                        $product['image_thumbnail'],
                        $thumbnailImageName
                    );
                    $this->apiProducts->save($prod);
                } catch (\Exception $e) {
                    $output->writeln(
                        'Something went wrong when saving a product. Product UUID - '
                        . $product['uuid']
                    );
                }

                $output->writeln(
                    'Successfully saved a product. Product UUID - '
                    . $product['uuid']
                );
            }
        }

        $output->writeln('Test message CLI');
    }

    /**
     * @param $imageUrl
     * @param $imageName
     *
     * @return void
     * @throws FileSystemException
     */
    public function saveImage($imageUrl, $imageName): void
    {
        copy($imageUrl, $this->directoryList->getPath('media') . '/image_full/' . $imageName);
    }

    /**
     * @param string $apiEndpoint
     *
     * @return array
     */
    private function getApiProductsData(
        string $apiEndpoint
    ): array {
        $this->curl->addHeader('Content-Type', 'application/json');
        $this->curl->addHeader('Accept', 'application/json');
        $this->curl->get($apiEndpoint);
        try {
            $result = [
                'success' => true,
                'result_data' => json_decode(
                    $this->curl->getBody(),
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                )
            ];
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'result_data' => []
            ];
        }

        return $result;
    }
}
