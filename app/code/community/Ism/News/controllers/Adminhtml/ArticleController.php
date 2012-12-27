<?php
/**
 * Created by JetBrains PhpStorm.
 * User: e.goshko
 * Date: 12/27/12
 * Time: 11:29 AM
 * To change this template use File | Settings | File Templates.
 */

class Ism_News_Adminhtml_ArticleController extends Mage_Adminhtml_Controller_action
{
	protected function _initAction()
	{
		$this->loadLayout()
			->_setActiveMenu('news/article')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('News Manager'), Mage::helper('adminhtml')->__('News Manager'));
		return $this;
	}

	public function indexAction()
	{
		$this->_initAction()
			->renderLayout();
	}

	public function newAction(){
		$this->_forward('edit');
	}


	public function editAction()
	{


		$id = $this->getRequest()->getParam('id');
		$model = Mage::getModel('news/article')->load($id);
		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}
			Mage::register('news_data', $model);
			$this->loadLayout();
			$this->_setActiveMenu('news/articles');
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'),
								  Mage::helper('adminhtml')->__('News Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'),
								  Mage::helper('adminhtml')->__('Item News'));
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock('news/adminhtml_articles_edit'))
				->_addLeft($this->getLayout()->createBlock('news/adminhtml_articles_edit_tabs'));
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
}
