<?php

class Synsoft_Notification_Block_Adminhtml_Notification_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
          
        $this->_objectId = 'id';
        $this->_blockGroup = 'notification';
        $this->_controller = 'adminhtml_notification';
		
        $this->_updateButton('back', array(
            'label'     => Mage::helper('adminhtml')->__('Back'),
            'onclick'   => 'setLocation(\'' . $this->getBackUrl() . '\')',
            'class'     => 'back',
        ), -1);
        $this->_updateButton('send', 'label', Mage::helper('notification')->__('Send Notification'));
        $this->_updateButton('delete', 'label', Mage::helper('notification')->__('Delete Notification'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('notification_data') && Mage::registry('notification_data')->getId() ) {
            return Mage::helper('notification')->__("Edit Notification Message", $this->htmlEscape(Mage::registry('notification_data')->getName()));
        } else {
            return Mage::helper('notification')->__('Add Notification Message');
        }
    }
	
	 public function getBackUrl()
    {
        if( Mage::registry('notification_data') && Mage::registry('notification_data')->getId() ) {
           return $this->getUrl('*/*/view');
        } else {
           return $this->getUrl('*/*/');
        }
		
    }
}