<?php

class Email
{
	var $to;
	var $cc;
	var $bcc;
	var $subject;
	var $from;
	var $headers;
	var $html;

	function sendMail()
	{
		$this->to       = NULL;
		$this->cc       = NULL;
		$this->bcc      = NULL;
		$this->subject  = NULL;
		$this->from     = NULL;
		$this->headers  = NULL;
		$this->html     = FALSE;
	}

	function getParams($params)
	{
		$i = 0;
		foreach ($params as $key => $value) {
			switch($key) {
				case 'to':
					$this->to       = $value;
					break;
				case 'cc':
					$this->cc       = $value;
					break;
				case 'bcc':
					$this->bcc       = $value;
					break;
				case 'subject':
					$this->subject  = $value;
					break;
				case 'from':
					$this->from     = $value;
					break;
				case 'submitted':
					NULL;
					break;
				default:
					$this->body[$i]["key"]     = str_replace("_", " ", ucWords(strToLower($key)));
					$this->body[$i++]["value"] = $value;
			}
		}
	}

	function setHeaders()
	{
		$this->headers = "From: $this->from\r\n";
		if($this->html === TRUE) {
			$this->headers.= "MIME-Version: 1.0\r\n";
			$this->headers.= "Content-type: text/html; charset=UTF-8\r\n";
		}
		if(!empty($this->cc))  $this->headers.= "Cc: $this->cc\r\n";
		if(!empty($this->bcc)) $this->headers.= "Bcc: $this->bcc\r\n";
	}

	function parseBody()
	{
		$content = "";
		$count = count($this->body);
		for($i = 0; $i < $count; $i++) {
			if($this->html) $content.= "<b>";
			//$content .= $this->body[$i]["key"].': ';
			if($this->html) $content.= "</b>";
			if($this->html) $content .= nl2br($this->body[$i]["value"])."\n";
			else $content .= $this->body[$i]["value"];
			if($this->html) $content.= "<hr noshade size=1>\n";
			else $content.= "\n".str_repeat("-", 80)."\n";
		}
		if($this->html) {
			$content = "
            <style>
                BODY {
                  font-family: tahoma;
                  font-size: 10;
                  text-align:right;
                  direction:rtl;
                  padding:20px;
                }
            </style>
            ".$content;
		}
		$this->body = $content;
	}

	function send()
	{
		if(mail($this->to, $this->subject, $this->body, $this->headers)) return TRUE;
		else return FALSE;
	}

	function set($key, $value)
	{
		if($value) $this->$key = $value;
		else unset($this->$key);
	}
}
