@extends('partials.master') @section('main') <div class="container">
  <div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title">Kullanıcı Detay Bilgileri</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col-md-12 d-none">
              <div class="mb-3">
                <label for="id" class="form-label">Kullanıcı ID</label>
                <input type="text" class="form-control" id="id" value="{{$user->id}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">İsim Soyisim</label>
                <input type="text" class="form-control" id="name" value="{{$user->name}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label">E-Posta Adresi</label>
                <input type="text" class="form-control" id="email" value="{{$user->email}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="phone" class="form-label">Telefon Numarası</label>
                <input type="text" class="form-control" id="phone" value="{{$user->phone}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="department_id" class="form-label">Departman Bilgisi</label>
                <select class="form-select" id="department_id"> @foreach($departments as $department) <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                  </option> @endforeach </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Rol Bilgisi</label>
                <select class="form-select" id="role_id"> @foreach($roles as $role) <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                  </option> @endforeach </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Durum Bilgisi</label>
                <select class="form-select" id="status_id" name="status_id">
                  <option value="1" {{ $user->status_id == 1 ? 'selected' : '' }}>Aktif</option>
                  <option value="2" {{ $user->status_id == 2 ? 'selected' : '' }}>Pasif</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <button id="userInfoUpdateButton" class="btn btn-success btn-sm float-end">Kullanıcı Bilgilerini Güncelle</button>
          </div>
        </form>
      </div>
    </div>
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title">Kullanıcı Parola Değiştir</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="password" class="form-label">Parola</label>
              <input type="text" class="form-control" id="password">
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="password" class="form-label">Parola Tekrarı</label>
              <input type="text" class="form-control" id="repeatPassword">
            </div>
          </div>
          <div class="col-md-12">
            <button id="userPasswordUpdateButton" class="btn btn-success btn-sm float-end">Kullanıcı Parolasını Güncelle</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    // Kullanıcı Bilgilerini Güncelle
    $('#userInfoUpdateButton').click(function(e) {
      e.preventDefault();
      let userId = $('#id').val();
      let name = $('#name').val();
      let email = $('#email').val();
      let phone = $('#phone').val();
      let department_id = $('#department_id').val();
      let role_id = $('#role_id').val();
      let status_id = $('#status_id').val();
      $.ajax({
        type: "POST",
        url: "{{route('users.update')}}",
        data: {
          userId: userId,
          name: name,
          email: email,
          phone: phone,
          department_id: department_id,
          role_id: role_id,
          status_id: status_id,
          _token: "{{csrf_token()}}",
        },
        success: function(response) {
          if (response.success) {
            console.log(response.message)
            Swal.fire({
              icon: "success",
              title: response.message,
              showDenyButton: false,
              showCancelButton: false,
              confirmButtonText: "Tamam",
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            });
          } else {
            console.log(response.message);
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: response.message,
            });
          }
        }
      })
    })
    // Kullanıcı Parola Güncelle
    $('#userPasswordUpdateButton').click(function(e) {
      e.preventDefault();
      let password = $('#password').val();
      let repeatPassword = $('#repeatPassword').val();
      let user_id = $('#id').val();
      if (password !== repeatPassword) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Şifreler eşleşmiyor!",
        });
        return;
      }
      $.ajax({
        type: "POST",
        url: "{{ route('users.updatePassword') }}",
        data: {
          user_id: user_id,
          password: password,
          _token: "{{ csrf_token() }}",
        },
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: "success",
              title: response.message,
              showDenyButton: false,
              showCancelButton: false,
              confirmButtonText: "Tamam",
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: response.message,
            });
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr)
          console.log(status)
          console.log(error)
          Swal.fire({
            icon: "error",
            title: "Hata",
            text: "Bir hata oluştu, lütfen tekrar deneyin.",
          });
        }
      });
    });
    // 
  })
</script> @endsection