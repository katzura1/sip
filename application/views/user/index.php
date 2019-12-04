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
        <li class="active">User</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Database User</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                  <?php if($level>2) : ?>
                    <button id="btn_add" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"> Add New User</i>
                    </button>
                  <?php endif;?>
                    <table class="table table-sm" id="tb_user">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Level</th>
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
        <h4 class="modal-title" id="modal_title">New User</h4>
      </div>
      <form method="POST" id="form_user">
      <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="user" id="user" placeholder="Enter ..." required maxlength="30" />
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama" id="nama" placeholder="Enter ..." required maxlength="30" />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" class="form-control" name="password" id="password" placeholder="Enter ..." required maxlength="30" />
          <p class="help-block" id="help_password"></p>
        </div>
        <div class="form-group">
          <label>Level</label>
          <?=form_dropdown('level',$dd_level,'','id="level" class="form-control" required')?>
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

    var tb = $('#tb_user').DataTable({
        ajax : {
            url : "<?=site_url('user/ajax_dt_user')?>",
            data : {},
            type : 'POST',
        },
        order : [],
        columns : [
            {
                data : 'id'
            },
            {
                data : 'user'
            },
            {
                data : 'nama'
            },
            {
                data : 'level',
                render : function(data, type, row){
                  if(data=='1'){
                    return 'User';
                  }else if(data=='2'){
                    return 'Admin';
                  }else{
                    return 'Super Admin';
                  }
                }
            },
            {
                data : 'id',
                render : function(data, type, row){

                    var btn1 = '<button class="btn btn-warning btn-sm text-white mr-2 mb-2 btn-edit" data-id="'+data+'"><i class="fa fa-edit"></i></button>';
                    var btn2 = '<button class="btn btn-danger btn-sm text-white mr-2 mb-2 btn-delete" data-id="'+data+'"><i class="fa fa-trash"></i></button>';
                    return btn1+btn2;
                },
                visible : <?=$level<3?'false':'true'?>
            },
        ],
    });

    tb.on( 'order.dt search.dt', function () {
        tb.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#btn_add').on('click', function(){
        $('input[name=password]').attr('required',true);
        $('#help_password').html('');
        $('#modal_title').html('Add User');
        $('#modal_add').modal();
    })

    $('.btn-close').on('click', function(){
        $('#form_user')[0].reset();
    })

    $(document).on('click', '.btn-delete' ,function(){
        var id = $(this).data('id');

        if(confirm('Are you sure ?')){
            $.ajax({
                url : "<?=site_url('user/delete_user')?>",
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
            url : "<?=site_url('user/get_info')?>",
            data : {id : id},
            type : 'GET',
            dataType : 'JSON',
            beforeSend : function(){
              $('#modal_title').html('Edit User');
              $('input[name=password]').removeAttr('required');
              $('#help_password').html('Biarkan kosong, apabila tidak ingin mengubah <i>password</i>.')
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

    $('#modal_add').on('hidden.bs.modal', function () {
       $('input[name=id]').val('');
       $('#form_user')[0].reset();
    });

    $('#form_user').on('submit', function(e){
        e.preventDefault();

        if(confirm('Are you sure ?')){
            var formdata = new FormData($(this)[0]);
            $.ajax({
              url : "<?=site_url('user/submitForm')?>",
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