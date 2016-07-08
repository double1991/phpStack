<?php
require ("stockUser.php");
header("Content-Type: text/html; charset=utf-8");
$con = @mysql_connect("localhost", "root", "newpass");
if (!$con) {
	die('Could not connect: ' . mysql_error());
} else {
	mysql_select_db("stock_db", $con);
	$myFile = fopen("D:\allcode.txt", "r") or die("Unable to open file!");
	$code;
	$flage = TRUE;

	while (!feof($myFile) && $flage) {
		$code = fgets($myFile);
		$bar = intval($code);
		//echo "select * from stock_tb where stockCode='$bar'";
		$rs = mysql_query("select * from stock_tb where stockCode='$bar' limit 30");
		$stockArr = array();
		while ($row = mysql_fetch_array($rs)) {
			$stockPerson = new StockPerson();
			$stockPerson -> stockCode = sprintf("%06d", $row['stockCode']);
			$stockPerson -> openData = $row['openData'];
			$stockPerson -> lastData = $row['lastData'];
			$stockPerson -> stockDay = $row['stockDay'];
			$stockPerson->turnoverOfRate = $row['TurnoverOfRate'];
			$stockArr[] = $stockPerson;
		}
		//$flage = FALSE;
		if (count($stockArr) > 1) {
			checkStock($stockArr);
		}
	}
	fclose($myFile);
}

function getFloatValue($value) {
	return floatval($value);
}

//篩選最低價格的股票
function checkStock($stockArray) {
	$size = count($stockArray) > 10 ? 10 : count($stockArray);
	for ($i = 1; $i < $size; $i++) {
		if( getFloatValue($stockArray[$i]->turnoverOfRate > 2.0) && (getFloatValue($stockArray[$i]->lastData)<getFloatValue($stockArray[0]->lastData*1.02)) && (getFloatValue($stockArray[$i]->lastData)>getFloatValue($stockArray[0]->lastData*0.98))){
		}else{
			return;
		}
	}
	echo $stockArray[0] -> stockCode;
	//echo "stockCode = " . $stockArray[0] -> stockCode;
	echo "<br />";

	/*foreach ($stockArray as $stockPerson) {
	 echo "stockCode =" . $stockPerson -> openData . ", last =" . $stockPerson -> lastData . " day = " . $stockPerson -> stockDay;
	 echo "<br>";
	 }*/
}
?>