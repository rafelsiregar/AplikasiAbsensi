
<!DOCTYPE html>
<html>
    <head>
        <title> Aplikasi Absensi Online</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.min.css")?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" text="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <link rel="stylesheet" text="text/css" href="<?php echo base_url()?>assets/plugin/jqueryui/jquery-ui.min.css">
    </head>
    <body>
        <!--Navbar untuk admin-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Aplikasi Simulasi Absensi Online</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a href="<?php echo base_url("admin/dashboard")?>" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item">
                    <a href="<?php echo base_url("admin/data_siswa")?>" class="nav-link">INFO SISWA</a>
                    </li>
                    <li class="nav-item">
                    <a href="<?php echo base_url("admin/data_kelas")?>" class="nav-link">INFO KELAS</a>
                    </li>
                    <li class="nav-item">
                    <a href="<?php echo base_url("admin/dashboard/log_out")?>" type="submit" 
                            class="nav-link"> LOGOUT</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class = "container">
            <div class="row">
            <!--Div untuk List Group-->
                <div class="col-md-3" style="margin-top:40px;margin-left:-100px;">
                        <div class="list-group">
                        <p class="list-group-item active" style="text-align:center;background-color:black;border-color:black">
                            ADMIN</p>
                            <a href="<?php echo base_url("admin/dashboard")?>" class="list-group-item list-group-item-dark">HOME</a>
                            <a href="<?php echo base_url("admin/data_absensi")?>" class="list-group-item list-group-item-dark">RIWAYAT ABSEN</a>
                            <a href="<?php echo base_url("admin/data_user")?>" class="list-group-item list-group-item-dark">DAFTAR USER</a>
                        </div>
                    </div>
                <!--Div untuk konten dari dashboard-->
                <div class="col-md-9">
                    <h3 style="margin-top:60px">Info User </h3>
                    <table class="table table-bordered table-striped" id="table_user">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td> Username </td>
                                <td> Password Hash</td>
                                <td> Role </td>
                                <td class="text-center"> Action </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $key=>$val) :?> 
                            <tr>
                                <td><?php echo $key+1?></td>
                                <td><?php echo $val->username?></td>
                                <td><?php echo $val->password?></td>
                                <td><?php echo $val->role?></td>
                                <td class="text-center"><a href="<?php echo base_url('admin/data_user/update').'/'.$val->id_user?>">Edit</a>&nbsp||<a href="<?php echo base_url('admin/data_user/delete').'/'.$val->id_user?>">Delete</a>&nbsp</td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="col-md-12 text-left">
                        <?php echo anchor(site_url('admin/data_user/create'), '+ Tambah User', 'class="btn btn-primary"'); ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var t = $("#table_user").dataTable({});
            });
        </script>
    </body>
</html>
