<?php
// Oturumu başlat
session_start();

// Veritabanı bağlantısı
$servername = "localhost";
$username = "tmtalonl_admindashboard";
$password = "Tmtal123!";
$dbname = "tmtalonl_admindashboard";

// Veritabanı bağlantısı oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Kullanıcının token değerini al
if(isset($_SESSION['token'])) {
    $token = $_SESSION['token'];

    // Token değerini kullanarak ilgili admin kaydının sadece token alanını temizleme
    $sql = "UPDATE admin SET token = NULL WHERE token='$token'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../login.php?action=logout");
    } else {
        echo "Oturum sonlandırılırken bir hata oluştu: " . $conn->error;
    }
} else {
    echo "Token bulunamadı.";
}

// Bağlantıyı kapatma
$conn->close();
exit;
?>
