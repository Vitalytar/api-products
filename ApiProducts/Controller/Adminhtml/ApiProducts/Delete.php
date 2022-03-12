<?php
/**
 * @category Custom
 * @package  Custom_ApiProducts
 * @author   Vitalijs Visnakovs <vitalijs.visnakovs@gmail.com>
 */

declare(strict_types=1);

namespace Custom\ApiProducts\Controller\Adminhtml\ApiProducts;

use Custom\ApiProducts\Controller\Adminhtml\ApiProducts;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Delete
 *
 * @package Custom\ApiProducts\Controller\Adminhtml\ApiProducts
 */
class Delete extends ApiProducts
{
    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('apiproducts_id');

        if ($id) {
            try {
                $model = $this->_objectManager->create(\Custom\ApiProducts\Model\ApiProducts::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the product.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['apiproducts_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a product to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
