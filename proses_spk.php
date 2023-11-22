<?php
    session_start();
    error_reporting(0);
    if(empty($_SESSION['id'])){
        header('location:login.php?error_login=1');
    }
?>
<?php include 'header.php';?>
<?php include 'menu.php';?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Proses SPK</h4>
                </div>
            </div>
            <div class="row">
                <h3>Tabel Total Penilaian</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>### </th>
                                <?php foreach ($db->select('kriteria','kriteria')->get() as $k): ?>
                                <th>
                                    <?php
                                        $tmp = explode('_',$k['kriteria']);
                                        echo ucwords(implode(' ',$tmp));
                                    ?>
                                </th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($db->select('santri.nama,nilai.*','santri,nilai')->where('santri.id_santri=nilai.id_santri')->get() as $data):
                            ?>
                                <tr>
                                    <td><?= $data['nama']?></td>
                                    <?php foreach ($db->select('kriteria','kriteria')->get() as $kr ): ?>
                                <td><?= $data[$kr['kriteria']]?></td>
                                <?php endforeach ?>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn btn-lg" onclick="tpl()">PROSES</button>
                </div>
            </div>
            <br>
            <div id="proses_spk" style="display: none;">
                <div class="row">
                <h3>Normalisasi</h3>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>### </th>
                                <?php foreach ($db->select('kriteria','kriteria')->get() as $k): ?>
                                <th>
                                    <?php
                                        $tmp = explode('_',$k['kriteria']);
                                        echo ucwords(implode(' ',$tmp));
                                    ?>
                                </th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($db->select('santri.nama,nilai.*','santri,nilai')->where('santri.id_santri=nilai.id_santri')->get() as $data):
                            ?>
                                <tr>
                                    <td><?= $data['nama']?></td>
                                    <?php foreach ($db->select('kriteria','kriteria')->get() as $td): ?>
                                        <td><?= number_format($db->rumus($data[$td['kriteria']],$td['kriteria']),2);?></td>
                                    <?php endforeach ?>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="display: none;">
                <h3>Proses Penentuan</h3>
                <div class="table-responsive">
                    <table id="example3" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama </th>
                                <th>Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($db->select('santri.id_santri,santri.nama,nilai.*','santri,nilai')->where('santri.id_santri=nilai.id_santri')->get() as $data):
                            ?>
                                <tr>
                                    <td><?= $data['nama']?></td>
                                    <td>
                                    <?php 
                                        $hasil = [];
                                        $bulan = date('m'); 
                                        $tahun = date('Y'); 
                                        $tanggal = date('Y-m-d');

                                        $minggu = $db->weekOfMonth($tanggal);

                                        foreach($db->select('kriteria','kriteria')->get() as $dt){
                                            array_push($hasil,$db->rumus($data[$dt['kriteria']],$dt['kriteria'])*$db->bobot($dt['kriteria']));
                                        }
                                        echo $h = number_format(array_sum($hasil),2);
                                        if($db->select('id_santri','hasil_spk')->where("id_santri='$data[id_santri]' and minggu='$minggu' and bulan='$bulan' and tahun='$tahun'")->count() == 0){
                                            $db->insert('hasil_spk',"'','$data[id_santri]','$h','$minggu','$bulan','$tahun'")->count();
                                        } else {
                                            $db->update('hasil_spk',"hasil_spk='$h',minggu='$minggu',bulan='$bulan',tahun='$tahun'")->where("id_santri='$data[id_santri]' and minggu='$minggu' and bulan='$bulan' and tahun='$tahun'")->count();
                                        }
                                        
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <h3>Perankingan</h3>
                <div class="table-responsive">
                    <table id="example4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Hasil </th>
                                <?php $no = 1; foreach ($db->select('kriteria','kriteria')->get() as $th): ?>
                                <th>K<?= $no?></th>
                                <?php $no++; endforeach ?>
                                <th rowspan="2" style="padding-bottom:25px">Hasil</th>
                                <th rowspan="2" style="padding-bottom:25px">Ranking</th>
                            </tr>
                            <tr>
                                <th>Bobot </th>
                                <?php foreach ($db->select('bobot','kriteria')->get() as $th): ?>
                                <th><?= $th['bobot']?></th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $bulan = date('m'); 
                                $tahun = date('Y'); 
                                $tanggal = date('Y-m-d');

                                $minggu = $db->weekOfMonth($tanggal);
                                foreach ($db->select('distinct(santri.nama),nilai.*,hasil_spk.*','santri,nilai,hasil_spk')->where('santri.id_santri=nilai.id_santri and santri.id_santri=hasil_spk.id_santri and hasil_spk.minggu='.$minggu.' and hasil_spk.bulan='.$bulan.' and hasil_spk.tahun='.$tahun.'')->order_by('hasil_spk.hasil_spk','desc')->get() as $data):
                            ?>
                                <tr>
                                    <td><?= $data['nama']?></td>
                                    <?php foreach ($db->select('kriteria','kriteria')->get() as $td): ?>
                                    <td><?= number_format($db->rumus($data[$td['kriteria']],$td['kriteria']),2);?></td>
                                    <?php endforeach ?>
                                    <td>
                                    <?php 
                                        $hasil = [];
                                        foreach($db->select('kriteria','kriteria')->get() as $dt){
                                            array_push($hasil,$db->rumus($data[$dt['kriteria']],$dt['kriteria'])*$db->bobot($dt['kriteria']));
                                        }
                                        echo $r = number_format(array_sum($hasil),2);
                                    ?>
                                    </td>
                                    <td>
                                        <?= $no?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>    
            </div>
            
    </div>
</div>
    <!-- CONTENT-WRAPPER SECTION END-->
<?php include 'footer.php'; ?>
<script type="text/javascript">
    $(function(){
        // $("#proses").addClass('menu-top-active');
        // $.ajax({
        //     url:'truncate_tpa.php',
        //     success:function(data){
        //         //alert(data);
                    
        //     }
        // });
    });
    function tpl(){
        $("#proses_spk").show();    
    }
</script>
