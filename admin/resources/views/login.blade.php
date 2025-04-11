<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8" authoor="Selimcan Gürsu | Full Stack Web Developer">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Giriş Yap | Wiky Watch Admin Panel</title>
  </head>
  <body>
    <div class="container text-center">
      <img class="mt-5" style="width:100%;max-width: 200px" src="{{asset('assets/img/wiky-logo.svg')}}" alt="wiky-watch-logo">
      <div class="card d-flex m-auto w-50 justify-content-center mt-3">
        <div class="card-header text-center">
          <h5 class="card-title"> Giriş Yap </h3>
        </div>
        <div class="card-body text-start">
          <form>
          	@csrf
            <div class="mb-3">
              <label for="email" class="form-label">E-Posta Adresi</label>
              <input type="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Parola</label>
              <input type="password" class="form-control" id="password">
            </div>
            <button type="button" id="save" class="btn btn-primary w-100">Giriş Yap</button>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    $(document).ready(function(){
    $('#save').click(function(e){
        e.preventDefault();

        let email    = $('#email').val();
        let password = $('#password').val();

        $.ajax({
            type: "POST",
            url: "{{route('login.post')}}",
            data: {
                email: email,
                password: password,
                _token: "{{csrf_token()}}"
            },
            success: function(response) {
                if(response.success) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Giriş Başarılı',
                        text: 'Yönlendiriliyorsunuz...',
                        timer: 2000, 
                        showConfirmButton: false
                    }).then(function() {
                        window.location.href = "{{ route('dashboard') }}";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Giriş Başarısız',
                        text: response.message,
                        showConfirmButton: true
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Bir Hata Oluştu',
                    text: 'Lütfen tekrar deneyin.',
                    showConfirmButton: true
                });
            }
        });
    });
});

  </script>
</html>