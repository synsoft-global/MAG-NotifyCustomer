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
 * @category 	Magestore
 * @package 	Magestore_Bannerslider
 * @copyright 	Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license 	http://www.magestore.com/license-agreement.html
 */

/**
 * Bannerslider Adminhtml Controller
 * 
 * @category 	Magestore
 * @package 	Magestore_Bannerslider
 * @author  	Magestore Developer
 */
class Synsoft_Notification_IndexController extends Mage_Core_Controller_Front_Action {

    /**
     * index action
     */
    protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }
	
	public function indexAction()
	{
		if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('');
            return;
        }
		
        $this->loadLayout();
		$this->_initLayoutMessages('customer/session');
        $this->renderLayout();
		
	}
	
	public function viewAction()
	{
		if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('');
            return;
        }
		$notificationId  = (int) $this->getRequest()->getParam('id');

		Mage::Register('notification_id',$notificationId);
		//$this->setTemplate('notification/notification_view.phtml');
		$this->loadLayout();
		$this->_initLayoutMessages('customer/session');
        $this->renderLayout();
	}

}