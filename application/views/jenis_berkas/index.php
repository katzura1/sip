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
        <li class="active">Document Type</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default jenis_berkas -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Database Document Type</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                  <?php if($level>1) : ?>
                    <button id="btn_add" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"> Add New</i>
                    </button>
                  <?php endif;?>
                    <table class="table table-sm" id="tb_jenis_berkas">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Aksi</th>
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

</section><!-- /.content -->
<!-- Modal -->
<div class="modal modal-default fade" id="modal_add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New Document Type</h4>
      </div>
      <form method="POST" id="form_jenis_berkas">
      <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <div class="form-group">
          <label>Kode</label>
          <input type="text" class="form-control" name="kode" id="kode" placeholder="Enter ..." />
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama" id="nama" placeholder="Enter ..." required/>
        </div>
        <div class="form-group">
           <button type="submit" class="btn btn-primary">Save changes</button>
           <button type="button" class="btn btn-danger btn-close" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){

  var tb = $('#tb_jenis_berkas').DataTable({
      ajax : {
          url : "<?=site_url('jenis_berkas/ajax_dt_jenis_berkas')?>",
          data : {},
          type : 'POST',
      },
      order : [],
      columns : [
          {
              data : 'id'
          },
          {
              data : 'kode'
          },

          {
              data : 'nama'
          },

          {
              data : 'id',
              render : function(data, type, row){
                var level = "<?=$level?>";
                var btn1 = '<button class="btn btn-warning btn-sm text-white mr-2 mb-2 btn-edit" data-id="'+data+'"><i class="fa fa-edit"></i></button>';
                var btn2 = '<button class="btn btn-danger btn-sm text-white mr-2 mb-2 btn-delete" data-id="'+data+'"><i class="fa fa-trash"></i></button>';
                var btn3 = '<a class="btn btn-success btn-sm text-white mr-2 mb-2 btn-view" href="<?=site_url('document/view/')?>'+data+'"><i class="fa fa-eye"></i></a>';
                return btn1+btn2;
              },
              visible : <?=($level<2?'false':'true')?>
          },
      ],
  });

  tb.on( 'order.dt search.dt', function () {
      tb.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
      } );
  } ).draw();

  $('#btn_add').on('click', function(){
      $('.modal-title').html('Add Document Type');
      // $('#kode').removeAttr('required');
      // $('#kode').prop('readonly',true);
      // $('#kode').attr('placeholder','Kode akan auto generate setelah data disimpan');
      $('#modal_add').modal();
  })

  $('.btn-close').on('click', function(){
      $('#form_jenis_berkas')[0].reset();
  })

  $(document).on('click', '.btn-delete' ,function(){
      var id = $(this).data('id');

      if(confirm('Are you sure ?')){
          $.ajax({
              url : "<?=site_url('jenis_berkas/delete_jenis_berkas')?>",
              data : {id : id},
              type : 'POST',
              dataType : 'JSON',
              beforeSend : function(){},
              success : function(result){
                  if(result.code=='200'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Great',
                        text: 'Data saved successfully',
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
              },
              error : function(xhr, ajaxOptions, thrownError){
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
  
  $(document).on('click','.btn-edit', function(){
      var id = $(this).data('id');

      $.ajax({
          url : "<?=site_url('jenis_berkas/get_info')?>",
          data : {id : id},
          type : 'GET',
          dataType : 'JSON',
          beforeSend : function(){
              // $('.modal-title').html('Edit Box');
              // $('#kode').removeAttr('required');
              // $('#kode').prop('readonly',true);
              // $('#kode').attr('placeholder','Kode akan auto generate setelah data disimpan');
          },
          success: function(result){
              console.log(result);
              $.each(result, function(i,val){
                  $('#'+i).val(val).change();
              });
              $('#modal_add').modal();
          },
          error : function(xhr, ajaxOptions, thrownError){
            Swal.fire({
              icon: 'warning',
              title: 'Error',
              text: xhr.status + ' ' +thrownError,
              showConfirmButton: false,
              timer: 1500
            })  
          }
      })
  })

  $('#modal_add').on('hidden.bs.modal', function () {
     $('input[name=id]').val('');
     $('#form_jenis_berkas')[0].reset();
  });

  $('#form_jenis_berkas').on('submit', function(e){
      e.preventDefault();

      if(confirm('Are you sure ?')){
          var formdata = new FormData($(this)[0]);
          $.ajax({
            url : "<?=site_url('jenis_berkas/submitForm')?>",
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
                    text: 'Data saved successfully',
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
              $('#modal_add').modal('hide');
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