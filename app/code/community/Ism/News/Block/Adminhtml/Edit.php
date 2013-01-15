<?php

class Ism_News_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'news';
        $this->_controller = 'adminhtml_article';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('cms')->__('Save Article'));
        $this->_updateButton('delete', 'label', Mage::helper('cms')->__('Delete Article'));

    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
            return Mage::helper('cms')->__('New Article');
    }

}
