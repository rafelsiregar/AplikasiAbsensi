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
                <li class="nav-item active">
                <a href="dashboard" class="nav-link">HOME</a>
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
                        <a href="dashboard" class="list-group-item list-group-item-dark">HOME</a>
                        <a href="<?php echo base_url("admin/data_absensi")?>" class="list-group-item list-group-item-dark">RIWAYAT ABSEN</a>
                        <a href="<?php echo base_url("admin/data_user")?>" class="list-group-item list-group-item-dark">DAFTAR USER</a>
                    </div>
                </div>
                <!--Div untuk konten dari dashboard-->
                <div class="col-md-9">
                    <h3 style="margin-top:60px">Halaman Admin</h3>
                    <p style="margin-top:50px">Selamat datang, admin Aplikasi Simulasi Absensi Online <br>
                    Di sini anda dapat mengedit data siswa serta kelas dari siswa. <br>
                </p>
                <h3><marquee>Selamat bekerja...</marquee></h3>
                </div>
            </div>
    </div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>"></script>
</body>
</html>