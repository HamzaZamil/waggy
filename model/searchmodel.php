<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $usersearch = $_POST["usersearch"];

    try{
        require_once "../includes/conn.php";

        $query = " SELECT * FROM products WHERE product_desription LIKE :usersearch";

        $stmt =$conn->prepare($query);

       // Add wildcards for partial matches
       $search_term = "%" . $usersearch . "%";
       $stmt->bindParam(":usersearch", $search_term, PDO::PARAM_STR);

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

        // header("Location: index.php");


    }catch(PDOException $e){

    }
}


?>