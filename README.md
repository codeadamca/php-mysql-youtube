# php-mysql-youtube

A basic sample of integrating YouTube vdeos into a MySQL database.

## The End Goal

The `images.sql` file in the repository includes a list of Instagram images that can be imported into your MySQL database. There are also thre eimages file in the rpository that should be placed in the same folder as your PHP file. Once those have been imported we will use PHP and SQL to display the data from the MySQL database in an HTML webpage. 

There are multiple methods of retrieving data from a MySQL database using PHP. For simplicity sake the example below will use a series of `mysqli` PHP functions. 

## Steps

1. Open up phpMyAdmin.

If you're using a local server phpMyAdmin can usually be accessed by starting your server and then clicking on the phpMyAdmin link. If you're using a hosting account there will be a link to phpMyAdmin in your control panel. 

Once you have phpMyAdmin open, click on the import tab and select the `links.sql` file from this repository. This will create a table called `links` and populate it with some sample data. 

2. Place the images form the repository in the same folder as your PHP. 

3. Create a new file and name it `images.php`. In that file place the following code:

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

    <h1>PHP, MySQL, and Images</h1>

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

4. Update the SQL statement to include the fields, table, and order components.

```php
<?php

$query = 'SELECT id,name,filename
  FROM images
  ORDER BY name';

?>
```

5. Add PHP to loop to output the name and image:

```php
<?php

while ($record = mysqli_fetch_assoc($result))
{

  echo '<hr>';
  echo '<h2>'.$record['name'].'</h2>';
  echo '<img src="'.$record['filename'].'">';

}

?>
```

## Tutorial Requirements:

* [Visual Studio Code](https://code.visualstudio.com/) or [Brackets](http://brackets.io/) (or any code editor)
* [Filezilla](https://filezilla-project.org/) (or any FTP program)

Full tutorial URL: https://codeadam.ca/learning/php-mysql-images.html

<a href="https://codeadam.ca">
<img src="https://codeadam.ca/images/code-block.png" width="100">
</a>
