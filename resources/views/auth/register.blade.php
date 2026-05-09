<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Form</title>
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

      .register-card {
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

      .form-control.is-invalid {
        border-color: #dc3545;
      }

      .invalid-feedback {
        display: block;
        font-size: 14px;
        color: #dc3545;
        margin-top: -15px;
        margin-bottom: 15px;
      }

      .btn-register {
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

      .btn-register:hover {
        background: #cc0000;
        color: white;
      }

      .login-link {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
      }

      .login-link p {
        color: #666;
        margin: 0;
      }

      .login-link a {
        color: #ff0000;
        text-decoration: none;
        font-weight: 500;
      }

      .login-link a:hover {
        color: #cc0000;
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <div class="register-card">
      <h1 class="welcome-title">Register</h1>
      
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name Field -->
        <div class="form-group">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukkan Nama">
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <!-- Email Field -->
        <div class="form-group">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan Email">
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <!-- Password Field -->
        <div class="form-group">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukkan Password">
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-register">Register</button>
      </form>

      <!-- Link to login page -->
      <div class="login-link">
        <p>Sudah punya akun? <a href="{{ route('login') }}">Login Sekarang</a></p>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>