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
];
