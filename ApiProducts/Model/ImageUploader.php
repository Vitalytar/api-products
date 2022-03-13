<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

namespace Custom\ApiProducts\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\UrlInterface;
use Magento\MediaStorage\Helper\File\Storage\Database;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ImageUploader
 *
 * @package Custom\ApiProducts\Model
 */
class ImageUploader
{
    /**
     * "image_full" Image upload directory in pub/media/image_full
     *
     * @var string
     */
    const IMAGE_BASE_PATH = 'image_full';

    /**
     * Core file storage database
     *
     * @var Database
     */
    private $coreFileStorageDatabase;

    /**
     * Media directory object (writable).
     *
     * @var WriteInterface
     */
    private $mediaDirectory;

    /**
     * Uploader factory
     *
     * @var UploaderFactory
     */
    private $uploaderFactory;

    /**
     * Base path
     *
     * @var string
     */
    protected $basePath;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Database              $coreFileStorageDatabase
     * @param Filesystem            $filesystem
     * @param UploaderFactory       $uploaderFactory
     * @param StoreManagerInterface $storeManager
     * @param LoggerInterface       $logger
     *
     * @throws FileSystemException
     */
    public function __construct(
        Database $coreFileStorageDatabase,
        Filesystem $filesystem,
        UploaderFactory $uploaderFactory,
        StoreManagerInterface $storeManager,
        LoggerInterface $logger
    ) {
        $this->coreFileStorageDatabase = $coreFileStorageDatabase;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->uploaderFactory = $uploaderFactory;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
        $this->basePath = self::IMAGE_BASE_PATH;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * @param $path
     * @param $imageName
     *
     * @return string
     */
    public function getFilePath($path, $imageName): string
    {
        return rtrim($path, '/') . '/' . ltrim($imageName, '/');
    }

    /**
     * @param $fileId
     *
     * @return array|bool
     * @throws LocalizedException|NoSuchEntityException
     */
    public function saveFileToTmpDir($fileId)
    {
        $basePath = $this->getBasePath();
        $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);
        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'png']);
        $uploader->setAllowRenameFiles(true);
        $result = $uploader->save($this->mediaDirectory->getAbsolutePath($basePath));

        if (!$result) {
            throw new LocalizedException(
                __('File can not be saved to the destination folder.')
            );
        }

        $result['tmp_name'] = str_replace('\\', '/', $result['tmp_name']);
        $result['path'] = str_replace('\\', '/', $result['path']);
        $result['url'] = $this->storeManager
                ->getStore()
                ->getBaseUrl(
                    UrlInterface::URL_TYPE_MEDIA
                ) . $this->getFilePath($basePath, $result['file']);
        $result['name'] = $result['file'];

        if (isset($result['file'])) {
            try {
                $relativePath = rtrim($basePath, '/') . '/' . ltrim($result['file'], '/');
                $this->coreFileStorageDatabase->saveFile($relativePath);
            } catch (\Exception $e) {
                $this->logger->critical($e);
                throw new LocalizedException(
                    __('Something went wrong while saving the file(s).')
                );
            }
        }

        return $result;
    }
}
