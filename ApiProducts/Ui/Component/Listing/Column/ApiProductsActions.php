<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class ApiProductsActions
 *
 * @package Custom\ApiProducts\Ui\Component\Listing\Column
 */
class ApiProductsActions extends Column
{
    public const URL_PATH_DETAILS = 'custom_apiproducts/apiproducts/details';
    public const URL_PATH_DELETE = 'custom_apiproducts/apiproducts/delete';
    public const URL_PATH_EDIT = 'custom_apiproducts/apiproducts/edit';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['apiproducts_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'apiproducts_id' => $item['apiproducts_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'apiproducts_id' => $item['apiproducts_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete product'),
                                'message' => __('Are you sure you wan\'t to delete a product?')
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
