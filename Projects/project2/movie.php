<html>
<head><title>Movie Page</title></head>
<body>
<h1> Movie Page</h1>
<?php
$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$id = $_GET['id'];
$mid = $id;
$movieQuery = "SELECT * FROM Movie WHERE id=$id";
$movie = $db->query($movieQuery);
while ($row = $movie->fetch_assoc()) { 
    $title = $row['title'];
}

$movieActorQuery = "SELECT * FROM MovieActor NATURAL JOIN (SELECT first, last, id as aid FROM Actor) AS M WHERE mid=$id";
$rs = $db->query($movieActorQuery);
if (!$rs) {
    $errmsg = $db->error; 
    print "Query failed: $errmsg <br>"; 
    exit(1); 
}
$userQuery = "SELECT AVG(rating) as AVT FROM Review WHERE mid = $id";
$userR = $db->query($userQuery);
$commentQuery = "SELECT * FROM Review WHERE mid = $id";
$comment = $db->query($commentQuery);
?>

<h4> Movie: <?php 
    echo "$title<br>"; ?> <h4>
 <h4> Actors: <br/>
 <?php
$str = '';
while ($row = $rs->fetch_assoc()) { 
    $id = $row['aid'];
    $first = $row['first'];
    $last = $row['last'];
    $str = $str . '<a href="./actor.php?id=' . $id . '">' . $first . ' ' .  $last  . '</a> </br>';
    }
$rs->free();
print $str;
?> 
<h4>
<h4> User Review : <br/>
<?php
if (!$userR) {
    $errmsg = $db->error; 
    print "Query failed: $errmsg <br>"; 
    exit(1); 
}
while ($row = $userR->fetch_assoc()){
    echo $row['AVT']; 
}
$userR->free();?> <br>
<?php
$str =  '<a href="./review.php?id=' . $mid . '">' . "Add Comment" . '</a> </br>';
echo $str;
?>
<h4> Comments shown below : <br/>
<?php
if (!$comment) {
    $errmsg = $db->error; 
    print "Query failed: $errmsg <br>"; 
    exit(1); 
}
$str = "";
while ($row = $comment->fetch_assoc()){
    echo $row['comment'];
    echo '</br>';
    echo "By: ". $row['name']. " Rating: " . $row['rating'] . " Date: " . $row['time'];
    echo '</br>';
    echo '</br>';
}
$comment->free();
?>
<br/>


</body>
</html>