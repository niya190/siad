<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Nota Dinas</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Source Sans Pro', sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0;
            /* Background Laut / Navy Resmi */
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            color: #333;
        }
        
        .login-box {
            position: relative;
            background-color: #ffffff; 
            width: 100%; 
            max-width: 400px; 
            padding: 40px 30px; 
            border-radius: 15px; 
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3); 
            text-align: center;
            overflow: hidden;
        }

        /* Hiasan Atas (Garis Biru) */
        .login-box::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            background: #007bff; /* Warna Khas Link/Biru Laut Terang */
        }

        .logo-container {
            margin-bottom: 20px;
        }

        .logo-circle {
            width: 80px; 
            height: 80px; 
            background: #e3f2fd; /* Biru Muda Pucat */
            color: #1e88e5; /* Biru Laut */
            border-radius: 50%;
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 2.5rem; 
            margin: 0 auto;
            border: 3px solid #bbdefb;
        }

        .app-title {
            margin: 15px 0 5px;
            color: #1c2331;
            font-weight: 700;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .app-subtitle {
            color: #78909c;
            font-size: 0.9rem;
            margin-bottom: 30px;
            font-weight: 400;
        }

        .form-group { 
            margin-bottom: 1.2rem; 
            text-align: left; 
            position: relative; 
        }

        .form-group input { 
            width: 100%; 
            padding: 12px 15px 12px 45px; 
            font-size: 1rem; 
            border: 1px solid #cfd8dc; 
            border-radius: 8px; 
            box-sizing: border-box; 
            transition: all 0.3s;
            background: #fcfcfc;
        }

        .form-group i { 
            position: absolute; 
            left: 15px; 
            top: 50%;
            transform: translateY(-50%);
            color: #90a4ae; 
        }

        .form-group input:focus { 
            border-color: #1e88e5; 
            outline: none; 
            background: #fff;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.1); 
        }

        .btn-login { 
            background: #1e88e5; 
            color: white; 
            padding: 12px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 1rem; 
            font-weight: 600; 
            width: 100%; 
            margin-top: 10px;
            transition: background 0.3s, transform 0.2s; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login:hover { 
            background: #1565c0; 
            transform: translateY(-2px); 
        }

        .error-message { 
            background-color: #ffcdd2; 
            color: #c62828; 
            padding: 10px; 
            border-radius: 6px; 
            margin-bottom: 20px; 
            font-size: 0.9rem;
            border-left: 4px solid #c62828;
            text-align: left;
        }

        .footer {
            margin-top: 25px;
            font-size: 0.8rem;
            color: #b0bec5;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <div class="logo-container">
            <div class="logo-circle">
                <i class="fas fa-anchor"></i>
            </div>
        </div>

        <h2 class="app-title">KANTOR NAVIGASI</h2>
        <p class="app-subtitle">Sistem Manajemen Nota Dinas Elektronik</p>
        
        <?php 
        $session = session();
        $error = $session->getFlashdata('error');
        if($error){
            echo '<div class="error-message"><i class="fas fa-exclamation-circle mr-2"></i> ' . esc($error) . '</div>';
        }
        ?>

        <form action="<?= base_url('/login') ?>" method="POST"> 
            <?= csrf_field(); ?>
            
            <div class="input-group mb-3">
    <input type="text" name="username" class="form-control" placeholder="Masukkan NIP / ID">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
        </div>
    </div>
</div>
            
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Kata Sandi" required>
            </div>
            
            <button type="submit" class="btn-login">
                MASUK APLIKASI <i class="fas fa-sign-in-alt ml-2"></i>
            </button>
        </form>
        
        <div class="footer">
            &copy; <?= date('Y') ?> Kantor Distrik Navigasi.<br>All rights reserved.
        </div>
    </div>

</body>
</html>