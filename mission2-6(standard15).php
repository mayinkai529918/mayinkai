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
  <input name ="comment"cols="40" rows="20"></textarea><br/> <br/> 
  送信パスワード:
  <input type = "text" name ="pass" size ="2"/><br/> 
  <input type="submit" name = "save" value="送信"><br/> <br/> 
  
  削除番号:
  <input type = "text" name ="delete" size ="2"/>
　パス:
  <input type = "text" name ="dpass" size ="2"/>
  <input type="submit" name = "del" value="削除"><br/><br/>  
  
  編集番号:
  <input type = "text" name ="edition" size ="2"/>
　パス:
<input type = "text" name ="epass" size ="2"/>
<input type="submit" name = "edit" value="編集"><br/> 　

<input type="hidden" name="editmodel"/>
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
$count = sizeof(file("kadai2-6s.txt"));
$count = $count+1;
//fopenで開いたテキストファイルに内容を書き込む
$fp = fopen ('kadai2-6s.txt', 'a');
fwrite($fp, $count."<>".$name."<>".$comment."<>".$dateup."<>".$pass."<>"."/\n");
//テキストファイルを閉じる
fclose($fp);  
}

//消除を押して、指定する番号をdeleteする
if($_REQUEST['del']){
//file関数で2-3の配列を読み込む
$fp = file("kadai2-6s.txt"); 
//2-4をclearする
 $dp = fopen ('kadai2-6s.txt', 'w+');
 foreach($fp as $line){
   $filedata = explode('<>',$line);
   if($dpass !== $filedata[4] || $delete !== $filedata[0]){
     fputs($dp, $line);
   }
 }
fclose($dp);
}

//編集を押して、指定する番号を編集する
if($_REQUEST['edit']){
 //file関数で2-3の配列を読み込む
 $fp = file("kadai2-6s.txt"); 
 //2-4をclearする
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
   echo "&nbsp;&nbsp;&nbsp;&nbsp;名前:{$filedata[1]}";
   echo "<br><br>";
   echo "コメント:{$filedata[2]}";
   echo "<br>";
   echo "{$filedata[3]}";
   echo "<br>***********************************************<br>";
  }

?>
</body>
</html>
