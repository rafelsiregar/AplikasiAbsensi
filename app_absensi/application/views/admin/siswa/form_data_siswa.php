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
                <a href="<?php echo base_url("admin/dashboard")?>" class="nav-link">HOME</a>
                </li>
                <li class="nav-item active">
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
                <div class="col-md-9 " style ="overflow :auto">
                    <h3 style="margin-top:60px">Form Info Siswa </h3>
                        <!-- form start -->
                        <div class="box-body">
                            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="varchar">NIS : <?php echo form_error('nis')?> </label>
                                <input type="text" class="form-control" name="nis" id="nis" placeholder="NIS" value="<?php echo $nis; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">NAMA SISWA :  <?php echo form_error('nama') ?></label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Siswa" value="<?php echo $nama; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">JENIS KELAMIN :  <?php echo form_error('jenis_kelamin') ?></label>
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="" disabled selected>Jenis Kelamin</option>
                                    <option value="Laki-laki" <?php if ($jenis_kelamin=="Laki-laki") echo "selected" ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php if ($jenis_kelamin=="Perempuan") echo "selected" ?> >Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="varchar">TEMPAT LAHIR :  <?php echo form_error('tempat_lahir') ?></label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
                            </div>
                            <div>
                            <label for="varchar">TANGGAL LAHIR :  <?php echo form_error('tanggal_lahir') ?></label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
                            </div>
                            </div>  
                            <div class="form-group">
                                <label for="int">KELAS : </label><br><?php echo form_error('kelas') ?>
                                <select class="form-control" name="kelas" id="kelas">
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    <?php foreach ($kelas as $row): ?>
                                        <option value="<?php echo $row->id_kelas ?>" <?php echo $kelas_siswa[$row->id_kelas]?>>
                                            <?php echo $row->nama_kelas?>   
                                        </option>                           
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <input type="hidden" name="id_siswa" value="<?php echo $id_siswa; ?>" />
                            <button type="submit" class="btn btn-primary" style="margin-left:200px; margin-top:10px;margin-bottom:50px"><?php echo $button ?></button> 
                            <a href="<?php echo site_url('admin/data_siswa') ?>" class="btn btn-default" style="margin-top:10px;margin-left:20px; margin-bottom:50px">Batalkan</a>
                        </form>
                        </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!--<script type="text/javascript" src="<?php echo base_url()?>"></script>-->
</body>
</html>