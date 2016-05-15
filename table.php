<?php
	// table.php
	
	//getting our config
	require_once("../../config.php");
	require_once("header.php");
	require_once ("functions.php");
	
	//create connection
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_mertyarba");
	
	//IF THERE IS "?DELETE=ROW_ID" in the url
	if (isset ($_GET["deleted"])){
		
		echo "Deleting row with id:".$_GET["deleted"];
		
		$stmt=$mysql->prepare("UPDATE todo SET deleted=NOW() WHERE id = ?");
		
		echo $mysql->error;
		
		//replace the "?"
		$stmt->bind_param("i", $_GET["deleted"]);
		
		if($stmt->execute()){
			echo "deleted successfully";
		}else{
			echo $stmt->error;
		}
		
			$stmt->close();
		
	}

	
	//SQL sentence
	$stmt = $mysql->prepare("SELECT id, task, deadline, completion, deleted FROM todo WHERE deleted IS NULL ORDER BY deadline DESC LIMIT 10");
	//WHERE DELETED IS NULL show only those that are not deleted
	
	//if error in sentence
	echo $mysql->error;
	
	//variables for data for each row we will get
		$stmt->bind_result($id, $task, $deadline, $completion, $deleted);
	
	//query
	$stmt->execute();
	
	$table_html = "";

	//add something to string
	$table_html .= "<table class=table table-bordered'>";
	$table_html .= "<tr>";
		$table_html .= "<tr>";
		$table_html .= "<th>ID</th>";
		$table_html .= "<th>Task</th>";
		$table_html .= "<th>Deadline</th>";
	$table_html .= "</tr>";
	
	// GET RESULT 
	//we have multiple rows
	while($stmt->fetch()){
		
		//DO SOMETHING FOR EACH ROW
		//echo $id."".$message."<br>";
		$table_html .= "<tr>"; //start new row
			$table_html .= "<td>".$id."</td>"; //add columns
			$table_html .= "<td>".$task."</td>";
			$table_html .= "<td>".$deadline."</td>";
			$table_html .= "<td><a class='btn btn-danger' href='?deleted=".$id."'>x</a></td>";
		$table_html .= "</tr>"; //end row

	}
	$table_html .= "</table>";
	
	
	
	


?>


	
		<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#"></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
		  <ul class="nav navbar-nav">
			
			<li>
				<a href="restrict.php">
					Make a list!
				</a>
			</li>
			
			
			<li class="active" >
				<a href="table.php">
					Your ToDos
				</a>
			</li>
			
		  </ul> 
		  
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

		<h1> Your ToDos </h1>

	<?php echo $table_html; ?>
  
	</div>







  </body>
 </html>
