<!DOCTYPE html>
<html>
<head>
    <title>Selamat Datang di Aplikasi Absensi Online</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.min.css")?>">
    <!--<style>

    </style>-->
</head>
<body style="overflow:hidden; background-color:#00008B">
<div class="content overflow-hidden container" style="margin-top:60px">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-md-5 col-lg-5">
                            
                            <!--Nama Aplikasi-->
                            <h1 class="text-center h2" style="background-color:red;color:white">Absensi Online Siswa</h1>
                            <h1 class="text-center h2" style="background-color:white;color:red"> Berbasis Android</h1>
                            <h3 class="text-center h5" style="color:white"> HALAMAN WEB </h3>
                            <br><br><br><br>
                            <form action="<?php echo site_url("login");?>" method="post">
                                    <div class="form-group">
                                    <!--Username dan Password yang akan dimasukkan--> 
                                        <input class="form-control" type="text" id="username" name="username" 
                                        placeholder="Username">
                                    </div>
                                <div class="form-group">
                                        <input class="form-control" type="password" id="login-password" name="password"
                                        placeholder="Password">
                                </div>
                                <!--Checklist "remember me"-->
                                <div class="form-group">
                                    <label style="color:black">
                                        <input type="checkbox"><span style="color:white"> Remember Me</span>
                                    </label>
                                </div>
                                <!--Tombol untuk melakukan Login-->
                                <div class="form-group">
                                    <button class="btn btn-lg btn-light" type="submit">
                                    LOG IN</button>
                                </div>
                            </form>
                            <!-- END Login Form -->
                            <div id="error" style="margin-top: 10px"><?php if(isset($error)) { echo $error; }; ?></div>
                            <p style="color:white; text-align:center">
                            <?php if(isset($error)) 
                                echo "Lupa Password? Silahkan hubungi bagian administrasi untuk tindakan lebih lanjut.";?>
                             </p>
                            </div>
                    </div>
</div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
</body>
</html>