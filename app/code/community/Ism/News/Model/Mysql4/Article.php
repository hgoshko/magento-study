<?php
/**
 * Created by JetBrains PhpStorm.
 * User: e.goshko
 * Date: 12/26/12
 * Time: 10:03 AM
 * To change this template use File | Settings | File Templates.
 */

class Ism_News_Model_Mysql4_Article extends Mage_Core_Model_Mysql4_Abstract {

	public function _construct() {
		$this->_init('news/article', 'article_id');
	}

}