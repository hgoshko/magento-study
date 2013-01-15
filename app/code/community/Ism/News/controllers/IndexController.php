<?php


class Ism_News_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout()->renderLayout();
    }

    public function viewAction(){
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('news/article')->load($id);
        Mage::register('ism_news_article', $model);

        if (!$model->getId()) {
            $this->_forward('noRoute');
            return;
        }

        $this->loadLayout()->renderLayout();
    }



}
