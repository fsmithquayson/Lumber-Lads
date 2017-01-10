<!this will be used for processing logs from db>

<html>
<head>
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
</head>
<body>
<?php
	include "connection.php";
	include "Log.php";
	include "Lumber.php";
	include "Cut.php";
	include "Area.php";
	include "Inventory.php";
	// Create connection
	$conn = new mysqli($host, $user, $password, $db);


?>
<h1 align = "center">Where the magic happens.</h1>
<div align = "center">
<table>
<tr>
<td>Theses are the current logs that need to be cut for lumber.<br><div align="center">(W-H-L)</div></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>These are the most up to date prices and types of lumber <br>cuts that we can perform.
	W-H-L-P</td>
</tr>
<tr>
	<td>
	<?php
	$logs = array();
	//select the most recently added log demensions
	$sql = "SELECT * FROM logdemensions WHERE DATE IN (SELECT max(DATE) FROM logdemensions)";
	$result = $conn -> query($sql);
	if($result ->num_rows > 0 ) {
		while($row = $result->fetch_assoc()) {
			$mylog = new Log();
    		$mylog->width = $row['WIDTH'];
    		$mylog->height = $row['HEIGHT'];
    		$mylog->length = $row['LENGTH'];
    		//echo $mylog->width . " X " . $mylog->height . " X " . $mylog->length . "<br>";
    		array_push($logs,$mylog);
    	}

	} else {
    	echo "0 results";
	}

	foreach($logs as $log){
		//print_r($log);
		echo "<br>";
		echo $log-> width . " X " . $log -> height . " X " . $log ->length;
	}


	echo "</td><td></td><td>";
	$lumberTypes = array();
	//select the most recently added Current lumber
	$sql = "SELECT * FROM currentlumber WHERE DATE IN (SELECT max(DATE) FROM currentlumber)";
	$result = $conn -> query($sql);
	if($result ->num_rows > 0 ) {
	while($row = $result->fetch_assoc()) {
    	$mylumber = new Lumber();
    	$mylumber->width = $row['WIDTH'];
    	$mylumber->height = $row['HEIGHT'];
    	$mylumber->length = $row['LENGTH'];
    	$mylumber->price = $row['PRICE'];
    	array_push($lumberTypes,$mylumber);
    	}
	} else {
    	echo "0 results";
	}
	foreach($lumberTypes as $lumber){
		$lum = new Lumber();
		$lum->width = $lumber->height;
		$lum->height = $lumber->width;
		$lum->length = $lumber->length;
		$lum->price = $lumber->price;
		array_push($lumberTypes,$lum);


	}

	usort($lumberTypes,"cmp");
	$lumberTypes = array_reverse($lumberTypes);

	foreach($lumberTypes as $lumber){
		if($lumber->height != 12 && $lumber->width != 12){
		echo $lumber->width . " X " . $lumber->height . " X " . $lumber->length . " X " .
				$lumber->price . "<br>";
		}
		else{
			$scrapPrice = $lumber->price;
		}
	}
	/****************************************************************************
		Cuting starts here
	******************************************************************************/
	?>
		</td>
