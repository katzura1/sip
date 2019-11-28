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

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Boxs</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>44</h3>
                    <p>Documents</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>65</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->
</section><!-- /.content -->
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
            <input type="text" name="search_box" class="form-control" placeholder="Kode / Nama Box..." required>
        </div>
        <div col-lg-1>
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    </form>
</section>

<?php
$this->load->view('template/js');
?>
<script type="text/javascript">
$(document).ready(function(){
    $('#form_search').on('submit', function(e){
        e.preventDefault();

        var search = $('input[name=search_box]').val();
        $.ajax({
            url : "<?=site_url('box/search_box')?>",
            data : {param : search},
            type : 'POST',
            dataType : 'JSON',
            beforeSend : function(){},
            success : function(result){
                if(result.code=='200'){
                    var url = "<?=site_url('document/view/')?>"+result.id_box;
                    window.location.href=url;
                }else{
                    swal.fire({
                        title : 'Box not Found!',
                        icon : 'warning',
                    })
                }
            },
            error : function(xhr, ajaxOptions, thrownError){
                swal.fire({
                    title : xhr.status,
                    icon : 'danger',
                    message : thrownError
                })
            }
        })
    })
})
</script>
<?php
$this->load->view('template/foot');
?>