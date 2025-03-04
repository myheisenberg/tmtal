<?php include 'ayar/kontrol.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Öğrenciler | TMTAL</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>

<body>
<?php include 'ayar/hizliayar.php'; ?>
      <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span> Öğrenciler
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
<?php


// Veritabanı bağlantısını dahil etme
require_once 'ayar/db/db_connectionv2.php';

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// Kullanıcı adını almak için SQL sorgusu
$sql = "SELECT kullanici FROM admin";

// SQL sorgusunu çalıştırma
$result = $conn->query($sql);

// Oturum bilgilerinden token değerini al
$token = $_SESSION['token'];

// Veritabanından token değerini kullanarak ilgili admin kaydını sorgulama
$sql = "SELECT kullanici FROM admin WHERE token='$token'";

// SQL sorgusunu çalıştırma
$result = $conn->query($sql);

// Sonucu kontrol etme ve admin kullanıcı adını alıp oturum değişkenine atama
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $isim = $row['kullanici'];
} else {
    $isim = "Kullanıcı Adı Yok";
}

// Bağlantıyı kapatma
$conn->close();
?>

<!-- HTML içinde kullanıcı adını gösterme -->
<a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
    <?php ob_start(); ?><i class="fas fa-user"></i> <span><?php echo $isim; ?></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
</a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                       
                    
                                        <li><a href="../admin/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
<?php
header('Content-Type: text/html; charset=utf-8');

// Veritabanı bağlantısını dahil etme
require_once 'ayar/db/db_connection.php';

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// Veritabanı karakter setini UTF-8 olarak ayarlama
$conn->set_charset("utf8");

// Öğrencileri seçmek için SQL sorgusu
$sql = "SELECT id, numara, CONCAT(adi, ' ', soyadi) AS isim, sinifi, okulagiristarihi, okulacikistarihi, ogrencikartid FROM ogrenciler";

// SQL sorgusunu hazırlama
$stmt = $conn->prepare($sql);

// SQL sorgusunu çalıştırma
$stmt->execute();

// Sonucu alma
$result = $stmt->get_result();

?>

<div class="content">
    <div class="container">
        <div class="page-title">
            <h3>Öğrenciler</h3>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">Öğrenciler</div>
                    <div class="card-body">
                        <p class="card-title"></p>
                        <table class="table table-hover" id="dataTables-example" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>İsim</th>
                                    <th>Numara</th>
                                    <th>Sınıf</th>
                                    <th>Okula Giriş Tarihi</th>
                                    <th>Okuldan Çıkış Tarihi</th>
                                    <th>Öğrenci Kart ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['isim']; ?></td>
                                    <td><?php echo $row['numara']; ?></td>
                                    <td><?php echo $row['sinifi']; ?></td>
                                    <td><?php echo $row['okulagiristarihi']; ?></td>
                                    <td><?php echo $row['okulacikistarihi']; ?></td>
                                    <td><?php echo $row['ogrencikartid']; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

// Bağlantıyı kapatma
$stmt->close();
$conn->close();

?>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>