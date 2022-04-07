<?php
namespace ASPTest\Model;
use ASPTest\Model\Connection;

Class User{

	private $dbh;

	public function __construct(){

		$con = new Connection();
	//	var_dump($con);exit;
		$this -> dbh = $con -> getConnection();
	}


	public function add($dataSet){

		$query = 'INSERT INTO user(firstname, lastname, email, age) VALUES(:firstname, :lastname, :email, :age)';

		$stmt = $this -> dbh -> prepare ($query);

		$stmt -> bindParam(":firstname", $dataSet['firstname']);
		$stmt -> bindParam(":lastname", $dataSet['lastname']);
		$stmt -> bindParam(":email", $dataSet['email']);
		$stmt -> bindParam(":age", $dataSet['age']);

		$stmt -> execute();

		if($stmt -> rowCount()){
			return true;
		}else{
			$error = $this -> dbh -> errorInfo();
			print_r($error[2]);
			return false;
		}

	}

	public function get($id){

		$query =  'SELECT * FROM user WHERE id = :id';

		$stmt = $this -> dbh -> prepare ($query);

		$stmt -> bindParam(":id", $id);

		$stmt -> execute();

		if($stmt -> rowCount()){
			return $stmt -> fetchAll(\PDO::FETCH_OBJ);
			#return true;
	    }else{
	    	return false;
	    }

	}

	public function setPassword($passwordData){


		$query = 'UPDATE user SET pwd = :password WHERE id = :id';

		$stmt = $this -> dbh -> prepare ($query);

		$stmt -> bindParam(":id", $passwordData['user_id']);
		$stmt -> bindParam(":password", $passwordData['password']);

		$stmt -> execute();

		if($stmt -> rowCount()){
			return true;
		}else{
			$error = $this -> dbh -> errorInfo();
			print_r($error[2]);
			return false;
		}

	}


}