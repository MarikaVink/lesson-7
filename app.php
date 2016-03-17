<?php

	//required another php file
	require_once("../../config.php");


	$everything_was_okay = true;

	//check if there is variable in the URL
	
	
	//for Message* field:
	if(isset($_GET["message"])){
		
		//only if there is message in the URL
		//echo "there is message";
		
		//if it's empty
		if(empty($_GET["message"])){
			$everything_was_okay = false;
			//it is empty
			echo "Please enter the message!";
	}else{
			
			//its not empty
			echo "Message: ".$_GET["message"]."<br>"; 
		}
		
	}else{
		//echo "there is no such thing as message";
		$everything_was_okay = false;
	}
	
	//for To* field:
	if(isset($_GET["to"])){
		
		//only if there is to* in the URL
		//echo "there is addressee";
		
		//if it's empty
		if(empty($_GET["to"])){
			$everything_was_okay = false;
			//it is empty
			echo "Please enter the addressee!";
	}else{
			//its not empty
			echo "To: ".$_GET["to"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as addressee";
		$everything_was_okay = false;
	}
	
//for From* field:
	if(isset($_GET["from"])){
		
		//only if there is from* in the URL
		//echo "there is addresser";
		
		//if it's empty
		if(empty($_GET["from"])){
			$everything_was_okay = false;
			//it is empty
			echo "Please enter the addresser!";
	}else{
			//its not empty
			echo "From: ".$_GET["from"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as addressee";
		$everything_was_okay = false;
	}
	
//Getting the message from address
//if there is ?name= .. then $_GET["name"]
//$my_message = $_GET["message"];
//$to = $_GET["to"];
//$from = $_GET["from"];


//echo "My message is ".$my_message." for"." ".$to." from "." ".$from;

	/******************************
	****** SAVE TO DATABASE *******
	*******************************/

	//? was everything okay

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
		
		$stmt = $mysql->prepare("INSERT INTO messages_sample(recipient, message, sender) VALUES (?,?,?)");
		
		//echo error if something in line above has a spelling or other kind of mistake
		echo $mysql->error;
		
		
		//WE ARE REPLACING QUESTION MARKS
		//s - string, date or smth that is based on characters and 
		//i - integer, number_format
		//d - decimal, float
		
		$stmt->bind_param("sss",$_GET["to"],$_GET["message"],$_GET["from"] );
		
		//save
		if($stmt->execute()){
			echo "saved successfully";
		}else{
			echo $stmt->error;}
	}
?>

<h2> First application </h2>
<br>
<a href="table.php">table</a>

<form method="get">
<label for="message"> Message:*</label><br>
<input type="text" name="message"><br>
<label for="to"> To:*</label><br>
<input type="text" name="to"><br>
<label for="from"> From:*</label><br>
<input type="from" name="from"><br>
<input type="submit" value="Save to DB"> 

	

</form>

