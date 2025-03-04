<?php
header('Content-Type: text/html; charset=utf-8');
include 'ayar/kontrol.php';
include 'ayar/kullanici_adi.php';


require_once 'ayar/db/db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8"); // UTF-8 karakter setini belirtiyoruz

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if (!isset($_SESSION['token']) || !isset($_SESSION['tarih'])) {
    header("Location: ../login.php");
    exit;
}

$token = $_SESSION['token'];

$sql = "SELECT tarih FROM admin WHERE token='$token'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $oturumTarihi = strtotime($row['tarih']);
    $suankiTarih = time();

    $gecenSure = $suankiTarih - $oturumTarihi;

    if ($gecenSure > 1800) {
        session_unset();
        session_destroy();
        header("Location: ../login.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ogrenci_ekle'])) {
        $isimx = $_POST['ogrenci_isim'];
        $soyisim = $_POST['ogrenci_soyisim'];
        $ogrenciNo = $_POST['ogrenci_no'];
        $sinif = $_POST['ogrenci_sinif'];
        $kartID = $_POST['ogrenci_kart_id'];

        // Öğrenci veritabanına ekleme sorgusu
        $sql = "INSERT INTO ogrenciler (adi, soyadi, numara, sinifi, ogrencikartid) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $isimx, $soyisim, $ogrenciNo, $sinif, $kartID);

        if ($stmt->execute()) {
            $success_message = "Öğrenci başarıyla eklendi.";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } elseif (isset($_POST['ogretmen_ekle'])) {
        $isimx = $_POST['ogretmen_isim'];
        $soyisim = $_POST['ogretmen_soyisim'];
        $kartID = $_POST['ogretmen_kart_id'];

        // Öğretmen veritabanına ekleme sorgusu
        $sql = "INSERT INTO ogretmen (isim, soyisim, ogretmenkartid) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $isim, $soyisim, $kartID);

        if ($stmt->execute()) {
            $success_message1 = "Öğretmen başarıyla eklendi.";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Öğrenci Ekle | TMTAL</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">

    <style>
        #prevBtn,
        #nextBtn {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #prevBtn:hover,
        #nextBtn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'ayar/hizliayar.php'; ?>

    <div id="body" class="active">
        <!-- navbar navigation component -->
        <nav class="navbar navbar-expand-lg navbar-white bg-white">
            <button type="button" id="sidebarCollapse" class="btn btn-light">
                <i class="fas fa-bars"></i><span></span> Anasayfa
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ms-auto">

                    <li class="nav-item dropdown">
                        <div class="nav-dropdown">


                            <!-- HTML içinde kullanıcı adını gösterme -->
                            <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> <span><?php echo $isim; ?></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                <ul class="nav-list">

                                    <li><a href="../admin/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Öğrenci Ekleme Formu -->
        <div class="content">
            <div class="container">
                <div class="page-title">
                    <h3>Kayıt İşlemi</h3>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Öğrenci Kayıt</div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="ogrenci_isim" class="form-label">İsim</label>
                                    <input type="text" name="ogrenci_isim" placeholder="İsim" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ogrenci_soyisim" class="form-label">Soyisim</label>
                                    <input type="text" name="ogrenci_soyisim" placeholder="Soyisim" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ogrenci_no" class="form-label">Öğrenci Numarası</label>
                                    <input type="number" name="ogrenci_no" placeholder="Öğrenci Numarası" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ogrenci_sinif" class="form-label">Öğrenci Sınıfı</label>
                                    <input type="text" name="ogrenci_sinif" placeholder="Öğrenci Sınıfı" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ogrenci_kart_id" class="form-label">Kart ID</label>
                                    <input type="number" name="ogrenci_kart_id" placeholder="Kart ID" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" name="ogrenci_ekle" class="btn btn-primary" value="Öğrenci Ekle">
                                </div>
                            </form>
                                                <?php if(isset($success_message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Öğretmen Kayıt</div>
                        <div class="card-body">

                            <form method="POST">
                                <div class="mb-3">
                                    <label for="ogretmen_isim" class="form-label">İsim</label>
                                    <input type="text" name="isim" placeholder="İsim" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ogretmen_soyisim" class="form-label">Soyisim</label>
                                    <input type="text" name="ogretmen_soyisim" placeholder="Soyisim" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ogretmen_kart_id" class="form-label">Kart ID</label>
                                    <input type="number" name="ogretmen_kart_id" placeholder="Kart ID" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" name="ogretmen_ekle" class="btn btn-primary" value="Öğretmen Ekle">
                                </div>
                            </form>
                            <?php if(isset($success_message1)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message1; ?>
                        </div>
                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/form-validator.js"></script>
        <script src="assets/js/script.js"></script>
</body>

</html>
