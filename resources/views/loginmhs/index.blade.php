<head>
  <meta charset="UTF-8">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
    <section>
        <form action="{{ route('login.signin') }}" method="POST">
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:red">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf
            <h1>Login</h1>            
            <div class="inputbox">
                <ion-icon name="person-outline"></ion-icon>
                <input type="text" name="username" required>
                <label for="">Username</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="password" required>
                <label for="">Password</label>
            </div>
            <div class="forget">
                <!-- <label for=""><input type="checkbox">Remember Me</label>
              <a href="#">Forget Password</a> -->
            </div>
            <button>Log in</button>
            <div class="register">                                                  
                <p>Don't have a account? <a href="{{route('register.index')}}">Register</a></p>                                         
            </div>
        </form>
    </section>
</body>