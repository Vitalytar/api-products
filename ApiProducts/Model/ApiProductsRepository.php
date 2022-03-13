<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Model;

use Custom\ApiProducts\Api\ApiProductsRepositoryInterface;
use Custom\ApiProducts\Api\Data\ApiProductsInterface;
use Custom\ApiProducts\Api\Data\ApiProductsInterfaceFactory;
use Custom\ApiProducts\Api\Data\ApiProductsSearchResultsInterface;
use Custom\ApiProducts\Api\Data\ApiProductsSearchResultsInterfaceFactory;
use Custom\ApiProducts\Model\ResourceModel\ApiProducts as ResourceApiProducts;
use Custom\ApiProducts\Model\ResourceModel\ApiProducts\CollectionFactory as ApiProductsCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

/**
 * Class ApiProductsRepository
 *
 * @package Custom\ApiProducts\Model
 */
class ApiProductsRepository implements ApiProductsRepositoryInterface
{
    /**
     * @var ApiProductsFactory
     */
    protected $apiProductsFactory;

    /**
     * @var ApiProductsCollectionFactory
     */
    protected $apiProductsCollectionFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var ApiProductsInterfaceFactory
     */
    protected $dataApiProductsFactory;

    /**
     * @var ApiProductsSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var ResourceApiProducts
     */
    protected $resource;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @param ResourceApiProducts $resource
     * @param ApiProductsFactory $apiProductsFactory
     * @param ApiProductsInterfaceFactory $dataApiProductsFactory
     * @param ApiProductsCollectionFactory $apiProductsCollectionFactory
     * @param ApiProductsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceApiProducts $resource,
        ApiProductsFactory $apiProductsFactory,
        ApiProductsInterfaceFactory $dataApiProductsFactory,
        ApiProductsCollectionFactory $apiProductsCollectionFactory,
        ApiProductsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->apiProductsFactory = $apiProductsFactory;
        $this->apiProductsCollectionFactory = $apiProductsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataApiProductsFactory = $dataApiProductsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * @param ApiProductsInterface $apiProducts
     *
     * @return ApiProductsInterface
     * @throws CouldNotSaveException
     */
    public function save(ApiProductsInterface $apiProducts)
    {
        $apiProductsData = $this->extensibleDataObjectConverter->toNestedArray(
            $apiProducts,
            [],
            ApiProductsInterface::class
        );
        $apiProductsModel = $this->apiProductsFactory->create()->setData($apiProductsData);

        try {
            $this->resource->save($apiProductsModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the apiProducts: %1',
                $exception->getMessage()
            ));
        }

        return $apiProductsModel->getDataModel();
    }

    /**
     * @param $apiProductsId
     *
     * @return ApiProductsInterface
     * @throws NoSuchEntityException
     */
    public function get($apiProductsId)
    {
        $apiProducts = $this->apiProductsFactory->create();
        $this->resource->load($apiProducts, $apiProductsId);

        if (!$apiProducts->getId()) {
            throw new NoSuchEntityException(__('ApiProducts with id "%1" does not exist.', $apiProductsId));
        }

        return $apiProducts->getDataModel();
    }

    /**
     * @param SearchCriteriaInterface $criteria
     *
     * @return ApiProductsSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->apiProductsCollectionFactory->create();
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            ApiProductsInterface::class
        );
        $this->collectionProcessor->process($criteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $items = [];

        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @param ApiProductsInterface $apiProducts
     *
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(ApiProductsInterface $apiProducts): bool
    {
        try {
            $apiProductsModel = $this->apiProductsFactory->create();
            $this->resource->load($apiProductsModel, $apiProducts->getApiproductsId());
            $this->resource->delete($apiProductsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the ApiProducts: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }

    /**
     * @param $apiProductsId
     *
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($apiProductsId): bool
    {
        return $this->delete($this->get($apiProductsId));
    }
}
