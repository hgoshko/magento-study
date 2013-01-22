<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Ism_News_Block_Adminhtml_Article_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('article_form');
        $this->setTitle('Article information');
    }

    /**
     * Load Wysiwyg on demand and Prepare layout
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    protected function _prepareForm()
    {
        $article = Mage::registry('ism_news_article');
        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );
        $form->setHtmlIdPrefix('block_');
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'=>Mage::helper('cms')->__('General Information'),
            'class' => 'fieldset-wide'));

        if ($article->getArticleId()) {
            $fieldset->addField('article_id', 'hidden', array(
                'name' => 'article_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('news')->__('Article Title'),
            'title'     => Mage::helper('news')->__('Article Title'),
            'required'  => true,
        ));

      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('cms')->__('Content'),
          'title'     => Mage::helper('cms')->__('Content'),
          'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
		  'required'  => true,
      ));

        $dateFormatIso = Mage::app()->getLocale()->getDateFormat(
            Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
        );

        $fieldset->addField('publish_date', 'date', array(
            'name'      => 'publish_date',
            'label'     => Mage::helper('cms')->__('Publish date'),
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => $dateFormatIso,
        ));

        $fieldset->addField('announce', 'textarea', array(
            'name'      => 'announce',
            'label'     => Mage::helper('cms')->__('Announce'),
            'title'     => Mage::helper('cms')->__('Announce'),
        ));

        $fieldset->addField('published', 'select', array(
            'label'     => Mage::helper('cms')->__('Published'),
            'title'     => Mage::helper('cms')->__('Published'),
            'name'      => 'published',
            'required'  => true,
            'options'   => array(
                '0' => Mage::helper('cms')->__('No'),
                '1' => Mage::helper('cms')->__('Yes'),
            ),
        ));

        $form->setValues($article->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
