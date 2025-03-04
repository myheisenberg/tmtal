<?php include 'ayar/kontrol.php'; ?>
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

// Kullanıcının formu gönderip göndermediğini kontrol etme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $adminYetki = isset($_POST['adminYetki']) ? 1 : 0; // Eğer checkbox işaretliyse 1, değilse 0
    $ogretmenYetki = isset($_POST['ogretmenYetki']) ? 1 : 0; // Eğer checkbox işaretliyse 1, değilse 0

    // Kullanıcı adını al
    $kullaniciAdi = $_POST['kullaniciAdi'];

    // Veritabanında admin veya ogretmenyetkiyi güncelleme
    $sql = "UPDATE admin SET admin = ?, ogretmenyetki = ? WHERE kullanici = ?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Bind parameters
    $stmt->bind_param("iis", $adminYetki, $ogretmenYetki, $kullaniciAdi);
    // Execute statement
    if ($stmt->execute()) {
        $success_message = "Yetkiler başarıyla güncellendi.";
    } else {
        $error_message = "Hata: " . $sql . "<br>" . $conn->error;
    }
}

// Veritabanından kullanıcının yetkilerini çekme
$kullaniciAdi = $_GET['kullanici']; // URL'den kullanıcı adını al
$sql = "SELECT admin, ogretmenyetki FROM admin WHERE kullanici = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $kullaniciAdi);
$stmt->execute();
$result = $stmt->get_result();

// Kullanıcının yetkilerini tutacak değişkenler
$adminYetki = 0;
$ogretmenYetki = 0;

// Sonucu kontrol etme ve yetkileri değişkenlere atama
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $adminYetki = $row['admin'];
    $ogretmenYetki = $row['ogretmenyetki'];
}

// Veritabanı bağlantısını kapat
$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Permissions | Bootstrap Simple Admin Template</title>
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
            <i class="fas fa-bars"></i><span></span>
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
                        $sql = "SELECT kullanici FROM admin WHERE token=?";

                        // Prepare statement
                        $stmt = $conn->prepare($sql);
                        // Bind parameter
                        $stmt->bind_param("s", $token);
                        // Execute statement
                        $stmt->execute();
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

                        <!-- HTML içinde kullanıcı adını gösterme -->
                        <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <span><?php echo $isim; ?></span> <i
                                    style="font-size: .8em;" class="fas fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                            <ul class="nav-list">


                                <li><a href="" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Çıkış
                                        Yap</a></li>
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
            <div class="page-title">
                <h3>YETKI DÜZENLEME
                    <a href="users.php" class="btn btn-sm btn-outline-info float-end"><i class="fas fa-angle-left"></i>
                        <span class="btn-header">Geri Dön</span></a>
                </h3>
            </div>
            <div class="box box-primary">
                <div class="box-body">
                    <form method="post" accept-charset="utf-8">
                        <div class="mb-3">
                            <label for="email" class="form-label text-uppercase"><small>Yetkiler</small></label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="adminYetki" name="adminYetki" <?php echo $adminYetki == 1 ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="adminYetki">Admin Yetki</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="ogretmenYetki" name="ogretmenYetki" <?php echo $ogretmenYetki == 1 ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="ogretmenYetki">Öğretmen Yetki</label>
                            </div>
                        </div>
                        <input type="hidden" name="kullaniciAdi" value="<?php echo $_GET['kullanici']; ?>">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Kaydet</button>
                            <a href="users.php" class="btn btn-secondary"><i class="fas fa-times"></i> Vazgeç</a>
                        </div>
                    </form>
                    <?php if(isset($success_message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>
