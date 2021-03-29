<?php
namespace Nachoaguirre\Ci4phpmailer\Libraries;

use CodeIgniter\Email\Email as BaseEmail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends BaseEmail {
	
	protected $protocols = [
		'mail',
		'sendmail',
		'smtp',
		'phpmailer',
	];
	
	public function __construct() {
        parent::__construct();
    }
    
	protected function sendWithPhpmailer() {
		$this->sendWithSmtp();
	}
	
	
	
	protected function sendWithSmtp() {
		if ($this->SMTPHost === '') { $this->setErrorMessage(lang('Email.noHostname')); return false; }
		if ($this->SMTPUser === '' || $this->SMTPPass === '') { $this->setErrorMessage(lang('Email.noSMTPAuth')); return false; }

		if ($this->SMTPCrypto === '') {
			if ($this->SMTPPort === 465) {  $this->SMTPCrypto = 'ssl'; $encryption = PHPMailer::ENCRYPTION_SMTPS; } 
			elseif ($this->SMTPPort === 587) { $this->SMTPCrypto = 'tls'; $encryption = PHPMailer::ENCRYPTION_STARTTLS; } 
			else { $this->setErrorMessage(lang('Email.noHostname')); return false; } // TODO: Add language string "No SMTP Encryption was defined" 	
		}
		
		if ($this->SMTPPort === '') {
			if ($this->SMTPCrypto === 'ssl') { $this->SMTPPort = 465; $encryption = PHPMailer::ENCRYPTION_SMTPS; } 
			elseif ($this->SMTPCrypto === 'tls') { $this->SMTPPort = 587; $encryption = PHPMailer::ENCRYPTION_STARTTLS; } 
			else { $this->setErrorMessage(lang('Email.noHostname')); return false; } // TODO: Add language string "No SMTP Port was defined"
		}		
		
		$recipients = is_array($this->recipients) ? implode(', ', $this->recipients) : $this->recipients;
		$from       = $this->cleanEmail($this->headers['Return-Path']);
		//$from     = $this->cleanEmail($this->headers['From']);
				
		$mail = new PHPMailer(true);
		try {
			$mail->isSMTP();
			$mail->Host       = $this->SMTPHost;
			$mail->SMTPAuth   = true;
			$mail->Username   = $this->SMTPUser;
			$mail->Password   = $this->SMTPPass;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //$encryption;
			$mail->Port       = $this->SMTPPort;
						
			$mail->setFrom($from, 'Reservame'); // TODO: Set name from sender,,,
			$mail->addAddress($recipients);			
			$mail->Subject = $this->subject;
			
			
			if ($this->wordWrap === true && $this->mailType !== 'html') { $this->body = $this->wordWrap($this->body); }
			
			
			switch ($this->getContentType()) {
				case 'plain':
					$mail->Body = $this->body;
				break;
				case 'html':
					$mail->isHTML(true);
					$mail->msgHTML($this->body);
				break;
				default:
					$mail->isHTML(true);
					$mail->msgHTML($this->body);
			}	
			
			
			if(!empty($this->attachments)){
				for ($i = 0, $c = count($this->attachments); $i < $c; $i++) {
					$name = isset($this->attachments[$i]['name'][1]) ? $this->attachments[$i]['name'][1] : basename($this->attachments[$i]['name'][0]);
					$mail->addAttachment($this->attachments[$i]['content'], $name, 'base64', $this->attachments[$i]['type']);
				}
			}
					
			$mail->send();
			return true;	
		} catch (Exception $e) {
			//return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			return false;
		}
	}

}