<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | TOAN Kogi State</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Admin Style -->
    <link rel="stylesheet" href="assets/css/admin.css">
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
        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.2rem center;
            background-size: 1rem;
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
                <img src="../images/logo.jpeg" alt="TOAN Logo">
            </div>
            <div class="login-header">
                <h2>Admin Access</h2>
                <p>Secure portal for Kogi State revenue officials and administrators.</p>
            </div>

            <form id="adminLoginForm" onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label for="adminId">Administrator ID / Email</label>
                    <input type="text" id="adminId" class="form-control" placeholder="e.g. admin@toankogi.gov" required>
                </div>
                
                <div class="form-group">
                    <label for="adminPass">Secure Password</label>
                    <input type="password" id="adminPass" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">Verify & Enter Dashboard</button>
            </form>
        </div>
        
        <div class="login-footer">
            <p>&copy; 2026 Kogi State Ministry of Transportation. <br> <a href="../index.php">Return to Public Portal</a></p>
        </div>
    </div>

    <script>
        function handleLogin(e) {
            e.preventDefault();
            const adminId = document.getElementById('adminId').value.toLowerCase();
            const btn = e.target.querySelector('button');
            
            // Visual feedback
            btn.disabled = true;
            btn.innerText = 'Detecting Access Level...';
            
            setTimeout(() => {
                // Simplified role detection for prototype
                let roleParam = '';
                if (adminId.includes('lga')) {
                    roleParam = '?role=lga';
                } else if (adminId.includes('unit')) {
                    roleParam = '?role=unit';
                } else if (adminId.includes('agent')) {
                    roleParam = '?role=agent';
                }
                
                // For prototype purposes, we redirect to the dashboard with the detected role
                window.location.href = 'index.php' + roleParam;
            }, 1500);
        }
    </script>
</body>
</html>
