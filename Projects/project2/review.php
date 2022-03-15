<html>
<head><title>Review Page</title></head>
<body>
    <h1> Review Page </h1>
    
    <?php
    
        $id = $_GET['id'];
        //isset($_GET['mid']);
        if(isset($_GET['name']) && isset($_GET['rating']) && isset($_GET['comment']) && isset($_GET['mid'])) {
            $db = new mysqli('localhost', 'cs143', '', 'class_db');
            if ($db->connect_errno > 0) {
                die('Unable to connect to database [' . $db->connect_error . ']');
            }
            $query = 'INSERT INTO Review (name, time, rating, comment, mid) VALUES ("'. $_GET['name'] . '", CURRENT_TIMESTAMP, ' . $_GET['rating'] . ', "' . $_GET['comment'] . '", ' . $_GET['mid'] . ');';
            $rs = $db->query($query);

            echo '<h4> You have successfully added a review! </h4>';
        }
        else {
            
            
            
            echo '<form action="review.php" method="get">';
            echo 'Name: <input type="text" name="name"><br>';
            echo 'Rating (1-10): <input type="text" name="rating"><br>';
            echo 'Comment: <input type="text" name="comment"><br>';
            echo '<input type="hidden" name="mid" value ="'. $id .'" ><br>';
            echo '<input type="submit" value="Submit">';
            echo '</form>';
        }
    

    ?>
</body>
</html>