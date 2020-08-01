<?php

 function show_cavt(){

   $stmt = $pdo->query("SELECT cat_id, cat_name FROM categorie LIMIT 5 ");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         $cat_id = $row['cat_id'];
         $cat_title = $row['cat_name'];
         echo "<a class='dropdown-item' href='category.html?cat_id={$cat_id}'>";
         echo "{$cat_title}</a>";
     }
 }
?>
