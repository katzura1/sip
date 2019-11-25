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
        <li class="active">Box</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Database Box</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                  <?php if($level>1) : ?>
                    <button id="btn_add" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"> Add New Box</i>
                    </button>
                  <?php endif;?>
                    <table class="table table-sm" id="tb_box">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Kode Box</th>
                                <th>Nama Box</th>
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
        <h4 class="modal-title">New Box</h4>
      </div>
      <form method="POST" id="form_box">
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
<div class="modal modal-default fade" id="modal_view">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_title_view">Box B001- Box Name</h4>
      </div>
      <div class="modal-body">
        <table class="table table-sm table-responsive-lg" id="tb_doc">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama File</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>

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

  function insert_log(keterangan){
    $.ajax({
      url : "<?=site_url('log/insert_log')?>",
      data : {aksi : keterangan},
      type : 'POST',
      beforeSend : function(){},
      success : function(result){
        console.log(result);
      },
      error : function(xhr, ajaxOptions, thrownError){
        console.log(xhr.status + ' - ' + thrownError);
      }
    })
  }

    var tb = $('#tb_box').DataTable({
        ajax : {
            url : "<?=site_url('box/ajax_dt_box')?>",
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
                  var btn3 = '<button class="btn btn-success btn-sm text-white mr-2 mb-2 btn-view" data-id="'+data+'"><i class="fa fa-eye"></i></button>';  
                  if(level==2){
                    return btn1+btn2+btn3;
                  }else{
                    return btn3;
                  } 
                },
            },
        ],
    });

    tb.on( 'order.dt search.dt', function () {
        tb.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#btn_add').on('click', function(){
        $('.modal-title').html('Add Box');
        $('#kode').removeAttr('required');
        $('#kode').prop('readonly',true);
        $('#kode').attr('placeholder','Kode akan auto generate setelah data disimpan');
        $('#modal_add').modal();
    })

    $('.btn-close').on('click', function(){
        $('#form_box')[0].reset();
    })

    $(document).on('click', '.btn-delete' ,function(){
        var id = $(this).data('id');

        if(confirm('Are you sure ?')){
            $.ajax({
                url : "<?=site_url('box/delete_box')?>",
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
            url : "<?=site_url('box/get_info')?>",
            data : {id : id},
            type : 'GET',
            dataType : 'JSON',
            beforeSend : function(){
                $('.modal-title').html('Edit Box');
                $('#kode').removeAttr('required');
                $('#kode').prop('readonly',true);
                $('#kode').attr('placeholder','Kode akan auto generate setelah data disimpan');
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
              })  
            }
        })
    })
    
    $(document).on('click','.btn-view', function(){
        var id = $(this).data('id');
        var row = tb.row($(this).parent().parent()).data();
        $('#modal_title_view').html(row['kode']+'-'+row['nama']);
        $.ajax({
            url : "<?=site_url('box/get_document')?>",
            data : {id : id},
            type : 'GET',
            beforeSend : function(){
                $('#tb_doc tbody').html('');
            },
            success: function(result){
               $('#tb_doc tbody').html(result);
               insert_log('View Box '+row['kode']+'-'+row['nama']);
               $('#modal_view').modal();
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

    $('#modal_add').on('hidden.bs.modal', function () {
       $('input[name=id]').val('');
       $('#form_box')[0].reset();
    });

    $('#form_box').on('submit', function(e){
        e.preventDefault();

        if(confirm('Are you sure ?')){
            var formdata = new FormData($(this)[0]);
            $.ajax({
              url : "<?=site_url('box/submitForm')?>",
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