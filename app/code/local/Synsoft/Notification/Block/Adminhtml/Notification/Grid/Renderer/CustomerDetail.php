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
class Synsoft_Notification_Block_Adminhtml_Notification_Grid_Renderer_CustomerDetail extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
    {	
		//print_r($row['receivers']);die();
		$counter = count(json_decode($row['receivers']));
		$ctr =1;
		foreach(json_decode($row['receivers']) as $user_list)
		{
			echo $this->getCustomerName($user_list);
			if($counter > $ctr)
			{
				echo ";</br>";
				$ctr++;
			}
			
		}
		/*$_product = $row->getData($this->getColumn()->getIndex());
		$html=Mage::helper('quickrfq/form')->getTargetLanguageValue($_product);  */  
		//return  $reciver_list;
    }

	public function getCustomerName($customer_id)
	{
		$customer_data = Mage::getModel('customer/customer')->load($customer_id);
		//print_r($customer_data->getData('firstname'));die();
		$customer_name = $customer_data->getData('firstname')." ".$customer_data->getData('lastname');
		return $customer_name;
	}


}