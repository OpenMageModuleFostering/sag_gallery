<?php
class Sag_Gallery_Block_Gallery extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		parent::_prepareLayout();
		
		if (!$this->hasData('gallery')) {
			$current_cat =$this->getRequest()->getParam('cat');
			
			$collection = Mage::getModel('gallery/gallery')->getCollection()->addFieldToFilter("category", $current_cat);
			$this->setCollection($collection);
			
			////////////////////////   per page setting get value from configuration setting  //////////////////////////////
			$_module_img_item_per_page = Mage::getStoreConfig('saggallery/general/gallery_img_item_per_page',Mage::app()->getStore());
			if($_module_img_item_per_page==''){
				$per_page = array(10=>10,20=>20,30=>30,'all'=>'all');
			}else{
				$ar = explode(',',$_module_img_item_per_page);
				for($i=0; $i<count($ar); $i++){
					$val = $ar[$i];
					$per_page[$val] = $val;
				}
				$per_page['all'] = 'all';
			}
			////////////////////////   per page setting get value from configuration setting  //////////////////////////////
				
			$pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
			$pager->setAvailableLimit($per_page);
			$pager->setCollection($this->getCollection());
			$this->setChild('pager', $pager);
			$this->getCollection()->load();
			return $this;
		}
    }
    
    /*public function getGallery()     
    { 
        if (!$this->hasData('gallery')) {
			$current_cat =$this->getRequest()->getParam('cat');
			
            $this->setData('gallery', Mage::getModel('gallery/gallery')->getCollection()->addFieldToFilter("category", $current_cat));
        }
        return $this->getData('gallery');
    }*/
	
	public function getPagerHtml()
	{
		return $this->getChildHtml('pager');
	}
	
	
	
	
	public function getImage()     
    { 
        if (!$this->hasData('gallery')) {
			$current_img =$this->getRequest()->getParam('img');
            $this->setData('gallery', Mage::getModel('gallery/gallery')->getCollection()->addFieldToFilter("gallery_id", $current_img));
        }
        return $this->getData('gallery');
        
    }
	
	public function getCategoryById()     
    {   $current_cat =$this->getRequest()->getParam('cat');
        $this->setData('cat',Mage::getModel('gallery/category')->getCollection()->addFieldToFilter("category_id", $current_cat));
		
		$catcount = count($this->getData('cat'));
		if($catcount > 0 ):
			foreach ($this->getData('cat') as $catTitle):
				echo $catTitle->getTitle();
			endforeach;
		endif;
			
        //return $this->getData('cat');
    }
	
	
	/**
	 * Resize Image proportionally and return the resized image url
	 *
	 * @param string $imageName         name of the image file
	 * @param integer|null $width       resize width
	 * @param integer|null $height      resize height
	 * @param string|null $imagePath    directory path of the image present inside media directory
	 * @return string               full url path of the image
	 */
	public function resizeImage($imageName, $width=NULL, $height=NULL, $imagePath=NULL)
	{      
		$imagePath = str_replace("/", DS, $imagePath);
		$imagePathFull = Mage::getBaseDir('media') . DS . $imagePath . DS . $imageName;
		 
		if($width == NULL && $height == NULL) {
			$width = 100;
			$height = 100;
		}
		$resizePath = $width . 'x' . $height;
		$resizePathFull = Mage::getBaseDir('media') . DS . $imagePath . DS . $resizePath . DS . $imageName;
				 
		if (file_exists($imagePathFull) && !file_exists($resizePathFull)) {
			$imageObj = new Varien_Image($imagePathFull);
			$imageObj->constrainOnly(TRUE);
			$imageObj->keepAspectRatio(TRUE);
			$imageObj->resize($width,$height);
			$imageObj->save($resizePathFull);
		}
				 
		$imagePath=str_replace(DS, "/", $imagePath);
		$img = Mage::getBaseUrl("media") . $imagePath . "/" . $resizePath . "/" . $imageName;
		return str_replace(DS, "/", $img);
	}
	
}