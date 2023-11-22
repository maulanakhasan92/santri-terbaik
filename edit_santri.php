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
                    Form Edit Data Santri
                  </div>
                  <div class="panel-body">
                      <form method="post" action="update_santri.php" enctype="multipart/form-data">
                          <?php if (!empty($_GET['error_msg'])): ?>
                              <div class="alert alert-danger">
                                  <?= $_GET['error_msg']; ?>
                              </div>
                          <?php endif ?>
                          <?php foreach ($db->select('*','santri')->where('id_santri='.$_GET['id'])->get() as $data): ?>
                              <input type="hidden" name="id" value="<?= $data[0]?>">
                              <div class="form-group">
                                  <label for="nama">Nama</label>
                                  <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']?>">
                              </div>
                              <div class="form-group">
                              <label for="nama">Kelas</label>
                                <select required rows="2" class="form-control" id="kelas" name="kelas">
                                <option value="">PILIH KELAS</option>
                                <option <?php if( $data['kelas']=='Persiapan'){echo "selected"; } ?> value="Persiapan">Persiapan</option>
                                <option <?php if( $data['kelas']=='1'){echo "selected"; } ?> value="1">1</option>
                                <option <?php if( $data['kelas']=='2'){echo "selected"; } ?> value="2">2</option>
                                </select>
                              </div>
                          <?php endforeach ?>
                          
                          <div class="form-group">
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