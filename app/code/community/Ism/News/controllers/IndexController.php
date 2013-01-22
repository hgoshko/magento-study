<?php


class Ism_News_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout()->renderLayout();
    }

    public function viewAction(){

		$id = $this->getRequest()->getParam('id');

		$article = Mage::getModel('news/article')->load($id);
		if ((!$article->getId()) || (!$article->getPublished()) ) {
			 $this->_forward('noRoute');
			 return;
		}

		Mage::register('ism_news_article', $article);
		$this->loadLayout()->renderLayout();
    }


}
