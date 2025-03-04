<?php
// Oturum başlatma
session_start();

// Veritabanı bağlantısını dahil etme
require_once 'db/db_connection.php';

// Eğer token değeri yoksa veya tarih değeri yoksa
if (!isset($_SESSION['token']) || !isset($_SESSION['tarih'])) {
    // dashboard/admin/index.php'ye yönlendirme
    header("Location: ../login.php");
    exit;
}

// Kullanıcının tokenini al
$token = $_SESSION['token'];

// Veritabanından kullanıcının oturum tarihini al
$sql = "SELECT tarih FROM admin WHERE token='$token'";
$result = $conn->query($sql);

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
        header("Location: ../login.php");
        exit;
    }
} else {
    // Oturum bulunamadı, giriş sayfasına yönlendirme
    header("Location: ../login.php");
    exit;
}

// Bağlantıyı kapatma
$conn->close();
?>