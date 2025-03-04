<?php
    // Veritabanı bağlantısı
    $servername = "localhost"; // Sunucu adı
    $username = "root"; // XAMPP varsayılan kullanıcı adı
    $password = ""; // XAMPP varsayılan şifre (boş)
    $dbname = "tmtalonl_admindashboard"; // Veritabanı adı

    // Bağlantı oluşturma
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantıyı kontrol etme
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }
    } catch (Exception $e) {
        die("Bağlantı hatası: " . $e->getMessage());
    }

    // Kullanıcı adı ve parola alınması
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Kullanıcı adı ve parola ile veritabanında arama yapma
        $stmt = $conn->prepare("SELECT * FROM admin WHERE kullanici=? AND sifre=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Eğer eşleşen bir sonuç varsa
        if ($result->num_rows > 0) {
            // Otomatik token oluşturma
            $token = bin2hex(random_bytes(16));
            // GMT+03:00 saat dilimindeki tarih
            $tarih = gmdate('Y-m-d H:i:s', strtotime('+3 hours'));

            // Veritabanında token değerini güncelleme
            $update_stmt = $conn->prepare("UPDATE admin SET token=?, tarih=? WHERE kullanici=?");
            $update_stmt->bind_param("sss", $token, $tarih, $username);
            if ($update_stmt->execute() === TRUE) {
                session_start();
                // Oturum verilerini ayarla
                $_SESSION['token'] = $token;
                $_SESSION['tarih'] = $tarih;

                // Giriş başarılı, yönlendirme
                header("Location: ../admin/dashboard.php");
                exit; // exit ekleyerek diğer işlemlerin çalışmasını engelliyoruz
            } else {
                $errorMessage = "Giriş başarısız!";
            }
        } else {
            $errorMessage = "Kullanıcı adı veya parola hatalı!";
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Giriş | TMTAL</title>
    <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/assets/css/auth.css" rel="stylesheet">
    <!-- Font Awesome kütüphanesi -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <img class="brand" src="assets/img/bootstraper-logo.png" alt="bootstraper logo">
                    </div>
                    <h6 class="mb-4 text-muted">Hesabınıza Giriş Yapın</h6>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3 text-start">
                            <label for="username" class="form-label">Kullanıcı Adı</label>
                            <input type="text" name="username" class="form-control" placeholder="Kullanıcı Adı" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Parola</label>
                            <input type="password" name="password" class="form-control" placeholder="Parola" required>
                        </div>

                        <button type="submit" class="btn btn-primary shadow-2 mb-4">Giriş</button>
                                          <?php
                        if(isset($errorMessage)) {
                            echo '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> '.$errorMessage.'</div>';
                        }
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
