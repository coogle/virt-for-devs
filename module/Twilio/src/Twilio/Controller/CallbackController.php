<?php

namespace Twilio\Controller;

use Twilio\Entity\SMSRequest;
use Twilio\SMS\Response as TwilioResponse;
use Zend\Mvc\Controller\AbstractActionController;

class CallbackController extends AbstractActionController
{
	public function smsCallbackAction()
	{
		$request = $this->getRequest();

		if($request->getPost('SmsSid', false) === false) {
			throw new \RuntimeException("Invalid Input");
		}

		$smsRequest = SMSRequest::createFromRequest($request);
		$smsResponse = new TwilioResponse();

		$this->getEventManager()->trigger('twilioSmsRequest', $this, array(
			'smsRequest' => $smsRequest,
			'smsResponse' => $smsResponse
		));

		return $smsResponse;
	}

}