<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?=$this->session->userdata('sip_nama')?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="<?=site_url('dashboard1')?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
            </li>
            <li class="treeview">
                <a href="<?=site_url('box')?>"><i class="fa fa-book"></i> Box</a>
            </li>
            <li class="treeview">
                <a href="<?=site_url('jenis_berkas')?>"><i class="fa fa-file"></i> Jenis Berkas</a>
            </li>
            <li class="treeview">
                <a href="<?=site_url('user')?>"><i class="fa fa-user"></i> User</a>
            </li>
            <?php if($level=='3'): ?>
            <li class="treeview">
                <a href="<?=site_url('log')?>"><i class="fa fa-calendar"></i> Log</a>
            </li>
            <?php endif; ?>
            <li class="treeview">
                <a href="<?=site_url('auth/logout')?>"><i class="fa fa-sign-out"></i> Logout</a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">