<?php
namespace app\models;

use PDO;

class Profile extends \app\core\Model{
	public $profile_id;//PK
	public $user_id;
	public $first_name;
	public $middle_name;
	public $last_name;


	//CRUD

	//create
	public function insert(){
    $SQL = 'INSERT INTO profile(user_id,first_name,middle_name,last_name) VALUES (:user_id,:first_name,:middle_name,:last_name)';
    $STMT = self::$_conn->prepare($SQL);
    $STMT->execute([
        'user_id' => $this->user_id,
        'first_name' => $this->first_name,
        'middle_name' => $this->middle_name,
        'last_name' => $this->last_name
    ]);

    // Retrieve the last inserted ID and store it in the profile_id property
    $this->profile_id = self::$_conn->lastInsertId();
}



	//read
	public function getForUser($user_id){
    $SQL = 'SELECT * FROM profile WHERE user_id = :user_id';
    $STMT = self::$_conn->prepare($SQL);
    $STMT->execute(['user_id' => $user_id]);
    $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Profile');
    return $STMT->fetch(); // Return a single profile object
}

	public function getAll(){
		$SQL = 'SELECT * FROM profile';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Profile');//set the type of data returned by fetches
		return $STMT->fetchAll();//return all records
	}

	public function getByName($name){//search
		$SQL = 'SELECT * FROM profile WHERE CONCAT(first_name,\' \',middle_name,\' \',last_name) = :name';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['name'=>$name]
		);
		$STMT->setFetchMode(PDO::FETCH_CLASS,'app\models\Profile');//set the type of data returned by fetches
		return $STMT->fetchAll();//return all records
	}


	//update
	//you can't change the user_id that's a business logic choice that gets implemented in the model
	public function update(){
		$SQL = 'UPDATE profile SET first_name=:first_name,middle_name=:middle_name,last_name=:last_name WHERE profile_id = :profile_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['profile_id'=>$this->profile_id,
			'first_name'=>$this->first_name,
			'middle_name'=>$this->middle_name,
			'last_name'=>$this->last_name]
		);
	}

	//delete
	public function delete(){
		$SQL = 'DELETE FROM profile WHERE profile_id = :profile_id';
		$STMT = self::$_conn->prepare($SQL);
		$STMT->execute(
			['profile_id'=>$this->profile_id]
		);
	}


}