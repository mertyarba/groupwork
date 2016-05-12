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
	
	if (isset($_GET["add_new_interest"])){
		
		if (!empty($_GET["new_interest"])){
		
		saveInterest($_GET["new_interest"]);
		
		}else{
			
			echo "You left the interest field empty!";
		}	
	}
	
	if (isset($_GET["select_interest"])){
		
		if (!empty($_GET["user_interest"])){
		
		saveUserInterest($_GET["user_interest"]);
		
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

<h2>Select User Interest</h2>
<form>
	<?php createInterestDropdown(); ?>
	<input type="submit" name="select_interest" value="Select">
	
</form>

<h2>Interests</h2>
<form>
	<?php createUserInterestList(); ?>
	
	
</form>