<?php

header('Content-Type: text/html; charset=utf-8');

// Oturum başlatma
session_start();

// Veritabanı bağlantısı
$servername = "localhost"; // Sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı parolası
$dbname = "tmtalonl_admindashboard"; // Veritabanı adı

// Bağlantı oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Eğer token değeri yoksa veya tarih değeri yoksa
if (!isset($_SESSION['token']) || !isset($_SESSION['tarih'])) {
    // dashboard/admin/index.php'ye yönlendirme
    header("Location: index.html");
    exit;
}

// Kullanıcının tokenini al
$token = $_SESSION['token'];

// Veritabanından kullanıcının oturum tarihini al
$stmt = $conn->prepare("SELECT tarih FROM admin WHERE token=?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $oturumTarihi = strtotime($row['tarih']);
    $suankiTarih = time();

    // Oturumun açıldığı tarih ile şu anki tarih arasındaki farkı kontrol et
    $gecenSure = $suankiTarih - $oturumTarihi;

    if ($gecenSure > 1800) {
        // Oturumu sonlandır
        session_unset();
        session_destroy();
        // dashboard/admin/index.php'ye yönlendirme
        header("Location: index.html");
        exit;
    }
} else {
    // Oturum bulunamadı, giriş sayfasına yönlendirme
    header("Location: index.html");
    exit;
}

// Bağlantıyı kapatma
$conn->close();

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root"; // MySQL kullanıcı adı
$password = ""; // MySQL şifre
$database = "tmtalonl_admindashboard"; // Kullanmak istediğiniz veritabanı adı

// MySQL bağlantısı oluşturma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanı bağlantısında hata oluştu: " . $conn->connect_error);
}

// Bağlantı karakter setini UTF-8 olarak ayarlama
$conn->set_charset("utf8");

// Bugünün tarihini al
$bugununTarihi = date("Y-m-d");

// Öğrenci bilgilerini çekme, bugünün tarihine sahip olanları seçme
$offset = $_GET["offset"];
$limit = $_GET["limit"];
$stmt = $conn->prepare("SELECT adi, soyadi, numara, okulacikistarihi FROM ogrenciler WHERE DATE(okulacikistarihi) = ? LIMIT ?, ?");
$stmt->bind_param("sii", $bugununTarihi, $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Sorgudan dönen verileri tabloya ekleme
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><i class='flag-icon flag-icon-tr'></i> " . $row["adi"] . " " . $row["soyadi"] . " " . $row["numara"] . "</td>";
        echo "<td class='text-end'>" . $row["okulacikistarihi"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<style>#nextExitBtn { display: none; }</style>";
    echo "<tr><td colspan='2'>Bugün okuldan çıkış yapan öğrenci bulunamadı.</td></tr>";
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
