<?php

return array(
	'router' => array(
			'routes' => array(
				'aruba-vc-landing' => array(
					'type' => 'Zend\Mvc\Router\Http\Literal',
					'options' => array(
						'route'	=> '/twilio-sms-callback',
						'defaults' => array(
							'controller' => 'Twilio\Controller\Callback',
							'action'	 => 'smsCallback',
						),
					)
				)
			)
	),
	'twilio' => array(
	),
	'controllers' => array(
		'invokables' => array(
				'Twilio\Controller\Callback' => 'Twilio\Controller\CallbackController'
		),
	)
);