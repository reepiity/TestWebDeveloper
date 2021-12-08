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