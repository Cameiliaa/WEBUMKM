<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <style>
      body {
        background: linear-gradient(135deg, #ff0000 0%, #ffffff 50%, #000000 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      .login-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 40px;
        width: 100%;
        max-width: 400px;
        border: none;
      }

      .welcome-title {
        font-size: 28px;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
      }

      .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 12px 15px;
        font-size: 16px;
        margin-bottom: 20px;
      }

      .form-control:focus {
        border-color: #ff0000;
        box-shadow: 0 0 0 2px rgba(255, 0, 0, 0.1);
      }

      .btn-login {
        background: #ff0000;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
        color: white;
        width: 100%;
        margin-top: 10px;
      }

      .btn-login:hover {
        background: #cc0000;
        color: white;
      }

      .show-password-container {
        margin-bottom: 20px;
      }

      .show-password-container label {
        font-size: 14px;
        color: #666;
        margin-left: 5px;
      }

      .register-link {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
      }

      .register-link p {
        color: #666;
        margin: 0;
      }

      .register-link a {
        color: #ff0000;
        text-decoration: none;
        font-weight: 500;
      }

      .register-link a:hover {
        color: #cc0000;
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <div class="login-card">
      <h1 class="welcome-title">Hai, Selamat Datang</h1>
      
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
          <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required />
        </div>
        
        <div class="form-group">
          <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required />
        </div>
        
        <div class="show-password-container">
          <input type="checkbox" id="show-password" class="form-check-input">
          <label for="show-password">Show Password</label>
        </div>
        
        <button type="submit" class="btn btn-login">Masuk</button>
      </form>
      
      <div class="register-link">
        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript untuk fitur Show Password
        document.getElementById("show-password").addEventListener("change", function () {
          const passwordField = document.getElementById("password");
          if (this.checked) {
            passwordField.type = "text";
          } else {
            passwordField.type = "password";
          }
        });
    </script>
  </body>
</html>