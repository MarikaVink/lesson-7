<style>
body {
	color:rgb(41,91,81);
	background-color:rgb(201,245,225);
	font-family:sans-serif;
	font-size:10pt;
	text-align:center;
	margin:100px;}
	}
h2   {
	font-size:26pt;
	color:#54b352; 
	font-family:sans-serif;
	text-align:center;}
p    {
	color:green; 
	font-family:sans-serif; 
	font-size:8pt;
	text-align:justify;}
	

</style>

<h2> First application (BMI)</h2>

<p>My idea is to create a personal app for tracking your body mass index (BMI). After inputing your parameters, the app will let you know if your body mass index
is normal or should you lose/gain weight. The app could track user's progress 
and leave positive comments /send reminders. The app could be accessible after entering a password.</p>

<form method="get"
	<label for="gender"> I am:*</label><br>
	<input type="radio" name="gender" value="Male"> Male<br>
	<input type="radio" name="gender" value="Female"> Female<br>

 
 	
<?php
	//required another php file
	require_once("../../config.php");


	$everything_was_okay = true;

	//check if there is variable in the URL
	
	
	//for Gender* field:
	if(isset($_GET["gender"])){
		
		//only if there is gender typed in the URL
		//echo "there is gender";
		
		//if it's empty
		if(empty($_GET["gender"])){
			//it is empty
			echo "Please choose your gender!";
	}else{
			//its not empty
			echo "Gender: ".$_GET["gender"]."<br>"; 
		}
		
	}else{
		//echo "there is no such thing as gender typed";
		$everything_was_okay = false;
	}
?>
<br><br>
		

	<label for="age"> Age:*</label>
	<input type="number" name="age" min="1" max="130" ><br>

<?php	
	//required another php file
	require_once("../../config.php");
	
	
		$everything_was_okay = true;
	//for Age* field:
	if(isset($_GET["age"])){
		
		//only if there is age typed* in the URL
		//echo "there is age typed";
		
		//if it's empty
		if(empty($_GET["age"])){
			//it is empty
			echo "Please enter your age!";
	}else{
			//its not empty
			echo "Age: ".$_GET["age"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as age typed";
		$everything_was_okay = false;
	}
?>
<br><br>

	<label for="height"> Height (cm):*</label>
	<input type="number" name="height" min="50" max="250"><br>

<?php	
	//required another php file
	require_once("../../config.php");


	$everything_was_okay = true;
	//for Height* field:
	if(isset($_GET["height"])){
		
		//only if there is height typed* in the URL
		//echo "there is height typed";
		
		//if it's empty
		if(empty($_GET["height"])){
			//it is empty
			echo "Please enter your height!";
	}else{
			//its not empty
			echo "Height: ".$_GET["height"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as height typed";
		$everything_was_okay = false;
	}
	
?>
<br><br>

	<label for="weight"> Weight (kg):*</label>
	<input type="number" name="weight" min="15" max="600"><br><br>

<?php	

	//required another php file
	require_once("../../config.php");


	$everything_was_okay = true;
		//for Weight* field:
	if(isset($_GET["weight"])){
		
		//only if there is weight typed* in the URL
		//echo "there is weight typed";
		
		//if it's empty
		if(empty($_GET["weight"])){
			//it is empty
			echo "Please enter your weight!";
	}else{
			//its not empty
			echo "Weight: ".$_GET["weight"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as weight typed";
		$everything_was_okay = false;
	}
	
?>

	<br><input type="submit" value="Get my BMI"> 
</form>
<?php
	if($everything_was_okay == true){
		
		echo "Saving to database . . .";
		
		//connection with username and password
		//access username from config
		//echo $db_username;
		
		//1 servername
		//username	
		//password
		//database
		$mysql = new mysqli("localhost",$db_username, $db_password,"webpr2016_marvin");
		
		$stmt = $mysql->prepare("INSERT INTO BMI_app(gender, age, height, weight) VALUES (?,?,?,?)");
		
		//echo error
		echo $mysql->error;
		
		
		//WE ARE REPLACING QUESTION MARKS
		//s - string, date or smth that is based on characters and 
		//i - integer, number_format
		//d - decimal, float
		
		$stmt->bind_param("siii",$_GET["gender"],$_GET["age"],$_GET["height"],$_GET["weight"] );
		
		//save
		if($stmt->execute()){
			echo "saved successfully";
		}else{
			echo $stmt->error;}
	}
?>

<a href="table2.php">table</a>