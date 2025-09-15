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
        <h1>Email Verifikasi Telah Dikirim</h1>

        @if (session('message   '))
            <p style="color: green;">{{ session('message') }}</p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">Kirim ulang link verifikasi</button>
        </form>
    </section>
</body>
</html>