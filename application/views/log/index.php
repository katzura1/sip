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

</section><!-- /.content -->
<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){

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
})
</script>
<?php
$this->load->view('template/foot');
?>