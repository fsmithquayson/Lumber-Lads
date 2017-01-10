<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body>
<style>
	.bgimg{
    min-height: 30%;
    background-position: center;
    background-size: cover;
	}
	.bgimg {background-image: url("http://cdn.pcwallart.com/images/dark-forest-background-wallpaper-3.jpg")}
</style>
<script>

</script>
<!-- Header -->
<header class="w3-display-container w3-wide bgimg w3-grayscale-min" id="home">
  <div class="w3-display-middle w3-text-white w3-center">
    <h1 class="w3-jumbo">LumberLads</h1>
    <h2><b>Fall 2016</b></h2>
  </div>
</header>
<!-- Top Navigation Bar -->
<div class="w3-hide-small">
  <ul class="w3-navbar w3-black w3-center w3-padding-8 w3-opacity-min w3-hover-opacity-off">
  	<li style="width:8%">
  	<a href="index.html">
  	<img src="images/home-icon.png" style="width:32px;height:32px;border:10px">
	</a>
	</li>
    <li style="width:23%"><a href="fileInput.php" class="w3-margin-left w3-round">Input Logs</a></li>
    <li style="width:23%"><a href="viewInventory.php" class="w3-round">View Inventory</a></li>
    <li style="width:23%"><a href="placeOrder.php" class="w3-round">Place Order</a></li>
    <li style="width:23%"><a href="receipts.php" class="w3-margin-right w3-round">View Receipts</a></li>
  </ul>
</div>
<p>Hi, Welcome to LumberLad's  LumberYard. If you would like to come some wood, please use our simple uploader
system to upload lumber values and log demensions and let us do the rest!</p>
<div>
	<div name="uploadForm" style="border:1px solid black; 
							   ">
	<form action="uploader.php" method="post" enctype="multipart/form-data">
    	Select file to upload for Log Demensions:
		<input type="file" name="fileToUpload" id="fileToUpload">
    
    	<br>
    	Select file to upload for Lumber Dimensions:
    	<input type="file" name="fileToUpload2" id="fileToUpload2"><br>
    	<div align="center">
    		<input type="submit" value="Upload File" name="submit" >
   		</div>
<?php
include 'connection.php';
// Create connection
$conn = new mysqli($host, $user, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
	</form>
	
</div>
</body></html>