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
            <h3 class="box-title">View Document</h3>
              <div class="pull-right">
                <button class="btn btn-sm btn-primary" onclick="window.history.back()">
                    <i class="fa fa-arrow-left"> Kembali</i>
                </button>
              </div>
        </div>
        <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <table class="table">
                      <tr>
                        <td style="width: 10%">Kode Box </td><td style="width: 3%">:</td><td> <?=$kode?></td>
                      </tr>
                      <tr>
                        <td style="width: 10%">NPWP </td><td style="width: 3%">:</td><td> <?=$npwp?></td>
                      </tr>
                      <tr>
                        <td style="width: 10%">Nama </td><td style="width: 3%">:</td><td> <?=$nama?></td>
                      </tr>
                      <tr>
                        <td style="width: 10%">Alamat </td><td style="width: 3%">:</td><td> <?=$alamat?></td>
                      </tr>
                      <tr>
                        <td style="width: 10%">Lokasi Berkas </td><td style="width: 3%">:</td><td> <?=$lokasi?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <table class="table table-sm" id="tb_doc">
                  <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Jenis Berkas</th>
                        <th>Masa Pajak</th>
                        <th>Tahun Pajak</th>
                        <th>Status Pembetulan</th>
                        <th>Keterangan</th>
                        <th>Status Pinjam</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-3">
              <button id="btn_add_berkas" class="btn btn-sm btn-secondary">
                <i class="fa fa-plus"> Add Document</i>
              </button>
            </div>
          </div>
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
      <form method="POST" id="form_update">
      <div class="modal-body">
        <input type="hidden" id="id" name="id">
        <input type="hidden" id="id_box" name="id_box" value="<?=$id_box?>">
        <div class="form-group">
          <label>Jenis Berkas</label>
          <?=form_dropdown('id_jenis',$dd_jb,'','class="form-control select2" id="id_jenis')?>
        </div>
        <div class="form-group">
          <label>Masa Pajak</label>
          <?=form_dropdown('masa_pajak',$dd_bulan,'','class="form-control" name="masa_pajak" id="masa_pajak"')?>
        </div>
        <div class="form-group">
          <label>Tahun Pajak</label>
          <input type="number" class="form-control" name="tahun_pajak" id="tahun_pajak" placeholder="Enter ..." maxlength="4" required/>
        </div>
        <div class="form-group">
          <label>Status Pembetulan</label>
          <input type="text" class="form-control" name="status_pembetulan" id="status_pembetulan" placeholder="Enter ..." maxlength="8" required/>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Enter ..." required/>
        </div>
        <div class="form-group">
          <label>Status Pinjam</label>
          <select class="form-control" name="status_pinjam" id="status_pinjam">
            <option value="1">Dipinjam</option>
            <option value="0">Ada</option>
          </select>
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

  $('#btn_add').on('click', function(){
      $('.modal-title').html('Add Box');
      $('#kode').removeAttr('required');
      $('#kode').prop('readonly',true);
      $('#kode').attr('placeholder','Kode akan auto generate setelah data disimpan');
      $('#modal_add').modal();
  })

  $('.btn-close').on('click', function(){
      $('#form_update')[0].reset();
  })

  $('#btn_add_berkas').on('click', function(){
    $('.select2').select2();
    $('#modal_add').modal();
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
          url : "<?=site_url('document/get_document')?>",
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
     $('#form_update')[0].reset();
  });

  $('#form_update').on('submit', function(e){
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

  var bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

  var tb = $('#tb_doc').DataTable({
    ajax : {
      url : "<?=site_url('document/ajax_dt_document')?>",
      data : function(d){
        d.kodebox = "<?=$id_box?>";
      },
      type : 'POST'
    },
    order : [[1,'asc']],
    columns : [
      {
        data : 'id'
      },
      {
        data : 'jenis_berkas'
      },
      {
        data : 'masa_pajak',
        render : function(data, type, row){
          return bulan[data-1];
        }
      },
      {
        data : 'tahun_pajak'
      },
      {
        data : 'status_pembetulan'
      },
      {
        data : 'keterangan'
      },
      {
        data : 'status_pinjam',
        render : function(data, type, row){
          return data==0?'Ada':'Dipinjam';
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
        }
      },
    ]
  })

  tb.on( 'order.dt search.dt', function () {
    tb.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
  } ).draw();
})
</script>
<?php
$this->load->view('template/foot');
?>