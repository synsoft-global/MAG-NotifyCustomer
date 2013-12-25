<?php 
 /**
 * Notification Adminhtml Block
 * 
 * @category 	Notification
 * @package 	Synsoft_Notification
 * @author  	Synsoft Global Developer
 */
class Synsoft_Notification_Block_Notification extends Mage_Directory_Block_Data
{
	protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('head')->setTitle(Mage::helper('customer')->__('Customer Notification'));
        return parent::_prepareLayout();
    }
	
	public function viewNotification()
	{
		$notifiation_id = Mage::Registry('notification_id');
		$notifiation_content = Mage::getModel('notification/notification')->load($notifiation_id);
		return $notifiation_content->getData();
	}
	
	public function getCustomerNotification()
	{
		$current_user = $this->getCustomer();
		$_count = Mage::getModel('notification/notification')->getCollection()
				->setOrder('created_on', 'DESC');	
		$fetch_data	= $_count->addFieldToFilter('receivers ', array('like' => '%'.$current_user->getId().'%'));
				
		$result = $fetch_data->getData();
		return $result;
	}
	
	public function getNotificationCount()
	{
		$count =count ($this->getCustomerNotification());
		return $count;
	}
	
	public function getCustomer()
    {
		$current_user = Mage::getSingleton('customer/session')->getCustomer();
		return $current_user;
    }
}
