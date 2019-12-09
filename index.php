<!DOCTYPE html>
<html lang="en">
  <head>    
		<link rel="stylesheet" type="text/css" href="styles/style.css" />
<html>
	<head>
		<title>Главная страница</title>		
		<link rel="stylesheet" type="text/css" href="styles/style.css" />		
	</head>
	
    
<?php
include_once("bd.php");

$morning = "Доброе утро";
$day = "Добрый день";
$evening = "Добрый вечер";
$night = "Доброй ночи";
 
$minyt = date("i");
$chasov = date("H")+8;
 
if($chasov >= 06 or $chasov < 12) {$hello = $morning;}
if($chasov >= 12 or $chasov < 18) {$hello = $day;}
if($chasov >= 18 or $chasov < 01) {$hello = $evening;}
if($chasov > 23 or $chasov < 06) {$hello = $night;}
 

if(empty($login) and empty($password)){


include_once("header.php");


echo "<center>
$hello незарегистрированный пользователь, для дальнейших операций на сайте советую тебе авторизоваться/зарегистрироваться на сайте
</center>";

include_once("footer.php");
}

else{
include_once("header.php");
echo "<center> $hello, $login </center>";
include_once("footer.php");
}
?>
	
</body>
</html>