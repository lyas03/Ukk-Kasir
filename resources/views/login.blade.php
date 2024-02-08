<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Big Foody | Login</title>
  <link rel="stylesheet" href="{{ asset ('css/login-style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
   <div class="container">
    <form action="{{ route('login') }}" method="post">
      @csrf
        <h1>Login</h1>
        <div class="input-box">
          <input type="text" name="username" placeholder="Username" required>
          <i class="bx bxs-user"></i>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Password" required>
          <i class="bx bxs-lock-alt"></i>
        </div>
        <div>
          <button type="submit" class="btn-login">Login</button>
        </div>
    </form>
   </div>
   @include('message.error-login')
   <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    $(document).ready(function() {
        // Cek apakah ada pesan error dari response JSON
        @if(session('login'))
            $('#errorModalBody').text('{{ session('login') }}');
            $('#errorModal').modal('show');
        @endif

        $('#errorModal button[data-bs-dismiss="modal"]').on('click', function () {
            $('#errorModal').modal('hide');
        });
    });
  </script>
</body>
</html>