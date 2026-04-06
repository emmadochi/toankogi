<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>

        :root {
            --glass-bg: rgba(255, 255, 255, 0.8);
        }
        body.login-page {
            background: radial-gradient(circle at top left, #059669 0%, #0f172a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
            animation: slideUp 0.6s ease-out;
        }
        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        .login-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 18px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .login-logo img {
            width: 60px;
            height: auto;
            border-radius: 8px;
        }
        .login-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        .login-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--dark);
        }
        .form-control {
            width: 100%;
            padding: 1rem 1.2rem;
            background: rgba(15, 23, 42, 0.03);
            border: 1.5px solid var(--glass-border);
            border-radius: 14px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
            outline: none;
        }
        .form-control:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
        }
        .btn-login {
            width: 100%;
            padding: 1.1rem;
            background: var(--dark);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
        }
        .btn-login:hover {
            background: var(--dark-alt);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.2);
        }
        .login-footer {
            margin-top: 2rem;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
        }
        .login-footer a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="login-page">

    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="TOAN Logo">
            </div>
            <div class="login-header">
                <h2>Admin Access</h2>
                <p>Secure portal for Kogi State revenue officials and administrators.</p>
            </div>

            <?php flash('admin_login_error'); ?>
            <?php flash('admin_access_error'); ?>

            <form action="<?php echo URLROOT; ?>/admin/login" method="POST">
                <div class="form-group">
                    <label for="adminId">Administrator ID / Username</label>
                    <input type="text" name="username" id="adminId" class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" placeholder="e.g. admin@toankogi.gov" value="<?php echo $data['username']; ?>" required>
                    <span class="invalid-feedback" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;"><?php echo $data['username_err']; ?></span>
                </div>
                
                <div class="form-group">
                    <label for="adminPass">Secure Password</label>
                    <input type="password" name="password" id="adminPass" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" placeholder="••••••••" required>
                    <span class="invalid-feedback" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;"><?php echo $data['password_err']; ?></span>
                </div>

                <button type="submit" class="btn-login">Verify & Enter Dashboard</button>
            </form>
        </div>
        
        <div class="login-footer">
            <p>&copy; 2026 Kogi State Ministry of Transportation. <br> <a href="<?php echo URLROOT; ?>">Return to Public Portal</a></p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.swal-flash');
            flashMessages.forEach(flash => {
                const message = flash.getAttribute('data-message');
                const icon = flash.getAttribute('data-icon') || 'success';
                
                Swal.fire({
                    title: icon.charAt(0).toUpperCase() + icon.slice(1),
                    text: message,
                    icon: icon,
                    background: '#ffffff',
                    color: '#1e293b',
                    confirmButtonColor: '#059669',
                    timer: 3000,
                    timerProgressBar: true
                });
                flash.remove();
            });
        });
    </script>
</body>

</html>
