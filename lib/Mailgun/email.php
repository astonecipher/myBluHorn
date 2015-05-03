<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;

		$mg = new \Mailgun\Mailgun("key-48c0a228297f5e095233b236cd4bda7d");
		$domain = "bluhorn.com";

		$mg->sendMessage($domain, array('from'    => 'wbenwick@bluhorn.com', 
                                'to'      => 'wbenwick@gmail.com', 
                                'subject' => 'The PHP SDK is awesome!', 
                                'text'    => 'It is so simple to send a message.'));	
?>
