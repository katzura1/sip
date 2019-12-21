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
                        <td style="width: 10%">Jenis Berkas </td><td style="width: 3%">:</td><td> <?=$jenis_berkas?></td>
                      </tr>
                      <tr>
                        <td style="width: 10%">Keterangan </td><td style="width: 3%">:</td><td><?=$keterangan?></td>
                      </tr>
                      <tr>
                        <td style="width: 10%">Tahun Pajak </td><td style="width: 3%">:</td><td> <?=$tahun_pajak?></td>
                      </tr>
                      <tr>
                        <td style="width: 10%">Masa Pajak </td><td style="width: 3%">:</td><td> <?=$masa_pajak?></td>
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
                        <th>Nama File</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $max = 0;
                  foreach ($lampiran->result() as $row):?>
                    <tr>
                      <td></td>
                      <td><?=$row->files?></td>
                      <td>
                        <a class="btn btn-primary btn-sm btn-download mr-2 mb-3" href="<?=base_url('files/document/'.$row->files)?>" target="_blank" download>
                          <i class="fa fa-download"></i>
                        </a>
                        <?php 
                        if($level>1):
                        ?>
                        <button class="btn btn-danger btn-sm btn-delete mr-2 mb-3" data-id="<?=$row->id?>">
                          <i class="fa fa-trash"></i>
                        </button>
                        <?php 
                        endif;
                        ?>
                      </td>
                    </tr>
                  <?php
                    $max++;
                  endforeach;
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <div class="row">
            <form id="form_update" method="POST">
            <div class="col-sm-8">
              <label>File</label>
              <input type="file" name="lampiran[]" id="lampiran" class="form-control" required multiple accept="application/pdf, image/*">
            </div>
            <div class="col-sm-3">
              <label style="color:white;display: block">BUTTON</label>
              <button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>
            </form>
          </div>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->
<!-- Modal -->

<div class="modal fade" id="modal_alert">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){
  var MAX_FILE = 8 - <?=$max?>;
  $(document).on('change','input[type=file]', function(){
    var $fileUpload = $(this);
    if (parseInt($fileUpload.get(0).files.length)>MAX_FILE){
     alert("You can only upload a maximum of "+MAX_FILE+" files");
     $(this).val('');
     return false;
    }
  })

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
    $('#fg_lampiran').css('display','block');
    $('#lampiran').attr('type','file');
    $('#lampiran').attr('required',true);
    $('#modal_add .modal-title').html('Add Document');
    $('#modal_add').modal();
  })

  $(document).on('click', '.btn-delete' ,function(){
    var id = $(this).data('id');

    if(confirm('Are you sure ?')){
      $.ajax({
        url : "<?=site_url('document/delete_attach')?>",
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
            location.reload();
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

  $('#modal_add').on('hidden.bs.modal', function () {
     $('input[name=id]').val('');
     $('#form_update')[0].reset();
  });

  $('#form_update').on('submit', function(e){
    e.preventDefault();
    if(confirm('Are you sure ?')){
        var formdata = new FormData($(this)[0]);
        $.ajax({
          url : "<?=site_url('document/upload_data/'.$id.'/1')?>",
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
            if(result.c_err=='0'){
              $('#modal_alert .modal-body').html(result.result);
              $('#modal_alert').modal();
              setTimeout(function(){ $('#modal_alert').modal('hide'); location.reload(); }, 1500);
            }else{
              $('#modal_alert .modal-body').html(result.result);
              $('#modal_alert').modal();
              setTimeout(function(){ $('#modal_alert').modal('hide'); location.reload(); }, 2000);
            }
            //location.reload();
            //$('#modal_add').modal('hide');
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

  var bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

  var tb = $('#tb_doc').DataTable({
    order : [[1,'asc']],
  })

  tb.on( 'order.dt search.dt', function () {
    tb.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
  } ).draw();

  $('.dataTables_filter input').attr('maxlength', 30);
})
</script>
<?php
$this->load->view('template/foot');
?>