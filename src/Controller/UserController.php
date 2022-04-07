<?php
namespace ASPTest\Controller;
use ASPTest\Model\User;

Class UserController{

/*
	private $userData;
	private $index = 1;
*/
	public function addUser($userData){

		$user = new User();

		return $user -> add ($userData);

	}

	public function getUser($id){
		$user = new User();

		return $user -> get($id);
	}

	public function setPassword($passwordData){

		$user = new User();

		return $user -> setPassword($passwordData);

	}

}