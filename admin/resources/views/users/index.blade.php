@extends('partials.master')
@section('main')
<div class="container">
  <div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Tüm Kullanıcılar</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="basic-datatables" class="display table table-striped table-hover" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>İsim Soyisim</th>
                <th>Departman</th>
                <th>E-Posta</th>
                <th>Telefon Numarası</th>
                <th>Pozisyon</th>
                <th>Durum</th>
                <th>İşe Başlama Tarihi</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('#basic-datatables').DataTable({
    processing: true,
    serverSide: true,
    ajax:{
    	type:"GET",
    	url:"{{route('users.fetch')}}",
    },
    columns: [
      { data: "id", name: "id" },
      { data: "name", name: "name" },
      { data: "departmentName", name: "departmentName" },
      { data: "email", name: "email" },
      { data: "phone", name: "phone" },
      { data: "roleName", name: "roleName" },
      {
       data: "status_id",
       name: "status_id",
       render: function(data, type, row) {
        if (data == 1) {
            return '<span class="badge bg-success">Aktif</span>';
        } else if (data == 2) {
            return '<span class="badge bg-danger">Pasif</span>'; 
        }
        return '';
        }
      },
      {
       data: "created_at",
       name: "created_at",
       render: function(data, type, row) {
        return moment(data).format('DD/MM/YYYY HH:mm');
       }
      },
      { data: "action", name: "action", render: function(data, type, row) {
        return `<a href="users/edit/${row.id}" class="btn btn-sm btn-primary">İncele</a>`;
        }
      }
    ]
  });
});
</script>

@endsection

