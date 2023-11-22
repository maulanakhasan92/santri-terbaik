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
			$pesan = "<div class='alert alert-success' id='message'>Penilaian berhasil ditambahkan.</div>";
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
            <br/>  
              <div class="panel panel-default">
                  <div class="panel-heading">
                    Form Penilaian
                  </div>
                  <div class="panel-body">
                      <form method="post" action="insert_tpa.php" enctype="multipart/form-data">
                          <?php if (!empty($_GET['error_msg'])): ?>
                              <div class="alert alert-danger">
                                  <?= $_GET['error_msg']; ?>
                              </div>
                          <?php endif ?>
                          <div class="form-group col-md-12">
                              <div class="alert alert-info">
                                  <i class="fa fa-info-circle"></i> Nama Yang Ditampilkan adalah nama Santri yang belum dinilai...
                              </div>
                              <label for="nama">Nama Santri</label>
                                  <select required class="form-control" name="id_santri">
                                  <?php  foreach ($db->select('*','santri')->where('id_santri not in (select id_santri from nilai)')->get() as $val): ?> 
                                  <option value="<?= $val['id_santri']?>"><?= $val['nama'] ?></option>
                                  <?php endforeach ?>
                                  </select>
                          </div>
                          
                          <?php foreach ($db->select('id_kriteria,kriteria','kriteria')->get() as $r): ?>
                          <div class="form-group col-md-3">
                              <label>
                                    <?php
                                        $tmp = explode('_',$r['kriteria']);
                                        echo ucwords(implode(' ',$tmp));
                                    ?>
                                </label>
                              <input required type="number" step="0.01" name="place[]" class="form-control">
                          </div>
                          <?php endforeach ?>
                          
                          <div class="form-group col-md-12">
                              <button class="btn btn-primary">Simpan</button>
                          </div>
                      </form>
                  </div>
              </div>
            </div>
        </div>
        <?=$pesan?>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
<script>
setTimeout(function() {
  document.getElementById("message").style.display = 'none';
}, 3000);
</script>