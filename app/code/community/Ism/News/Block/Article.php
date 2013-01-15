<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elena
 * To change this template use File | Settings | File Templates.
 */
class Ism_News_Block_Article extends Mage_Core_Block_Template {

    public function getArticle() {
        return Mage::registry('ism_news_article');
    }

}