<?php
 /**
 * Notification Adminhtml Block
 * 
 * @category 	Notification
 * @package 	Synsoft_Notification
 * @author  	Synsoft Global Developer
 */
class Synsoft_Notification_Block_Adminhtml_Notification extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct(){
		$this->_controller = 'adminhtml_notification';
		$this->_blockGroup = 'notification';
		$this->_headerText = "Notification Manager";
		$this->_addButtonLabel = Mage::helper('notification')->__('Send Notification');
		parent::__construct();
	}
}