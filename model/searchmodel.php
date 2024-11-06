<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $usersearch = $_POST["usersearch"];

   
        require_once "../includes/conn.php";

        $query = " SELECT * FROM products WHERE product_desription LIKE :usersearch";

        $stmt =$conn->prepare($query);
       $usersearch= "%" . $usersearch . "%";
       $stmt->bindParam(":usersearch", $search_term, PDO::PARAM_STR);

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
}


?>