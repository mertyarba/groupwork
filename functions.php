<?php

	require_once ("../config.php");

	//start server session to store data
	//in every file you want to access session you should require functions
	session_start();

	function login($user, $pass){
		//hash the password
		$pass = hash("sha512", $pass);

		//GLOBALS - access outside variable in function
		$mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");
		$stmt = $mysql->prepare ("SELECT id, name FROM login WHERE username=? and password=?");

		echo $mysql->error;

		$stmt->bind_param("ss", $user, $pass);

			$stmt->bind_result($id, $name);

			$stmt->execute();

			//GET THE DATA
			if($stmt->fetch()){
				echo "user with id".$id."logged in!";

				//create sesssion variables and redirect user
				$_SESSION["user_id"] = $id;
				$_SESSION["username"] = $user;
				$_SESSION["name"] = $name;

				header("Location: restrict.php");


			}else{
				//username or password was wrong
				echo $stmt->error;
				echo "Wrong credentials!";
			}

	}
	function signup($user, $pass, $name){

		//hash the password
		$pass = hash("sha512", $pass);

		//GLOBALS - access outside variable in function
		$mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");

		$stmt = $mysql->prepare("INSERT INTO users (username, password, name) VALUES (?,?,?)");

		echo $mysql->error;

		$stmt->bind_param("sss", $user, $pass, $name);

		if($stmt->execute()){
			echo "user saved successfully! ";
		}else{
			echo $stmt->error;
		}
	}
	function AddToDo($todo_id){

		$mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");

		//if user already has interests
		$stmt = $mysql->prepare("SELECT id FROM label WHERE label_id = ? and todo_id = ?");
		echo $mysql->error;
		$stmt->bind_param("ii", $_SESSION["label_id"], $todo_id);
		$stmt->execute();

		if($stmt->fetch()){
			//it existed
			echo "You already have this task!";
			return; //stop it there
		}
		$stmt->close();

		$stmt = $mysql->prepare("INSERT INTO labels (label_id, todo_id) VALUES (?, ?)");

		echo $mysql->error;
		$stmt->bind_param("ii", $_SESSION["label_id"] ,$todo_id);

		if($stmt->execute()){

			echo "Saved successfully.";
		}else{
			echo $stmt->error;
		}

	}
	function createUserInterestList(){
			$mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");
		$stmt = $mysql->prepare("SELECT interest.name FROM user_interests INNER JOIN interest ON user_interests.id = interest.id WHERE user_interests.user_id = ?");

		echo $mysql->error;

		$stmt->bind_param("i", $_SESSION["user_id"]);

		$stmt->bind_result($interest);

		$stmt->execute();
		$html = "<ul>";

		//for each interest
		while ($stmt->fetch()){

			$html .= "<li>".$interest."</li>";

		}
		$html .= "</ul>";

		echo $html;

	}

	?>
