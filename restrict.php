<?php
	
	//we need functions for dealing with session
	require_once("functions.php");
	
	if(!isset($_SESSION["user_id"])){
		//redirect not logged in user to the login page
		header("Location: login.php");
		
	}


	//?Logout is in the URL
	if(isset($_GET["logout"])){
		
		//delete the session
		session_destroy();
		
		header("Location: login.php");
	}
	
	if (isset($_GET["AddLabelToTodo"])){
		
		if (!empty($_GET["todo_id"])){
		
		saveTodo($_GET["todo_id"]);
		
		}else{
			
			echo "You left the todo field empty!";
		}	
	}
	
	if (isset($_GET["select_todo"])){
		
		if (!empty($_GET["label_id"])){
		
		saveUserInterest($_GET["label_id"]);
		
		}else{
			
			echo "ERROR!";
		}	
	}
	

?>

<a href="?logout=1">Log out</a>
<br>
<br>
<br>
<h1>Welcome <?php echo $_SESSION["name"];?> (<?=$_SESSION["user_id"];?>) </h1>

<h2>Add ToDo</h2>
<form>

	<input type="text" name="new_interest">
	<input type="submit" name="add_new_interest" value="Add">
	
</form>

<h2>Select ToDo</h2>
<form>
	<?php createLabelDropdown(); ?>
	<input type="submit" name="select_interest" value="Select">
	
</form>

<h2>ToDos</h2>
<form>
	<?php createUserInterestList(); ?>
	
	
</form>