<?php
    session_start();
    error_reporting(0);
    if(empty($_SESSION['id'])){
        header('location:login.php?error_login=1');
    }
?>
<?php
$pesan ="";
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="ok"){
			$pesan = "<div class='alert alert-success' id='message'>Data berhasil diperbarui.</div>";
            // header('refresh: 1.5; url=login.php');
		}
	}
	?>
<?php include 'header.php';?>
<?php include 'menu.php';?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Penilaian Santri</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (!empty($_GET['error_msg'])): ?>
                      <div class="alert alert-danger">
                          <?= $_GET['error_msg']; ?>
                      </div>
                    <?php endif ?>
                </div>
            </div>  
            <div class="row">
                <div><a href="input_tpa.php" class="btn btn-info">Tambah Data</a></div>
                <br>
                <div><?=$pesan?></div>
                <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <?php foreach ($db->select('kriteria','kriteria')->get() as $kr ): ?>
                                <th>
                                    <?php
                                        $tmp = explode('_',$kr['kriteria']);
                                        echo ucwords(implode(' ',$tmp));
                                    ?>
                                </th>
                                <?php endforeach ?>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($db->select('santri.id_santri,santri.nama,nilai.*','santri,nilai')->where('santri.id_santri=nilai.id_santri')->get() as $data): ?>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?= $data['nama']?></td>
                                <?php foreach ($db->select('kriteria','kriteria')->get() as $kr ): ?>
                                <td><?= $data[$kr['kriteria']]?></td>
                                <?php endforeach ?>
                                <td>
                                    <a class="btn btn-warning" href="edit_tpa.php?id=<?php echo $data[0]?>">Edit</a>
                                    <a class="btn btn-danger" onclick="return confirm('Yakin Hapus?')" href="delete_tpa.php?id=<?php echo $data[0]?>">Hapus</a>
                                </td>
                            </tr>
                            <?php $no++; endforeach; ?>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->

<?php include 'footer.php'; ?>
<script>
setTimeout(function() {
  document.getElementById("message").style.display = 'none';
}, 3000);
</script>