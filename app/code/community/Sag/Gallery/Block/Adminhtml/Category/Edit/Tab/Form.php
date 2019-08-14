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
 
class Sag_Gallery_Block_Adminhtml_Category_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('category_form', array('legend'=>Mage::helper('gallery')->__('Category information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('gallery')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
	  
 
      $fieldset->addField('filename', 'image', array(
          'label'     => Mage::helper('gallery')->__('Image'),
          'required'  => true,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('gallery')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('gallery')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('gallery')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('gallery')->__('Content'),
          'title'     => Mage::helper('gallery')->__('Content'),
          'style'     => 'width:700px; height:200px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getCategoryData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getCategoryData());
          Mage::getSingleton('adminhtml/session')->setCategoryData(null);
      } elseif ( Mage::registry('category_data') ) {
          $form->setValues(Mage::registry('category_data')->getData());
      }
      return parent::_prepareForm();
  }
}