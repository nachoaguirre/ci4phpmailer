<?php namespace App\Controllers;

use App\Libraries\Email;

class Sendtest extends BaseController {

	public function index(){		
		$email = new \App\Libraries\Email;
		
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
