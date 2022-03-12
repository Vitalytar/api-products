<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Model\Data;

use Custom\ApiProducts\Api\Data\ApiProductsExtensionInterface;
use Custom\ApiProducts\Api\Data\ApiProductsInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

/**
 * Class ApiProducts
 *
 * @package Custom\ApiProducts\Model\Data
 */
class ApiProducts extends AbstractExtensibleObject implements
    ApiProductsInterface
{
    /**
     * Get apiproducts_id
     *
     * @return string|null
     */
    public function getApiproductsId(): ?string
    {
        return $this->_get(self::APIPRODUCTS_ID);
    }

    /**
     * Set apiproducts_id
     *
     * @param string $apiproductsId
     *
     * @return ApiProductsInterface
     */
    public function setApiproductsId($apiproductsId): ApiProductsInterface
    {
        return $this->setData(self::APIPRODUCTS_ID, $apiproductsId);
    }

    /**
     * Get product_id
     *
     * @return string|null
     */
    public function getProductId(): ?string
    {
        return $this->_get(self::PRODUCT_ID);
    }

    /**
     * Set product_id
     *
     * @param string $productId
     *
     * @return ApiProductsInterface
     */
    public function setProductId($productId): ApiProductsInterface
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return ApiProductsExtensionInterface|null
     */
    public function getExtensionAttributes(): ?ApiProductsExtensionInterface
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     *
     * @param ApiProductsExtensionInterface $extensionAttributes
     *
     * @return $this
     */
    public function setExtensionAttributes(
        ApiProductsExtensionInterface $extensionAttributes
    ): ApiProducts {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get product_uuid
     *
     * @return string|null
     */
    public function getProductUuid(): ?string
    {
        return $this->_get(self::PRODUCT_UUID);
    }

    /**
     * Set product_uuid
     *
     * @param string $productUuid
     *
     * @return ApiProductsInterface
     */
    public function setProductUuid($productUuid): ApiProductsInterface
    {
        return $this->setData(self::PRODUCT_UUID, $productUuid);
    }

    /**
     * Get property_type_id
     *
     * @return string|null
     */
    public function getPropertyTypeId(): ?string
    {
        return $this->_get(self::PROPERTY_TYPE_ID);
    }

    /**
     * Set property_type_id
     *
     * @param string $propertyTypeId
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeId($propertyTypeId): ApiProductsInterface
    {
        return $this->setData(self::PROPERTY_TYPE_ID, $propertyTypeId);
    }

    /**
     * Get county
     *
     * @return string|null
     */
    public function getCounty(): ?string
    {
        return $this->_get(self::COUNTY);
    }

    /**
     * Set county
     *
     * @param string $county
     *
     * @return ApiProductsInterface
     */
    public function setCounty($county): ApiProductsInterface
    {
        return $this->setData(self::COUNTY, $county);
    }

    /**
     * Get country
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->_get(self::COUNTRY);
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return ApiProductsInterface
     */
    public function setCountry($country): ApiProductsInterface
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * Get town
     *
     * @return string|null
     */
    public function getTown(): ?string
    {
        return $this->_get(self::TOWN);
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return ApiProductsInterface
     */
    public function setTown($town): ApiProductsInterface
    {
        return $this->setData(self::TOWN, $town);
    }

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->_get(self::DESCRIPTION);
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ApiProductsInterface
     */
    public function setDescription($description): ApiProductsInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Get address
     *
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->_get(self::ADDRESS);
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return ApiProductsInterface
     */
    public function setAddress($address): ApiProductsInterface
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
     * Get image_full
     *
     * @return string|null
     */
    public function getImageFull(): ?string
    {
        return $this->_get(self::IMAGE_FULL);
    }

    /**
     * Set image_full
     *
     * @param string $imageFull
     *
     * @return ApiProductsInterface
     */
    public function setImageFull($imageFull): ApiProductsInterface
    {
        return $this->setData(self::IMAGE_FULL, $imageFull);
    }

    /**
     * Get image_thumbnail
     *
     * @return string|null
     */
    public function getImageThumbnail(): ?string
    {
        return $this->_get(self::IMAGE_THUMBNAIL);
    }

    /**
     * Set image_thumbnail
     *
     * @param string $imageThumbnail
     *
     * @return ApiProductsInterface
     */
    public function setImageThumbnail($imageThumbnail): ApiProductsInterface
    {
        return $this->setData(self::IMAGE_THUMBNAIL, $imageThumbnail);
    }

    /**
     * Get latitude
     *
     * @return string|null
     */
    public function getLatitude(): ?string
    {
        return $this->_get(self::LATITUDE);
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return ApiProductsInterface
     */
    public function setLatitude($latitude): ApiProductsInterface
    {
        return $this->setData(self::LATITUDE, $latitude);
    }

    /**
     * Get longitude
     *
     * @return string|null
     */
    public function getLongitude(): ?string
    {
        return $this->_get(self::LONGITUDE);
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return ApiProductsInterface
     */
    public function setLongitude($longitude): ApiProductsInterface
    {
        return $this->setData(self::LONGITUDE, $longitude);
    }

    /**
     * Get num_bedrooms
     *
     * @return string|null
     */
    public function getNumBedrooms(): ?string
    {
        return $this->_get(self::NUM_BEDROOMS);
    }

    /**
     * Set num_bedrooms
     *
     * @param string $numBedrooms
     *
     * @return ApiProductsInterface
     */
    public function setNumBedrooms($numBedrooms): ApiProductsInterface
    {
        return $this->setData(self::NUM_BEDROOMS, $numBedrooms);
    }

    /**
     * Get num_bathrooms
     *
     * @return string|null
     */
    public function getNumBathrooms(): ?string
    {
        return $this->_get(self::NUM_BATHROOMS);
    }

    /**
     * Set num_bathrooms
     *
     * @param string $numBathrooms
     *
     * @return ApiProductsInterface
     */
    public function setNumBathrooms($numBathrooms): ApiProductsInterface
    {
        return $this->setData(self::NUM_BATHROOMS, $numBathrooms);
    }

    /**
     * Get price
     *
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->_get(self::PRICE);
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return ApiProductsInterface
     */
    public function setPrice($price): ApiProductsInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * Get type
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->_get(self::TYPE);
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ApiProductsInterface
     */
    public function setType($type): ApiProductsInterface
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     *
     * @param string $createdAt
     *
     * @return ApiProductsInterface
     */
    public function setCreatedAt($createdAt): ApiProductsInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     *
     * @param string $updatedAt
     *
     * @return ApiProductsInterface
     */
    public function setUpdatedAt($updatedAt): ApiProductsInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get property_type_title
     *
     * @return string|null
     */
    public function getPropertyTypeTitle(): ?string
    {
        return $this->_get(self::PROPERTY_TYPE_TITLE);
    }

    /**
     * Set property_type_title
     *
     * @param string $propertyTypeTitle
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeTitle($propertyTypeTitle): ApiProductsInterface
    {
        return $this->setData(self::PROPERTY_TYPE_TITLE, $propertyTypeTitle);
    }

    /**
     * Get property_type_description
     *
     * @return string|null
     */
    public function getPropertyTypeDescription(): ?string
    {
        return $this->_get(self::PROPERTY_TYPE_DESCRIPTION);
    }

    /**
     * Set property_type_description
     *
     * @param string $propertyTypeDescription
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeDescription($propertyTypeDescription): ApiProductsInterface
    {
        return $this->setData(
            self::PROPERTY_TYPE_DESCRIPTION,
            $propertyTypeDescription
        );
    }

    /**
     * Get property_type_created_at
     *
     * @return string|null
     */
    public function getPropertyTypeCreatedAt(): ?string
    {
        return $this->_get(self::PROPERTY_TYPE_CREATED_AT);
    }

    /**
     * Set property_type_created_at
     *
     * @param string $propertyTypeCreatedAt
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeCreatedAt($propertyTypeCreatedAt): ApiProductsInterface
    {
        return $this->setData(
            self::PROPERTY_TYPE_CREATED_AT,
            $propertyTypeCreatedAt
        );
    }

    /**
     * Get property_type_updated_at
     *
     * @return string|null
     */
    public function getPropertyTypeUpdatedAt(): ?string
    {
        return $this->_get(self::PROPERTY_TYPE_UPDATED_AT);
    }

    /**
     * Set property_type_updated_at
     *
     * @param string $propertyTypeUpdatedAt
     *
     * @return ApiProductsInterface
     */
    public function setPropertyTypeUpdatedAt($propertyTypeUpdatedAt): ApiProductsInterface
    {
        return $this->setData(
            self::PROPERTY_TYPE_UPDATED_AT,
            $propertyTypeUpdatedAt
        );
    }
}
