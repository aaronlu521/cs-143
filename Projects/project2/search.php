<html>
<head><title>Search Page</title></head>
<body>
    <h1> Search Page </h1>
    <?php
        if(isset($_GET['actor'])) {
            $actor = $_GET['actor'];
            $keyWords = explode(" ", $actor);
            
            $db = new mysqli('localhost', 'cs143', '', 'class_db');
            if ($db->connect_errno > 0) {
                die('Unable to connect to database [' . $db->connect_error . ']');
            }
            $movieActorQuery = "SELECT * FROM Actor WHERE";
            foreach($keyWords as $keyWord) {
                $movieActorQuery = $movieActorQuery . " lower(concat(first,' ',last)) LIKE lower('%" . $keyWord . "%') AND";
            }
            //$finalQuery = substr($movieActorQuery, 0, strlen($movieActorQuery)-3))

            $movieActorQuery = substr($movieActorQuery, 0, strlen($movieActorQuery)-3) . ";";
            $movieActorQuery = $movieActorQuery . ";";
            
            $rs = $db->query($movieActorQuery);
            if (!$rs) {
                $errmsg = $db->error; 
                print "Query failed: $errmsg <br>"; 
                exit(1); 
            }
            echo 'List of actors: <br>';           
            $str = '';
            while ($row = $rs->fetch_assoc()) { 
                $id = $row['id'];
                $first = $row['first'];
                $last = $row['last'];
                $str = $str . '<a href="./actor.php?id=' . $id . '">' . $first . ' ' .  $last  . '</a> </br>';
                }
            $rs->free();
            print $str;
        }
        else if(isset($_GET['movie'])) {
            $movie = $_GET['movie'];
            $keyWords = explode(" ", $movie);
            $db = new mysqli('localhost', 'cs143', '', 'class_db');
            if ($db->connect_errno > 0) {
                die('Unable to connect to database [' . $db->connect_error . ']');
            }
            $movieQuery = "SELECT * FROM Movie WHERE";
            foreach($keyWords as $keyWord) {
                $movieQuery = $movieQuery . " lower(title) LIKE lower('%" . $keyWord . "%') AND";
            }
            //$movieQuery = "SELECT * FROM Movie WHERE lower(title) = 'sum'";
            $movieQuery = substr($movieQuery, 0, strlen($movieQuery)-3) . ";";
            $movie = $db->query($movieQuery);

            echo 'List of movies: <br>';
            $str = '';
            while ($row = $movie->fetch_assoc()) { 
                $id = $row['id'];
                $title = $row['title'];
                $str = $str . '<a href="./movie.php?id=' . $id . '">' . $title . '</a> </br>';
            }
            print $str;
            }
        else {

            
            echo 'Search For: <br>';
            echo '<form action="search.php" method="get">';
            echo 'Actor: <input type="text" name="actor"><br>';
            echo '</form>';
            echo '<form action="search.php" method="get">';
            echo 'Movie: <input type="text" name="movie"><br>';
            echo '</form>';
            echo '<input type="submit" value="Submit">';
            echo '</form>';
        }
    

    ?>
    
    
   
  

</body>
</html>

