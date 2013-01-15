<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elena
 * To change this template use File | Settings | File Templates.
 */
class Ism_News_Block_List extends Mage_Core_Block_Template {

    public function getCollection() {
        return Mage::getModel('news/article')->getCollection()->addFieldToFilter('published', 0);
    }

}