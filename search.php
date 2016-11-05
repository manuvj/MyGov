<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=0.3, maximum-scale=0.3">
<title>MyGov</title>
<head>
<style>
header {
     font-family:Arial;
     font-size: 150%;
     text-align:center;
     background-color: #969ca5;
     padding: 20px

}

section {
    background-color:transparent;
    color: #333;
    line-height: 1.5;
    letter-spacing: -0.01em;
    font-size: 140%;
    font-family:Helvetica;
    padding: 50px 200px 50px 200px;
    text-align:center;
    

}

footer {
    background-color:transparent;
    font-size: 100% ;
    text-align:center;
    padding: 30px 30px 30px 30px;
}
</style>
</head>
<body>
<header>
<img src="my-gov-logo.png"alt="image not found" width="120"; height="55" align="left" >
<form action="search.php" method="GET">
<div><input type="text" size="60" name="query"></div><br>
</header>
<section>
    <?php
    mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
    mysql_select_db("myDB") or die(mysql_error()); 

    $query = $_GET['query']; 
$min_length = 3;
 if(strlen($query) >= $min_length){ 
        $query = htmlspecialchars($query); 
        $query = mysql_real_escape_string($query);
        $raw_results = mysql_query("SELECT * FROM mygov
            WHERE (`heading` LIKE '%".$query."%') OR (`subheading` LIKE '%".$query."%')") or die(mysql_error());
        if(mysql_num_rows($raw_results) > 0){ 
            while($results = mysql_fetch_array($raw_results)){
                echo "<p><h3>".$results['heading']."</h3>".$results['subheading']."</p>";
            }
             
        }
        else{ 
            echo "No results";
        }
         
    }
    else{ 
        echo "Minimum length is ".$min_length;
    }
?>
</section>

</body>
</html>




