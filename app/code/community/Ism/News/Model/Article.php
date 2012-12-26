<?php
/**
 * Created by JetBrains PhpStorm.
 * User: e.goshko
 * Date: 12/26/12
 * Time: 10:01 AM
 * To change this template use File | Settings | File Templates.
 */

class Ism_News_Model_Article extends Mage_Core_Model_Abstract {

	public function _construct()
	{
		parent::_construct();
		$this->_init('news/article');
	}


}