<?php namespace Nachoaguirre\Ci4phpmailer\Controllers;

use Nachoaguirre\Ci4phpmailer\Libraries\Email;

class Sendtest extends BaseController {

	public function index(){		
		$email = new \Nachoaguirre\Ci4phpmailer\Libraries\Email;
		
		$config['protocol']   = 'smtp';
		$config['SMTPHost']   = 'smtp.gmail.com';
		$config['SMTPUser']   = 'your@gmail.com';
		$config['SMTPPass']   = 'yourp4ssword';
		$config['SMTPPort']   = 465;
		$config['SMTPCrypto'] = 'ssl';
		$email->initialize($config);

		$email->setFrom('noreply@yoursite.com', 'Your Name');
		$email->setTo('buddy@foo.com');

		$email->setSubject('Hey dude!');
		$email->setMessage('Corre que te pillo...');

		$email->send(false);
		//echo $email->printDebugger();	
	}
		
}
