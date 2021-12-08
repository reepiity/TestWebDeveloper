<script type="text/javascript">
  $(document).ready(function() {
    $(".tbObat").DataTable({
       "pageLength": 15,
       "lengthChange": false,
       "order": [[ 0, "asc" ]], 
       "columnDefs" : [{"targets":1, "type":"date-eu"}]
    });
  } );
  $(function () {
    $('.select2').select2({
        theme: 'bootstrap4'
    });
    $('.money').mask("#.##0", {reverse: true});

    $("#idkodeObat").change(function() {
      var scKode = document.getElementById("idkodeObat").value;
      var scjObat = document.getElementById("idjObat").value;
      // alert(scDiv);
      $.ajax({
        type: "GET",
        url: "resep/dataObat.php?kdObat="+scKode+"&kdjObat="+scjObat,
        success: function (data) {
          $(".PutDataObat").html(data);
        }
      });    
    });
    
  });
</script>