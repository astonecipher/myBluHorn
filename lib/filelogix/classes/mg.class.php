<?php

/**
 * FILELOGIX MG CLASS (uses Mailgun)
 *  
 * @author Wes Benwick
 * @link http://www.filelogix.com
 * @license Part of Filelogix usage license
 *
 *
 * @description This class will handle the composing, sending and downloading of multi-part MIME messages with plain text and Smarty template based content, plus attachments
 *
 */ 

require_once '/var/www/html/lib/Mailgun/Constants/Constants.php';

use Mailgun\Mailgun;

class mg
{  
    // Will store database connection here
	private $db;
	private $template;
	private $domain;
	private $to = array();
	private $cc = array();
	private $bcc = array();
	private $attachments = array();
	private $attachment;
	private $contents;
	private $from;
	private $replyto;
	private $subject;
	private $text = "";
	private $html = "";
	private $randomHash;
	private $didSend;
	private $vars = array();
	private $inliner;
	private $response = array();
	private $messageID;
	private $queue;
	private $status;
	private $sentStamp;
	private $deliveredStamp;
	private $isOpened;
	private $isDelivered;
		
	public function __construct($db, $domain, $template) {

		  $this->db = $db;
		  $this->domain = $domain;
		  $this->template = $template;

		  $this->randomHash = md5(date('r', time()));
		  		  		  
		  $this->vars["boundary"] = "_NextPart-" . $this->randomHash . "\r";
		  $this->vars["begin"] = "\r\n--_NextPart-" . $this->randomHash . "";
		  $this->vars["end"] = "--_NextPart-" . $this->randomHash . "--";
     	  $this->template = new \template($this->db, $this->template);
	}
	
	public function send($mailQueue, $isMIME = false) {

		$mg = new \Mailgun\Mailgun("key-48c0a228297f5e095233b236cd4bda7d");

		$this->queue = $mailQueue;
		
		$this->sentStamp = date("Y-m-d H:i:s");

		if ($isMIME) {

			error_log("Send Mailgun ($isMIME)");

			$attachments = array();
			$attachments[0] = $this->contents;
			
			$this->vars["attachments"] = $attachments;
			
			$this->vars["from"]= $this->from;
			$this->vars["replyto"]= $this->replyto;
			$this->vars["to"] = implode(",", $this->to);
			$this->vars["cc"] = implode(",", $this->cc);
			$this->vars["bcc"] = implode(",", $this->bcc);
			$this->vars["subject"] = $this->subject;
			$this->vars["html"] = $this->html;
			$this->vars["text"] = $this->text;
			
			$message = $this->template->fetch($this->vars);

//			$message = str_replace("\n", "\r\n", $message);
			
			error_log("MIME: " . $message);

			try {
			
				$responseJSON = $mg->sendMessage($this->domain, 
								array('from'=>$this->from, 'to' => implode(",",$this->to), 'reply-to'=>$this->replyto, 'bcc' => implode(",",$this->bcc), 'cc' => implode(",",$this->cc), 'subject' => $this->subject),
                                $message);				
			}
			catch (Exception $e) {		
				
				error_log("Unable to send mail (mime) " . $e->getMessage());
			}
		}

		else {
		
			error_log("Send Mailgun (API)");

			try {
				
				$responseJSON = $mg->sendMessage($this->domain, array('from'    => $this->from, 
                                'to'      => implode(",",$this->to), 
                                'cc'      => implode(",",$this->cc), 
                                'bcc'      => implode(",",$this->bcc), 
                                'subject' => $this->subject,
								'text'    => $this->text,
                                'html'    => $this->html
								));	
			}
			catch (Exception $e) {		
				
				error_log("Unable to send mail (api) " . $e->getMessage());
			}
		}

		$this->response = json_decode(json_encode($responseJSON), true);
		
		error_log("Response:" . print_r($this->response, true));
				
		$this->messageID = $this->response["http_response_body"]["id"];
		
		$this->store();
		
		if ($this->messageID != "") {
			return true;
		}
		
		else {
			return false;
		}
		
	}

	public function vars($vars) {
		
		foreach ($vars as $var) {
			
			array_push($this->vars, $var);
			
		}
		
	}

	public function text($content) {

		$this->text .= $content;
		
		return $this->text;			
	
	}

	public function textByTemplate($templateName, $content = array()) {

		$template = new \template($this->db, $templateName, BASE);
		if ($template->exists("db:" . $templateName)) {
			return $this->text($template->fetch($content));
		}
		else {
			return false;			
		}	
	}		
	
