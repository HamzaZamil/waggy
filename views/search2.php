<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemsearch = (trim($_POST['itemsearch']));
   try{
    require_once "../includes/conn.php";

    protected $db;

    public function __construct() {
        $this->db = $this->connect();
    }


    $query = "SELECT * FROM products WHERE product_description =  "

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(":itemsearch", $itemsearch);

    $stmt->execute();
    $results = $stmt->fetchALL(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;

   }catch (PDOException $e){
    die ("failed:" . $e->getMessage());
   }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h3> Results: </h3>
    
    <?php

    if (empty($results)){
        echo"<div>";
        echo"<p>No Results found. Contact us and suggest items.</p>";
        echo"</div>";
    }else{
        foreach ($results as $row) {
            echo $row []
        }
    }






    ?>

</body>
</html>