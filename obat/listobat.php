<?php
  $typeHal = 'List Obat';  
?>
<div class="content-wrapper">
  <?php
    headerDoc($typeHal);
  ?>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-danger">
            <div class="card-body"> 
              
              <table class="table table-bordered table-hover tbObat">
                <thead>
                  <tr>
                    <th><center>NO</center></th>
                    <th width="150">OBATALKES KODE</th>
                    <th>OBATALKES NAMA</th>
                    <th><center>STOK</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sqlObt   = "SELECT * FROM obatalkes_m";
                  $statObt  = $conn->query($sqlObt);
                  $no = 1;
                  while($rowObt   = $statObt->fetch_assoc()){
                    $kodeObat = $rowObt['obatalkes_kode'];
                    ?>
                    <tr>
                      <td><?= $no?></td>
                      <td><?= $rowObt['obatalkes_kode']?></td>
                      <td><?= $rowObt['obatalkes_nama']?></td>
                      <td><?= number_format($rowObt['stok'])?></td>
                    </tr>
                    <?php
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>