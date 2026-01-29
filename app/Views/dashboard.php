<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EDUSYS FTTK</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        .container { max-width: 1000px; margin: 0 auto; background: #fff; border: 1px solid #ccc; padding: 1.5rem; border-radius: 8px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 1rem; }
        .logout-btn { background: #dc3545; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="header">
            <h2>Selamat Datang di EDUSYS FTTK</h2>
            <a href="<?= base_url('/logout') ?>" class="logout-btn">Logout</a>
        </div>
        
        <h1>Halaman Dashboard</h1>
        <p>Anda telah berhasil login.</p>
        
        <?php 
            // $session = session();
            // echo "Username: " . $session->get('nama_user');
            // echo "<br>";
            // echo "Role: " . $session->get('role');
        ?>
    </div>

</body>
</html>