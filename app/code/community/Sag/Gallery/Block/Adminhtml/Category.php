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
 
class Sag_Gallery_Block_Adminhtml_Category extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_category';
    $this->_blockGroup = 'gallery';
    $this->_headerText = Mage::helper('gallery')->__('Category Manager');
    $this->_addButtonLabel = Mage::helper('gallery')->__('Add Category');
    parent::__construct();
  }
  
  
}