</tr>
</table>
</div>
	<?php

	// Create connection

	 $conn = new mysqli($host, $user, $password, $db);



	function makeCutsTest($lumberTypes,$logs,$conn,$scrapPrice){
	$summary =  array();
	$totalscrap = array();
	echo "<h3>Cutting Lumber..</h3><br>";

	$i = 1;
	foreach($logs as $myLog){

		echo "<h3>Log: " . $i . "</h3>";
		$i++;
	$logw = $myLog->height;
	$logh = $myLog->width;
	$logl = $myLog->length;


		$bestcuts = array();
		$idnum = 1;
		$origin = new Cut();
		$origin->id = 0;
		foreach($lumberTypes as $lum){
			$lumh = $lum->height;
			$lumw = $lum->width;
			$price = $lum->price;
			$luml = $lum->length;
			$cut = new Cut();
			$cut = makeCuts($logh,$logw,$lumh,$lumw,$price);
			$cut->parentid = 0;
			$cut->id = $idnum;
			$cut->mytype = (string)($lumh . "x" . $lumw);
			$cut->length = $luml;
			$cut->width = $lumw;
			$cut->height = $lumh;
			$cut->price = $price;
			$idnum++;
			if($cut->val > 0){
				$key = $cut->id;
				$bestcuts[$key] = $cut;

			}

			$area = $cut->areas;
			while($area != null){
				foreach($area as $x => $x_val){


					$log1h = $x_val->high;
					$log1w = $x_val->wid;

					foreach($lumberTypes as $lum1){ // foreach 1
						$lum1h = $lum1->height;
						$lum1w= $lum1->width;
						$price1 = $lum1->price;
						$cut2 = new Cut();
						$cut2 = makeCuts($log1h,$log1w,$lum1h,$lum1w,$price1);

						$cut2->parentid = $cut->id;

						$cut2->mytype = (string)($lum1h . "x" . $lum1w);
						$cut2->length = $lum1->length;
						$cut2->width = $lum1->width;
						$cut2->height = $lum1->height;
						$cut2->price =  $price1;
						if($cut2->val > 0){
					  		$cut2->id = $idnum;
					  		$cut2->val = $cut2->val + $cut->val;

					  		$key = $cut2->id;

					  		$bestcuts[$key] = $cut2;
					   		$idnum++;
					 }//close foreach 1

					//$cut->areas = $cut2->areas;


				}// for each two
				//$cut = $cut2;

				$area = $cut2->areas;
				//$cut->areas = $cut2->areas;
			}//while
			//since cut2 relies on cut values reassign for proper parent id'ing
			//$cut = $cut2;
		}//foreach lumber
		$cut = $cut2;
	}//for each log

	$maxval = 0;
	$maxCut = new Cut();
	foreach($bestcuts as $thiscut){
		if($thiscut->val > $maxval){
		 $maxval = $thiscut->val;
		 $maxCut = $thiscut;
		 }
	}


	$logvolume = $logh * $logw * $logl;

	echo "<table border = \'1px solid black \'>";
	echo "<tr><td>Quantity</td><td>Height</td><td>Width</td><td>Length</td><td>Value</td></tr>";

	while($maxCut->parentid != 0){
		$maxCut->quan = intval($maxCut->quan) * intval($logl/$maxCut->length);

		//************************************************************************
		//this is for getting current quantity from inventory and updating it
		$quan = intval($maxCut->quan);
		$thistype = strval($maxCut->mytype);
		$thisprice = floatval($maxCut->price);
		$sql = "SELECT * FROM inventory WHERE TYPE = '$thistype'";
		$query = $conn -> query($result);
		$result = $conn -> query($sql);
		if($result ->num_rows > 0 ) {
			while($row = $result->fetch_assoc()) {
    			$inventoryObject = new Inventory();
    			$inventoryObject->mytype= $row['TYPE'];
    			$inventoryObject->mycount = $row['count'];
    			$inventoryObject->price = $row['price'];

    			$quan+=$inventoryObject->mycount;

    			$sql1 = "UPDATE inventory
         		   SET count =  '$quan', price ='$thisprice'
        	 	   WHERE TYPE = '$thistype'";
				if($conn->query($sql1)===false)echo "error updating quantity";

    		}
			} else {
				//here we are gonna try it a different way;)
    			$thistype = strrev($thistype);
    			$sql = "SELECT * FROM inventory WHERE TYPE = '$thistype'";
				$query = $conn -> query($result);
				$result = $conn -> query($sql);
			}


		//************************************************************************
		//this is for getting current quantity from inventory and updating it
		$quan = intval($maxCut->quan);
		$thistype = strval($maxCut->mytype);
		$thisprice = floatval($maxCut->price);
		$sql = "SELECT * FROM inventory WHERE TYPE = '$thistype'";
		$query = $conn -> query($result);
		$result = $conn -> query($sql);
		if($result ->num_rows > 0 ) {
			while($row = $result->fetch_assoc()) {
    			$inventoryObject = new Inventory();
    			$inventoryObject->mytype= $row['TYPE'];
    			$inventoryObject->mycount = $row['count'];

    			$quan+=$inventoryObject->mycount;

    			$sql1 = "UPDATE inventory
         		   SET count =  '$quan', price ='$thisprice'
        	 	   WHERE TYPE = '$thistype'";
				if($conn->query($sql1)===false)echo "error updating quantity";
				echo "<tr><td>" . number_format($maxCut->quan,2) . "</td> <td>" . number_format($maxCut->height,2).
						"</td> <td>" . number_format($maxCut->width,2) . "</td> <td>" .
					number_format($maxCut->length,2)
					. "</td> <td>$" .number_format($maxCut->quan*$maxCut->price,2) . "</td></tr>";
					array_push($summary,$maxCut);
    		}
			} else {
				//here we are gonna try it a different way;)
    			$thistype = strrev($thistype);
    			$w = $maxCut->width;
    			$maxCut->width = $maxCut->height;
    			$maxCut->height = $w;
    			$maxCut->mytype = $thistype;
    			$sql = "SELECT * FROM inventory WHERE TYPE = '$thistype'";
				$query = $conn -> query($result);
				$result = $conn -> query($sql);
				if($result ->num_rows > 0 ) {
					while($row = $result->fetch_assoc()) {
    					$inventoryObject = new Inventory();
    					$inventoryObject->mytype= $row['TYPE'];
    					$inventoryObject->mycount = $row['count'];
    					$inventoryObject->price = $row['price'];
    					$quan+=$inventoryObject->mycount;
    					$sql1 = "UPDATE inventory
         				   SET count =  '$quan', price ='$thisprice'
        	 			   WHERE TYPE = '$thistype'";
						if($conn->query($sql1)===false)echo "error updating quantity";
						echo "<tr><td>" . number_format($maxCut->quan,2) . "</td> <td>" . number_format($maxCut->height,2).
							"</td> <td>" . number_format($maxCut->width,2) . "</td> <td>" .
							number_format($maxCut->length,2)
							. "</td> <td>$" .number_format($maxCut->quan*$maxCut->price,2) . "</td></tr>";
						array_push($summary,$maxCut);
    				}
				}
			}//sloses else
		//************************************************************************

		$logvolume = $logvolume - $maxCut->quan * intval($maxCut->width) * intval($maxCut->height)
											* intval($maxCut->length);

		$pid = intval($maxCut->parentid);
		foreach($bestcuts as $cut){
			if($cut->id == $pid){
				$maxCut = $cut;
			}
		}


	}//closes while statement

	$maxCut->quan = intval($maxCut->quan) * intval($logl/$maxCut->length);

	$quan = intval($maxCut->quan);
	$thistype = strval($maxCut->mytype);
	$thisprice = floatval($maxCut->price);


	//*******************************************************
	$sql = "SELECT * FROM inventory WHERE TYPE = '$thistype'";
	$query = $conn -> query($result);
	$result = $conn -> query($sql);
	if($result ->num_rows > 0 ) {
	while($row = $result->fetch_assoc()) {
    	$inventoryObject = new Inventory();
    	$inventoryObject->mytype= $row['TYPE'];
    	$inventoryObject->mycount = $row['count'];
    	$inventoryObject->price = $row['price'];


    	$quan+=$inventoryObject->mycount;

    	$sql1 = "UPDATE inventory
            SET count =  '$quan', price = '$thisprice'
            WHERE TYPE = '$thistype'";

		if($conn->query($sql1)===false)echo "error updating quantity";
		echo "<tr><td>" . number_format($maxCut->quan,2) . "</td> <td>" . number_format($maxCut->height,2).
			"</td> <td>" . number_format($maxCut->width,2) . "</td> <td>" .
			number_format($maxCut->length,2)
			. "</td> <td>$" .number_format($maxCut->quan*$maxCut->price,2) . "</td></tr>";
		echo "</table>";

			array_push($summary,$maxCut);
    	}
	} else {
    			//here we are gonna try it a different way;)
    			$thistype = strrev($thistype);
    			$w = $maxCut->width;
    			$maxCut->width = $maxCut->height;
    			$maxCut->height = $w;
    			$maxCut->mytype = $thistype;
    			$sql = "SELECT * FROM inventory WHERE TYPE = '$thistype'";
				$query = $conn -> query($result);
				$result = $conn -> query($sql);
				if($result ->num_rows > 0 ) {
					while($row = $result->fetch_assoc()) {
    					$inventoryObject = new Inventory();
    					$inventoryObject->mytype= $row['TYPE'];
    					$inventoryObject->mycount = $row['count'];
    					$inventoryObject->price = $row['price'];


    					$quan+=$inventoryObject->mycount;

    					$sql1 = "UPDATE inventory
         				   SET count =  '$quan', price ='$thisprice'
        	 			   WHERE TYPE = '$thistype'";
						if($conn->query($sql1)===false)echo "error updating quantity";
						echo "<tr><td>" . number_format($maxCut->quan,2) . "</td> <td>" . number_format($maxCut->height,2).
							"</td> <td>" . number_format($maxCut->width,2) . "</td> <td>" .
							number_format($maxCut->length,2)
							. "</td> <td>$" .number_format($maxCut->quan*$maxCut->price,2) . "</td></tr>";
						echo "</table>";
						array_push($summary,$maxCut);
    				}
				}
	}
	//************************************************************************

	$logvolume = $logvolume - $maxCut->quan  * intval($maxCut->width) * intval($maxCut->height)
									* intval($maxCut->length);
	$scrapinin = $logvolume;
	$scrapvolume =$logvolume/1728;
	$percentscrap = number_format(100 *$scrapinin / ($logh * $logw * $logl),2);
	$lumbertotworth = $maxval * intval($logl/$maxCut->length);
	if($percentscrap == 100) $scrapvolume = ($logh * $logw * $logl)/1728;
	echo "<br>Scrap: " . number_format($logvolume/1728,6) . " cubic feet.<br>";
	array_push($totalscrap,$scrapvolume);
	echo "<table border = \'1px solid black \'>";
	echo "<tr><td></td><td>Value</td><td>%Value</td></tr>";
	echo "<tr><td>Lumber</td><td>$" . number_format($lumbertotworth,2) . "</td><td>" . (100 - $percentscrap) . "%<td><tr>";
	echo "<tr><td>Scrap</td><td>$" .number_format($scrapvolume *
    			$scrapPrice,2). "</td><td>" . $percentscrap . "%<td><tr>";
	echo "<tr><td>Total</td><td>$" . number_format(($lumbertotworth + $scrapvolume * $scrapPrice),2) . "</td><td></td></tr>";
	echo "</table>";
		///update the scrap
	$sql = "SELECT * FROM inventory WHERE TYPE = 'scrap'";
	$query = $conn -> query($result);
	$result = $conn -> query($sql);
		if($result ->num_rows > 0 ) {
			while($row = $result->fetch_assoc()) {
    			$inventoryObject = new Inventory();

    			$mycount = floatval($row['count']);
    			$inventoryObject->price = $row['price'];



    			$scrapvolume += $mycount;

    			number_format($scrapvolume,2);
    			//$thistype = strval('scrap');
    			$sql1 = "UPDATE inventory
            		SET count =  '$scrapvolume', price = '$scrapPrice'
           			 WHERE TYPE = 'scrap'";


				if($conn->query($sql1)===false)echo "error updating quantity";
			}
		}else {
    		echo "0 results";
    		echo " yet";
		}

	}
	//here we want to display a cumalative cut report
	$FinalSummary = array();
	$FinalSummary2 = array();
	$cutsum = new Cut();
	$temp;
	foreach($summary as $sum){

		//echo "<br>" .  " ". $sum->mytype. " " . $sum->height . "x" . $sum->width . "x".$sum->length
		//		. "  $". number_format($sum->price * $sum->quan,2) . "<br>";

		if(!array_key_exists($sum->mytype,$FinalSummary)){
		 	$FinalSummary[$sum->mytype] = $sum->price * $sum->quan;
		 	$temp = $FinalSummary[$sum->mytype];


		}
		 else{
			$temp = $FinalSummary[$sum->mytype];
			$FinalSummary[$sum->mytype] = $temp + $sum->price * $sum->quan;
		}
		if(!array_key_exists($sum->mytype,$FinalSummary2)){
			$cutsum = new Cut();
		 	$cutsum->mytype = $sum->mytype;
		 	$cutsum->length = $sum->length;
		 	$cutsum->width = $sum->width;
		 	$cutsum->height = $sum->height;
		 	$cutsum->price = $sum->price;
		 	$cutsum->quan = $sum->quan;
		 	$FinalSummary2[$cutsum->mytype] = $cutsum;

		}
		else{
			$temp = new Cut();
			$temp = $FinalSummary2[$sum->mytype];
			$temp->quan = $temp->quan + $sum->quan;
			$FinalSummary2[$sum->mytype] = $temp;
		}
	}
	echo "<br>Summary<br>";
	echo "<table border = \'1px solid black \'>";
	echo "<tr><th>Quantity</th><th>Height</th><th>Width</th><th>Length</th><th>Value</th></tr>";
		$temptotal = 0;
		foreach($FinalSummary2 as $key=>$cutval){
			echo "<tr><td>" . $cutval->quan  . "</td><td>" .$cutval->height . "</td><td>" . $cutval->width. "</td><td>". $cutval->length."</td><td>$"
				. number_format($cutval->quan*$cutval->price,2) . "</td></tr>";
				$value = $cutval->quan*$cutval->price;
				$temptotal += $value;
		}
	echo "</table>";
	$scrap = array_sum($totalscrap);
	$totscrapworth = $scrap * $scrapPrice;
	echo "<br>Total Scrap:   ". number_format($scrap,2) . "cf<br>";
	echo "<table border = \'1px solid black \'>";
	echo "<tr><th></th><th>Value</th><th>% Values</th></tr>";
	echo "<tr><td>Lumber</td><td>$".number_format($temptotal,2). "</td><td>".
		number_format($temptotal/($temptotal+$totscrapworth)*100,2) . "%</td></tr> ";
	echo "<tr><td>Scrap</td><td>$". number_format($totscrapworth,2)."</td><td>" .
		number_format($totscrapworth/($temptotal+$totscrapworth)*100,2)."%</td></tr>";
	echo "<tr><td>Total </td><td>$" . number_format($temptotal + $totscrapworth,2) . "</td><td></td></tr>";
	echo "</table>";





	//select the most recently added Current lumber
	$myinventory = array();
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
    	echo "0 results here";
	}


	/*
	//display the inventory here
	echo "<table>";
	echo "<tr><td>Type:</td><td>Count:</td><td>Price Per Board:</td></tr>";
	foreach($myinventory as $var1){
		echo "<tr>";
		echo "<td>" . $var1->mytype . "</td><td>" . $var1->mycount . "</td><td>$" . number_format($var1->price,2) . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	*/

	echo "<br><a href=woodcutter.php>go back</a>";
	echo "<br><a href=index.html>Home</a>";

	}// close function

	?>


