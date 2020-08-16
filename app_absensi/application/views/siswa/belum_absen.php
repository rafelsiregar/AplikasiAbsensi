<!DOCTYPE html>
<html>
<head>
    <title> Aplikasi Absensi Online</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.min.css")?>">
</head>
<body>
    <!--Navbar untuk siswa-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Aplikasi Simulasi Absensi Online</a>
        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a href="<?php echo base_url("siswa/dashboard")?>" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item active">
                    <a href="<?php echo base_url('siswa/status_absen/check').'/'.$_SESSION['id_user']?>" class="nav-link">STATUS ABSEN</a>
                    </li>
                    <li class="nav-item">
                    <a href= "<?php echo base_url("siswa/status_absen/read")?>" class="nav-link">RIWAYAT ABSEN</a>
                    </li>
                    <li class="nav-item">
                    <a href="<?php echo base_url("siswa/dashboard/log_out")?>" type="submit" 
                            class="nav-link "> LOGOUT</a>
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
                        SISWA</p>
                        <a href="<?php echo base_url("siswa/dashboard")?>" class="list-group-item list-group-item-dark">HOME</a>
                        <a href="<?php echo base_url("siswa/data_siswa/read").'/'.$_SESSION['id_user']?>" class="list-group-item list-group-item-dark">DATA SISWA</a>
                        <a href="<?php echo base_url("siswa/data_siswa/update_user_info").'/'.$_SESSION['id_user']?>" class="list-group-item list-group-item-dark">UBAH DATA AKUN</a>
                    </div>
                </div>
                <!--Div untuk konten dari dashboard-->
                <div class="col-md-9">
                    <h3 style="margin-top:60px">Halaman Siswa</h3>
                    <?php if(is_weekend()): ?>
                        <p style="margin-top:50px">Hari ini libur.<br>
                        Anda tidak perlu melakukan absensi hari ini. <br>
                        </p>
                    <?php else :?>
                        <p style="margin-top:50px">Anda belum absen.<br>
                        Silahkan melakukan absensi di dengan mengeklik tombol <b>ABSEN MASUK</b> untuk melakukan absen masuk pada smartphone anda. <br>
                        </p>
                    <?php endif;?>
                </div>
            </div>
    </div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>"></script>
</body>
</html>