<?php
/**
 * SAGIPL
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * 
 * @category   	SAGIPL
 * @package	Sag_Gallery
 * @copyright  	Copyright (c) 2014 SAGIPL. (http://www.sagipl.com/)
 * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Simple Images Gallery with Categories
 *
 * @category	SAGIPL
 * @package	Sag_Gallery
 * @author	Navneet <navneet.kshk@gmail.com>
 */
 
class Sag_Gallery_ImageController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
	
		$_module_enabaled = Mage::getStoreConfig('saggallery/general/gallery_enabled_select_box',Mage::app()->getStore());
		
		if($_module_enabaled==1){
			$this->loadLayout();     
			$this->renderLayout();
		}else{
			$this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
			$this->getResponse()->setHeader('Status','404 File not found');
			$this->_forward('defaultNoRoute');
		}
    }
}