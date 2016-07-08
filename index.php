<?php
include 'db_class.php';
$mysql=new DB();
$sql="select * from test";

$data=$mysql->get_all($sql);

p($data);
echo '===========================================================';
p($data[0]['name']);
$arrlength=count($data);
//p($arrlength);
foreach($data as $key=>$value){
	
//	 echo "<br>";
//p($value);
//	p($value['id']);
//	 p($value['name']);
	 /*echo $value;*/
//	foreach($value as $k=>$v){
//		echo $k."  ".$v."   ";
//	}
//p($date);
}
die;


for($x=0;$x<$arrlength;$x++) {
  p($data[$x]);
  echo "<br>";
}
/*$myfile = fopen("my_test_file.txt", "w") or die("Unable to open file!");
$txt = "Bill Gates\n";
fwrite($myfile, $txt);
$txt = "Steve Jobs\n";
fwrite($myfile, $txt);
fclose($myfile);*/
 function p($var) {
 	echo "<pre>";
	print_r($var);
	echo "</pre>";
 }
 
 
/* Array
(
    [0] => Array
        (
            [id] => 1
            [name] => dasda
            [email] => askdnaskdn
        )

    [1] => Array
        (
            [id] => 2
            [name] => asdasda
        )

)*/
?>