<?php

class Synsoft_Notification_Block_Adminhtml_Notification_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      
	  parent::__construct();
      $this->setId('notification_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('notification')->__('Notification Manager'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('notification')->__('Notification Information'),
          'title'     => Mage::helper('notification')->__('Notification Information'),
          'content'   => $this->getLayout()->createBlock('notification/adminhtml_notification_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}