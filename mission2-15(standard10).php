<html>

<head>

<title>�\��N
</title>
</head>
<body>

<!-���̓t�H�[�����쐬����->
<form  method="post"  action ="#">
  
  ���O:<br/>
  <input type = "text" name ="name"/><br/> 
  �R�����g:<br/>
  <input name ="comment"cols="40" rows="20"></textarea><br/> <br/> 
  ���M�p�X���[�h:
  <input type = "text" name ="pass" size ="2"/><br/> 
  <input type="submit" name = "save" value="���M"><br/> <br/> 
  
  �폜�ԍ�:
  <input type = "text" name ="delete" size ="2"/>
�@�p�X:
  <input type = "text" name ="dpass" size ="2"/>
  <input type="submit" name = "del" value="�폜"><br/><br/>  
  
  �ҏW�ԍ�:
  <input type = "text" name ="edition" size ="2"/>
�@�p�X:
<input type = "text" name ="epass" size ="2"/>
<input type="submit" name = "edit" value="�ҏW"><br/> �@

<input type="hidden" name="editmodel"/>
</form>

<?php

$dsn ='mysql:dbname=co_669_it_99sv_coco_com;host=localhost';
$user ='co-669.it.99sv-c';
$password ='9Jni6Vs';
$pdo = new PDO ($dsn,$user,$password);

$sql="CREATE TABLE tbtest2"
."("
."id INT,"
."nm TEXY,"
."kome TEXT,"
."dt char(32),"
."ps char(32)"
.");";
$stmt=$pdo->query($sql);

//���̓f�[�^�̃Q�[�g
$name = $_POST["name"];
$comment = $_POST["comment"];
$delete = $_POST["delete"];
$edition = $_POST["edition"];
$pass = $_POST["pass"];
$dpass = $_POST["dpass"];
$epass = $_POST["epass"];
$dateup = date('Y-m-d H:i:s');

//���M�������āA���e��ۑ�����
if($_REQUEST['save']){
//�e�L�X�g�t�@�C���̍s���̃Q�[�g�Acount�ɕۑ�����
$count = sizeof(file("kadai2-15s.txt"));
$count = $count+1;
//fopen�ŊJ�����e�L�X�g�t�@�C���ɓ��e����������
$fp = fopen ('kadai2-15s.txt', 'a');
fwrite($fp, $count."<>".$name."<>".$comment."<>".$dateup."<>".$pass."<>"."/\n");
//�e�L�X�g�t�@�C�������
fclose($fp);  

$stmt=$pdo->query('SET NAMES utf8');

$sql=$pdo->prepare("INSERT INTO tbtest2(id,nm,kome,dt,ps)VALUES(:id,:name,:comment,:dateup,:pass)");

$sql ->bindParam(':id',$count, PDO::PARAM_STR);
$sql ->bindParam(':name',$name, PDO::PARAM_STR);
$sql->bindParam(':comment',$comment,PDO::PARAM_STR);
$sql->bindParam(':dateup',$dateup,PDO::PARAM_STR);
$sql ->bindParam(':pass',$pass, PDO::PARAM_STR);
$sql->execute();

}

//�����������āA�w�肷��ԍ���delete����
if($_REQUEST['del']){
//file�֐���2-3�̔z���ǂݍ���
$fp = file("kadai2-15s.txt"); 
//2-4��clear����
 $dp = fopen ('kadai2-15s.txt', 'w+');
 foreach($fp as $line){
   $filedata = explode('<>',$line);
   if($dpass !== $filedata[4] || $delete !== $filedata[0]){
     fputs($dp, $line);
   }
   if($dpass == $filedata[4] || $delete == $filedata[0]){
   $id=$delete;
   $sql="delete from tbtest2 where id='$id'";
   $result=$pdo->query($sql);
   }
 }
fclose($dp);
}

//�ҏW�������āA�w�肷��ԍ���ҏW����
if($_REQUEST['edit']){
 //file�֐���2-3�̔z���ǂݍ���
 $fp = file("kadai2-15s.txt"); 
 //2-4��clear����
  $ep = fopen ('kadai2-15s.txt', 'w+');
  foreach($fp as $line){
   $filedata = explode('<>',$line);
   if($epass == $filedata[4] && $edition == $filedata[0]){
     $text=$filedata[0]."<>".$name."<>".$comment."<>".$dateup."<>".$pass."<>";
     fputs($ep,$text);
    
    $id=$filedata[0];$nm=$name;$kome=$comment;$ps=$pass;$dt=$dateup;
    $sql="update tbtest2 set nm='$nm',kome='$kome', dt='$dt', ps='$ps' where id='$id'";
    $result=$pdo->query($sql);
    }
    else{
    fputs($ep, $line);
    }
  }
fclose($ep);
}

$fp = file("kadai2-15s.txt");
  for($i=0;$i<count($fp);$i++){
   $filedata = explode("<>",$fp[$i]);
   echo "{$filedata[0]}";
   echo "&nbsp;&nbsp;&nbsp;&nbsp;���O:{$filedata[1]}";
   echo "<br><br>";
   echo "�R�����g:{$filedata[2]}";
   echo "<br>";
   echo "{$filedata[3]}";
   echo "<br>***********************************************<br>";
  }

?>
</body>
</html>
