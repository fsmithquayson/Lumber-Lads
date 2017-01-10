<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" type="text/css" href="style.css">
<header class="w3-display-container w3-wide bgimg w3-grayscale-min" id="home">
  <div class="w3-display-middle w3-text-white w3-center">
    <h1 class="w3-jumbo">LumberLads</h1>
    <h2><b>Fall 2016</b></h2>
  </div>
</header>
<style>
	.bgimg{
    min-height: 30%;
    background-position: center;
    background-size: cover;
	}
	.bgimg {background-image: url("http://cdn.pcwallart.com/images/dark-forest-background-wallpaper-3.jpg")}
</style>
<body>
<div padding = "10px">
<?php
	include 'connection.php';
	$target_path = "uploads/";
	$target_path1 = $target_path . basename( $_FILES['fileToUpload']['name']);
	$target_path2 = $target_path . basename ( $_FILES['fileToUpload2']['name']);

  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_path1);
  move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_path2);

	// Create connection
	$conn = new mysqli($host, $user, $password, $db);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	//load log demensions
	$myfile = fopen($target_path1, "r") or die("Unable to open file!");
	// Output one line until end-of-file
	$count = 0;
	echo "Log Demensions: <br>";
	while(!feof($myfile)) {

  		//echo fgets($myfile) . "<br>";
  		$line = fgets($myfile). "<br>";
  		$pieces = explode(" ", $line);
  		$p1 = intval($pieces[0]);
  		$p2 = intval($pieces[1]);
  		$p3 = intval($pieces[2]);

  		//echo $p1." ".$p2. " ".$p3."<br>";
  		$value = $p1 * $p2 * $p3;
  		if($p1 !=null && $p2 !=null && $p3 != null && $value > 0 && $pieces[3] == null) {

  			echo $pieces[0]. " ". $pieces[1]. " ". $pieces[2];
  			$sql = "INSERT INTO logdemensions(WIDTH,HEIGHT,LENGTH,DATE)
  			VALUES('$p1','$p2','$p3',null)";
  			if($conn->query($sql)===false)echo "error inputting log demensions";
  		}
  		else{
  			//echo "\nThis log had improper dimensions:" . $line . "\n";
  		}
  	$count++;
	}

	fclose($myfile);
	//load the lumber demensions and prices
	$myfile = fopen($target_path2, "r") or die("Unable to open file!");
	// Output one line until end-of-file
	$count = 0;

	echo "Lumber Types: <br> ";
	while(!feof($myfile)) {


  		$line = fgets($myfile). "<br>";
  		//echo $line;
  		$pieces = explode(" ", $line);

  		$p1 = intval($pieces[0]);
  		$p2 = intval($pieces[1]);
  		$p3 = intval($pieces[2]);
  		$p4 = floatval($pieces[3]);


  		$value2 = $p1 * $p2 * $p3 *$p4;
  		if($p1 !=null && $p2 !=null && $p3 != null && $p4 != null && $value2 > 0
  					    							&& $pieces[4] == null){

  			echo $p1. " ". $p2. " ". $p3 . " " . $p4 . "<br>";
  			$sql = "INSERT INTO currentlumber(WIDTH,HEIGHT,LENGTH,PRICE,DATE)
  			VALUES('$p1','$p2','$p3','$p4',null)";
  			if($conn->query($sql)===false)echo "error inputting lumber prices";
  		}
  		else{
  			if(feof($myfile)){
  				echo "scrap is: " . $line . "\n";
  				$scrapval = floatval($line);
  				$sql = "INSERT INTO currentlumber(WIDTH,HEIGHT,LENGTH,PRICE,DATE)
  					VALUES(12,12,12,$scrapval,null)";
  				if($conn->query($sql)===false)echo "error inputting lumber prices";
  			}
  			else{
  				//echo "This lumber had improper values: " . $line . "\n";
  			}
  		}

  	 $count++;
	}

	fclose($myfile);
	$count=0;
?>
</div>
<div align="center">
<h1>Uploading....Done</h1>
<a href="woodCutter.php">Cut Wood</a>
<a href="index.html">Go home</a>
</div>
</body></html>
