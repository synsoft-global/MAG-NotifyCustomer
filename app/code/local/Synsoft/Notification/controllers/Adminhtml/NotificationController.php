<?php

/**
 * Magestore
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category 	Notification
 * @package 	Synsoft_Notification
 * @author  	Synsoft Global Developer
 */
class Synsoft_Notification_Adminhtml_NotificationController extends Mage_Adminhtml_Controller_Action 
{
    protected function _initAction() 
	{
        $this->loadLayout()
			->_setActiveMenu('notification')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }	  

    /**
     * index action
     */
    public function indexAction() 
	{
        $this->_initAction()
            ->renderLayout();
    }

    /**
     * view and edit item action
     */
	 
	public function editAction()
    {
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('notification/notification')->load($id);
 
        if ($model->getId() || $id == 0)
		{			
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data))
                $model->setData($data);
            Mage::register('notification_data', $model);
 
            $this->loadLayout();
            $this->_setActiveMenu('notification');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('notification/adminhtml_notification_edit'));
                 //->_addLeft($this->getLayout()->createBlock('<module>/adminhtml_<module>_edit_tabs'));
               
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
   
    public function newAction()
    {
        $user_list = $this->getRequest()->getParam('notification');
 
		if (!is_array($user_list)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select Customer(s)'));
			$this->_redirect('*/*/');
        } else {
			Mage::register('user_notification', $user_list);
			$this->_forward('edit');
		}
    }   

    /**
     * save item action
     */	
	public function saveAction()
    {
        if ($data = $this->getRequest()->getPost() ) {
			$data['created_on'] = now();
			$data['receivers'] = json_encode($data['receivers']);
			
            try {
                $model = Mage::getModel('notification/notification');
               
                $model->setData($data)
					->setId($this->getRequest()->getParam('id'))
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Notification was successfully sent'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
		 
                $this->_redirect('*/*/view');
                return;
            }catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/view');
    }
	
	public function viewAction()
	{
		$this->_initAction()
            ->renderLayout();
	}

    /**
     * delete item action
     */
    public function deleteAction() {
		$id = $this->getRequest()->getParam('id');
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model =  Mage::getModel('notification/notification');
                $model->setId($this->getRequest()->getParam('id'))
					->setId($this->getRequest()->getParam('id'))
                        ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Notification was successfully deleted'));
                $this->_redirect('*/*/view');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/view');
    }

    /**
     * mass delete item(s) action
     */
    public function massDeleteAction() {
        $notificationIds = $this->getRequest()->getParam('notification');
        if (!is_array($notificationIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($notificationIds as $notificationId) {
                    $model = Mage::getModel('notification/notification')->load($notificationId);
                    $model->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($notificationIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/view');
    }

    
    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('banner');
    }

}