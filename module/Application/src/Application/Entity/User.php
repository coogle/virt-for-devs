<?php

namespace Application\Entity;

class User 
{
	/**
	 * The user we're talking about
	 * @var string
	 */
	protected $_user;
	
	/**
	 * The description of that user.
	 * @var string
	 */
	protected $_description;
	
	/**
	 * Set via array
	 * @param array $data
	 * @return self
	 */
	public function exchangeArray(array $data)
	{
		$this->setUser(isset($data['user']) ? $data['user'] : null)
			 ->setDescription(isset($data['description']) ? $data['description'] : null);
		
		return $this;
	}
	
	/**
	 * Return an array of data
	 * @return array 
	 */
	public function toArray()
	{
		return array(
			'user' => $this->getUser(),
			'description' => $this->getDescription()
		);
	}
	
	/**
	 * @return string
	 */
	public function getUser() {
		return $this->_user;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->_description;
	}

	/**
	 * @param string $_user
	 * @return self
	 */
	public function setUser($_user) {
		$this->_user = $_user;
		return $this;
	}

	/**
	 * @param string $_description
	 * @return self
	 */
	public function setDescription($_description) {
		$this->_description = $_description;
		return $this;
	}

}