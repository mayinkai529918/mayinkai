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
  <input type = "text" name ="comment"/><br/> <br/> 
  ���M�p�X���[�h:
  <input type = "text" name ="pass" size ="2"/><br/> 
  <input type="submit" name = "save" value="���M"><br/> <br/> 
  
  �폜�ԍ�:
  <input type = "test" name ="delete" size ="2"/>
�@�p�X:
  <input type = "test" name ="dpass" size ="2"/>
  <input type="submit" name = "del" value="�폜"><br/><br/>  
  
  �ҏW�ԍ�:
  <input type = "test" name ="edition" size ="2"/>
�@�p�X:
<input type = "test" name ="epass" size ="2"/>
<input type="submit" name = "edit" value="�ҏW"><br/> �@

<input type="hidden" name="model" value="" />
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
$count = sizeof(file("kadai2-6.txt"));
$count = $count+1;
//fopen�ŊJ�����e�L�X�g�t�@�C���ɓ��e����������
$fp = fopen ('kadai2-6.txt', 'a');
fwrite($fp, $count."<>".$name."<>".$comment."<>".$pass."<>".$dateup."\n");
//�e�L�X�g�t�@�C�������
fclose($fp);
  
}


//�����������āA�w�肷��ԍ���delete����
elseif($_REQUEST['del']){
//file�֐���2-3�̔z���ǂݍ���
$fp = file("kadai2-6.txt"); 
//2-4��clear����
 $dp = fopen ('kadai2-7.txt', 'w');
  fwrite($dp,"");
  fclose($dp);
//�w�肵���ҍ��ȊO�̓��e��2-7�ɏ�������
for($i=0;$i<count($fp);$i++){
  $filedata = explode("<>",$fp[$i]);
  if ($dpass !== $filedata[3] || $delete !== $filedata[0]){
  $dp = fopen ('kadai2-7.txt', 'a');
  fwrite($dp,$filedata[0]."<>".$filedata[1]."<>".$filedata[2]."<>".$filedata[3]."<>".$filedata[4]);
  fclose($dp);
  }
 }
//2-6��clear���A2-7�̓��e����������
$fp = file("kadai2-7.txt");
$dp = fopen ('kadai2-6.txt', 'w');
  fwrite($dp,"");
  fclose($dp);
for($i=0;$i<count($fp);$i++){
  $filedata = explode("<>",$fp[$i]);
  $dp = fopen ('kadai2-6.txt', 'a');
  $ii=$i+1;
  fwrite($dp,$ii."<>".$filedata[1]."<>".$filedata[2]."<>".$filedata[3]."<>".$filedata[4]);
  fclose($dp);
 }
}


//�ҏW�������āA�w�肷��ԍ���ҏW����
elseif($_REQUEST['edit']){
 //�e�L�X�g�t�@�C���̍s���̃Q�[�g�Acount�ɕۑ�����
 $count = sizeof(file("kadai2-6.txt"));
 //file�֐���2-3�̔z���ǂݍ���
 $fp = file("kadai2-6.txt"); 
 //2-4��clear����
  $ep = fopen ('kadai2-7.txt', 'w');
  fwrite($ep,"");
  fclose($ep);
  //�w�肵���ҍ��ȊO�̓��e��2-7�ɏ�������
  for($i=0;$i<count($fp);$i++){
    $filedata = explode("<>",$fp[$i]);
    if($epass == $filedata[3] && $edition == $filedata[0]){
     $ep = fopen ('kadai2-7.txt', 'a');
     $ii=$i+1;
     fwrite($ep,$ii."<>".$name."<>".$comment."<>".$pass."<>".$dateup."\n");
     fclose($ep);
     }
    else{
    $ep = fopen ('kadai2-7.txt', 'a');
    fwrite($ep,$filedata[0]."<>".$filedata[1]."<>".$filedata[2]."<>".$filedata[3]."<>".$filedata[4]);
    fclose($ep);
    }
   }
//2-6��clear���A2-7�̓��e����������
   $fp = file("kadai2-7.txt");
   $ep = fopen ('kadai2-6.txt', 'w');
   fwrite($ep,"");
   fclose($ep);
   for($i=0;$i<count($fp);$i++){
    $filedata = explode("<>",$fp[$i]);
    $ep = fopen ('kadai2-6.txt', 'a');
    fwrite($ep,$filedata[0]."<>".$filedata[1]."<>".$filedata[2]."<>".$filedata[3]."<>".$filedata[4]);
    fclose($ep);
    }
}

$fp = file("kadai2-6.txt");
  for($i=0;$i<count($fp);$i++){
   $filedata = explode("<>",$fp[$i]);
   echo "{$filedata[0]}";
   echo "&nbsp;&nbsp;&nbsp;&nbsp;���O:{$filedata[1]}";
   echo "<br><br>";
   echo "�R�����g:{$filedata[2]}";
   echo "<br>";
   echo "{$filedata[4]}";
   echo "<br>***********************************************<br>";
  }
?>
</body>
</html>
