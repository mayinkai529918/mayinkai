<html>

<head>

<title>申レN
</title>
</head>
<body>

<!-入力フォームを作成する->
<form  method="post"  action ="#">
  
  名前:<br/>
  <input type = "text" name ="name"/><br/> 
  コメント:<br/>
  <input type = "text" name ="comment"/><br/> <br/> 
  送信パスワード:
  <input type = "text" name ="pass" size ="2"/><br/> 
  <input type="submit" name = "save" value="送信"><br/> <br/> 
  
  削除番号:
  <input type = "test" name ="delete" size ="2"/>
　パス:
  <input type = "test" name ="dpass" size ="2"/>
  <input type="submit" name = "del" value="削除"><br/><br/>  
  
  編集番号:
  <input type = "test" name ="edition" size ="2"/>
　パス:
<input type = "test" name ="epass" size ="2"/>
<input type="submit" name = "edit" value="編集"><br/> 　

<input type="hidden" name="model" value="" />
</form>

<?php

//入力データのゲート
$name = $_POST["name"];
$comment = $_POST["comment"];
$delete = $_POST["delete"];
$edition = $_POST["edition"];
$pass = $_POST["pass"];
$dpass = $_POST["dpass"];
$epass = $_POST["epass"];
$dateup = date('Y-m-d H:i:s');

//送信を押して、内容を保存する
if($_REQUEST['save']){
//テキストファイルの行数のゲート、countに保存する
$count = sizeof(file("kadai2-6.txt"));
$count = $count+1;
//fopenで開いたテキストファイルに内容を書き込む
$fp = fopen ('kadai2-6.txt', 'a');
fwrite($fp, $count."<>".$name."<>".$comment."<>".$pass."<>".$dateup."\n");
//テキストファイルを閉じる
fclose($fp);
  
}


//消除を押して、指定する番号をdeleteする
elseif($_REQUEST['del']){
//file関数で2-3の配列を読み込む
$fp = file("kadai2-6.txt"); 
//2-4をclearする
 $dp = fopen ('kadai2-7.txt', 'w');
  fwrite($dp,"");
  fclose($dp);
//指定した編号以外の内容を2-7に書き込む
for($i=0;$i<count($fp);$i++){
  $filedata = explode("<>",$fp[$i]);
  if ($dpass !== $filedata[3] || $delete !== $filedata[0]){
  $dp = fopen ('kadai2-7.txt', 'a');
  fwrite($dp,$filedata[0]."<>".$filedata[1]."<>".$filedata[2]."<>".$filedata[3]."<>".$filedata[4]);
  fclose($dp);
  }
 }
//2-6をclearし、2-7の内容を書き込む
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


//編集を押して、指定する番号を編集する
elseif($_REQUEST['edit']){
 //テキストファイルの行数のゲート、countに保存する
 $count = sizeof(file("kadai2-6.txt"));
 //file関数で2-3の配列を読み込む
 $fp = file("kadai2-6.txt"); 
 //2-4をclearする
  $ep = fopen ('kadai2-7.txt', 'w');
  fwrite($ep,"");
  fclose($ep);
  //指定した編号以外の内容を2-7に書き込む
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
//2-6をclearし、2-7の内容を書き込む
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
   echo "&nbsp;&nbsp;&nbsp;&nbsp;名前:{$filedata[1]}";
   echo "<br><br>";
   echo "コメント:{$filedata[2]}";
   echo "<br>";
   echo "{$filedata[4]}";
   echo "<br>***********************************************<br>";
  }
?>
</body>
</html>
