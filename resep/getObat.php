<?php
  include '../core/tech/connect.php';
  $jObat   = "Racikan";
?>
<div class="row">
  <div class="col-sm-3">
    <select name="kodeObat[]" id="idobat2" class="form-control select2" required="required" style="width: 100%;">
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
    <div class="PutDataObat2">
      
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function () {
    $('.select2').select2({
        theme: 'bootstrap4'
    });
  });
  $("#idobat2").change(function() {
    var scKode = document.getElementById("idobat2").value;
    var scjObat = document.getElementById("idjObat").value;
    // alert(scDiv);
    $.ajax({
      type: "GET",
      url: "resep/dataObat2.php?kdObat="+scKode+"&kdjObat="+scjObat,
      success: function (data) {
        $(".PutDataObat2").html(data);
      }
    });    
  });
</script>