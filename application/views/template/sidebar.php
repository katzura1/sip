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
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=site_url('user')?>"><i class="fa fa-circle-o"></i> Users</a></li>
                    <li><a href="<?=site_url('box')?>"><i class="fa fa-circle-o"></i> Boxs</a></li>
                    <?php if($this->session->userdata('sip_level')=='2'):?>
                    <li><a href="<?=site_url('document')?>"><i class="fa fa-circle-o"></i> Documents</a></li>
                    <?php endif;?>
                </ul>
            </li>

            <li><a href="#"><i class="fa fa-book"></i> Documentation</a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">