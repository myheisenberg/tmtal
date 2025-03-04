<?php include 'ayar/kontrol.php'; ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Grafik | TMTAL</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>

<body>
<?php include 'ayar/hizliayar.php'; ?>
      <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span> Grafik
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
<?php


// Veritabanı bağlantısı için gerekli bilgiler
$servername = "localhost"; // sunucu adı
$username = "root"; // kullanıcı adı
$password = ""; // parola
$database = "tmtalonl_admindashboard"; // veritabanı adı

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
    <i class="fas fa-user"></i> <span><?php echo $isim; ?></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
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
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Grafik</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <div >
                                        <div >
                                            <h5>Trafik Analizi</h5>
                                        </div>
                                        <div  style="width: 1000px; height: 600px;">
                                        <canvas  id="linechart" ></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chartsjs/Chart.min.js"></script>
    <script src="assets/js/charts.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
