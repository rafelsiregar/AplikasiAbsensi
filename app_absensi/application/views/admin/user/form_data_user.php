
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
                    <li class="nav-item">
                    <a href="<?php echo base_url("admin/siswa/data_siswa")?>" class="nav-link">INFO SISWA</a>
                    </li>
                    <li class="nav-item">
                    <a href="<?php echo base_url("admin/kelas/data_kelas")?>" class="nav-link">INFO KELAS</a>
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
                        <!-- form start -->
                        <div class="box-body">
                            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="varchar">Username : <?php echo form_error('username')?> </label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="" value="<?php echo $username; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Password :  <?php echo form_error('password') ?></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="********" value="<?php echo $password; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="int">Role : </label><br>
                                <select class="form-control" name="role" id="role" onchange="showSiswa()">
                                    <!--<option value="" disabled selected>Pilih Role</option>-->
                                        <option value="admin" <?php if ($role=="admin") echo "selected" ?>>Admin</option>
                                        <option value="siswa" <?php if($role!="admin") echo "selected"?>>Siswa</option>                           
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="int">NIS - Nama Siswa : </label><br>
                                <select class="form-control" name="siswa" id="siswa">
                                <option value="" disabled selected>Pilih</option>
                                    <?php foreach ($siswa as $row): ?>
                                        <option value="<?php echo $row->id_siswa ?>"<?php echo $nis_siswa[$row->id_siswa]?>>
                                            <?php echo $row->nis;?>   - <?php echo $row->nama;?>
                                        </option>                           
                                    <?php endforeach ?>    
                                </select>
                            </div>
                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                            <a href="<?php echo site_url('admin/data_user') ?>" class="btn btn-default">Batalkan</a>
                        </form>
                        </div>
                </div>
            </div>
        </div>
        <!--type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"-->
        <script>
            function showSiswa() {
                if(document.getElementById("role").value!=="siswa"){
                    document.getElementsByTagName("label")[3].style.display = 'none';
                    document.getElementById("siswa").style.display = 'none';
                } else {
                    document.getElementsByTagName("label")[3].style.display='inline';
                    document.getElementById("siswa").style.display = 'block';
                }
            }
        </script>
    </body>
</html>