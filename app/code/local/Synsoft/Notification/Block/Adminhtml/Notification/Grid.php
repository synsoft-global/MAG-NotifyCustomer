<?php

class Synsoft_Notification_Block_Adminhtml_Notification_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('notificationGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
		$this->setUseAjax(true);
    }

    protected function _prepareCollection() {    
		$collection = Mage::getResourceModel('customer/customer_collection')
            ->addNameToSelect()
            ->addAttributeToSelect('email')
			->addAttributeToSelect('group_id')
			->joinAttribute('billing_city', 'customer_address/city', 'default_billing', null, 'left')
			->joinAttribute('billing_region', 'customer_address/region', 'default_billing', null, 'left')
            ->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left');
			
        $this->setCollection($collection);
		
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
		$this->addColumn('entity_id', array(
            'header'    => Mage::helper('customer')->__('ID'),
            'width'     => '50',
            'index'     => 'entity_id',
            'type'  => 'number',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('customer')->__('Name'),
			'width'     => '150',
            'index'     => 'name'
        ));
        $this->addColumn('email', array(
            'header'    => Mage::helper('customer')->__('Email'),
            'width'     => '150',
            'index'     => 'email'
        ));

        $groups = Mage::getResourceModel('customer/group_collection')
            ->addFieldToFilter('customer_group_id', array('gt'=> 0))
            ->load()
            ->toOptionHash();

        $this->addColumn('group', array(
            'header'    =>  Mage::helper('customer')->__('Group'),
            'width'     =>  '150',
            'index'     =>  'group_id',
            'type'      =>  'options',
            'options'   =>  $groups,
        ));
		
		$this->addColumn('billing_city', array(
            'header'    => Mage::helper('customer')->__('City'),
            'width'     => '100',
            'type'      => 'city',
            'index'     => 'billing_city',
        ));
		
		$this->addColumn('billing_region', array(
            'header'    => Mage::helper('customer')->__('State/Province'),
            'width'     => '100',
            'index'     => 'billing_region',
        ));
		
		$this->addColumn('billing_country_id', array(
            'header'    => Mage::helper('customer')->__('Country'),
            'width'     => '100',
            'type'      => 'country',
            'index'     => 'billing_country_id',
        ));
		
		if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('website_id', array(
                'header'    => Mage::helper('customer')->__('Website'),
                'align'     => 'center',
                'width'     => '80px',
                'type'      => 'options',
                'options'   => Mage::getSingleton('adminhtml/system_store')->getWebsiteOptionHash(true),
                'index'     => 'website_id',
            ));
        }
		
        //$this->addExportType('*/*/exportCsv', Mage::helper('bannerslider')->__('CSV'));
        //$this->addExportType('*/*/exportXml', Mage::helper('bannerslider')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('notification');

        $this->getMassactionBlock()->addItem('send_notification', array(
             'label'    => Mage::helper('customer')->__('Send Notification'),
             'url'      => $this->getUrl('*/*/new')
        ));
        return $this;
    }
	
	public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=> true));
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId(), 'store' => $this->getRequest()->getParam('store')));
    }

}