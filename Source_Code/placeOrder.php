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
<body >

<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

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
<!-- End top navigation bar -->
<body>

<h2 align="center">LumberYard Order Page</h2>
<div style="margin-left: 30%; margin-right: 30%">

<form id="form1" name="form1" method="post" action="submitorder.php">
  <fieldset>
  <legend align="center"><b>Order information:</b></legend>
  First name:<br>
  <input type="text" name="firstName" id="firstName"><br>
  Last name:<br>
  <input type="text" name="lastName" id="lastName" ><br>

    Address:<br>
    <input type="text" name="Address" id="Address"><br>
    Appartment #:<br>
    <input type="text" name="appartment" id="appartment"><br>
    City:<br>
    <select name="City" id="City">
    <option value="Quitman">Quitman</option>
    <option value="Hahira">Hahira</option>
    <option value="Adel">Adel</option>
    <option value="Lakeland">Lakeland</option>
    <option value="Statenville">Statenville</option>
    <option value="LakePark">Lake Park</option>
    <option value="Jasper">Jasper</option>
    <option value="Madison">Madison</option>
    <option value="Tifton">Tifton</option>
    <option value="Nashville">Nashville</option>
    <option value="Homerville">Homerville</option>
    <option value="Pearson">Pearson</option>
    <option value="Douglass">Douglass</option>
    <option value="Waycross">Waycross</option>
    <option value="Fargo">Fargo</option>
    <option value="LakeCityMonticello">Lake City Monticello</option>
    <option value="Tallahassee">Tallahassee</option>
    <option value="Thomasville">Thomasville</option>
    <option value="Jacksonville">Jacksonville</option>
    </select><br>
    Zip Code:<br>
    <input type="text" name="Zip" id="Zip"><br><br>

    Type Quantity of each size you would like to purchase:<br>
    <table class="table table-bordered">
        <col width="100">
        <col width="100">
        <col width="100">
    <thead>
          <tr>
            <th align="left">Size</th>
            <th align="left">In Stock</th>
            <th align="left">Quantity</th>
            <th align="left">Unit Price</th>
          </tr>
    </thead>
    <tbody>
      <?php
     require('connection.php');

//$user = 'root';


$conn = new mysqli($host, $user, $password, $db);
      $sql = "SELECT TYPE, count, price FROM inventory";
	     $result = $conn -> query($sql);

      $quan= 0;
	     while($row = $result->fetch_assoc()) {


        echo     "<tr>
              <td>{$row['TYPE']}</td>
              <td>{$row['count']}</td>
              <td><input type='number' name='{$quan}'></td>
              <td>\${$row['price']}</td>
            </tr>";
            $quan++;
      }

      ?>

    </tbody>
</table><br>

<br><br>
  <input type="submit" value="Submit">
</form>

<br />
<br />
<br />
<br />
<br />
<br />

</div>

</body>
</html>
