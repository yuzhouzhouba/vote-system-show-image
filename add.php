<?php
$value = $_GET['vote'];
$length=count($value);
for ($i=0; $i <$length; $i++) { 
	echo $value[$i]."号食物";
}

$value_string=implode(',', $value);


$sql="select * from eat where foodId in ($value_string) ";



$conn=mysql_connect("localhost","root","") or die ("connect fail".mysql_error());
mysql_select_db("food",$conn) or die (mysql_error());
mysql_query("set names utf8") or die (mysql_error());
$res=mysql_query($sql,$conn) or die (mysql_error());

$data=array();
$i=0;


while($row=mysql_fetch_array($res))
{
	$data[$i]=$row[3];
	$data[$i];
	$i++;
}

$length=count($data);
for ($i=0; $i <$length; $i++) { 
	$data[$i]+=1;
	echo $data[$i];
    mysql_query("update eat set datay=$data[$i] where foodId in ($value_string)");
}


echo '<br/>投票成功，刷新可以刷票';



mysql_free_result($res);
mysql_close($conn);
?>

