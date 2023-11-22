<?php
    session_start();
    error_reporting(0);
    if(empty($_SESSION['id'])){
        header('location:login.php');
    }
?>
<?php include 'header.php';?>
<?php include 'menu.php';?>

<div class="content-wrapper">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Beranda</h4>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-md-12">
                    <div class="alert alert-success">
                        Selamat Datang <?php echo $_SESSION['nama'] ?>!
                    </div>
                </div> -->
            </div>
            <section class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Sistem Pendukung Keputusan Santri Teladan Pondok Pesantren Al - Manshur</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <p class="card-text">
                                        Santri teladan, merupakan program yang rutin diadakan setiap tahunnya di Pondok Pesantren Al – Manshur. Program ini bertujuan untuk memberikan apresiasi kepada santri karena telah menjalankan tugasnya sebagai santri dengan mengikuti setiap kegiatan pondok dengan baik serta tertib dalam mematuhi peraturan pondok pesantren. Walaupun hanya dipilih satu santri teladan, program ini diharapkan bisa mendorong santri - santri yang lain untuk menjadi santri yang lebih baik lagi dan lebih memperhatikan peraturan yang ada.
                                        </p>
                                        <hr>
                                        <p class="card-text">
                                        Tahapan Pemilihan Santri Teladan
                                        </p>
                                        <ol type="1">
                                        <li>Memilih kandidat calon santri teladan berdasarkan kelengkapan presensi di kelas;</li>
                                        <li>Mengamati keseharian para kandidat dan memberikan penilaian berdasarkan kriteria yang telah ditentukan, yaitu penilaian ustadz di kelas, penilaian budi pekerti, kedisiplinan dalam menaati peraturan dan seluruh kegiatan pondok serta pelanggaran;</li>
                                        <li>Melakukan rapat evaluasi guna menetapkan santri terbaik di antara para kandidat untuk dinobatkan sebagai santri teladan;</li>
                                        <li>Melakukan pengumuman dan pemberian hadiah serta piagam kepada santri teladan yang terpilih.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

            </div>
                <!-- /.row -->
            
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
</div>
<?php include 'footer.php'; ?>
