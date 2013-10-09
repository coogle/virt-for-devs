<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Entity\User;
class UserTable
{
	/**
	 * @var Zend\Db\TableGateway\TableGateway
	 */
	protected $_tableGateway;
	
	function __construct(TableGateway $tableGateway) {
		$this->_tableGateway = $tableGateway;
	}
	
	/**
	 * Fetch all
	 * @return \Zend\Db\ResultSet\ResultSet
	 */
	public function fetchAll()
	{
		$result = $this->_tableGateway->select();
		return $result;
	}
	
	/**
	 * Return a single user's description
	 * @param string $user
	 * @return \ArrayObject
	 */
	public function findByUser($user) {
		$row = $this->_tableGateway->select(
			array('user' => $user)
		)->current();
		
		if(!$row) {
			return null;
		}
		
		return $row;
	}
	
	public function save(User $user) {
		
		$data = $user->toArray();
		
		if(empty($data['user'])) {
			throw new \RuntimeException("Must provide a user to describe");
		}
		
		$existing = $this->findByUser($data['user']);
		
		if(!$existing) {
			$this->_tableGateway->insert($data);
		} else {
			$this->_tableGateway->update($data, array('user' => $data['user']));
		}
		
	}
	
	public function delete(User $user) {
		$this->_tableGateway->delete(array('user' => $user->getUser()));
	}
}