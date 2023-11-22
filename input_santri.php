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
			$pesan = "<div class='alert alert-success' id='message'>Data Kandidat berhasil ditambahkan.</div>";
            // header('refresh: 1.5; url=login.php');
		}
	}
	?>
<?php include 'header.php';?>
<?php include 'menu.php';?>
<div class="content-wrapper">
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <br/>  
              <div class="panel panel-default">
                  <div class="panel-heading">
                  Form Kandidat Santri Teladan
                  </div>
                  <div class="panel-body">
                      <form method="post" action="insert_santri.php" enctype="multipart/form-data">
                          <?php if (!empty($_GET['error_msg'])): ?>
                              <div class="alert alert-danger">
                                  <?= $_GET['error_msg']; ?>
                              </div>
                          <?php endif ?>
                          <div class="form-group">
                              <label for="nama">Nama</label>
                              <input type="text" required rows="2" class="form-control" id="nama" name="nama">
                          </div>
                          <div class="form-group">
                              <label for="nama">Kelas</label>
                                <select required rows="2" class="form-control" id="kelas" name="kelas">
                                <option value="">PILIH KELAS</option>
                                <option value="Persiapan">Persiapan</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                </select>
                          </div>
                          <div class="form-group">
                              <button class="btn btn-primary">Simpan</button>
                          </div>
                      </form>
                      <div><?=$pesan?></div>
                  </div>
              </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>
<?php include 'footer.php';?>
<script>
setTimeout(function() {
  document.getElementById("message").style.display = 'none';
}, 3000);
</script>