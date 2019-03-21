<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['protocol']		= 'smtp';
$config['smtp_host'] 	= getenv('SMTP_HOST');
$config['smtp_port'] 	= getenv('SMTP_PORT');
$config['smtp_user'] 	= getenv('SMTP_USER');
$config['smtp_pass'] 	= getenv('SMTP_PASS');
$config['mailtype']  	= 'html';
$config['smtp_timeout']	= '30';
$config['newline']		= "\r\n";

/* End of file email.php */
/* Location: ./application/config/email.php */
