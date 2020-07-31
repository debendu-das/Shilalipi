<?php

 function show_cat(){

   $sql = "SELECT * FROM categorie";
   $stmt = $pdo->query($sql);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $cat_id = $row['cat_id'];
     $cat_title = $row['cat_name'];
     // echo "<a class='dropdown-item' href='category.html?cat_id=";
     // echo ($cat_id);
     // echo "'>{$cat_title}</a>";
     echo "<a class='dropdown-item'>abcd</a> ";
   }
 }
?>
