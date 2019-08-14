<?php
class Sag_Gallery_CategoryController extends Mage_Core_Controller_Front_Action
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