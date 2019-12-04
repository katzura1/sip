<?php
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<!-- iCheck -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />
<style type="text/css">
video {
  width: 100%;
  max-height: 100%;
}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Searh Box
        <small></small>
    </h1>
</section>
<section class="content">
    <form id="form_search">
    <div class="row">
        <div class="col-lg-3">
            <input type="text" name="search_box" class="form-control" placeholder="Kode / Nama Box..." required autofocus>
        </div>
        <div class="col-lg-1">
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-search"> Search</i>
            </button>
        </div>
<!--         <div class="col-lg-1">
            <button type="button" class="btn btn-danger" id="btn_scan">
                <i class="fa fa-barcode"> Scan</i>
            </button>
        </div> -->
    </div>
    </form>
</section>
<!-- Modal -->
<div class="modal fade" id="modal_scan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_scan_title">Scan Barcode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <video id="preview"></video>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php
$this->load->view('template/js');
?>
<script type="text/javascript">
$(document).ready(function(){
    $('input[name=search_box').focus();

    $('#form_search').on('submit', function(e){
        e.preventDefault();

        var search = $('input[name=search_box]').val();
        $.ajax({
            url : "<?=site_url('box/search_box')?>",
            data : {param : search},
            type : 'POST',
            dataType : 'JSON',
            beforeSend : function(){
                $('input[name=search_box').focus();
                $('input[name=search_box').val('');
            },
            success : function(result){
                if(result.code=='200'){
                    var url = "<?=site_url('document/view/')?>"+result.id_box;
                    window.location.href=url;
                }else{
                    swal.fire({
                        title : 'Box not Found!',
                        icon : 'warning',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('input[name=search_box').focus();
                    $('input[name=search_box').val('');
                }
            },
            error : function(xhr, ajaxOptions, thrownError){
                swal.fire({
                    title : xhr.status,
                    icon : 'danger',
                    message : thrownError,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    });

    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        //alert(content);
        $.ajax({
            url : "<?=site_url('box/get_box_id')?>",
            data : {kode : content},
            type : 'POST',
            beforeSend : function(){

            },
            success : function(result){
                if(result==0){
                    alert('Not Found');
                }else{
                    window.location.href="<?=site_url('document/view/')?>"+result;
                }
                
            },
            error : function(xhr, ajaxOptions, thrownError){
                alert(xhr.status+' : '+thrownError);
            }
        })
      });

    $('#modal_scan').on('shown', function(){
        scan_qr();
    });

    $('#btn_scan').on('click', function(){
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
              scanner.start(cameras[0]);
            } else {
              console.error('No cameras found.');
              alert('Camera Not Found');
            }
        }).catch(function (e) {
            console.error(e);
            alert(e);
        });
        $('#modal_scan').modal();
    })

    $('#modal_scan').on('hidden.bs.modal', function(e){
        scanner.stop();
    })

})
</script>
<?php
$this->load->view('template/foot');
?>