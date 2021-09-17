<?php

    if (!empty($_POST['refreshTime'])) {

        $refreshTime = htmlspecialchars($_POST['refreshTime']) ;
        //open the database
        $db = new PDO('sqlite:' . __DIR__ . '/vmSafeguard.db');
        // TRUNCATE Table 
        $db->exec("DELETE FROM webPanel ;");
        $db->exec("INSERT INTO webPanel (RefreshTime) VALUES ('$refreshTime');");

        $statement = $db->prepare("SELECT RefreshTime FROM webPanel ;"); // cette requête nous retourne un tableau à assiossatif ip=>
        $rows = $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $row) {
            $valueFromTheDB = htmlspecialchars($row['RefreshTime']);
            echo "<pre>You dashboard will reload itself every <strong>$valueFromTheDB</strong> seconds</pre>";
            echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"../\" >Reload the dashboard</a></button>";
                
        } 
    }
?>