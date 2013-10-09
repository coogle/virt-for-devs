<?php

namespace Twilio\Entity;

class SMSRequest
{
	/**
	 * @var string
	 */
	protected $_sId;

	/**
	 * @var string
	 */
	protected $_accountId;

	/**
	 * @var string
	 */
	protected $_from;

	/**
	 * @var string
	 */
	protected $_to;

	/**
	 * @var string
	 */
	protected $_body;

	/**
	 * @var string
	 */
	protected $_fromCity;

	/**
	 * @var string
	 */
	protected $_fromState;

	/**
	 * @var string
	 */
	protected $_fromZip;

	/**
	 * @var string
	 */
	protected $_fromCountry;

	/**
	 * @var string
	 */
	protected $_toCity;

	/**
	 * @var string
	 */
	protected $_toState;

	/**
	 * @var string
	 */
	protected $_toZip;

	/**
	 * @var string
	 */
	protected $_toCountry;

	static public function createFromRequest(\Zend\Http\Request $request)
	{
		$retval = new self();

		$retval->setSId($request->getPost('SmsSid', null))
				->setAccountId($request->getPost('AccountSid', null))
				->setFrom($request->getPost('From', null))
				->setTo($request->getPost('To', null))
				->setBody($request->getPost('Body', null))
				->setFromCity($request->getPost('fromCity', null))
				->setFromState($request->getPost('fromState', null))
				->setFromZip($request->getPost('fromZip', null))
				->setFromCountry($request->getPost('fromCountry', null))
				->setToCity($request->getPost('toCity', null))
				->setToState($request->getPost('toState', null))
				->setToCountry($request->getPost('toCountry', null));

		return $retval;
	}

	/**
	 * @return the $_sId
	 */
	public function getSId() {
		return $this->_sId;
	}

	/**
	 * @return the $_accountId
	 */
	public function getAccountId() {
		return $this->_accountId;
	}

	/**
	 * @return the $_from
	 */
	public function getFrom() {
		return $this->_from;
	}

	/**
	 * @return the $_to
	 */
	public function getTo() {
		return $this->_to;
	}

	/**
	 * @return the $_body
	 */
	public function getBody() {
		return $this->_body;
	}

	/**
	 * @return the $_fromCity
	 */
	public function getFromCity() {
		return $this->_fromCity;
	}

	/**
	 * @return the $_fromState
	 */
	public function getFromState() {
		return $this->_fromState;
	}

	/**
	 * @return the $_fromZip
	 */
	public function getFromZip() {
		return $this->_fromZip;
	}

	/**
	 * @return the $_fromCountry
	 */
	public function getFromCountry() {
		return $this->_fromCountry;
	}

	/**
	 * @return the $_toCity
	 */
	public function getToCity() {
		return $this->_toCity;
	}

	/**
	 * @return the $_toState
	 */
	public function getToState() {
		return $this->_toState;
	}

	/**
	 * @return the $_toZip
	 */
	public function getToZip() {
		return $this->_toZip;
	}

	/**
	 * @return the $_toCountry
	 */
	public function getToCountry() {
		return $this->_toCountry;
	}

	/**
	 * @param string $_sId
	 * @return self
	 */
	public function setSId($_sId) {
		$this->_sId = $_sId;
		return $this;
	}

	/**
	 * @param string $_accountId
	 * @return self
	 */
	public function setAccountId($_accountId) {
		$this->_accountId = $_accountId;
		return $this;
	}

	/**
	 * @param string $_from
	 * @return self
	 */
	public function setFrom($_from) {
		$this->_from = $_from;
		return $this;
	}

	/**
	 * @param string $_to
	 * @return self
	 */
	public function setTo($_to) {
		$this->_to = $_to;
		return $this;
	}

	/**
	 * @param string $_body
	 * @return self
	 */
	public function setBody($_body) {
		$this->_body = $_body;
		return $this;
	}

	/**
	 * @param string $_fromCity
	 * @return self
	 */
	public function setFromCity($_fromCity) {
		$this->_fromCity = $_fromCity;
		return $this;
	}

	/**
	 * @param string $_fromState
	 * @return self
	 */
	public function setFromState($_fromState) {
		$this->_fromState = $_fromState;
		return $this;
	}

	/**
	 * @param string $_fromZip
	 * @return self
	 */
	public function setFromZip($_fromZip) {
		$this->_fromZip = $_fromZip;
		return $this;
	}

	/**
	 * @param string $_fromCountry
	 * @return self
	 */
	public function setFromCountry($_fromCountry) {
		$this->_fromCountry = $_fromCountry;
		return $this;
	}

	/**
	 * @param string $_toCity
	 * @return self
	 */
	public function setToCity($_toCity) {
		$this->_toCity = $_toCity;
		return $this;
	}

	/**
	 * @param string $_toState
	 * @return self
	 */
	public function setToState($_toState) {
		$this->_toState = $_toState;
		return $this;
	}

	/**
	 * @param string $_toZip
	 * @return self
	 */
	public function setToZip($_toZip) {
		$this->_toZip = $_toZip;
		return $this;
	}

	/**
	 * @param string $_toCountry
	 * @return self
	 */
	public function setToCountry($_toCountry) {
		$this->_toCountry = $_toCountry;
		return $this;
	}

}