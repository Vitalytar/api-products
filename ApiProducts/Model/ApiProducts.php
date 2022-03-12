<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Model;

use Custom\ApiProducts\Api\Data\ApiProductsInterface;
use Custom\ApiProducts\Api\Data\ApiProductsInterfaceFactory;
use Custom\ApiProducts\Model\ResourceModel\ApiProducts\Collection;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

/**
 * Class ApiProducts
 *
 * @package Custom\ApiProducts\Model
 */
class ApiProducts extends AbstractModel
{
    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = 'custom_apiproducts_apiproducts';

    /**
     * @var ApiProductsInterfaceFactory
     */
    protected $apiproductsDataFactory;


    /**
     * @param Context                     $context
     * @param Registry                    $registry
     * @param ApiProductsInterfaceFactory $apiproductsDataFactory
     * @param DataObjectHelper            $dataObjectHelper
     * @param ResourceModel\ApiProducts   $resource
     * @param Collection                  $resourceCollection
     * @param array                       $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ApiProductsInterfaceFactory $apiproductsDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\ApiProducts $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->apiproductsDataFactory = $apiproductsDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve apiproducts model with apiproducts data
     *
     * @return ApiProductsInterface
     */
    public function getDataModel(): ApiProductsInterface
    {
        $apiproductsData = $this->getData();
        $apiproductsDataObject = $this->apiproductsDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $apiproductsDataObject,
            $apiproductsData,
            ApiProductsInterface::class
        );

        return $apiproductsDataObject;
    }
}
