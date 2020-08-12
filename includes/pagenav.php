<?php
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else {
    $page = 1;
  }
 ?>
  <li class="page-item"><a class="page-link" href="index.php?page=<?= $page>1 ? $page-1 : $page  ?>" >&lt;</a></li>
  <li class="page-item <?php if($page==1) echo ('active'); ?>"><a class="page-link" href="index.php">1</a></li>
  <li class="page-item <?php if($page==2) echo ('active'); ?>"><a class="page-link" href="index.php?page=2">2</a></li>
  <li class="page-item <?php if($page==3) echo ('active'); ?>"><a class="page-link" href="index.php?page=3">3</a></li>
  <li class="page-item <?php if($page==4) echo ('active'); ?>"><a class="page-link" href="index.php?page=4">4</a></li>
  <li class="page-item <?php if($page==5) echo ('active'); ?>"><a class="page-link" href="index.php?page=5">5</a></li>
  <li class="page-item"><a class="page-link" href="index.php?page=<?= $page+1 ?>">&gt;</a></li>
