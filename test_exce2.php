<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> <head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>テスト</title>
</head>
<body>

<form method="POST" action="./test.php">
場所名1: <input type="text "name="spot_name1"><br/>
場所名2: <input type="text "name="spot_name2"><br/>
場所名3: <input type="text "name="spot_name3"><br/>
<input type="submit" value="送信">
</form>



<?php
$dbconn = pg_connect("host=localhost dbname=tani user=tani password=tfCKUFGk")
//$dbconn = pg_connect("host=localhost port=5432 dbname=aitech user=guruiji password=Mizuki08122580")
//$dbconn = pg_connect("dbname=aitech")
      or die('Could not connect: ' . pg_last_error());



if(isset($_POST['spot_name1'])){
  $spot_name1=$_POST['spot_name1'];

  $sql="select * from Kyoto_spot where spot_name = '$spot_name1'";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    #echo $line[1] . " (" . $line[0] . ") by " . $line[2] . "<br>";
    #echo "unameは、$line[0]<br>";
    #echo "messageは、$line[1]<br>";
    #echo "theradは、$line[3]<br>";
    echo "$line[0]:$line[1]:$line[2]:$line[3]<br>";
    $a1 = $line[2];
    $b1 = $line[3];
}
}

if(isset($_POST['spot_name2'])){
  $spot_name2=$_POST['spot_name2'];

  $sql="select * from Kyoto_spot where spot_name = '$spot_name2'";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    #echo $line[1] . " (" . $line[0] . ") by " . $line[2] . "<br>";
    #echo "unameは、$line[0]<br>";
    #echo "messageは、$line[1]<br>";
    #echo "theradは、$line[3]<br>";
    echo "$line[0]:$line[1]:$line[2]:$line[3]<br>";
    $a2 = $line[2];
    $b2 = $line[3];
}
}
if(isset($_POST['spot_name3'])){
  $spot_name3=$_POST['spot_name3'];

  $sql="select * from Kyoto_spot where spot_name = '$spot_name3'";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  while ($line = pg_fetch_row($result)){
    #echo $line[1] . " (" . $line[0] . ") by " . $line[2] . "<br>";
    #echo "unameは、$line[0]<br>";
    #echo "messageは、$line[1]<br>";
    #echo "theradは、$line[3]<br>";
    echo "$line[0]:$line[1]:$line[2]:$line[3]<br>";
    $a3 = $line[2];
    $b3 = $line[3];
}
}

$command = "export LANG=ja_JP.UTF-8;python /home/h0/tani/public_html/aitech/root.py $a1 $b1 $a2 $b2 $a3 $b3 ";
#$command = 'echo $a,$b |export LANG=ja_JP.UTF-8;python /Users/guruiji/desktop/aitech/test11.py';
exec($command, $output);
foreach ($output as $o) {
 echo $o . '<br>';
}
?>

</body>
</html>
