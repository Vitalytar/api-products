<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Api;

use Custom\ApiProducts\Api\Data\ApiProductsInterface;
use Custom\ApiProducts\Api\Data\ApiProductsSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface ApiProductsRepositoryInterface
 *
 * @package Custom\ApiProducts\Api
 */
interface ApiProductsRepositoryInterface
{
    /**
     * Save ApiProducts
     *
     * @param ApiProductsInterface $apiProducts
     *
     * @return ApiProductsInterface
     * @throws LocalizedException
     */
    public function save(ApiProductsInterface $apiProducts);

    /**
     * Retrieve ApiProducts
     *
     * @param string $apiproductsId
     *
     * @return ApiProductsInterface
     * @throws LocalizedException
     */
    public function get($apiproductsId);

    /**
     * Retrieve ApiProducts matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return ApiProductsSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete ApiProducts
     *
     * @param ApiProductsInterface $apiProducts
     *
     * @return bool
     * @throws LocalizedException
     */
    public function delete(ApiProductsInterface $apiProducts);

    /**
     * Delete ApiProducts by ID
     *
     * @param string $apiproductsId
     *
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($apiproductsId);
}

