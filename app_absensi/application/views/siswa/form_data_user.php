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
                        SISWA</p>
                        <a href="<?php echo base_url("siswa/dashboard")?>" class="list-group-item list-group-item-dark">HOME</a>
                        <a href="<?php echo base_url("siswa/data_siswa/read").'/'.$_SESSION['id_user']?>" class="list-group-item list-group-item-dark">DATA SISWA</a>
                        <a href="<?php echo base_url("siswa/data_siswa/update_user_info").'/'.$_SESSION['id_user']?>" class="list-group-item list-group-item-dark">UBAH DATA AKUN</a>
                    </div>
                </div>
                <!--Div untuk konten dari dashboard-->
                <div class="col-md-9">
                <h3 style="margin-top:60px">Ubah Data Akun </h3>
                        <!-- form start -->
                        <div class="box-body">
                            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="varchar">Username : <?php echo form_error('username')?> </label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="" value="<?php echo $username; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Password Sebelumnya :  <?php echo form_error('password')?></label>
                                <input type="password" class="form-control" name="password" id="password" value="<?php echo $password; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Password Baru :  <?php echo form_error('new_password') ?></label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="********" value="<?php echo $password; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Konfirmasi Password Baru :  <?php echo form_error('confirm_password') ?></label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="********" value="<?php echo $password; ?>" />
                            </div>
                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                            <a href="<?php echo site_url('siswa/dashboard') ?>" class="btn btn-default">Batalkan</a>
                        </form>
                        </div>
                </div>
            </div>
        </div>
        <!--type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"-->
    </body>
</html>