<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Controller\Adminhtml\ApiProducts;

use Custom\ApiProducts\Model\ApiProducts;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Catalog\Model\ImageUploader;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\MediaStorage\Model\File\UploaderFactory;

/**
 * Class Save
 *
 * @package Custom\ApiProducts\Controller\Adminhtml\ApiProducts
 */
class Save extends Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * @var WriteInterface
     */
    protected $mediaDirectory;

    /**
     * @var UploaderFactory
     */
    protected $uploaderFactory;

    /**
     * @param Context                $context
     * @param DataPersistorInterface $dataPersistor
     * @param ImageUploader          $imageUploader
     * @param WriteInterface         $mediaDirectory
     * @param UploaderFactory        $uploaderFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        ImageUploader $imageUploader,
        WriteInterface $mediaDirectory,
        UploaderFactory $uploaderFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->imageUploader = $imageUploader;
        $this->mediaDirectory = $mediaDirectory;
        $this->uploaderFactory = $uploaderFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     * @throws LocalizedException|Exception
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('apiproducts_id');
            $model = $this->_objectManager->create(ApiProducts::class)->load($id);

            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This product no longer exists.'));

                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the product.'));
                $this->dataPersistor->clear('custom_apiproducts_apiproducts');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['apiproducts_id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the product.'));
            }

            $this->dataPersistor->set('custom_apiproducts_apiproducts', $data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['apiproducts_id' => $this->getRequest()->getParam('apiproducts_id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}
