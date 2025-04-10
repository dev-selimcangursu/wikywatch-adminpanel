@extends('partials.master') @section('main') <div class="container">
  <div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Yeni Kullanıcı Ekleme Formu</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="name" class="form-label">İsim Soyisim</label>
              <input type="text" class="form-control" id="name">
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="email" class="form-label">E-Posta Adresi</label>
              <input type="email" class="form-control" id="email">
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="phone" class="form-label">Telefon Numarası</label>
              <input type="text" class="form-control" id="phone">
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="department_id" class="form-label">Departman Bilgisi</label>
              <select class="form-select" id="department_id">
                <option selected>Seçiniz...</option>
                 @foreach($departments as $department)
                  <option value="{{$department->id}}">{{$department->name}}</option>
                 @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="" class="form-label">Rol Bilgisi</label>
              <select class="form-select" id="role_id">
                <option selected>Seçiniz...</option>
                 @foreach($roles as $role)
                  <option value="{{$role->id}}">{{$role->name}}</option>
                 @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="status_id" class="form-label">Durum</label>
              <select class="form-select" id="status_id">
                <option selected>Seçiniz...</option>
                <option value="1">Aktif</option>
                <option value="2">Pasif</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="password" class="form-label">Parola</label>
              <input type="password" class="form-control" id="password">
            </div>
          </div>
          <div class="col-md-12">
            <button id="save" class="float-end btn btn-primary btn-sm">Yeni Kullanıcıyı Ekle</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#save').click(function(e) {
      e.preventDefault();
      let name = $('#name').val();
      let email = $('#email').val();
      let phone = $('#phone').val();
      let department_id = $('#department_id').val();
      let role_id = $('#role_id').val();
      let status_id = $('#status_id').val();
      let password = $('#password').val();
      $.ajax({
        type: "POST",
        url: "{{route('users.store')}}",
        data: {
          name: name,
          email: email,
          phone: phone,
          department_id: department_id,
          role_id: role_id,
          status_id: status_id,
          password: password,
          _token: "{{csrf_token()}}"
        },
        success: function(response) {
          if (response.success) {
            console.log(response.message);
            Swal.fire({
              icon:"success",
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
  });
</script> 
@endsection