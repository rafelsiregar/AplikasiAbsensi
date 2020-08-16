
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
                    <a href="<?php echo base_url("siswa/dashboard")?>" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item">
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
                    <h3 style="margin-top:60px">Data Siswa </h3>
                        <table class="table">
							    <tr><td>NIS </td><td><?php echo $nis; ?></td></tr>
                                <tr><td>Nama Siswa</td><td><?php echo $nama; ?></td></tr>
                                <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
                                <tr><td>Tempat, Tanggal Lahir</td><td><?php echo $tempat_lahir;?>, 
                                <?php echo $tanggal_lahir;?></td></tr>
                                <tr><td>Kelas</td><td><?php foreach ($kelas as $row) {
                                    echo $row->nama_kelas;
                                }?></td></tr>
                                 <tr><td></td><td></td></tr>
                        </table>
                        <table class="table">
							   
						</table>
                    <div class=" d-flex justify-content-center">
                    <a href="<?php echo base_url('siswa/dashboard') ?>" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>