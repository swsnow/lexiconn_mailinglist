<?php


class Lexiconn_Mailinglist_Block_Subscriptionforminline
    extends Mage_Core_Block_Template 
    implements Mage_Widget_Block_Interface

{
   
   public $html;
   
   public $customFields;
    
   public function __construct(){
       $this->html = "";
       
       $this->customFields = "";
       
       
   }
   
   protected function getCustomField($id){
       $helper = Mage::helper('mailinglist');
       $fieldData = $helper->getCustomField($id);
       
       return fieldData;
   }
   
   
   protected function getCaptcha(){
       $block = $this->getLayout()->createBlock('captcha/captcha');
       
       $html = "Test 123";
       return $html;
       
   }

   protected function _toHtml()
   {

     $this->setTemplate('mailinglist/subscriptionform/subscription_form_inline.phtml');

       $html = $this->renderView();
       
       return $html;
   }

};