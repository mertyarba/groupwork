<?php


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

		$stmt = $mysql->prepare("INSERT INTO login (username, password, name) VALUES (?,?,?)");

		echo $mysql->error;

		$stmt->bind_param("sss", $user, $pass, $name);

		if($stmt->execute()){
			echo "user saved successfully! ";
		}else{
			echo $stmt->error;
		}
	}
	function AddLabelToTodo($todo_id){

		$mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");

		//if user already has interests
		$stmt = $mysql->prepare("SELECT id FROM label WHERE label_id = ? and todo_id = ?");
		echo $mysql->error;
		$stmt->bind_param("ii", $_SESSION["label_id"], $todo_id);
		$stmt->execute();

		if($stmt->fetch()){
			//it existed
			echo "You already have this label!";
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
	function GetToDoLabels(){
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

	function createLabelDropdown(){
		//query all interests
	  $mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");
	  $stmt = $mysql->prepare("SELECT id, name FROM labels ORDER BY name ASC");

	  echo $mysql->error;
	  $stmt->bind_result($id, $name);
	  $stmt->execute();

	  //dropdown html
	  $html ="<select name='label_id'>";

	  //for each interest
	  while($stmt->fetch()){
	    $html .="<option value='".$id."'>".$name."</option>";



	  }

	  $html .="</select>";
	  echo $html;

	}

	function DeleteLabel(){
		if(isset($_GET["delete"])){

			echo "Deleting row with id:".$_GET["delete"];

			// NOW() = current date-time
			$stmt = $mysql->prepare("UPDATE labels SET deleted=NOW() WHERE id = ?");

			echo $mysql->error;

			//replace the ?
			$stmt->bind_param("i", $_GET["delete"]);

			if($stmt->execute()){
				echo "deleted successfully";
			}else{
				echo $stmt->error;
			}
		}
	}

	function CreateToDo(){
			if(isset($_GET["create"])){

				echo "Creating To Do:".$_GET["create"];

				// NOW() = current date-time
				$stmt = $mysql->prepare("UPDATE labels SET deleted=NOW() WHERE id = ?");

				echo $mysql->error;

				//replace the ?
				$stmt->bind_param("i", $_GET["create"]);

				if($stmt->execute()){
					echo "To Do created";
				}else{
					echo $stmt->error;
				}

			}
	}

	function GetToDos(){
		$mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");

			$stmt = $mysql->prepare("SELECT id, task FROM todo");

			echo $mysql->error;

			//replace the ?
			$stmt->bind_results($id, $task);

			$stmt->execute();

			$table_html = "";

			//add smth to string .=
			$table_html .= "<table class=table table-'>";
				$table_html .= "<tr>";
					$table_html .= "<th>ID</th>";
					$table_html .= "<th>task</th>";
				$table_html .= "</tr>";

			while ($stmt->fetch()){
				// each row
				$table_html .= "<tr>"; //start new row
					$table_html .= "<td>".$id."</td>"; //add columns
					$table_html .= "<td>".$task."</td>";


				$table_html .= "</tr>"; //end row

			}
			$table_html .= "</table>";

			return $table_html;
			//GetToDos()
		}

		 // create todo

		// get todos

		// delete todo
?>
