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
        <li class="active">Document</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default Document -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Database Document</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-2">
                      <?=form_dropdown('kodebox',$dd_box,'','class="form-control select2 trigger" id="kodebox"')?>
                    </div>
                  <?php if($level>1) : ?>
                    <div class="col-sm-2 pull-right">
                      <button id="btn_add" class="btn btn-sm btn-primary pull-right">
                        <i class="fa fa-plus"> Add New Document</i>
                      </button>
                    </div>
                  <?php endif;?>
                  </div>
                  <table class="table table-sm" id="tb_box">
                      <thead>
                          <tr>
                              <th style="width: 5%">No</th>
                              <th>Nama</th>
                              <th>Box</th>
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
    </div><!-- /.box -->

</section><!-- /.content -->
<!-- Modal -->
<div class="modal modal-default fade" id="modal_add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New Document</h4>
      </div>
      <form method="POST" id="form_doc">
      <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <input type="hidden" id="id_box" name="id_box">
        <div class="form-group">
          <label>Nama Box</label>
          <input type="text" name="nama_box" id="nama_box" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama_file" id="nama_file" placeholder="Enter ..." required>
        </div>
<!--         <div class="form-group">
          <label>File</label>
          <input type="file" class="form-control" name="file_doc" id="file_doc" required>
        </div> -->
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
<div class="modal modal-default fade" id="modal_edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Document</h4>
      </div>
      <form method="POST" id="form_doc_edit">
      <div class="modal-body">
        <input type="hidden" id="id_edit" name="id">
        <div class="form-group">
          <label>Nama Box</label>
          <?=form_dropdown('id_box',$dd_box,'','class="form-control" id="id_box_edit"')?>
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama_file" id="nama_file_edit" placeholder="Enter ..." required>
        </div>
<!--         <div class="form-group">
          <label>File</label>
          <input type="file" class="form-control" name="file_doc" id="file_doc" required>
        </div> -->
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

  $('.select2').select2();

  var tb = $('#tb_box').DataTable({
      ajax : {
          url : "<?=site_url('document/ajax_dt_document')?>",
          data : function(d){
            d.kodebox = $('select[name=kodebox]').val();
          },
          type : 'POST',
      },
      order : [],
      columns : [
          {
              data : 'id'
          },
          {
              data : 'nama_file'
          },
          {
              data : 'kode_box',
              render : function(data, type, row){
                return row['kode_box']+'-'+row['nama_box'];
              }
          },
          {
              data : 'id',
              render : function(data, type, row){

                  var btn1 = '<button class="btn btn-warning btn-sm text-white mr-2 mb-2 btn-edit" data-id="'+data+'"><i class="fa fa-edit"></i></button>';
                  var btn2 = '<button class="btn btn-danger btn-sm text-white mr-2 mb-2 btn-delete" data-id="'+data+'"><i class="fa fa-trash"></i></button>';
                  var btn3 = '<button class="btn btn-success btn-sm text-white mr-2 mb-2 btn-view" data-id="'+data+'"><i class="fa fa-eye"></i></button>';
                  var btn4 = '<button class="btn btn-info btn-sm text-white mr-2 mb-2 btn-download" data-id="'+data+'"><i class="fa fa-download"></i></button>';
                  return btn1+btn2;
              },
              visible : <?=$level=='1'?'false':'true'?>
          },
      ],
  });

  tb.on( 'order.dt search.dt', function () {
      tb.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
      } );
  } ).draw();


  $('.trigger').on('change', function(){
    tb.ajax.reload();
  })

  $('#btn_add').on('click', function(){
    var id_box    = $('select[name=kodebox]').val();
    var nama_box  = $('select[name=kodebox]').find(':selected').text();
    if(id_box == '' || id_box==null){
      swal.fire({
        icon : 'warning',
        title : 'Warning!',
        text : 'Choose box before add document.'
      })
      return;
    }else{
      $('input[name=id_box]').val(id_box);
      $('input[name=nama_box').val(nama_box);
      $('.modal-title').html('Add Document');
      $('#modal_add').modal();
    }
      
  })

  $('.btn-close').on('click', function(){
      $('#form_doc')[0].reset();
  })

  $(document).on('click', '.btn-delete' ,function(){
      var id = $(this).data('id');

      if(confirm('Are you sure ?')){
          $.ajax({
              url : "<?=site_url('document/delete_doc')?>",
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
                     })
                  }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error',
                        text: result.message,
                     })
                  }
                  tb.ajax.reload();
              },
              error : function(xhr, ajaxOptions, thrownError){
                  Swal.fire({
                    icon: 'warning',
                    title: 'Error',
                    text: xhr.status + ' ' +thrownError,
                 })
              }
          })
      }
  })
  
  $(document).on('click','.btn-edit', function(){
      var id = $(this).data('id');

      $.ajax({
          url : "<?=site_url('document/get_info')?>",
          data : {id : id},
          type : 'GET',
          dataType : 'JSON',
          beforeSend : function(){
          },
          success: function(result){
              console.log(result);
              $.each(result, function(i,val){
                console.log('#'+i+'_edit');
                $('#'+i+'_edit').val(val).change();
              });
              $('#modal_edit').modal();
          },
          error : function(xhr, ajaxOptions, thrownError){
            Swal.fire({
              icon: 'warning',
              title: 'Error',
              text: xhr.status + ' ' +thrownError,
            })  
          }
      })
  })

  $(document).on('change', 'input[type=file]', function(){
    var filePath = $(this).val();
    console.log(filePath);
    var allowedExtensions = /(\.pdf|\.doc|\.jpg|\.png|\.docx|\.jpeg)$/i;
    if(!allowedExtensions.exec(filePath)){
      alert('Please upload file having extensions .jpeg/.jpg/.png/.pdf/.doc/.msg/.xls/.html only.');
      $(this).val('');
      return false;
    }
    var fileSize = this.files[0].size/1048576;
    if(fileSize>4){
      alert('Please upload file having size under 4 MB only.');
      $(this).val('');
      return false;
    }
  });

  $('#modal_add').on('hidden.bs.modal', function () {
    $('input[name=id]').val('');
    $('input[name=id_box]').val('');
    $('#form_doc')[0].reset();
  });

  $('#form_doc').on('submit', function(e){
      e.preventDefault();

      if(confirm('Are you sure ?')){
          var formdata = new FormData($(this)[0]);
          $.ajax({
            url : "<?=site_url('document/submitForm')?>",
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
                 })
              }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Error',
                    text: result.message,
                 })
              }
              tb.ajax.reload();
              $('#modal_edit').modal('hide');
            },
            error : function(xhr, ajaxOptions, thrownError) {
              Swal.fire({
                icon: 'warning',
                title: 'Error',
                text: xhr.status + ' ' +thrownError,
             })
            }
          })
      }
    })

  $('#form_doc_edit').on('submit', function(e){
      e.preventDefault();

      if(confirm('Are you sure ?')){
          var formdata = new FormData($(this)[0]);
          $.ajax({
            url : "<?=site_url('document/submitForm')?>",
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
                 })
              }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Error',
                    text: result.message,
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