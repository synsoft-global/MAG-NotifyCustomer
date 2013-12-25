<?php

class Synsoft_Notification_Block_Adminhtml_Notification_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$user_list = Mage::registry('user_notification');		      
		$data = array();
		$form = new Varien_Data_Form(array(
		  'id' => 'edit_form',
		  'action' => $this->getUrl('*/*/save', 
		  array('id' => $this->getRequest()->getParam('id'),
			   'store' => $this->getRequest()->getParam('store'),
				)),
		  'method' => 'post',
		  'enctype' => 'multipart/form-data'
		));
		
		if (Mage::getSingleton('adminhtml/session')->getNotificationData()) {
            $data = Mage::getSingleton('adminhtml/session')->getNotificationData();
            Mage::getSingleton('adminhtml/session')->setBannersliderData(null);
        } elseif (Mage::registry('notification_data')){
            $data = Mage::registry('notification_data')->getData();
			if($data['receivers']!='')
			{
				$user_list = json_decode($data['receivers']);
			}
		}
		//var_dump($data);die(); 
		$wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
        $wysiwygConfig->addData(array(
            'add_variables' => false,
            'plugins' => array(),
            'widget_window_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/widget/index'),
            'directives_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive'),
            'directives_url_quoted' => preg_quote(Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive')),
            'files_browser_window_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index'),
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('notification')->__('Notification Title'),
            'class'     => 'fieldset-wide'
        ));


        $fieldset->addField('title', 'text', array(
            'name'      => 'notification_title',
            'label'     => Mage::helper('notification')->__('Notification Title'),
            'title'     => Mage::helper('notification')->__('Notification Title'),
            'required'  => true,
            'value'     => $data['notification_title'],
        ));
		
		/*$fieldset->addField('receiver', 'multiselect', array(
            'name'      => 'receiver[]',
            'label'     => Mage::helper('notification')->__('Receivers '),
            'title'     => Mage::helper('notification')->__('Receivers '),
            'required'  => true,
            'values'     => $user_list,
        ));*/
		
		$i=0;
		foreach($user_list as $value){
			$fieldset->addField('receiver_id_'.$i, 'hidden', array(
                'name'      => 'receivers[]',
                'value'     => $value,
            ));
			$i++;
		}
		
		$fieldset->addField('text', 'editor', array(
            'name'      => 'notification_message',
            'label'     => Mage::helper('notification')->__('Content'),
            'title'     => Mage::helper('notification')->__('Content'),
            'required'  => true,
            'state'     => 'html',
            'style'     => 'height:36em;',
			'value'     => $data['notification_message'],
            'config'    => $wysiwygConfig
        ));

      $form->setUseContainer(true);
      $this->setForm($form);
      return parent::_prepareForm();
	}
}