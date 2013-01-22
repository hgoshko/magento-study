<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elena
 * To change this template use File | Settings | File Templates.
 */
class Ism_News_Block_List extends Mage_Core_Block_Template {

    public function getCollection() {
		$limit = $this->getRequest()->getParam('limit');
		return Mage::getModel('news/article')->getResourceCollection()
						->setPageSize($limit)
						->addFieldToFilter('published', 1)
						->setOrder('publish_date', 'DESC');
   }

}