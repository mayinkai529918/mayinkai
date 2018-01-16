<?php

$dsn ='mysql:dbname=co_669_it_99sv_coco_com;host=localhost';
$user ='co-669.it.99sv-c';
$password ='9Jni6Vs';
$pdo = new PDO ($dsn,$user,$password);
$stmt=$pdo->query('SET NAMES utf8');

$sql = 'SELECT * FROM tbtest2';
$result = $pdo -> query($sql);
foreach ($result as $row){
  echo $row['id'].',';
  echo $row['nm'].',';
  echo $row['kome'].',';
  echo $row['dt'].',';
  echo $row['ps'].'<br>';
}

?>