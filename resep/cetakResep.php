
<?php
include '../core/tech/connect.php';
$idResep = $_GET['idResep'];

?>    
<style type="text/css">
    .content {
      max-width: 550px;
      margin: auto;
    }
</style>
<body style="font-family: Helvetica, Sans-Serif;">
  <br>
  <div class="content">
    <center><img src="../dist/img/dHealthBig.png" alt="Logo" style="width: 300px;"></center>
    <center><br><br><h4>RECEIPT EXAMPLE</h4>
    <h4>Jl. Dago, Bandung</h4></center>
    <hr>
    <?php
    $sqlRsp   = "select a.obatalkes_kode, a.signa_kode, b.obatalkes_nama, b.stok, c.signa_nama, a.qty 
                  from resepobat a, obatalkes_m b, signa_m c
                  where a.obatalkes_kode = b.obatalkes_kode 
                  and a.signa_kode = c.signa_kode 
                  and resi_id=".$idResep;
    $statRsp  = $conn->query($sqlRsp);
    while($rowRsp   = $statRsp->fetch_assoc()){
      ?>
      <table class="table">
        <tr>
          <td><h4><?=number_format($rowRsp['qty'])?></h4></td>
          <td><h4><?=$rowRsp['obatalkes_nama']?></h4></td>
        </tr>
        <tr>
          <td width="50px;"></td>
          <td><h4 style="margin-top: -10px;"><?=$rowRsp['signa_nama']?></h4></td>
        </tr>
      </table>
      
      <?php
    }
    ?>
  </div>
  <script>
    window.print();
  </script>

</body>