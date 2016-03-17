<?php require_once("homeheader.php"); ?>

<?php
//table.php

//getting our configuration
require_once("../../config.php");

//create connection_aborted
$mysql = new mysqli("localhost",$db_username, $db_password,"webpr2016_marvin");

/*
IF THERE IS ?DELETE=ROW_ID in the url
*/
if(isset($_GET["delete"])){
	
	echo "Deleting row with id:".$_GET["delete"];
	
	$stmt = $mysql->prepare("UPDATE BMI_app SET deleted=NOW() WHERE id = ?");
	
	echo $mysql->error;
	
	//replace the ?
	$stmt->bind_param("i", $_GET["delete"]);
	
	if($stmt->execute()){
		echo "deleted successfully";
	}else{
		echo $stmt->error;
	}
	
	//closes the statement, so others can use connection
	$stmt->close();
}


//SQL sentence
$stmt = $mysql->prepare("SELECT id, gender, age, height, weight,
 created FROM BMI_app WHERE deleted IS NULL ORDER BY id DESC LIMIT 10");

//if error in sentence
echo $mysql->error;

//variables for data for each row we will get
$stmt->bind_result ($id, $gender, $age, $height, $weight, $created);

//query
$stmt->execute();

$table2_html = "";

$table2_html .="<table class='table table-striped'>";
	$table2_html .="<tr>";
$table2_html .="<th>ID</th>";
$table2_html .="<th>Gender</th>";
$table2_html .="<th>Age</th>";
$table2_html .="<th>Height</th>";
$table2_html .="<th>Weight</th>";
$table2_html .="<th>Created</th>";
$table2_html .="<th>Delete?</th>";
$table2_html .="</tr>";
		
//GET RESULT
//we have multiple rows
while($stmt->fetch()){
	
	//DO SOMETHING FOR EACH ROW
	//echo $id." ".$message."<br>";
		$table2_html .="<tr>";//start new row
$table2_html .="<td>".$id."</td>";
$table2_html .="<td>".$gender."</td>";
$table2_html .="<td>".$age."</td>";
$table2_html .="<td>".$height."</td>";
$table2_html .="<td>".$weight."</td>";
$table2_html .="<td>".$created."</td>";
$table2_html .="<td><a class='btn btn-danger' href='?delete=".$id."'>X</a></td>";
$table2_html .="</tr>"; //end row
	
	
}
$table2_html .="</table>";


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
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
		  <ul class="nav navbar-nav">
			
			<li >
				<a href="homeapp.php">
					Get my BMI
				</a>
			</li>
			
			
			<li class="active">
				<a href="table2.php">
					My progress
				</a>
			</li>
			
		  </ul> 
		  
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

		<h1> My progress </h1>
		
		<?php echo $table2_html; ?>
		
		
		</div>

  </body>
</html>
















