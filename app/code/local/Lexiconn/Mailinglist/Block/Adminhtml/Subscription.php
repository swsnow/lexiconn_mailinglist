<?php

class Lexiconn_Mailinglist_Block_Adminhtml_Subscription 
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{

      public function __construct(){
                $this->_headerText = Mage::helper('mailinglist')->__('Mailinglist subscriptions');
                $this->_blockGroup = 'mailinglist';
                $this->_controller = 'adminhtml_subscription';
                parent::__construct();
      }

      protected function _prepareLayout()
      {
          //var_dump($this->_blockGroup.'/' . $this->_controller . '_grid');
          //$class = Mage::getConfig()->getBlockClassName('lexiconn_mailinglist/adminhtml_subscription_grid');
          //var_dump($class);
                //$this->_removeButton('add');
                return parent::_prepareLayout();
      }
}