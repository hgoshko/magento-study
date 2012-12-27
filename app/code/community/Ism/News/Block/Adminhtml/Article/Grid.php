<?php
/**
 * Created by JetBrains PhpStorm.
 * User: e.goshko
 * Date: 12/26/12
 * Time: 4:33 PM
 * To change this template use File | Settings | File Templates.
 */

class Ism_News_Block_Adminhtml_Article_Grid extends Mage_Adminhtml_Block_Widget_Grid{

	public function __construct()
	{
		parent::__construct();
		$this->setId('newsArticleGrid');
		$this->setDefaultSort('article_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel('news/article')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
		$this->addColumn('article_id', array(
			'header'    => Mage::helper('news/article')->__('ID'),
			'align'     => 'right',
			'width'     => '50px',
			'index'     => 'article_id',
		));

		$this->addColumn('title', array(
			'header'    => Mage::helper('news/article')->__('Title'),
			'align'     => 'left',
			'index'     => 'title',
		));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}

}