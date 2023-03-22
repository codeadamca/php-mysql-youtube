<?php

// Connect to the MySQL database
$connect = mysqli_connect('<DB_HOST>', '<DB_USER>', '<DB_PASSWORD>', '<DB_DATABASE>');

// If the connection did not work, display an error message
if (!$connect) 
{
    echo 'Error Code: ' . mysqli_connect_errno() . '<br>';
    echo 'Error Message: ' . mysqli_connect_error() . '<br>';
    exit;
}

?>
<!doctype html>
<html>
    <head>
        <title>PHP, MySQL, and YouTube Videos</title>
    </head>
    <body>

        <h1>PHP, MySQL, and YouTube Videos</h1>

        <?php

        // Create a query
        $query = 'SELECT id,name,youtubeId
            FROM videos
            ORDER BY name';

        // Execute the query
        $result = mysqli_query($connect, $query);

        // If there is no result, display an error message
        if (!$result)
        {
            echo 'Error Message: ' . mysqli_error($connect) . '<br>';
            exit;
        }

        // Display the number of recirds found
        echo '<p>The query found ' . mysqli_num_rows($result) . ' rows:</p>';

        // Loop through the records found
        while ($record = mysqli_fetch_assoc($result))
        {

            // Output the record using if statements and echo
            echo '<hr>';

            echo '<h2>'.$record['name'].'</h2>';

            $url = 'https://www.youtube.com/watch?v='.$record['youtubeId'];

            echo '<a href="'.$url.'">'.$url.'</a>';

            echo '<br><br>';

            echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$record['youtubeId'].'?modestbranding=1" 
                rameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen></iframe>';

        }

        ?>        

    </body>
</html>
