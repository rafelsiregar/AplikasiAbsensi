<!DOCTYPE html>
<html>
    <head>
        <title> Aplikasi Absensi Online</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.min.css")?>">
    </head>
    <body>
        <!--Navbar untuk admin-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Aplikasi Simulasi Absensi Online</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a href="dashboard" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item">
                    <a href="info_siswa" class="nav-link">INFO SISWA</a>
                    </li>
                    <li class="nav-item">
                    <a href="info_kelas" class="nav-link">INFO KELAS</a>
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
                        <a href="dashboard" class="list-group-item list-group-item-dark">HOME</a>
                        <a href="<?php echo base_url("admin/data_absensi")?>" class="list-group-item list-group-item-dark">RIWAYAT ABSEN</a>
                        <a href="<?php echo base_url("admin/data_user")?>" class="list-group-item list-group-item-dark">DAFTAR USER</a>
                    </div>
                </div>
                <!--Div untuk konten dari dashboard-->
                <div class="col-md-9">
                <h3 style="margin-top:60px">Perbarui Info Kelas </h3>
                        <!-- form start -->
                        <div class="box-body">
                            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>" /> 
                            <input type="hidden" name="id_siswa" value="<?php echo $id_siswa; ?>" /> 
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                            <a href="<?php echo site_url('admin/data_siswa') ?>" class="btn btn-default">Batalkan</a>
                        </form>
                        </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </body>
</html>