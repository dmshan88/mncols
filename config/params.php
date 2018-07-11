<?php

return [
    'transport' => [
        'class' => 'Swift_SmtpTransport',  
        'host' => 'smtp.163.com',
        'username' => 'username@mnchip.com',  
        'password' => 'password',  
        'port' => '25',  
        'encryption' => 'tls',  
	],
	'PHONE_NUMBER' =>[
		'12345678901',
	],
	'MESSAGE_CONFIG' => [
		'ON'=>true,
		'APPID'=>123,
		'APPKEY'=>"key",
		'FORM1'=>45,
		'FORM2'=>54987,
	]
];
