<?php
  $typeHal = 'Daftar Resep';  
?>
<div class="content-wrapper">
  <?php
    headerDoc($typeHal);
  ?>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="card card-outline card-danger">
        <div class="card-body"> 
          <div class="row">
            <div class="col-md-2">
              <div class="btn-group dropright">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Input Resep
                </button>
                <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(112px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a class="dropdown-item" href="index.php?page=AR&jObat=Racikan">Racikan</a>
                <a class="dropdown-item" href="index.php?page=AR&jObat=Non Racikan">Non Racikan</a>
                </div>
              </div>
              <!-- <a href="index.php?page=AR" class="btn btn-primary">Input Resep</a> -->
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No Nota</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sqlRso       = "select * from resiobat order by resi_id asc";
                  $statRso      = $conn->query($sqlRso);
                  while($rowRso = $statRso->fetch_assoc()){
                    if (!empty($rowRso['created_date'])){
                      $cDate = date_create($rowRso['created_date']);
                      $dtDate   = date_format($cDate,"d/m/Y");
                    }
                    ?>
                    <tr>
                      <td><?=$rowRso['resi_id'];?></td>
                      <td><?=$dtDate;?></td>
                      <td><a href="resep/cetakResep.php?idResep=<?=$rowRso['resi_id'];?>" class="btn btn-success btn-sm">Cetak Resep</a></td>
                    </tr>
                    <?php
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