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

// Oturum bilgilerinden token değerini al
session_start();
$token = $_SESSION['token'];

// Veritabanından token değerini kullanarak ilgili admin kaydını sorgulama
$sql = "SELECT kullanici FROM admin WHERE token='$token'";

// SQL sorgusunu çalıştırma
$result = $conn->query($sql);

// Sonucu kontrol etme ve admin kullanıcı adını alıp oturum değişkenine atama
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $kullaniciAdi = $row['kullanici'];
} else {
    $kullaniciAdi = "Kullanıcı Adı Yok";
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kullanıcılar | TMTAL</title>
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
                    <i class="fas fa-bars"></i><span></span> Kullanıcılar
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span><?php echo $kullaniciAdi; ?></span> <i
                                        style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>
                                                Çıkış Yap</a></li>
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
                        <h3>Kullanıcılar
                        </h3>
                    </div>
                    <?php
                    // Veritabanı bağlantısı
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "tmtalonl_admindashboard";

                    // Veritabanı bağlantısını oluştur
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Bağlantıyı kontrol et
                    if ($conn->connect_error) {
                        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
                    }

                    // Token değerini session'dan al
                    session_start();
                    $token = $_SESSION['token']; // Bu kısmı doğru şekilde ayarlamalısınız.

                    // Token değerini kullanarak tüm admin kullanıcılarını sorgula
                    $sql = "SELECT kullanici, admin, ogretmenyetki FROM admin";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // En az bir admin bulundu
                        echo '
                        <div class="box box-primary">
                            <div class="box-body">
                                <table width="100%" class="table table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Kullanıcı Adı</th>
                                            <th>Yetki</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                        // Tüm admin kullanıcılarını listele
                        while ($row = $result->fetch_assoc()) {
                            $kullaniciadi = $row["kullanici"];
                            $adminYetki = $row["admin"];
                            $ogretmenYetki = $row["ogretmenyetki"];

                            // Yetki durumuna göre metni belirle
                            if ($adminYetki == 1 && $ogretmenYetki == 1) {
                                $yetkiDurumu = "Tam Yetki";
                            } elseif ($adminYetki == 1 && $ogretmenYetki == 0) {
                                $yetkiDurumu = "Admin";
                            } elseif ($adminYetki == 0 && $ogretmenYetki == 1) {
                                $yetkiDurumu = "Öğretmen";
                            } else {
                                $yetkiDurumu = "Yetkisiz";
                            }

                            // Kullanıcıyı tabloya ekle
                            echo '
                                    <tr>
                                        <td>' . $kullaniciadi . '</td>
                                        <td>' . $yetkiDurumu . '</td>
                                        <td class="text-end">
                                            <a href="permissions.php?kullanici='.$kullaniciadi.'" class="btn btn-sm btn-outline-primary float-end"><i class="fas fa-user-shield"></i> Yetki</a>
                                        </td>
                                    </tr>';
                        }

                        echo '
                                    </tbody>
                                </table>
                            </div>
                        </div>';
                    } else {
                        echo "Kullanıcı bulunamadı!";
                    }
                    $conn->close();
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
