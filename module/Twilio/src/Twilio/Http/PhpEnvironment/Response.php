<?php

namespace Twilio\Http\PhpEnvironment;

class Response extends \Zend\Http\PhpEnvironment\Response
{
	public function __construct()
	{
		$this->getHeaders()
			->addHeaderLine('Content-Type', 'text/xml');
	}
}