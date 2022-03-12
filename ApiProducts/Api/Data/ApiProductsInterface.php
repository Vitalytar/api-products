<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface ApiProductsInterface
 *
 * @package Custom\ApiProducts\Api\Data
 */
interface ApiProductsInterface extends ExtensibleDataInterface
{
    public const PROPERTY_TYPE_UPDATED_AT = 'property_type_updated_at';
    public const NUM_BATHROOMS = 'num_bathrooms';
    public const TOWN = 'town';
    public const CREATED_AT = 'created_at';
    public const ADDRESS = 'address';
    public const TYPE = 'type';
    public const PROPERTY_TYPE_CREATED_AT = 'property_type_created_at';
    public const COUNTY = 'county';
    public const COUNTRY = 'country';
    public const DESCRIPTION = 'description';
    public const IMAGE_FULL = 'image_full';
    public const PRICE = 'price';
    public const PRODUCT_ID = 'product_id';
    public const IMAGE_THUMBNAIL = 'image_thumbnail';
    public const LATITUDE = 'latitude';
    public const NUM_BEDROOMS = 'num_bedrooms';
    public const PROPERTY_TYPE_ID = 'property_type_id';
    public const PROPERTY_TYPE_TITLE = 'property_type_title';
    public const LONGITUDE = 'longitude';
    public const UPDATED_AT = 'updated_at';
    public const PROPERTY_TYPE_DESCRIPTION = 'property_type_description';
    public const APIPRODUCTS_ID = 'apiproducts_id';
    public const PRODUCT_UUID = 'product_uuid';

    /**
     * Get apiproducts_id
     *
     * @return string|null
     */
    public function getApiproductsId();

    /**
     * Set apiproducts_id
     *
     * @param string $apiproductsId
     *
     * @return ApiProductsInterface
     */
    public function setApiproductsId($apiproductsId);

    /**
     * Get product_id
     *
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     *
     * @param string $productId
     *
     * @return ApiProductsInterface
     */
    public function setProductId($productId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return ApiProductsExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param ApiProductsExtensionInterface $extensionAttributes
     *
     * @return $this
     */
    public function setExtensionAttributes(ApiProductsExtensionInterface $extensionAttributes);

    /**
     * Get product_uuid
     *
     * @return string|null
     */
    public function getProductUuid();

    /**
     * Set product_uuid
     *
     * @param string $productUuid
     *
     * @return ApiProductsInterface
     */
    public function setProductUuid($productUuid);

    /**
     * Get property_type_id
     *
     * @return string|null
     */
    public function getPropertyTypeId();

    /**
     * Set property_type_id
     *
     * @param string $propertyTypeId
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeId($propertyTypeId);

    /**
     * Get county
     *
     * @return string|null
     */
    public function getCounty();

    /**
     * Set county
     *
     * @param string $county
     *
     * @return ApiProductsInterface
     */
    public function setCounty($county);

    /**
     * Get country
     *
     * @return string|null
     */
    public function getCountry();

    /**
     * Set country
     *
     * @param string $country
     *
     * @return ApiProductsInterface
     */
    public function setCountry($country);

    /**
     * Get town
     *
     * @return string|null
     */
    public function getTown();

    /**
     * Set town
     *
     * @param string $town
     *
     * @return ApiProductsInterface
     */
    public function setTown($town);

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ApiProductsInterface
     */
    public function setDescription($description);

    /**
     * Get address
     *
     * @return string|null
     */
    public function getAddress();

    /**
     * Set address
     *
     * @param string $address
     *
     * @return ApiProductsInterface
     */
    public function setAddress($address);

    /**
     * Get image_full
     *
     * @return string|null
     */
    public function getImageFull();

    /**
     * Set image_full
     *
     * @param string $imageFull
     *
     * @return ApiProductsInterface
     */
    public function setImageFull($imageFull);

    /**
     * Get image_thumbnail
     *
     * @return string|null
     */
    public function getImageThumbnail();

    /**
     * Set image_thumbnail
     *
     * @param string $imageThumbnail
     *
     * @return ApiProductsInterface
     */
    public function setImageThumbnail($imageThumbnail);

    /**
     * Get latitude
     *
     * @return string|null
     */
    public function getLatitude();

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return ApiProductsInterface
     */
    public function setLatitude($latitude);

    /**
     * Get longitude
     *
     * @return string|null
     */
    public function getLongitude();

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return ApiProductsInterface
     */
    public function setLongitude($longitude);

    /**
     * Get num_bedrooms
     *
     * @return string|null
     */
    public function getNumBedrooms();

    /**
     * Set num_bedrooms
     *
     * @param string $numBedrooms
     *
     * @return ApiProductsInterface
     */
    public function setNumBedrooms($numBedrooms);

    /**
     * Get num_bathrooms
     *
     * @return string|null
     */
    public function getNumBathrooms();

    /**
     * Set num_bathrooms
     *
     * @param string $numBathrooms
     *
     * @return ApiProductsInterface
     */
    public function setNumBathrooms($numBathrooms);

    /**
     * Get price
     *
     * @return string|null
     */
    public function getPrice();

    /**
     * Set price
     *
     * @param string $price
     *
     * @return ApiProductsInterface
     */
    public function setPrice($price);

    /**
     * Get type
     *
     * @return string|null
     */
    public function getType();

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ApiProductsInterface
     */
    public function setType($type);

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     *
     * @param string $createdAt
     *
     * @return ApiProductsInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     *
     * @param string $updatedAt
     *
     * @return ApiProductsInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get property_type_title
     *
     * @return string|null
     */
    public function getPropertyTypeTitle();

    /**
     * Set property_type_title
     *
     * @param string $propertyTypeTitle
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeTitle($propertyTypeTitle);

    /**
     * Get property_type_description
     *
     * @return string|null
     */
    public function getPropertyTypeDescription();

    /**
     * Set property_type_description
     *
     * @param string $propertyTypeDescription
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeDescription($propertyTypeDescription);

    /**
     * Get property_type_created_at
     *
     * @return string|null
     */
    public function getPropertyTypeCreatedAt();

    /**
     * Set property_type_created_at
     *
     * @param string $propertyTypeCreatedAt
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeCreatedAt($propertyTypeCreatedAt);

    /**
     * Get property_type_updated_at
     *
     * @return string|null
     */
    public function getPropertyTypeUpdatedAt();

    /**
     * Set property_type_updated_at
     *
     * @param string $propertyTypeUpdatedAt
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeUpdatedAt($propertyTypeUpdatedAt);
}
