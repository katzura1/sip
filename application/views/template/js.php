</div><!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>
</div><!-- ./wrapper -->

<!-- jQuery  -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery.min.js') ?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/slimScroll/jquery.slimScroll.min.js') ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url('assets/AdminLTE-2.0.5/plugins/fastclick/fastclick.min.js') ?>'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/app.min.js') ?>" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<!--SweetAlert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var url = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
    $('.treeview-menu li').removeClass('active');
    $('[href$="'+url+'"]').parent().addClass("active");
    $('.treeview').removeClass('menu-open active');
    $('[href$="'+url+'"]').closest('li.treeview').addClass("menu-open active");


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

  });
</script>

<!--SELECT2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<!--Instascan-->
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>