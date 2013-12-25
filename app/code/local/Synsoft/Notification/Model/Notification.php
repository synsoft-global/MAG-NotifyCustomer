<?php
/**
 * Adminhtml form container block
 *
 * @category 	Notification
 * @package 	Synsoft_Notification
 * @author  	Synsoft Global Developer
 */
class Synsoft_Notification_Model_Notification extends Mage_Core_Model_Abstract 
{
	public function _construct()
    {
        parent::_construct();
        $this->_init('notification/notification');
    }

    protected function _beforeSave() 
	{		
		$defaultStore = Mage::getModel('notification/notification')->load($this->getId());
		$storeAttributes = $this->getStoreAttributes();
		//var_dump($storeAttributes);
		//print_r($this->getData());
		//print_r($this->getMyPostedField());
		//exit("hello");
		//$storeAttributes = $this->getStoreAttributes();
	
		/*foreach ($storeAttributes as $attribute) {
			if ($this->getData($attribute . '_default')) {
				$this->setData($attribute . '_in_store', false);
			} else {
				$this->setData($attribute . '_in_store', true);
				$this->setData($attribute . '_value', $this->getData($attribute));
			}
			$this->setData($attribute, $defaultStore->getData($attribute));
		}*/
        
        return parent::_beforeSave();
    }

    protected function _afterSave() {
	
        if ($storeId = $this->getStoreId()) {
            /*$storeAttributes = $this->getStoreAttributes();

            foreach ($storeAttributes as $attribute) {
                $attributeValue = Mage::getModel('bannerslider/value')
                        ->loadAttributeValue($this->getId(), $storeId, $attribute);
                if ($this->getData($attribute . '_in_store')) {
                    try {
                        $attributeValue->setValue($this->getData($attribute . '_value'))->save();
                    } catch (Exception $e) {
                        
                    }
                } elseif ($attributeValue && $attributeValue->getId()) {
                    try {
                        $attributeValue->delete();
                    } catch (Exception $e) {
                        
                    }
                }
            }*/
        }
        return parent::_afterSave();
    }
	
}
