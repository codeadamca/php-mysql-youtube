# Using PHP to Display YouTube Videos from a MySQL Database

A basic sample of integrating YouTube vdeos into a MySQL database.

## The End Goal

The `videos.sql` file in the repository includes a list of YoutTube videos that can be imported into your MySQL database. Once those have been imported we will use PHP and SQL to display the data from the MySQL database in an HTML webpage. 

There are multiple methods of retrieving data from a MySQL database using PHP. For simplicity sake the example below will use a series of `mysqli` PHP functions. 

## Steps

1. Open up phpMyAdmin.

If you're using a local server phpMyAdmin can usually be accessed by starting your server and then clicking on the phpMyAdmin link. If you're using a hosting account there will be a link to phpMyAdmin in your control panel. 

Once you have phpMyAdmin open, click on the import tab and select the `videos.sql` file from this repository. This will create a table called `videos` and populate it with some sample data. 

2. Create a new file and name it `videos.php`. In that file place the following code:

```php
<?php

$connect = mysqli_connect('localhost', 'root', 'root', 'sandbox');

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
    <title>PHP, MySQL, and Images</title>
  </head>
  <body>

    <h1>PHP, MySQL, and YouTube Videos</h1>

    <?php

    $query = 'SELECT 
      FROM 
      ORDER BY ';

    $result = mysqli_query($connect, $query);

    if (!$result)
    {
      echo 'Error Message: ' . mysqli_error($connect) . '<br>';
      exit;
    }

    echo '<p>The query found ' . mysqli_num_rows($result) . ' rows:</p>';

    while ($record = mysqli_fetch_assoc($result))
    {
      echo '<hr>';
    }

    ?>        

  </body>
</html>


?>
```

The first line of PHP will initiatie a connection to your MySQL server. The `mysqli_connect` function requires a host, username, password, and database name. 

If you are using a local PHP server link MAMP or WAMP your host is `localhost` and your username and password are likely both `root`. This may vary depending on how you set up your local host. The database name will be whataver you named your database. If you don't have one go ahead an create one. 

If you are using a hosting account, your MySQL user, password, and database will need to be created in your hosting control panel. There is likely help in your control panel on what to use for your host. 

The second part of the above code is not complete. The next few steps will complete the PHP script. 

> [More information on PHP and `mysqli_connect()`](https://www.php.net/manual/en/function.mysqli-connect.php)

3. Update the SQL statement to include the fields, table, and order components.

```php
<?php

$query = 'SELECT id,name,youtubeId
  FROM videos
  ORDER BY name';

?>
```

4. Add PHP to loop to output the name and YouTube ID:

```php
<?php

while ($record = mysqli_fetch_assoc($result))
{

  echo '<hr>';
  echo '<h2>'.$record['name'].'</h2>';
  echo $record['youtubeId'];

}

?>
```

5. Use the YouTbe ID to make a link to the YouTube video. Replace the `echo $record['youtubeId'];` line of code with:

```pph
<?php

$url = 'https://www.youtube.com/watch?v='.$record['youtubeId'];
echo '<a href="'.$url.'">'.$url.'</a>';

?>
```

6. Lastly, we want to display the image using the standard YouTube embed HTML. 

> Note: You can get a copy of this from visiting a YouTube video, clicking on share, and then embed.

Add the following code to the end of your PHP loop:

```php
<?php

echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$record['youtubeId'].'?modestbranding=1" 
    rameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
    allowfullscreen></iframe>';

?>
```

## Tutorial Requirements:

* [Visual Studio Code](https://code.visualstudio.com/) or [Brackets](http://brackets.io/) (or any code editor)
* [Filezilla](https://filezilla-project.org/) (or any FTP program)

Full tutorial URL: https://codeadam.ca/learning/php-mysql-youtube.html

<a href="https://codeadam.ca">
<img src="https://codeadam.ca/images/code-block.png" width="100">
</a>
