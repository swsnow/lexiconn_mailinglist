<?php

class Lexiconn_Mailinglist_Block_Adminhtml_System_Config_Form_Button extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /*
     * Set template
     */
    protected function _construct()
    {
        Mage::fireLog("Button instantiated", "Button");
        parent::_construct();
        
        
        $this->setTemplate('lexiconn/mailinglist/system/config/button.phtml');
    }
 
    /**
     * Return element html
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }
 
    /**
     * Return ajax url for button
     *
     * @return string
     */
    public function getAjaxCheckUrl()
    {
        return Mage::helper('adminhtml')->getUrl('adminhtml/adminhtml_lexiconn_mailinglist/check');
    }
 
    /**
     * Generate button html
     *
     * @return string
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
            'id'        => 'atwixtweaks_button',
            'label'     => $this->helper('adminhtml')->__('Create Form'),
            'onclick'   => 'javascript:check(); return false;'
        ));
 
        return $button->toHtml();
    }
}