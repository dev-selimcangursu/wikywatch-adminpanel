@extends('partials.master') @section('main') <div class="container">
  <div class="col-md-12 mt-3">
    <a href="{{route('users.index')}}" class="btn btn-dark btn-sm">Geri Dön</a>
    <button id="removeUserButton" class="btn btn-danger btn-sm">Kullanıcıyı Sil</button>
    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Kullanıcıya Mesaj Gönder </button>
    <div class="card mt-3">
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
        <form> @csrf <div class="col-md-12">
            <div class="mb-3">
              <label for="password" class="form-label">Parola</label>
              <input type="password" class="form-control" id="password">
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="password" class="form-label">Parola Tekrarı</label>
              <input type="password" class="form-control" id="repeatPassword">
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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Kullanıcıya Mesaj Gönder</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="phone_number" class="form-label">Telefon Numarası</label>
            <input type="text" class="form-control" id="phone_number" value="{{$user->phone}}">
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Mesajınız</label>
            <textarea id="message" class="form-control" rows="3"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
            <button type="button" id="smsSendButton" class="btn btn-primary">Gönder</button>
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
    // Kullanıcıyı Sil
    $('#removeUserButton').click(function(e) {
      e.preventDefault();
      let removeId = $('#id').val();
      Swal.fire({
        icon: "warning",
        title: "Bu Kaydı Silmek İstediğinize Emin Misiniz?",
        text: "Bu işlem geri alınamaz ve veriler kalıcı olarak silinecektir.",
        showCancelButton: true,
        confirmButtonText: "Evet,Sil!",
        cancelButtonText: "İptal!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "{{route('users.remove')}}",
            data: {
              removeId: removeId,
              _token: "{{csrf_token()}}",
            },
            success: function(response) {
              if (response.success) {
                Swal.fire({
                  icon: "success",
                  title: response.message,
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: "OK",
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = '{{ route("users.index") }}';
                  }
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: response.message,
                });
              }
            }
          });
        }
      });
    });
    // Sms Gönder
    $('#smsSendButton').click(function(e) {
      e.preventDefault();
      let phone_number = $('#phone_number').val();
      let message = $('#message').val();
      let smsId = {{$user->id}};
      $.ajax({
        type: "POST",
        url: "{{ route('sms.send') }}",
        data: {
          smsId: smsId,
          phone_number: phone_number,
          message: message,
          _token: "{{ csrf_token() }}"
        },
        success: function(response) {
          if (response.success) {
            console.log(response.message);
            Swal.fire({
              icon: "success",
              title: response.message,
              showDenyButton: false,
              showCancelButton: false,
              confirmButtonText: "Tamam",
            }).then((result) => {
               window.location.reload();
            });
          } else {
            console.log(response.message);
            Swal.fire({
              position: "top-center",
              icon: "error",
              title: response.message,
              showConfirmButton: true,
            });
          }
        },
        error: function(xhr, status, error) {
          console.error("Error: " + error);
          console.error("Status: " + status);
          console.error(xhr.responseText);
        }
      });
    });
  })
</script> @endsection