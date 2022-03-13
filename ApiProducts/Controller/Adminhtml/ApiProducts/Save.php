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
     * @param Context                $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     * @throws LocalizedException
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

            if (isset($data['image_full'][0]['name'])) {
                $data['image_full'] = $data['image_full'][0]['name'];
            } else {
                $data['image_full'] = null;
            }

            if (isset($data['image_thumbnail'][0]['name'])) {
                $data['image_thumbnail'] = $data['image_thumbnail'][0]['name'];
            } else {
                $data['image_thumbnail'] = null;
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
