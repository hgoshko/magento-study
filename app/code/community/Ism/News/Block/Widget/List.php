<?php

class Ism_News_Block_Widget_List extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{

    protected function _toHtml() {
		/* @var $list Ism_News_Model_Resource_Article_Collection*/

		$list = Mage::getModel('news/article')->getCollection()
			->addFieldToFilter('published', 1)
			->setOrder('created_date', 'DESC');

		$this->assign('list', $list);
		return parent::_toHtml();
    }


	public function __construct($data = array())
	{
		parent::__construct($data);
		$this->setTemplate('ism_news/widget_list.phtml');
	}

}
