<?php

class Lexiconn_Mailinglist_Block_Adminhtml_Renderer_Mailinglist extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
    	 $helper = Mage::helper('mailinglist');
    	 Mage::fireLog($row->getData('subscriber_email'));
    	// $subscriber = '';
        $subscriber = $helper->lexiconnSubscriber($row->getData('subscriber_email'));
        
        Mage::fireLog($subscriber);
         
         echo (string)$subscriber;
    }
}
