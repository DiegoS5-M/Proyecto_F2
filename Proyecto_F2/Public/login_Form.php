<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
  <title>Login - Cafetería Ebenezer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-box {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      border-radius: 10px;
      background-color: white;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
    
    <div class="container">
    <div class="login-box">
      <h3 class="text-center mb-4">🔐 Iniciar sesión</h3>
      
      <form action="login.php" method="POST">
        <div class="mb-3">
          <label for="correo" class="form-label">Correo electrónico</label>
          <input type="email" class="form-control" id="correo" name="correo" required>
        </div>

        <div class="mb-3">
          <label for="celular" class="form-label">Número de celular</label>
          <input type="text" class="form-control" id="celular" name="celular" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
      </form>

      <?php if (isset($_SESSION['error_login'])): ?>
        <div class="alert alert-danger mt-3">
          <?= $_SESSION['error_login'] ?>
          <?php unset($_SESSION['error_login']); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>