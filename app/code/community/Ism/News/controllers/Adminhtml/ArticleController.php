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
        Mage::register('ism_news_article', $model);

		if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
			$this->loadLayout();
			$this->_setActiveMenu('news/articles');
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'),
								  Mage::helper('adminhtml')->__('News Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'),
								  Mage::helper('adminhtml')->__('Item News'));
			$this->_addContent($this->getLayout()->createBlock('news/adminhtml_articles_edit'))
				->_addLeft($this->getLayout()->createBlock('news/adminhtml_articles_edit_tabs'));
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}



    /**
     * Save action
     */
    public function saveAction()
    {
        // check if data sent
        if ($data = $this->getRequest()->getPost()) {
            $id = $this->getRequest()->getParam('article_id');
            $model = Mage::getModel('news/article')->load($id);
            if (!$model->getId() && $id) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('cms')->__('This article no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
            // init model and set data
            $model->setData($data);
            // try to save it
            try {
                // save the data
                $model->save();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('cms')->__('The article has been saved.'));
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('article_id' => $model->getId()));
                    return;
                }
                // go to grid
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // save data in session
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                // redirect to edit form
                $this->_redirect('*/*/edit', array('article_id' => $this->getRequest()->getParam('article_id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Delete action
     */
    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                // init model and delete
                $model = Mage::getModel('news/article');
                $model->load($id);
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('cms')->__('The article has been deleted.'));
                // go to grid
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('article_id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('cms')->__('Unable to find an article to delete.'));
        // go to grid
        $this->_redirect('*/*/');
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('ism_news/article');
    }

}
