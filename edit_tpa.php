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
            <br/>  
              <div class="panel panel-default">
                  <div class="panel-heading">
                    Form Kriteria
                  </div>
                  <div class="panel-body">
                      <form method="post" action="update_tpa.php">
                          <?php if (!empty($_GET['error_msg'])): ?>
                              <div class="alert alert-danger">
                                  <?= $_GET['error_msg']; ?>
                              </div>
                          <?php endif ?>
                          <?php foreach ($db->select('nilai.*,santri.id_santri,santri.nama','nilai,santri')->where('nilai.id_santri=santri.id_santri and nilai.id_santri='.$_GET['id'])->get() as $data): ?>
                          	  <input type="hidden" name="id" value="<?= $data['id_santri']?>">
                                <div class="form-group col-md-12">
                                  <label for="nama">Nama</label>
                                  <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']?>" readonly>
                              </div>
                              <?php foreach ($db->select('id_kriteria,kriteria','kriteria')->get() as $r): ?>
	                          <div class="form-group col-md-2">
	                              <label><?= $r['kriteria']?></label>
                                <input required type="number" step="0.01" name="kriteria[]" class="form-control" value="<?= $data[$r['kriteria']]?>">
	                          </div>
	                          <?php endforeach ?>
                          <?php endforeach ?>
                          
                          <div class="form-group col-md-12">
                              <button class="btn btn-primary">Simpan</button>
                          </div>
                      </form>
                  </div>
              </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>