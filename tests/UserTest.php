<?php
namespace ASPTest;

use PHPUnit\Framework\TestCase;
use ASPTest\Controller\UserController;

final class UserTest extends TestCase
{
    public function testAddUser(){

    	$user = new UserController();

    	$userData =  [
            'firstname' => 'John'
            ,'lastname' => 'Doe'
            ,'email' => 'c@d.com'
            ,'age' => 35
        ];

        $this -> assertIsString($userData['firstname']);
        $this -> assertTrue((strlen($userData['firstname']) >= 2 && strlen($userData['firstname']) <=35));
        $this -> assertIsString($userData['lastname']);
        $this -> assertTrue((strlen($userData['lastname']) >= 2 && strlen($userData['lastname']) <=35));
     //   $this -> assertTrue(filter_var($userData['email'], FILTER_VALIDATE_EMAIL));
      //  $this -> assertNull($userData['age']);
        $this -> assertTrue($userData['age'] > 0 && $userData['age'] <=150);


        $this -> assertTrue(is_object($user));
        $this -> assertTrue($user -> addUser($userData));


    }

    public function testSetPassword(){

    	$user = new UserController();

        $passwordData = [
          'user_id' => 2
          ,'password' => 'NotMYP@ss2'
          ,'password_validation' => 'NotMYP@ss2'
        ];


        $this -> assertTrue((preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,100}$/',$passwordData['password']) == 1));
        $this -> assertEquals($passwordData['password'], $passwordData['password_validation']);

        $passwordData['password'] = password_hash($passwordData['password'], PASSWORD_BCRYPT, ['cost' => 10]);

        $this -> assertTrue($user -> setPassword($passwordData));

    }
}