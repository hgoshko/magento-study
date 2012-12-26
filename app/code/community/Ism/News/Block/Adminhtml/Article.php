<?php
/**
 * Created by JetBrains PhpStorm.
 * User: e.goshko
 * Date: 12/26/12
 * Time: 10:31 AM
 * To change this template use File | Settings | File Templates.
 */

class Ism_News_Block_Adminhtml_Article extends Mage_Adminhtml_Block_Widget_Grid_Container {

	public function __construct()
	{
		$this->_controller = 'adminhtml_article';
		$this->_blockGroup = 'news';
		$this->_headerText = Mage::helper('news/article')->__('News Manager');
		$this->_addButtonLabel = Mage::helper('news/article')->__('Add News');
		parent::__construct();
	}

}