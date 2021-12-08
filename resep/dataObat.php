<?php
  include '../core/tech/connect.php';

  $kdObat   = $_GET['kdObat'];
  $jObat  = $_GET['kdjObat'];

  $sqlObt   = "SELECT * FROM obatalkes_m where obatalkes_kode = '".$kdObat."'";
  $statObt  = $conn->query($sqlObt);
  $rowObt   = $statObt->fetch_assoc();

  $idObat   = $rowObt['obatalkes_id'];
  $kodeObat = $rowObt['obatalkes_kode'];
  $namaObat = $rowObt['obatalkes_nama'];
  $stok     = $rowObt['stok'];

  
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-sm-2">
            <input type="text" name="stok" id="idstok" class="form-control" value="<?=number_format($stok);?>" disabled placeholder="Stok">
          </div> 
          <?php
          if ($jObat == "Racikan") {
            ?>
            <div class="col-sm-1">
              <button type="button" class="btn btn-secondary btn-sm" id="addOns" style=""> 
                          <i class="fas fa-plus"></i>
              </button>
            </div>
            <?php
            }
          ?>                   
          <div class="col-sm-2">
            <input type="text" name="qty" id="idqty" class="form-control money" value="" required="required" placeholder="Qty">
          </div>      
          <div class="col-sm-5">
            <select name="kodeSigna" id="idSigna" class="form-control select2" required="required" style="width: 100%;">
              <option value="">--Pilih Signa--</option>
              <?php        
              $sqlObt   = "SELECT * FROM signa_m order by signa_nama asc";
              $statObt  = $conn->query($sqlObt);
              while($rowObt   = $statObt->fetch_assoc()){
                $idObat = $rowObt['obatalkes_id'];
                ?>
                <option value="<?=$rowObt['signa_kode'];?>"><?=$rowObt['signa_nama'];?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <div class="col-sm-2">
            <button type="submit" class="btn btn-primary btn-sm" id="idgenData" value="genData" name="simpandata">Submit</button>
          </div>
        </div>
      </div>   
    </div>


<script type="text/javascript">
  $(function () {
    $('.money').mask("#,##0", {reverse: true});
    $('.select2').select2({
        theme: 'bootstrap4'
    });
  });
  $("#idgenData").click(function(){  
    var idqty = document.getElementById("idqty").value;                
    var idstok = document.getElementById("idstok").value;
    if(Number(idqty) > Number(idstok)){
        alert("Qty tidak boleh melebihi Stok"); 
        $("#idqty").focus();
        return false;
    }
  });
  $("#addOns").click(function(){
    var scDiv = document.getElementById("idjObat").value;
    $.ajax({
        type: "GET",
        url: "resep/getObat.php?jObat="+scDiv,
        success: function (data) {
          $(".PutObat").append(data);
          // $(namaClass).prop("selectedIndex", -1);
        }
    });    
  });
  
</script>