# ci4-email-phpmailer

A simple package that extends the [Email class](https://codeigniter4.github.io/userguide/libraries/email.html) of CodeIgniter 4, modifying the SMTP protocol for sending through [PHPMailer](https://github.com/PHPMailer/PHPMailer).

Install with composer:
`composer require nachoaguirre/ci4phpmailer`

Then load the librarie:
`use Nachoaguirre\Ci4phpmailer\Libraries\Email;`

Then use almost same way the Email class (except the initiation):
`$email = new \Nachoaguirre\Ci4phpmailer\Libraries\Email;
		
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

$email->send();`


Tested with gmail account, and works perfect.


