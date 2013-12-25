<?php

class Synsoft_Notification_Block_Adminhtml_Notification_View extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('notificationGrid');
        $this->setDefaultSort('notification_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
		$this->setUseAjax(true);
    }
	
	protected function _prepareCollection() 
	{    
		$collection = Mage::getModel('notification/notification')->getCollection();
		
		/*$data = $collection->getData();
		$reciver_list = array();
        foreach($data as $user_data){
			foreach(json_decode($user_data['receivers']) as $k=>$user_list){
				$reciver_list[$k] = $this->getCustomerName($user_list);
			}
		}
		//print_r($reciver_list);die();
		//$collection->setData('receivers',$reciver_list);
		//print_r($collection);die();*/
		$this->setCollection($collection);
		
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() 
	{
		$this->addColumn('notification_id', array(
            'header'    => Mage::helper('notification')->__('ID'),
            'width'     => '50',
            'index'     => 'notification_id',
            'type'  => 'number',
        ));
		
		$this->addColumn('notification_title', array(
            'header'    => Mage::helper('notification')->__('Title'),
			'width'     => '150',
            'index'     => 'notification_title'
        ));
        $this->addColumn('notification_message', array(
            'header'    => Mage::helper('notification')->__('Message'),
            'width'     => '350',
            'index'     => 'notification_message'
        ));		
		$this->addColumn('receivers', array(
            'header'    => Mage::helper('notification')->__('Receivers'),
            'width'     => '150',
            'index'     => 'receivers',
			'renderer'  => new Synsoft_Notification_Block_Adminhtml_Notification_Grid_Renderer_CustomerDetail(),			
        ));
		$this->addColumn('created_on', array(
            'header'    => Mage::helper('notification')->__('Created On'),
            'width'     => '150',
            'index'     => 'created_on'
        ));
		$this->addColumn('action',
            array(
                'header'    => Mage::helper('notification')->__('Action'),
                'index'     =>'notification_id',
				'type'      => 'action',
                'getter'    => 'getId',
				'actions'   => array(
                    array(
                        'caption'   => Mage::helper('notification')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'sortable' =>false,
                'filter'   => false,
                'no_link' => false,
                'width'	   => '100',
        ));
		return parent::_prepareColumns();
    }
	
	protected function _prepareMassaction() 
	{
        $this->setMassactionIdField('notification_id');
        $this->getMassactionBlock()->setFormFieldName('notification');

		$this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('notification')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('notification')->__('Are you sure?')
        ));
        return $this;
    }
	
	public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=> true));
    }

    public function getRowUrl($row) 
	{
        return $this->getUrl('*/*/edit', array('id' => $row->getId(), 'store' => $this->getRequest()->getParam('store')));
    }	
	
}