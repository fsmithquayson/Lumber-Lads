<?php
	include 'Lumber.php';
	$logh = 7;
	$logw = 7;

	$lum1 = new Lumber();
	$lum1->height = 4;
	$lum1->width = 4;
	$lum1->price = 11.00;
	
	$lum2 = new Lumber();
	$lum2->height = 2;
	$lum2->width = 4;
	$lum2->price = 5.00;
	
	$lum3 = new Lumber();
	$lum3->height = 4;
	$lum3->width = 2;
	$lum3->price = 5.00;
	
	$lum4 = new Lumber();
	$lum4->height = 1;
	$lum4->width = 2;
	$lum4->price = 1.00;
	$lum5 = new Lumber();
	$lum5->height = 2;
	$lum5->width = 1;
	$lum5->price = 1.00;
	
	$lumbertypes = array($lum1,$lum2, $lum3, $lum4, $lum5);
	
	$bestcuts = array();
	
	$idnum = 1;
	$origin = new Cut();
	$origin->id = 0;
	foreach($lumbertypes as $lum){
		$lumh = $lum->height;
		$lumw = $lum->width;
		$price = $lum->price;
		$cut = new Cut();
		$cut = makeCuts($logh,$logw,$lumh,$lumw,$price);
		$cut->parentid = 0;
		$cut->id = $idnum;
		$cut->mytype = (string)($lumh . "x" . $lumw);
		$idnum++;
		if($cut->val > 0){
			$key = $cut->id;
			$bestcuts[$key] = $cut;
			array_push($bestcuts2,$cut);
		}
		echo "<br>Value of first cut: ***************************************************";	
		echo "<br>cut: " . $cut->mytype . " $" . $cut->val. " id:" .$cut->id . "<br>";
		$area = $cut->areas;
		while($area != null){
		
		foreach($area as $x => $x_val){
			
			echo "<br>**********area to fit in: = " . $x . " Values: " . $x_val->high . "X" . $x_val->wid . "<br>";
			$log1h = $x_val->high;
			$log1w = $x_val->wid;
			
			foreach($lumbertypes as $lum1){
				$lum1h = $lum1->height;
				$lum1w= $lum1->width;
				$price1 = $lum1->price;
				$cut2 = new Cut();
				$cut2 = makeCuts($log1h,$log1w,$lum1h,$lum1w,$price1);
				
				$cut2->parentid = $cut->id;
				
				$cut2->mytype = (string)($lum1h . "x" . $lum1w);
				
				if($cut2->val > 0){
				  $cut2->id = $idnum;
				  $cut2->val = $cut2->val + $cut->val;
	
				  $key = $cut2->id;
				  array_push($bestcuts2,$cut2);
				  $bestcuts[$key] = $cut2;
				   $idnum++;
				 } 
				 if($cut2->val > 0){
					echo "<br>Value of inner cut:";
					echo "<br>cut: " . $cut2->mytype . "Quantity: " .
						$cut2->quan . " $" . $cut2->val. " parent id: " . $cut2->parentid . " id: " .
														$cut2->id .  "<br>";
				
				}
				
			
			//$area = $cut2->areas;	
			}//close inner for loop
			
			$area = $cut2->areas;	
			
			
		}//close area for loop
		//since cut2 relies on cut values reassign for proper parent id'ing
		$cut = $cut2;
					
		}//close the while area != null loop
		
	}//close for each lumbertype outer most loop
	
	$maxval = 0;
	$maxCut = new Cut();
	foreach($bestcuts as $key=> $thiscut){
		if($thiscut->val > $maxval){
		 $maxval = $thiscut->val;
		 $maxCut = $thiscut;
		 }
	}
	foreach($bestcuts as $key=> $thiscut){
		echo "<br>" .$thiscut->id . " " . $thiscut->height . "<br>";
		$newarea = $thiscut->areas;
		foreach($newarea as $a){
		echo "   " . $a->high . "x" . $a->wid . " " ;
		 
		}
		echo "<br>";
	}
	
	echo "the max value from this log is $" . $maxval;
	
	
	while($maxCut->parentid != 0){
		echo "<br>" . $maxCut->mytype . " Q: " . $maxCut->quan . " PID: " . $maxCut->parentid .
					"Id: ".$maxCut->id ." Value " . $maxCut->val . "<br>";
		$pid = intval($maxCut->parentid);
		foreach($bestcuts as $cut){
			if($cut->id == $pid){
				$maxCut = $cut;
			}
		}
			
	}
	echo "<br>" . $maxCut->mytype . " Q: " . $maxCut->quan . " PID: " . $maxCut->parentid .
					" Id: ".$maxCut->id ." Value " . $maxCut->val . "<br>";
	
	
?>

<?php

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
		if($a >= $d && $b >= $c){
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
<?php

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
	class Cut{
		var $quan = 0,
		    $val = 0,
		    $areas = array(),
		    $parentID = null,
		    $id = 0,
		    $mytype;
	}
	class Area extends Cut{
		var $high = 0,
		    $wid = 0;
	}		
?>
