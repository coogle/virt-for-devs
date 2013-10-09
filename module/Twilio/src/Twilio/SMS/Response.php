<?php

namespace Twilio\SMS;

class Response extends \Twilio\Http\PhpEnvironment\Response
{
	/**
	 * @var array
	 */
	protected $_messages = array();

	/**
	 * @var string
	 */
	protected $_redirect;

	protected function _genResponse()
	{
		$writer = new \XMLWriter();
		$writer->openMemory();
		$writer->setIndent(4);

		$writer->startElement('Response');

		foreach($this->getMessages() as $message) {
			$writer->startElement('Sms');
			$writer->writeRaw((string)$message);
			$writer->endElement();
		}

		if($redirect = $this->getRedirect()) {
			$writer->startElement('Redirect');
			$writer->writeRaw($redirect);
			$writer->endElement();
		}

		$writer->endElement();

		return $writer->outputMemory(true);
	}

	public function addMessage($msg) {
		$this->_messages[] = $msg;
		$this->setContent($this->_genResponse());
		return $this;
	}

	/**
	 * @return the $_messages
	 */
	public function getMessages() {
		return $this->_messages;
	}

	/**
	 * @return the $_redirect
	 */
	public function getRedirect() {
		return $this->_redirect;
	}

	/**
	 * @param multitype: $_messages
	 * @return object
	 */
	public function setMessages(array $_messages) {
		$this->_messages = $_messages;
		$this->setContent($this->_genResponse());
		return $this;
	}

	/**
	 * @param string $_redirect
	 * @return object
	 */
	public function setRedirect($_redirect) {
		$this->_redirect = $_redirect;
		$this->setContent($this->_genResponse());
		return $this;
	}


}