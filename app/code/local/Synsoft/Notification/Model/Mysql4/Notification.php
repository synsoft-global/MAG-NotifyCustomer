<?php
/**
 * Adminhtml form container block
 *
 * @category 	Notification
 * @package 	Synsoft_Notification
 * @author  	Synsoft Global Developer
 */
class Synsoft_Notification_Model_Mysql4_Notification extends Mage_Core_Model_Mysql4_Abstract 
{
	public function _construct() {
        $this->_init('notification/notification', 'notification_id');
    }	
}
