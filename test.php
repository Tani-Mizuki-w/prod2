<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> <head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>最短ルート検索</title>
</head>
<body>

<h2>場所名を５つまで入力してください。最短ルートを検索できます。</h2>
<form method="POST" action="./test.php">
場所名1: <input type="text "name="spot_name1"><br/>
場所名2: <input type="text "name="spot_name2"><br/>
場所名3: <input type="text "name="spot_name3"><br/>
場所名4: <input type="text "name="spot_name4"><br/>
場所名5: <input type="text "name="spot_name5"><br/>
<input type="submit" value="送信">
</form>
<form method="POST" action="./test.php">
<button type="submit" name="root_all">ルート検索できる地名一覧</button>
</form>
<p>一覧に追加することができます。以下の3つの情報を入力してください。</p>
<form method="POST" action="./test.php">
場所名: <input type="text "name="spot_names"><br/>
緯度(半角・Degree形式で入力してください): <input type="text "name="longitude"><br/>
経度(半角・Degree形式で入力してください): <input type="text "name="latitude"><br/>
<input type="submit" value="送信">
</form>


<?php
$dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
      or die('Could not connect: ' . pg_last_error());

if(isset($_POST['root_all'])){
  $query="select spot_name from Kyoto_spot";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  echo "地名一覧：";
  while ($line = pg_fetch_row($result)){
    echo "$line[0]/";
      }
      }

if (isset($_POST['spot_names']) && !empty($_POST['spot_names'])) {
    $spot_names=$_POST['spot_names'];
}
if (isset($_POST['longitude']) && !empty($_POST['longitude'])) {
    $longitude=$_POST['longitude'];
}
if (isset($_POST['latitude']) && !empty($_POST['latitude'])) {
    $latitude=$_POST['latitude'];
}
if(isset($spot_names) and isset($longitude) and  isset($latitude)){
  $sql="insert into Kyoto_spot(spot_name,spot_longitude,spot_latitude) values
  ('" .$spot_names . "','" .$longitude . "','" .$latitude . "');";
        pg_query($sql) or die('Query failed: ' . pg_last_error());
}

if(isset($_POST['spot_name1'])){
  $spot_name1=$_POST['spot_name1'];

  $sql="select * from Kyoto_spot where spot_name = '$spot_name1'";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    #echo "messageは、$line[1]<br>";
    #echo "theradは、$line[3]<br>";
    echo "1:$line[1]<br>";
    #echo "1:$line[0]:$line[1]:$line[2]:$line[3]<br>";
    $c1 = $line[1];
    $a1 = $line[2];
    $b1 = $line[3];

}
}

if(isset($_POST['spot_name2'])){
  $spot_name2=$_POST['spot_name2'];

  $sql="select * from Kyoto_spot where spot_name = '$spot_name2'";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    echo "2:$line[1]<br>";
    $a2 = $line[2];
    $b2 = $line[3];
    $c2 = $line[1];
}
}
if(isset($_POST['spot_name3'])){
  $spot_name3=$_POST['spot_name3'];

  $sql="select * from Kyoto_spot where spot_name = '$spot_name3'";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    echo "3:$line[1]<br>";
    $a3 = $line[2];
    $b3 = $line[3];
    $c3 = $line[1];
}
}
if(isset($_POST['spot_name4'])){
  $spot_name4=$_POST['spot_name4'];

  $sql="select * from Kyoto_spot where spot_name = '$spot_name4'";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    echo "4:$line[1]<br>";
    $a4 = $line[2];
    $b4 = $line[3];
    $c4 = $line[1];
}
}
if(isset($_POST['spot_name5'])){
  $spot_name5=$_POST['spot_name5'];

  $sql="select * from Kyoto_spot where spot_name = '$spot_name5'";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    echo "5:$line[1]<br>";
    $a5 = $line[2];
    $b5 = $line[3];
    $c5 = $line[1];
}
}

$command = "export LANG=ja_JP.UTF-8;python /home/h0/tani/public_html/aitech/root.py $a1 $b1 $c1 $a2 $b2 $c2 $a3 $b3 $c3 $a4 $b4 $c4 $a5 $b5 $c5";
exec($command, $output);
foreach ($output as $o) {
 echo $o . '<br>';
}

echo "<br>";
echo '1:';
echo $output[1];
echo "<br>";
echo '2:';
echo $output[2];
echo "<br>";
echo '3:';
echo $output[3];
echo "<br>";


$point= [$output[2]];
echo $point;

?>

</body>
</html>
