<html>
<head><title>Actor Page</title></head>
<body>
<h1> Actor Page </h1>
<?php
$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$id = $_GET['id'];
$query = "SELECT * FROM Actor WHERE id=$id";
$rs = $db->query($query);

while ($row = $rs->fetch_assoc()) { 
    $aid = $row['id']; 
    $last = $row['last'];
    $first = $row['first'];
    $sex = $row['sex'];
    $dob = $row['dob'];
    $dod = $row['dob'];
}
$movieActorQuery = "SELECT * FROM MovieActor NATURAL JOIN (SELECT title, id as mid FROM Movie) AS M WHERE aid=$id";
        $movieActor = $db->query($movieActorQuery);


?>
<h4> Name: <?php echo "$first $last<br>"; ?> <h4>
<h4> Movies:<br/> <?php 
            //print "sssss";
$str = '';
while ($row = $movieActor->fetch_assoc()) { 
    $mid = $row['mid'];
    $title = $row['title'];
    $str = $str . '<a href="./movie.php?id=' . $mid . '">' . $title . '</a> </br>';
    }
print $str;
?> 
<h4>
  

</body>
</html>