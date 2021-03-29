CodeIgniter 4 SMTP Email with PHPMailer
============================================

### A simple extension of the Email Class to send SMTP with PHPMailer library.

[![Latest Stable Version](https://poser.pugx.org/nachoaguirre/ci4phpmailer/v)](//packagist.org/packages/nachoaguirre/ci4phpmailer) [![Total Downloads](https://poser.pugx.org/nachoaguirre/ci4phpmailer/downloads)](//packagist.org/packages/nachoaguirre/ci4phpmailer) [![Latest Unstable Version](https://poser.pugx.org/nachoaguirre/ci4phpmailer/v/unstable)](//packagist.org/packages/nachoaguirre/ci4phpmailer) [![License](https://poser.pugx.org/nachoaguirre/ci4phpmailer/license)](//packagist.org/packages/nachoaguirre/ci4phpmailer)

Tested witj CodeIgniter 4.1.1 and PHPMailer 6.3.0

## Install via Composer

### To get this plugin via composer is the quick start.

This plugin utilizes Composer for its installation and PHPMailer dependency. If you haven't already, start by installing [Composer](http://getcomposer.org/doc/00-intro.md).

And are available via [Composer/Packagist](https://packagist.org/packages/nachoaguirre/ci4phpmailer). Once you have Composer configured in your environment run the command line:
```CLI
  $  composer require nachoaguirre/ci4phpmailer
```
This command will write into composer.json beyond download and place this project files and PHPMailer dependencies into your ``vendor`` folder.

Your able to send e-mail anywhere inside your CodeIgniter application.


Load the library in your controller
```PHP
 use Nachoaguirre\Ci4phpmailer\Libraries\Email
```

Then in your method, create an instance of `Mail()` class:
```PHP
 $email = new \Nachoaguirre\Ci4phpmailer\Libraries\Email
```

## Example

Use the class in the same way you use the CI4 Email Class


```PHP
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

$email->send(); 
```
That's all.


## Gmail support 

I have tested with different accounts, in different environments, and got always working 🙌
