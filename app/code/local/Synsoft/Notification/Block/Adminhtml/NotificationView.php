<?php

class Synsoft_Notification_Block_Adminhtml_NotificationView extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct(){
		$this->_controller = 'adminhtml_notification';
		$this->_blockGroup = 'notification';
		$this->_headerText = "Notification Manager";
		$this->_addButtonLabel = Mage::helper('notification')->__('Send Notification');
		parent::__construct();
	}

	 protected function _prepareLayout()
    {
        $this->setChild( 'view',
            $this->getLayout()->createBlock( $this->_blockGroup.'/' . $this->_controller . '_view',
            $this->_controller . '.view')->setSaveParametersInSession(true) );
        return parent::_prepareLayout();
    }
	
	public function getGridHtml()
    {
        return $this->getChildHtml('view');
    }
	
	public function getCreateUrl()
    {
        return $this->getUrl('*/*/');
    }
}