<div align="center">
	<p>Please confirm if you would like to authorize the cuts.</p>
	<input type="submit" name="agree" onclick="document.write('<?php makeCutsTest($lumberTypes,$logs,$conn,$scrapPrice) ?>');" value="yes">
	<input type="submit" value="no">
</div>
<script>

</script>
<?php
function cmp($a, $b)
{
	return ($a-> price > $b -> price) ? +1 : -1;
}
/*************************************************************************************
 Helper functions for the main algorithm recursive because why not still runs super fast
	*************************************************************************************/
	function makecutshelperUp($a,$b,$c,$d){
		if($a < $c){
			return 0;
		}
		else{
			return 1 + makecutshelperup($a-$c,$b,$c,$d);
		}
	}
	function makecutshelperside($a,$b,$c,$d){
		if($b < $d){
			return 0;
		}
		else{
			return  1 + makecutshelperside($a,$b-$d,$c,$d);
		}
	}
	/*************************************************************************************
				Main Portion : this cuts an area and returns the 4 possible sub areas
	*************************************************************************************/
	function makeCuts($a,$b,$c,$d, $price){
		$thiscut = new Cut();
		$quantity1 = makecutshelperup($a,$b,$c,$d);
		$quantity2 = makecutshelperside($a,$b,$c,$d);
		$totalpieces = $quantity1 *$quantity2;
		$areas = array();
		if($a >= $c && $b >= $d){
			$a1 = new Area();
			$a1->high = $a%$c;
			$a1->wid = $b;
			$areas['a1'] = $a1;
		}
		if($a >= $d && $b >= $c){
			$a2 = new Area();
			$a2->high = $a - $a%$c;
			$a2->wid = $b%$d;
			$areas['a2'] = $a2;
		}
		if($a >= $c && $b >= $d){
			$a3 = new Area();
			$a3->high = $a%$c;
			$a3->wid = $b - $b%$d;
			$areas['a3'] = $a3;
		}
		if($a > $d && $b > $c){
			$a4 = new Area();
			$a4->high = $a;
			$a4->wid = $b%$d;
			$areas['a4'] = $a4;
		}
		$thiscut->quan = $totalpieces;
		$thiscut->val = $totalpieces * $price;
		$thiscut->areas = $areas;
		return $thiscut;
	}
?>
</body></html>
