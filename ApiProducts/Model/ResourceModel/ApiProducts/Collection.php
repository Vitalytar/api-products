<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Model\ResourceModel\ApiProducts;

use Custom\ApiProducts\Model\ApiProducts;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * @package Custom\ApiProducts\Model\ResourceModel\ApiProducts
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'apiproducts_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            ApiProducts::class,
            \Custom\ApiProducts\Model\ResourceModel\ApiProducts::class
        );
    }
}
