<?php
	include 'connection.php';
	include 'Log.php';
	include 'Lumber.php';
	include 'Inventory.php';

	// Create connection
	$conn = new mysqli($host, $user, $password, $db);
	?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="style.css">
<style>
	.bgimg{
    min-height: 40%;
    background-position: center;
    background-size: cover;
	}
	.bgimg {background-image: url("http://cdn.pcwallart.com/images/dark-forest-background-wallpaper-3.jpg")}
</style>
<!-- Header -->
<header class="w3-display-container w3-wide bgimg w3-grayscale-min" id="home">
  <div class="w3-display-middle w3-text-white w3-center">
    <h1 class="w3-jumbo">LumberLads</h1>
    <h2><b>Fall 2016</b></h2>
  </div>
</header>
<body>
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

<h1 align = "center">Current Inventory</h1>
<div align="center">
<?php


	$myinventory = array();
	//select the most recently added Current lumber
	$sql = "SELECT * FROM inventory";
	$result = $conn -> query($sql);
	if($result ->num_rows > 0 ) {
	while($row = $result->fetch_assoc()) {
    	$inventoryObject = new Inventory();
    	$inventoryObject->mytype= $row['TYPE'];
    	$inventoryObject->mycount = $row['count'];
    	$inventoryObject->price = $row['price'];

    	array_push($myinventory,$inventoryObject);

    	}
	} else {
    	echo "0 results";
	}

	echo "<table class=\"w3-table-all w3-centered w3-hoverable w3-responsivew\">";
	echo "<tr><td>Type:</td><td>Count:</td><td>Price Per Board:</td></tr>";
	foreach($myinventory as $var){
		echo "<tr>";
		echo "<td>" . $var->mytype . "</td><td>" . $var->mycount . "</td><td>$" . number_format($var->price,2) . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "</td>";
	echo "</table>";
?>
</div>
</body>

</html>
