<?php
  $typeHal = 'Daftar Resep'; 
  $jObat   = $_GET['jObat'];
  if ($jObat == "Non Racikan") {
    $NamekodeObat = 'kodeObat';
  }else if ($jObat == "Racikan") {
    $NamekodeObat = 'kodeObat[]';
  } 
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
        <form method="POST" class="form-horizontal" enctype="multipart/form-data">
          <div class="card-body"> 
            <div class="row">
              <?php
                $auto=$conn->query("select * from resiobat order by resi_id desc limit 1");
                $no=$auto->fetch_assoc();
                $angka=$no['resi_id']+1;
                echo "<input type='hidden' id='nota' name='nota' value='$angka' readonly class='form-control'>";
              ?>
            </div>
            <br>
            <div class="row">              
              <div class="col-md-3">
                <input type='hidden' id='idjObat' value='<?=$jObat?>' class='form-control'>
                <select name="<?=$NamekodeObat?>" id="idkodeObat" class="form-control select2" style="width: 100%;">
                  <option value="">--Pilih Kode Obat--</option>
                  <?php     
                  $sqlObt   = "SELECT * FROM obatalkes_m order by obatalkes_nama asc";
                  $statObt  = $conn->query($sqlObt);
                  while($rowObt   = $statObt->fetch_assoc()){
                    ?>
                    <option value="<?=$rowObt['obatalkes_kode'];?>"><?=$rowObt['obatalkes_nama'];?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-6">
                <input type="hidden" name="jObat" id="idjObat" class="form-control" value="<?=$jObat;?>" >
                <div class="PutDataObat">
                  
                </div>
              </div>
            </div>
            <br>
            <div class="row">              
              <div class="col-md-10">
                <div class="PutObat">
                  
                </div>
              </div>
            </div>
            <?php
            $sqlRsp   = "select a.resep_id, a.obatalkes_kode, a.signa_kode, b.obatalkes_nama, b.stok, c.signa_nama, a.qty 
                          from resepobat_sementara a, obatalkes_m b, signa_m c
                          where a.obatalkes_kode = b.obatalkes_kode 
                          and a.signa_kode = c.signa_kode ";
            $statRsp  = $conn->query($sqlRsp);
            
            ?>
            <br>
            <div class="row">
              <div class="col-sm-12">                
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Obat</th>
                      <th>Signa</th>
                      <th>Qty</th>
                      <th><center>Action</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                    while($rowRsp   = $statRsp->fetch_assoc()){

                      $idResep   = $rowRsp['resep_id'];
                      $kodekesObat   = $rowRsp['obatalkes_kode'];
                      $namaObat = $rowRsp['obatalkes_nama'];
                      $namaSigna = $rowRsp['signa_nama'];
                      $stok     = $rowRsp['stok'];
                      $qty     = $rowRsp['qty'];
                      ?>
                      <tr>
                        <td><?=$no;?></td>
                        <td><?=$namaObat;?></td>
                        <td><?=$namaSigna;?></td>
                        <td style="width:100px;">
                          <input type="text" name="Eqty" id="inputEqty<?=$idResep;?>" class="form-control" value="<?=number_format($qty);?>" required="required">
                          <input type="hidden" name="EidResep" id="EidResep<?=$idResep;?>" class="form-control" value="<?=number_format($idResep);?>" required="required">
                          <script type="text/javascript">
                            $("#inputEqty<?=$idResep;?>").keyup(function() {
                              var scqty = $(this).val();
                              var scid = document.getElementById("EidResep<?=$idResep;?>").value;
                              $.ajax({
                                type: "GET",
                                url: "resep/saveEdit.php?scqty="+scqty+"&scid="+scid,
                                success: function (response) {
                                  alert("Qty Update");
                                  window.location.href = window.location.href;
                                }
                              });    
                            });
                          </script>
                        </td>
                        <td>
                          <center>
                            <a href="index.php?page=AR&jObat=<?php echo $jObat; ?>&kode=<?php echo $kodekesObat; ?>&id=<?php echo $idResep; ?>&qty=<?=$qty;?>&delete=delete" 
                              onClick="return confirm('Are you sure to delete?');" 
                              title="Delete" class="btn btn-sm btn-danger">
                              <i class="fas fa-times"><b> Delete</b></i>
                            </a>
                          </center>
                          <?php
                          if($_GET['delete']) {
                            $query_delete ="DELETE FROM resepobat_sementara WHERE resep_id='".$_GET['id']."'";
                            if ($conn->query($query_delete) === TRUE) {  
                              
                              echo "
                              <script>top.location='".$_SERVER['PHP_SELF']."?page=AR&jObat=".$jObat."'; </script>
                              ";
                            } else {
                              echo "<script>alert(\" Data gagal didelete.\");</script>";
                              echo "
                              <script>top.location='".$_SERVER['PHP_SELF']."?page=AR&jObat=".$jObat."'; </script>
                              ";
                            }
                          }
                          ?>
                        </td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-12"> 
                <button type="submit" class="btn btn-primary btn-sm" id="idSaveResi" value="saveresi" name="simpandata">Submit</button>
                <!-- <a href="resep/cetakResep.php?idResep=<?=$idResep;?>" target="_blank" class="btn btn-primary">Cetak</a> -->
              </div>
            </div>
          </div>
        </form>
        
        <?php
        if(isset($_POST["simpandata"])){
          if ($_POST['simpandata']=="genData") {
            if ($jObat=="Non Racikan") {
              $kodeObat   = $_POST['kodeObat'];
              $kodeSigna  = $_POST['kodeSigna'];
              $qty        = $_POST['qty'];

              $qInsAgTM ="INSERT INTO resepobat_sementara (obatalkes_kode, signa_kode, qty, created_date) VALUES ('".$kodeObat."','".$kodeSigna."',".$qty.",'".$tglinput."')";      
              $getdtintTM = mysqli_query($conn, $qInsAgTM);

              echo "<script>window.location.href = window.location.href;</script>";
            }else if ($jObat=="Racikan") {
              for ($i=0; $i < count($_POST['kodeObat']); $i++) 
              { 
                $kodeObat    = $_POST['kodeObat'][$i];
                $kodeSigna  = $_POST['kodeSigna'];
                $qty        = $_POST['qty'];
                
                

                $qInsAgTM ="INSERT INTO resepobat_sementara (obatalkes_kode, signa_kode, qty, created_date) VALUES ('".$kodeObat."','".$kodeSigna."',".$qty.",'".$tglinput."')";      
                $getdtintTM = mysqli_query($conn, $qInsAgTM); 

                echo "<script>window.location.href = window.location.href;</script>";                                             
                  
              }
            }
          }
          if ($_POST['simpandata']=="saveresi") {
            $nota=$_POST['nota'];
            $qInsAgTM ="INSERT INTO resiobat (created_date) VALUES ('".$tglinput."')";      
            
            if(mysqli_query($conn, $qInsAgTM)){
              $query=$conn->query("select * from resepobat_sementara");
              while($r=$query->fetch_assoc()){
                $qInsAgTM ="insert into resepobat(resi_id,obatalkes_kode, signa_kode, qty, created_date)
                              values('".$nota."','".$r['obatalkes_kode']."','".$r['signa_kode']."',".$r['qty'].",'".$r['created_date']."')";      
                mysqli_query($conn, $qInsAgTM);

                $qUpd ="update obatalkes_m set stok=stok-'".number_format($r['qty'])."'
                        where obatalkes_kode='".$r['obatalkes_kode']."'"; 
                mysqli_query($conn, $qUpd);
              }
              //hapus seluruh isi tabel sementara
              $conn->query("truncate table resepobat_sementara");
              echo "<script>top.location='./'; </script>";

            }
          }
        }
        ?>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>