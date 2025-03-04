<?php include 'ayar/kontrol.php'; ?>
<?php include 'ayar/kullanici_adi.php'; ?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anasayfa | TMTAL</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">

    <style>
#prevBtn, #nextBtn {
    background-color: #007bff;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#prevBtn:hover, #nextBtn:hover {paneş
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
            <!-- end of navbar navigation -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 page-header">
                            <div class="page-pretitle">TMTAL</div>
                            <h2 class="page-title">ANASAYFA</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-3 mt-3">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-sign-in-alt"></i>
                                            </div>
                                        </div>
<?php

// Veritabanı bağlantısını dahil etme
require_once 'ayar/db/db_connectionv2.php';

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// Günlük giriş sayısını almak için SQL sorgusu
$sql = "SELECT COUNT(*) AS gunluk_giris_sayisi FROM ogrenciler WHERE DATE(okulagiristarihi) = CURDATE()";

// SQL sorgusunu hazırlama
$stmt = $conn->prepare($sql);

// SQL sorgusunu çalıştırma
$stmt->execute();

// Sonucu alma
$result = $stmt->get_result();

// Sonucu kontrol etme ve gösterme
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $gunluk_giris_sayisi = $row["gunluk_giris_sayisi"];
} else {
    $gunluk_giris_sayisi = 0;
}

// Bağlantıyı kapatma
$stmt->close();
$conn->close();

?>


<!-- HTML içinde günlük giriş sayısını gösterme -->
<div class="col-sm-8">
    <div class="detail">
        <p class="detail-subtitle"> GİRİŞ SAYISI</p>
        <span class="number"><?php echo $gunluk_giris_sayisi; ?></span>
    </div>
</div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="fas fa-crown"></i> Günlük Toplam Öğrenci Giriş Sayısını Gösterir
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 mt-3">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-sign-out-alt"></i>
                                            </div>
                                        </div>
<?php
// Veritabanı bağlantısını dahil etme
require_once 'ayar/db/db_connectionv2.php';

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// Günlük çıkış sayısını almak için SQL sorgusu
$sql = "SELECT COUNT(*) AS gunluk_cikis_sayisi FROM ogrenciler WHERE DATE(okulacikistarihi) = CURDATE()";

// SQL sorgusunu çalıştırma
$result = $conn->query($sql);

// Sonucu kontrol etme ve gösterme
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $gunluk_cikis_sayisi = $row["gunluk_cikis_sayisi"];
} else {
    $gunluk_cikis_sayisi = 0;
}

// Bağlantıyı kapatma
$conn->close();
?>

<!-- HTML içinde günlük çıkış sayısını gösterme -->
<div class="col-sm-8">
    <div class="detail">
        <p class="detail-subtitle"> ÇIKIŞ SAYISI</p>
        <span class="number"><?php echo $gunluk_cikis_sayisi; ?></span>
    </div>
</div>

                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="fas fa-crown"></i> Günlük Toplam Öğrenci Çıkış Sayısını Gösterir
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 mt-3">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-user-shield"></i>
                                            </div>
                                        </div>
<?php
// Veritabanı bağlantısını dahil etme
require_once 'ayar/db/db_connectionv2.php';

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// Admin sayısını almak için SQL sorgusu
$sql = "SELECT COUNT(*) AS admin_sayisi FROM admin WHERE admin = 1";

// SQL sorgusunu çalıştırma
$result = $conn->query($sql);

// Sonucu kontrol etme ve gösterme
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $admin_sayisi = $row["admin_sayisi"];
} else {
    $admin_sayisi = 0;
}

// Bağlantıyı kapatma
$conn->close();
?>

<!-- HTML içinde admin sayısını gösterme -->
<div class="col-sm-8">
    <div class="detail">
        <p class="detail-subtitle">Admin Sayısı</p>
        <span class="number"><?php echo $admin_sayisi; ?></span>
    </div>
</div>

                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="fas fa-crown"></i> Admin Sayısını Gösterir.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 mt-3">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
<?php
// Veritabanı bağlantısını dahil etme
require_once 'ayar/db/db_connectionv2.php';

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// Öğretmen sayısını almak için SQL sorgusu
$sql = "SELECT COUNT(*) as ogretmen_sayisi FROM admin WHERE ogretmenyetki = 1";

// SQL sorgusunu çalıştırma
$result = $conn->query($sql);

