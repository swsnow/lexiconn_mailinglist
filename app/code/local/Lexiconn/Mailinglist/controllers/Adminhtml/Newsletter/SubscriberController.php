<?php

require_once("/home/stevemagento/www/app/code/core/Mage/Adminhtml/controllers/Newsletter/SubscriberController.php");


class Lexiconn_Mailinglist_Adminhtml_Newsletter_SubscriberController extends Mage_Adminhtml_Newsletter_SubscriberController
{
    
    public function gridAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('adminhtml/mailinglist_subscriber_grid');
        
        
        $this->getResponse()->setBody($block->toHtml());
      
    }
    
 
//lexSubscribe
	public function lexSubscribeAction()
	{
        
	    $subscribersIds = $this->getRequest()->getParam('subscriber');
	    $email = $this->getRequest()->getParam('email');
	    $listid = $this->getRequest()->getParam('list');
	    
	    if(!is_array($subscribersIds)) {
	        Mage::getSingleton('adminhtml/session')->addError($this->__('Please select subscriber(s).'));
	    } else {
	    
	        // try {
	        $model = Mage::getModel('newsletter/subscriber');
	    
	        foreach ($subscribersIds as $id) {
	            $subscriber = $model->load($id);
	            
	            $email = $subscriber->getSubscriberEmail();
	            
	            $helper = Mage::helper('mailinglist');
	            $lexsubscriber = $helper->lexiconnSubscriber($email);
	            
	            if($lexsubscriber=='Magento Default List'){
	                Mage::fireLog("Magento Default List", "Add Subscriber");
	                
	            } else{
	                
	                $email = $subscriber->subscriber_email;
	                $cid = $subscriber->customer_id;
	                $sid = $subscriber->subscriber_id;
	                	
	                $customer = Mage::getSingleton('customer/customer')->load($cid);
	                	
	                $first_name = $customer->getFirstname();
	                $last_name  = $customer->getLastname();
	                
	                Mage::fireLog($sid . ":" . $email, "Add Subscriber");
	                
	                $options = array("id"	=> $sid,
	                        "email"      	=> $email,
	                        "first_name" 	=> $first_name,
	                        "last_name"  	=> $last_name,
	                        "listid"        => Mage::getStoreConfig('mailinglist/general/list_id'),
	                );
	                
	                $helper = Mage::helper('mailinglist');
	                $output = $helper->addSubscriber($options);
	                
	                Mage::fireLog($output, "TRUEFALSE");
	                
	                if($output == FALSE){
	                   // Mage::getSingleton('adminhtml/session')->addError(
	                   // Mage::helper('adminhtml')->__($helper->getErrorMessage())
	                    //);
	                } else{
	                    //Mage::getSingleton('adminhtml/session')->addSuccess(
	                       //Mage::helper('adminhtml')->__($helper->getSuccessMessage())
	                    //);
	                }
	                 
	                $remote_subscriber_id = $output['subscriber_id'];
	                
	            }
	        }
	         
	    }
	    /*
		$subscribersIds = $this->getRequest()->getParam('subscriber');
		
		Mage::fireLog($subscribersIds);
		die();
		if (!is_array($subscribersIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('newsletter')->__('Please select subscriber(s)'));
		}
		else {
			try {
				
				$success_count = 0;
				
				foreach ($subscribersIds as $subscriberId) {
					$subscriber = Mage::getModel('newsletter/subscriber')->load($subscriberId);
					$email = $subscriber->subscriber_email;
					$cid = $subscriber->customer_id;
					$sid = $subscriber->subscriber_id;
					
					$customer = Mage::getSingleton('customer/customer')->load($cid);
					
					$first_name = $customer->getFirstname();
    				$last_name  = $customer->getLastname();
    				
		    		$options = array("id"	=> $sid,
		    				"email"      	=> $email,
		    				"first_name" 	=> $first_name,
		    				"last_name"  	=> $last_name,
		    		);
		    
		    		$helper = Mage::helper('mailinglist');
		    		$output = $helper->addSubscriber($options);
		    		
		    		if($output == FALSE){
		    			Mage::getSingleton('adminhtml/session')->addError(
		    				Mage::helper('adminhtml')->__($helper->getErrorMessage())
		    			);
		    		} else{
		    			Mage::getSingleton('adminhtml/session')->addSuccess(
		    				Mage::helper('adminhtml')->__($helper->getSuccessMessage())
		    			);
		    		}
		    	
		    		$remote_subscriber_id = $output['subscriber_id'];

				}
			
				
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			*/
		//}
	
		//$this->_redirect('*/*/index');
	}
	
	public function lexCustomerAction(){
		
		$email = $this->getRequest()->getParam('email');
		$listid = $this->getRequest()->getParam('list');
		
		if(!is_array($adListingIds)) {
		    Mage::getSingleton('adminhtml/session')->addError($this->__('Please select subscriber(s).'));
		} else {
		      
		     // try {
		        $subscriber = Mage::getModel('newsletter/subscriber')->load($subscriberId);
		        $model = Mage::getModel('newsletter/subscriber');
		        
		        foreach ($listid as $id) {
		            Mage::fireLog($model->load($id), "Subscriber Model");
		        }

    		  /*
    			$subscriber = Mage::getModel('newsletter/subscriber')->load($subscriberId);
    			$email = $subscriber->subscriber_email;
    			$cid = $subscriber->customer_id;
    			$sid = $subscriber->subscriber_id;
    				
    			$customer = Mage::getSingleton('customer/customer')->load($cid);
    				
    			$first_name = $customer->getFirstname();
    			$last_name  = $customer->getLastname();
    			
    			$options = array("id"	=> $subscriber_id,
    					"email"      	=> $email,
    					"first_name" 	=> $first_name,
    					"last_name"  	=> $last_name,
    					"listid"		=> $listid,
    			);
    
    			
    			
    			$helper = Mage::helper('mailinglist');
    			$output = $helper->addSubscriber($options);
    			
    			if($output == FALSE){
    				print_r("Failed");
    			} else{
    				print_r("Success");
    			}
    			*/
		}	 
   
	}

}
