<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome to BudgetBuddy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #ffff;
      color: white;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .welcome-box {
      background-color: rgba(0, 0, 0, 0.4);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      max-width: 600px;
      width: 100%;
    }
    .btn-primary {
      background-color: #00c897;
      border: none;
    }
    .btn-primary:hover {
      background-color: #00a77c;
    }
  </style>
</head>
<body>

  <div class="welcome-box">
    <h1 class="mb-4">Welcome to <strong>BudgetBuddy</strong></h1>
    <h4 class="mb-4">By Muhammad Faza Ardianto</h4>
    <p class="lead mb-4">Kelola keuangan Anda dengan mudah, cepat, dan aman. Catat pemasukan, pengeluaran, serta pantau sisa uang Anda setiap saat.</p>
    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Login</a>
    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Daftar</a>
  </div>

</body>
</html>