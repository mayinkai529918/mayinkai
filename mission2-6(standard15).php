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
$count = sizeof(file("kadai2-6s.txt"));
$count = $count+1;
//fopen�ŊJ�����e�L�X�g�t�@�C���ɓ��e����������
$fp = fopen ('kadai2-6s.txt', 'a');
fwrite($fp, $count."<>".$name."<>".$comment."<>".$dateup."<>".$pass."<>"."/\n");
//�e�L�X�g�t�@�C�������
fclose($fp);  
}

//�����������āA�w�肷��ԍ���delete����
if($_REQUEST['del']){
//file�֐���2-3�̔z���ǂݍ���
$fp = file("kadai2-6s.txt"); 
//2-4��clear����
 $dp = fopen ('kadai2-6s.txt', 'w+');
 foreach($fp as $line){
   $filedata = explode('<>',$line);
   if($dpass !== $filedata[4] || $delete !== $filedata[0]){
     fputs($dp, $line);
   }
 }
fclose($dp);
}

//�ҏW�������āA�w�肷��ԍ���ҏW����
if($_REQUEST['edit']){
 //file�֐���2-3�̔z���ǂݍ���
 $fp = file("kadai2-6s.txt"); 
 //2-4��clear����
  $ep = fopen ('kadai2-6s.txt', 'w+');
  foreach($fp as $line){
   $filedata = explode('<>',$line);
   if($epass == $filedata[4] && $edition == $filedata[0]){
     $text=$filedata[0]."<>".$name."<>".$comment."<>".$dateup."<>".$pass."<>";
     fputs($ep,$text);
    }
    else{
    fputs($ep, $line);
    }
  }
fclose($ep);
}

$fp = file("kadai2-6s.txt");
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