// Sonucu kontrol etme ve öğretmen sayısını alıp değişkene atama
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ogretmenSayisi = $row['ogretmen_sayisi'];
} else {
    $ogretmenSayisi = 0;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

<!-- HTML içinde öğretmen sayısını gösterme -->
<div class="col-sm-8">
    <div class="detail">
        <p class="detail-subtitle">ÖĞRETMEN SAYISI</p>
        <span class="number"><?php echo $ogretmenSayisi; ?></span>
    </div>
</div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="fas fa-crown"></i> Öğretmen Sayısını Gösterir.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="content">
                <div class="head">
                    <h5 class="mb-0">TMTAL ÖĞRENCİ GİRİŞ BİLGİLERİ</h5>
                    <p class="text-muted">Öğrencilerin en son ne zaman okula giriş yaptığını gösterir.</p>
                </div>
                <div class="canvas-wrapper">
                    <table id="enterTable" class="table table-striped">
                        <thead class="success">
                            <tr>
                                <th>Öğrenci Adı Soyadı Numara</th>
                                <th class="text-end">Okula Giriş Tarihi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="text-center">
                        <button id="prevEnterBtn" class="btn btn-primary me-2">Geri</button>
                        <button id="nextEnterBtn" class="btn btn-primary">İleri</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="content">
                <div class="head">
                    <h5 class="mb-0">TMTAL ÖĞRENCİ ÇIKIŞ BİLGİLERİ</h5>
                    <p class="text-muted">Öğrencilerin en son ne zaman okulda çıkış yaptığını gösterir.</p>
                </div>
                <div class="canvas-wrapper">
                    <table id="exitTable" class="table table-striped">
                        <thead class="success">
                            <tr>
                                <th>Öğrenci Adı Soyadı Numara</th>
                                <th class="text-end">Okuldan Çıkış Tarihi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="text-center mt-3">
                        <button id="prevExitBtn" class="btn btn-primary me-2">Geri</button>
                        <button id="nextExitBtn" class="btn btn-primary">İleri</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var enterOffset = 0;
var enterLimit = 10; // Her seferinde 10 öğrenci göster

// Öğrenci giriş bilgilerini güncelleme fonksiyonu
function updateEnterStudentInfo() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "apis/gun_icinde_giren_ogrenciler.php?offset=" + enterOffset + "&limit=" + enterLimit, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector("#enterTable tbody").innerHTML = xhr.responseText;
            // Geri butonunu gösterme veya gizleme kontrolü
            document.getElementById("prevEnterBtn").style.display = (enterOffset - enterLimit >= 0) ? "inline-block" : "none";
        }
    };
    xhr.send();
}

document.getElementById("prevEnterBtn").addEventListener("click", function() {
    if (enterOffset - enterLimit >= 0) {
        enterOffset -= enterLimit;
        updateEnterStudentInfo();
    }
});

document.getElementById("nextEnterBtn").addEventListener("click", function() {
    enterOffset += enterLimit;
    updateEnterStudentInfo();
});

// Öğrenci çıkış bilgilerini güncelleme fonksiyonu
var exitOffset = 0;
var exitLimit = 10; // Her seferinde 10 öğrenci göster

function updateExitStudentInfo() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "apis/gun_icinde_cikan_ogrenciler.php?offset=" + exitOffset + "&limit=" + exitLimit, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector("#exitTable tbody").innerHTML = xhr.responseText;
            // Geri butonunu gösterme veya gizleme kontrolü
            document.getElementById("prevExitBtn").style.display = (exitOffset - exitLimit >= 0) ? "inline-block" : "none";
        }
    };
    xhr.send();
}

document.getElementById("prevExitBtn").addEventListener("click", function() {
    if (exitOffset - exitLimit >= 0) {
        exitOffset -= exitLimit;
        updateExitStudentInfo();
    }
});

document.getElementById("nextExitBtn").addEventListener("click", function() {
    exitOffset += exitLimit;
    updateExitStudentInfo();
});

// Sayfa yüklendiğinde öğrenci bilgilerini gösterme
document.addEventListener("DOMContentLoaded", function() {
    updateEnterStudentInfo();
    updateExitStudentInfo();
});
</script>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chartsjs/Chart.min.js"></script>
    <script src="assets/js/dashboard-charts.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
