<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<style type="text/css">
#btn_add{
    margin-bottom: 10px;
}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 style="visibility: hidden;">
        Blank page
        <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Log</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default jenis_berkas -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Database Log</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-danger btn-sm" id="btn_delete">
                        <i class="fa fa-trash"> Delete Log</i>
                    </button>
                </div>
                <div class="col-sm-12 mt-2">
                    <table class="table table-sm table-responsive-lg" id="tb_log">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Aksi</th>
                                <th>Tanggal</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- /.box-footer-->
    </div><!-- /.jenis_berkas -->
<div class="modal modal-default fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Log</h4>
      </div>
      <div class="modal-body">
        <form id="form_delete" method="POST">
            <div class="form-group">
                <label>Tahun</label>
                <?=form_dropdown('tahun',$dd_tahun,'','class="form-control select2"')?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger"> SAVE </button>
                <button data-dismiss="modal" class="btn btn-secondary"> CLOSE </button>
            </div>
        </form>
      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</section><!-- /.content -->
<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){

  $('.select2').select2();
  
  var tb = $('#tb_log').DataTable({
      ajax : {
          url : "<?=site_url('log/list_ajax_dt')?>",
          data : {},
          type : 'POST',
      },
      order : [],
      columns : [
          {
              data : 'id'
          },
          {
              data : 'aksi'
          },

          {
              data : 'tanggal'
          },

          {
            data : 'username'
          }
      ],
      scrollX : true,

  });

  tb.on( 'order.dt search.dt', function () {
      tb.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
      } );
  } ).draw();

  $('#btn_delete').on('click', function(){
      $('#modal_delete').modal();
  })

  $('#form_delete').on('submit', function(e){
      e.preventDefault();
      
      if(confirm('Are you sure ?')){
          var formdata = new FormData($(this)[0]);
          $.ajax({
            url : "<?=site_url('log/delete_log')?>",
            data: formdata,
            processData: false,
            contentType: false,
            async: false,
            cache: false,
            enctype: 'multipart/form-data',
            type : 'POST',
            dataType : 'JSON',
            beforeSend : function(){},
            success : function (result) {
              if(result.code=='200'){
                Swal.fire({
                    icon: 'success',
                    title: 'Great',
                    text: result.message,
                    showConfirmButton: false,
                    timer: 1500
                 })
              }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Error',
                    text: result.message,
                    showConfirmButton: false,
                    timer: 1500
                 })
              }
              tb.ajax.reload();
              $('#modal_delete').modal('hide');
            },
            error : function(xhr, ajaxOptions, thrownError) {
              Swal.fire({
                icon: 'warning',
                title: 'Error',
                text: xhr.status + ' ' +thrownError,
                showConfirmButton: false,
                timer: 1500
             })
            }
          })
      }
  })
})
</script>
<?php
$this->load->view('template/foot');
?>