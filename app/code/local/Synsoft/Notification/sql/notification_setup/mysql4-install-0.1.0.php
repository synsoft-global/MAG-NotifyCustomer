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
 * @category 	Magestore
 * @package 	Magestore_Bannerslider
 * @copyright 	Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license 	http://www.magestore.com/license-agreement.html
 */

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * create bannerslider table
 */
$installer->run("

DROP TABLE IF EXISTS {$this->getTable('notification_user')};

CREATE TABLE {$this->getTable('notification_user')} (
  `notification_id` int(10) NOT NULL AUTO_INCREMENT,
  `notification_title` varchar(250) NOT NULL,
  `notification_message` text NOT NULL,
  `receivers` text NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

");

$installer->endSetup();

