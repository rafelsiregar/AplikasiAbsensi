
<!DOCTYPE html>
<html>
    <head>
        <title> Aplikasi Absensi Online</title>
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
                    <a href= "<?php echo base_url("admin/data_kelas")?>" class="nav-link">INFO KELAS</a>
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
                    <div class="row mb-2">
                        <h3 style="margin-top:60px;">Riwayat Absensi Siswa </h3>
                        <form action="" method="get">
                        <div class="row float-right" style="margin-top:120px;margin-bottom:20px">
                            <div class="col">
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="" disabled selected> Pilih Bulan </option>
                                    <?php foreach($all_bulan as $bn => $bt): ?>
                                        <option value="<?= $bn ?>" <?= ($bn == $bulan) ? 'selected' : '' ?>><?= $bt ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col ">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="" disabled selected> Pilih Tahun</option>
                                    <?php for($i = date('Y'); $i >= (date('Y') - 5); $i--): ?>
                                        <option value="<?= $i ?>" <?= ($i == $tahun) ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col ">
                                <button type="submit" class="btn btn-primary btn-fill btn-block">Tampilkan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div>
                    <table class="table border-0">
                            <tr>
                                <th class="border-0">Nama Siswa</th>
                                <th class="border-0">:</th>
                                <th class="border-0"><?php echo ($siswa->nama); ?></th>
                            </tr>
                            <tr>
                                <th class="border-0">NIS</th>
                                <th class="border-0">:</th>
                                <th class="border-0"><?php echo ($siswa->nis); ?></th>
                            </tr>
                        </table>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td> Tanggal Absen</td>
                                <td> Jam Masuk</td>
                                <td> Jam Pulang </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($absen as $key=>$val) :?>
                            <tr>
                                <?php if($absen): ?>
                                    <?php foreach($hari as $i => $h): ?>
                                        <?php
                                            $absen_harian = array_search($h['tgl'], array_column($absen, 'tanggal')) !== false ? $absen[array_search($h['tgl'], array_column($absen, 'tanggal'))] : '';
                                        ?>
                                        <tr <?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'class="bg-dark text-white"' : '' ?> <?= ($absen_harian == '') ? 'class="bg-danger text-white"' : '' ?>>
                                            <td><?php echo ($i+1) ?></td>
                                            <td><?php echo $h['hari'] . ', ' . $h['tgl'] ?></td>
                                            <td class="text-center"><?php echo is_weekend($h['tgl']) ? 'Libur' : check_jam(@$absen_harian['jam_masuk'], 'masuk') ?></td>
                                            <td class="text-center"><?php echo is_weekend($h['tgl']) ? 'Libur' : check_jam(@$absen_harian['jam_pulang'], 'pulang') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td class="bg-light" colspan="4">Tidak ada data absen</td>
                                        </tr>
                                    <?php endif; ?>
                                        </tr>
                                    <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-9">
                    
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <!--<script type="text/javascript">
            $(document).ready(function() {
                var t = $("#table_absensi").dataTable({});
            });
        </script>-->
    </body>
</html>