<?php

namespace Twilio;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\EventManager\StaticEventManager;
use Zend\Session\Container;
use Zend\EventManager\EventInterface;
use Zend\Session\Config\SessionConfig;

class Module
{
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php'
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
				)
			)
		);
	}

	public function onBootstrap(EventInterface $e)
	{
		$config = $e->getApplication()->getServiceManager()->get('Config');
	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}
}