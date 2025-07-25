<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <section>
    <form action="{{ route('register.store') }}" method="POST">
      @csrf

      @if ($errors->any())
          <div class="error-message">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li style="color:red">{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <h1>Register</h1>

      <div class="inputbox">
        <ion-icon name="person-circle-outline"></ion-icon>
        <input type="text" name="nama" required>
        <label>Nama Lengkap</label>
      </div>

      <div class="inputbox">
        <ion-icon name="person-outline"></ion-icon>
        <input type="text" name="username" required>
        <label>Username</label>
      </div>

      <div class="inputbox">
        <ion-icon name="mail-outline"></ion-icon>
        <input type="email" name="email" required>
        <label>Email</label>
      </div>

      <div class="inputbox">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input type="password" name="password" required>
        <label>Password</label>
      </div>

      <div class="inputbox">
        <ion-icon name="male-female-outline"></ion-icon>
        <select name="jenis_kelamin" required style="width: 100%; padding: 10px; border: none; background: transparent; color: white;">
          <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
          <option value="Laki-laki" style="color: black;">Laki-laki</option>
          <option value="Perempuan" style="color: black;">Perempuan</option>
        </select>
      </div>

      <button>Register</button>

      <div class="register">
        <p>Sudah punya akun? <a href="{{ route('login.index') }}">Login</a></p>
      </div>
    </form>
  </section>
</body>
</html>