<?php

class Lexiconn_Mailinglist_Block_Adminhtml_System_Config_Custombutton extends Mage_Adminhtml_Block_System_Config_Form_Field  implements Varien_Data_Form_Element_Renderer_Interface{

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $buttonBlock = Mage::app()->getLayout()->createBlock('adminhtml/widget_button');

        $params = array(
            'website' => $buttonBlock->getRequest()->getParam('website')
        );

        $data = array(
            'label'     => Mage::helper('adminhtml')->__('Create Form'),
            'onclick'   => 'setLocation(\''.Mage::helper('adminhtml')->getUrl("*/mailinglist/createform", $params) . '\' )',
            'class'     => '',
        );

        $html = $buttonBlock->setData($data)->toHtml();

        return $html;
    }
}