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

// SQL sorgusunu hazırlama
$stmt = $conn->prepare($sql);

// SQL sorgusunu çalıştırma
$stmt->execute();

// Sonucu alma
$result = $stmt->get_result();

// Oturum bilgilerinden token değerini al
$token = $_SESSION['token'];

// Veritabanından token değerini kullanarak ilgili admin kaydını sorgulama
$sql = "SELECT kullanici FROM admin WHERE token=?";

// SQL sorgusunu hazırlama
$stmt = $conn->prepare($sql);

// Parametreleri bağlama
$stmt->bind_param("s", $token);

// SQL sorgusunu çalıştırma
$stmt->execute();

// Sonucu alma
$result = $stmt->get_result();

// Sonucu kontrol etme ve admin kullanıcı adını alıp oturum değişkenine atama
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $isim = $row['kullanici'];
} else {
    $isim = "Kullanıcı Adı Yok";
}

// Bağlantıyı kapatma
$stmt->close();
$conn->close();

?>