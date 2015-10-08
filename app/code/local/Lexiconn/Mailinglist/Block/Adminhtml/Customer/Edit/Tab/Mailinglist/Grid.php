<?php

class Lexiconn_Mailinglist_Block_Adminhtml_Customer_Edit_Tab_Mailinglist_Grid 
    extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('customer_subscription');
        $this->setDefaultSort('start_at');
        $this->setDefaultDir('desc');
        
        //$customer = Mage::registry('current_customer');
       // Mage::register('lex_customer', $customer);
       // Mage::fireLog($customer, "Set Customer");

        $this->setUseAjax(true);

        $this->setEmptyText(Mage::helper('customer')->__('No Newsletter Found'));

    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/newsletter', array('_current'=>true));
    }

    protected function _prepareCollection()
    {
        $email = Mage::registry('subscriber')->getEmail();
        $customer_id = Mage::registry('current_customer')->getId();
        
        Mage::fireLog($customer_id);
        Mage::fireLog($email);
        
        $helper = Mage::helper('mailinglist');
        $items = $helper->getSubscriberInfo($email);
       
        $collection = new Varien_Data_Collection();
        
        
        if($items != FALSE){
            foreach ($items as $item) {
                $listid = $item['listid'];
                $item['id'] = $customer_id . ":" . $email . ':' . $listid;
                /*
                $item['id'] = array("customer_id" => $customer_id,
                                    "email"       => $email,
                                    "listid"      => $listid,
                );
                */
                $varienObject = new Varien_Object();
                $varienObject->setData($item);
                $collection->addItem($varienObject);
                
            }
        }
        
       // Mage::fireLog($collection, "COLLECTION");
        
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        
        
        $this->addColumn('listid', array(
            'header'    =>  Mage::helper('customer')->__('List ID'),
            'align'     =>  'left',
            'index'     =>  'listid',
            'width'     =>  10
        ));
        
       
        
        $this->addColumn('listname', array(
                'header'    =>  Mage::helper('customer')->__('List Name'),
                'align'     =>  'center',
                'index'     =>  'listname'
        ));
        
        $this->addColumn('sdate', array(
                'header'    =>  Mage::helper('customer')->__('Subscription Date'),
                'type'      =>  'datetime',
                'align'     =>  'center',
                'index'     =>  'sdate',
                'default'   =>  ' ---- '
        ));

        $this->addColumn('first_name', array(
            'header'    =>  Mage::helper('customer')->__('First Name'),
            'align'     =>  'center',
            'index'     =>  'first_name'
        ));
        
        $this->addColumn('last_name', array(
                'header'    =>  Mage::helper('customer')->__('Last Name'),
                'align'     =>  'center',
                'index'     =>  'last_name'
        ));


         $this->addColumn('status', array(
            'header'    =>  Mage::helper('customer')->__('Status'),
            'align'     =>  'center',
            //'filter'    =>  'adminhtml/customer_edit_tab_newsletter_grid_filter_status',
            'index'     => 'status',
            'renderer'  =>  new Lexiconn_Mailinglist_Block_Adminhtml_Customer_Edit_Tab_Mailinglist_Renderer_Status()
        ));

        $this->addColumn('udate', array(
            'header'    =>  Mage::helper('customer')->__('Unsubscribe Date'),
            'type'      =>  'datetime',
            'align'     =>  'center',
            'index'     =>  'udate',
            'default'   =>  ' ---- '
        ));
        
   /*
        $this->addColumn('action', array(
            'header'    =>  Mage::helper('customer')->__('Action'),
            'align'     =>  'center',
            'filter'    =>  false,
            'sortable'  =>  false,
            'renderer'  =>  'adminhtml/customer_edit_tab_newsletter_grid_renderer_action'
        ));
   */

        return parent::_prepareColumns();
    }
    
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem('newsletter_resubscribe', array(
                'label'    => Mage::helper('customer')->__('Resubscribe to Newsletter'),
                'url'      => $this->getUrl('*/mailinglist_subscriber/resubscribe'),
                'confirm'  => Mage::helper('customer')->__('Resubscribe customer to selected list(s)?')
                 
        ));
        
        $this->getMassactionBlock()->addItem('newsletter_unsubscribe', array(
             'label'    => Mage::helper('customer')->__('Unsubscribe from Newsletter'),
             'url'      => $this->getUrl('*/mailinglist_subscriber/unsubscribe'),
             'confirm'  => Mage::helper('customer')->__('Unsubscribe customer from selected list(s)?')
   
        ));
        
        $this->getMassactionBlock()->addItem('newsletter_delete', array(
                'label'    => Mage::helper('customer')->__('Remove from List'),
                'url'      => $this->getUrl('*/mailinglist_subscriber/remove'),
                'confirm'  => Mage::helper('customer')->__('Permanently remove customer from selected list(s)?')
        ));

        return $this;
    }
    
    protected function _getCollectionClass()
    {
        return 'mailinglist/order_grid_collection';
    }
    
    public function getRowUrl($row)
    {
        if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/view')) {
            return $this->getUrl('*/sales_order/view', array('order_id' => $row->getId()));
        }
        return false;
    }

}
    