	public function html($content) {
	
		$this->html .= $content;
		return $this->html;			
	}
	
	public function htmlByTemplate($templateName, $content = array()) {
	
		$template = new \template($this->db, $templateName, BASE);
		if ($template->exists("db:" . $templateName)) {
			return $this->content(1,$template->fetch($content));
		}
		else {
			return false;			
		}
	}
	

	public function template($template) {
	
		if (strlen($template)>0) {
			$this->template = $template;
			if ($this->template->exists("db:" . $template)) {
		   	    $this->template = new \template($this->db, $template);
		   	}
		}
		
		return $this->template;
		
	}
	

	public function subject($subject) {
	
		if (strlen($subject)>0) {
			$this->subject = $subject;
		}
		
		return $this->subject;
		
	}
	
	public function to($to) {
	
		if (strlen($to)>0) {
			array_push($this->to, $to);
		}
		
		return $this->to;
		
	}

	public function bcc($bcc) {
	
		if (strlen($bcc)>0) {
			array_push($this->bcc, $bcc);
		}
		
		return $this->bcc;
		
	}

	public function cc($cc) {
	
		if (strlen($cc)>0) {
			array_push($this->cc, $cc);
		}
		
		return $this->cc;
		
	}
			
	public function from($from) {
		if (strlen($from)>0) {
			$this->from = $from;
		}
		
		return $this->from;		
	}
	
	public function replyto($replyto) {
		if (strlen($replyto)>0) {
			$this->replyto = $replyto;
		}
		
		return $this->replyto;		
	}

	public function addCC($cc) {
		
	}
	
	public function addBCC($bcc) {
		
	}
	
	public function addTo($to) {
	
		array_push($this->to, $to);
		
	}

	public function attachment($content) {
	
		array_push($this->attachments, $content);
		$this->attachment = $content;
				
	}

	public function contents($content) {
	
		$this->contents = $content;
				
	}

	public function addFileByURL($fileurl, $filename) {
		    $file = file_get_contents($fileurl);
			
			return $this->addContent("application/octet-stream; name=\"$filename\"",base64_encode($file), "utf-8", "base64\r\nContent-Disposition: attachment");  	
	}

	public function addFileByPath($filepath, $filename) {

		
	}
		
	public function open() {
		
	}

	public function finish() {
		
	}	
	
	public function retrieve() {
		
	}
	
	private function store() {
		
		$mail = array();
		
		$mail["queueID"] = $this->queue;
		$mail["from"] = $this->from;
		$mail["description"] = $this->subject;
		$mail["service"] = "mailgun";
		$mail["status"] = $this->status;
		$mail["refID"] = $this->messageID;
		$mail["to"] = implode(",", $this->to);
		$mail["sentStamp"] = $this->sentStamp;
		
		$this->db->insert("FLX_MAIL", $mail);
	}

	public function update($messageID, $params = array()) {

		$message = $this->getMessageByRefID($messageID);
		
		$this->db->update("FLX_MAIL", "id", $message["id"], $params);
	
	}

	public function getMessageByRefID($messageID) {

		$messageIDStr = $this->db->quote($messageID);
		
		$r = $this->db->query("select * from FLX_MAIL where service='mailgun' and refID = $messageIDStr");
		
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		return $results;

	}

	public function isDelivered($messageID, $delivered) {
		
		$messageIDStr = $this->db->quote($messageID);
		
		if (isset($delivered)) {
		
			if ($delivered) {
				$isDeliveredStr = "1";
			}
			else {
				$isDelveredStr = "0";
			}

			$message = $this->getMessageByRefID($messageID);

			$this->db->update("FLX_MAIL", "id", $message["id"], array("isDelivered"=>$isDeliveredStr));
		}
		
		$r = $this->db->query("select isDelivered from FLX_MAIL where service='mailgun' and refID = $messageIDStr");
		
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		return $results["isDelivered"];
				
	}

	public function isFailed($messageID, $failed) {
		
		$messageIDStr = $this->db->quote($messageID);
		
		if (isset($failed)) {
		
			if ($failed) {
				$isFailedStr = "1";
			}
			else {
				$isFailedStr = "0";
			}

			$message = $this->getMessageByRefID($messageID);

			$this->db->update("FLX_MAIL", "id", $message["id"], array("isFailed"=>$isFailedStr));
		}
		
		$r = $this->db->query("select isFailed from FLX_MAIL where service='mailgun' and refID = $messageIDStr");
		
		$results=$r->fetch(\PDO::FETCH_ASSOC);

		return $results["isFailed"];
				
	}
		
}

?>