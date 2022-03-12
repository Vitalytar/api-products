<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ApiProductsSearchResultsInterface
 *
 * @package Custom\ApiProducts\Api\Data
 */
interface ApiProductsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get ApiProducts list.
     *
     * @return ApiProductsInterface[]
     */
    public function getItems();

    /**
     * Set product_id list.
     *
     * @param ApiProductsInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items);
}
