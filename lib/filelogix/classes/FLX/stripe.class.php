<?php

/**
 * FILELOGIX STRIPE CLASS
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 *
 *
 * @description This class will handle the integration with the Stripe.com API
 *
 */ 

 
//require_once(SMARTY_DIR . 'Smarty.class.php');
//require_once(BASEDIR . 'plugins/resource.db.php');
//require_once(SMARTY_DIR . "sysplugins/smarty_internal_debug.php");

namespace FLX;
 
require_once("/var/www/html/lib/stripe/1.17.1.2/lib/Stripe.php");
 
class stripe
{  
    // Will store database connection here
	private $db;
	private $stripe;
	private $mode;
	private $errorMsg;
	private $customerID;
	private $cardID;
	private $stripeID;
	private $stripeKey;
	
	public function __construct($db, $mode, $stripeKey) {

		  $this->mode = $mode;
		  $this->db = $db;
		  $this->stripeKey = $stripeKey;
				
	}
		
	public function createCustomer($token, $customer) {

					error_log("Stripe: Create Customer");

				  if($token!= "") {
						// Set your secret key: remember to change this to your live secret key in production
						// See your keys here https://manage.stripe.com/account
						\Stripe::setApiKey($this->stripeKey);
										

						// Create the customer in Stripe
						try {
								$customer = \Stripe_Customer::create(array(
										"description" => $customer["name"],
										"email"=> $customer["emailAddress"],
										"metadata"=>array("customerID" => $customer["id"]),
										"card" => $token // obtained with Stripe.js
									));
								error_log("Stripe Create Customer: " . $customer["id"]);
								$this->customerID = $customer["id"];
								$this->stripeID = $this->db->insert("FLX_STRIPE", array("customer"=>$customer["id"]));
								
						} catch(Stripe_CardError $e) {
			
									$this->errorMsg = "An error occurred while attempting to save credit card.";
						}
						
/*
						
						// Create the charge on Stripe's servers - this will charge the user's card
						try {
							$charge = \Stripe_Charge::create(array(
							  "amount" => $totalCostStr, // amount in cents, again
							  "currency" => "usd",
							  "customer"=> $customer["id"],
							  "description" => "$eventName on $eventDate (" . session_id() . ")")
						);
			
						$ticket->markAsPaid(session_id(), $token, $totalCost, serialize($charge));
						$this->vars["successMsg"] = "You have been charged $" . $this->vars["totalCost"] ." for the following:";
						$this->vars["attendees"] = $ticket->getAttendeesBySession();
						
						
						session_regenerate_id();
						$this->view = "EVENTS_PAID";
						
						
						return true;
						
						} catch(Stripe_CardError $e) {
			
									error_log("Stripe Charge Error: " . $e);
									$this->vars["errorMsg"] = "An error occurred while attempting to charge the card you provided.";
									$this->view = "EVENTS_CCPAY";
									return true;
						}
*/
				return $this->stripeID;	
			}
					
	}

		
	public function updateCustomer($token, $customerID, $cust) {

		    if($token!= "") {
						// Set your secret key: remember to change this to your live secret key in production
						// See your keys here https://manage.stripe.com/account
						\Stripe::setApiKey($this->stripeKey);
																
						try {
						

								$stripe = $this->getStripeByCustomerID($customerID);
								$customer = \Stripe_Customer::retrieve($stripe["stripeCustomer"]);
								$customer->card = $token; // obtained with Stripe.js

								error_log("Stripe Update Customer: " . print_r($stripe, true));	
								error_log("Stripe Update Customer: " . print_r($customer, true));	

								$result = $customer->save();
								$this->customerID = $customer["id"];
		
								return $result["id"];				

						} catch(Stripe_CardError $e) {
									error_log("An error occurred while attempting to update");
									$this->errorMsg = "An error occurred while attempting to save credit card.";
						}
							
						error_log("Stripe Update Customer Finished");
					
						

				return false;
			}
					
	}
	


	public function getCustomerID($stripeID) {
		
		$stripeIDStr = $this->db->quote($stripeID);
		
		$r=$this->db->query("select * from FLX_STRIPE where id = $stripeID ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		if ($results["customer"]) {
			return $results["customer"];
		}
		else {
			return false;
		}		
	}

	public function getStripeByCustomerID($customerID) {
		
		$customerIDStr = $this->db->quote($customerID);
		
		$r=$this->db->query("select FLX_CUSTOMERS.*, FLX_STRIPE.customer as stripeCustomer, FLX_STRIPE.creditcard as stripeCard, FLX_STRIPE.id as stripeID from FLX_STRIPE left join FLX_CUSTOMERS on (FLX_CUSTOMERS.stripeID = FLX_STRIPE.id) where FLX_CUSTOMERS.id = $customerIDStr ");
		 
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		return $results;		
	}
		
	public function getCard($cardID) {
		
	}

	public function chargeCustomer($customerID, $cardID, $amount) {
		
	}
	
}

?>