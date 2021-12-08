<?php
  include '../core/tech/connect.php';
  $scid  = $_GET['scid'];
  $scqty = $_GET['scqty'];

  $qInsAgTM ="update resepobat_sementara set qty = ".$scqty ." where resep_id = ".$scid;      
  $getdtintTM = mysqli_query($conn, $qInsAgTM);
?>