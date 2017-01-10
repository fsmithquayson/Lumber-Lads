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
<style>
	.bgimg{
    min-height: 30%;
    background-position: center;
    background-size: cover;
	}
	.bgimg {background-image: url("http://cdn.pcwallart.com/images/dark-forest-background-wallpaper-3.jpg")}
</style>


<div>
<?php
include "connection.php";

//$user = 'root';

//$db = 'lumberyard2';
$conn = new mysqli($host, $user, $password, $db);
//gADD
$orderNum =("SELECT orderNumber FROM inventoryreceipts ORDER BY id DESC LIMIT 0,1");
$query = $conn -> query($orderNum);
$row = mysqli_fetch_assoc($query);
$orderNumber = $row['orderNumber'];
$orderNumber += 1;


$result = ("SELECT count, TYPE, price FROM inventory LIMIT 0,1");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['0'];

if ($_POST['City'] == 'Jasper' || $_POST['City'] == 'Madison' || $_POST['City'] == 'Tallahassee' || $_POST['City'] == 'Jacksonville' || $_POST['City'] == 'Lake City Monticello')
{
  $State = 'FL';
}
    else {
            $State = 'GA';
         }

echo "Your order number is : '$orderNumber'
 Your first name is : '{$_POST['firstName']}' <br>
 Your last name is : '{$_POST['lastName']}' <br>
 Your Address is : '{$_POST['Address']}' <br>
 Your city is : '{$_POST['City']}' <br>
 Your State is : '{$State}' <br>
 Your Zipcode is : '{$_POST['Zip']}' <br> <br>";

if ($_POST['0'] >= 1 && $remaining >= 0) {
  $total = ($_POST['0'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['0']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['0']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";

}

  else if ($_POST['0'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $success = $conn ->query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['0']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 1,2");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['1'];

if ($_POST['1'] >= 1 && $remaining >= 0) {
  $total = ($_POST['1'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['1']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['1']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['1'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['1']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 2,3");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['2'];

if ($_POST['2'] >= 1 && $remaining >= 0) {
  $total = ($_POST['2'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['2']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['2']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['2'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['2']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 3,4");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['3'];

if ($_POST['3'] >= 1 && $remaining >= 0) {
  $total = ($_POST['3'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['3']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['3']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['3'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['3']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 4,5");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['4'];

if ($_POST['4'] >= 1 && $remaining >= 0) {
  $total = ($_POST['4'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['4']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['4']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['4'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['4']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 5,6");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['5'];

if ($_POST['5'] >= 1 && $remaining >= 0) {
  $total = ($_POST['5'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['5']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['5']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['5'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['5']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 6,7");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['6'];

if ($_POST['6'] >= 1 && $remaining >= 0) {
  $total = ($_POST['6'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['6']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['6']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['6'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['6']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 7,8");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['7'];

if ($_POST['7'] >= 1 && $remaining >= 0) {
  $total = ($_POST['7'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['7']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['7']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['7'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['7']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 8,9");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['8'];


if ($_POST['8'] >= 1 && $remaining >= 0) {
  $total = ($_POST['8'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['8']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['8']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['8'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['8']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 9,10");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['9'];

if ($_POST['9'] >= 1 && $remaining >= 0) {
  $total = ($_POST['9'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['9']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

echo "You ordered {$_POST['9']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['9'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['9']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 10,11");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['10'];

if ($_POST['10'] >= 1 && $remaining >= 0) {
  $total = ($_POST['10'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['10']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['10']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['10'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['10']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 11,12");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['11'];

if ($_POST['11'] >= 1 && $remaining >= 0) {
  $total = ($_POST['11'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['11']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['11']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['11'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['11']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 12,13");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['12'];


if ($_POST['12'] >= 1 && $remaining >= 0) {
  $total = ($_POST['12'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['12']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['12']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['12'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['12']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 13,14");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['13'];


if ($_POST['13'] >= 1 && $remaining >= 0) {
  $total = ($_POST['13'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['13']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['13']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['13'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['13']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 14,15");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['14'];


if ($_POST['14'] >= 1 && $remaining >= 0) {
  $total = ($_POST['14'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['14']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['14']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['14'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['14']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 15,16");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['15'];

if ($_POST['15'] >= 1 && $remaining >= 0) {
  $total = ($_POST['15'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['15']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['15']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['15'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['15']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 16,17");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['16'];

if ($_POST['16'] >= 1 && $remaining >= 0) {
  $total = ($_POST['16'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['16']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['16']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['16'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['16']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$result = ("SELECT count, TYPE, price FROM inventory LIMIT 17,18");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['17'];

if ($_POST['17'] >= 1 && $remaining >= 0) {
  $total = ($_POST['17'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['17']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['17']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['17'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['17']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}
//========================================================================
$result = ("SELECT count, TYPE, price FROM inventory LIMIT 18,19");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['18'];

if ($_POST['18'] >= 1 && $remaining >= 0) {
  $total = ($_POST['18'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['18']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['18']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['18'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['18']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}
//========================================================================
$result = ("SELECT count, TYPE, price FROM inventory LIMIT 19,20");
$query = $conn -> query($result);
$row = mysqli_fetch_assoc($query);

$remaining = $row['count'] - $_POST['19'];

if ($_POST['19'] >= 1 && $remaining >= 0) {
  $total = ($_POST['19'] * $row['price']);

  $update = "UPDATE inventory SET count=$remaining WHERE TYPE='{$row['TYPE']}'";
  $success = $conn -> query($update);

  $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$_POST['19']}', '{$row['price']}', '$total' )";
  $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());
echo "You ordered {$_POST['19']} {$row['TYPE']}. There are $remaining {$row['TYPE']} left in stock. <br>";
}

  else if ($_POST['19'] >= 1 && $remaining < 0) {
    $total = ($row['count'] * $row['price']);

    $update = "UPDATE inventory SET count=0 WHERE TYPE='{$row['TYPE']}'";
    $setZero= $conn -> query($update);

    $inventoryreceipt = "INSERT INTO inventoryreceipts (orderNumber, type, count, price, total) VAlUES ('$orderNumber', '{$row['TYPE']}', '{$row['count']}', '{$row['price']}', '$total' )";
    $insert = $conn -> query($inventoryreceipt) or die("Could not process query: " . mysql_error());

    echo "You tried to order {$_POST['19']} {$row['TYPE']}, but there were only {$row['count']} {$row['TYPE']} left in stock. We will give you {$row['count']}. <br>";
}

$receipt = "INSERT INTO receipts (orderNumber, firstName, lastName, Address, City, State, Zip_Code) VALUES ('$orderNumber', '{$_POST['firstName']}', '{$_POST['lastName']}', '{$_POST['Address']}', '{$_POST['City']}', '{$State}', '{$_POST['Zip']}')";
$success = $conn -> query($receipt) or die("Could not process query: " . mysql_error());

 ?>
 </div>

 </html>
