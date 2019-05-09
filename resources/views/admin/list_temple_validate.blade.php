<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Validasi</title>

    <!-- Bootstrap -->
    <link type="text/css" href="{{ asset('public_admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--Font Awesome -->
    <link type="text/css" href="{{ asset('public_admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public_admin/vendors/datatables/datatables.min.css')}}">
    <!-- Custom Theme Style -->
    <link type="text/css" href="{{ asset('public_admin/build/css/custom.css') }}" rel="stylesheet">
  </head>
<body>  
  <div class="top_nav">
    <div class="nav_menu">
      <nav>
        <a class="brand" href="{{ route('show_list_temple_validate') }}">Validasi Data Pura </a>
        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="{{ route('admin.home') }}" class="user-profile" aria-expanded="false">
              Back To Dashboard
            </a>
          
        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->
  
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <!-- isi data -->
            <div class="card mb-3">
              @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <p>{{$message}}</p>
                </div>
              @endif

              @if($message = Session::get('warning'))
                <div class="alert alert-warning">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <p>{{$message}}</p>
                </div>
              @endif
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="data" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Pura</th>
                        <th>Jenis</th>
                        <th>Gambar</th>
                        <th>Alamat</th>
                        <th>Pengguna</th>
                        <th>Actions</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($temples as $data)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $data->temple_name }}</td>
                          <td>{{ $data->TempleType->type_name }}</td>
                          <td><img style="height: 100px;" src="{{ asset($data->image_name) }}"></td>
                          <td>{{ $data->address }}</td>
                          <td>{{ $data->User->name }}</td>
                          <td>
                            <a href=""><button class="btn btn-info " data-toggle="tooltip" data-placement="right" title="Detail Pura"><i class="fa fa-eye"></i></button></a>
                            <button class="btn btn-primary " name="temple_edit" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger " data-temple_id="{{ $data->id }}" data-temple_name="{{ $data->temple_name }}" data-toggle="modal"  name="confirm_delete" data-target="#modal_confirm_delete" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash"></i></button>
                          </td>
                          <td>
                            @if ($data->validate_status == 0)
                              <button class="btn btn-primary " data-type="verify" data-temple_id="{{ $data->id }}" data-temple_name="{{ $data->temple_name }}" data-toggle="modal"  name="confirm_verify" data-target="#modal_confirm_verify" data-toggle="tooltip" data-placement="right" title="Verify"><i class="fa fa-check"></i></button>
                              <button class="btn btn-danger " data-type="reject" data-temple_id="{{ $data->id }}" data-temple_name="{{ $data->temple_name }}" data-toggle="modal"  name="confirm_reject" data-target="#modal_confirm_verify" data-toggle="tooltip" data-placement="right" title="Decline"><i class="fa fa-remove"></i></button>
                            @elseif($data->validate_status == 1)
                              Active
                            @elseif($data->validate_status == 2)
                              Reject
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- </div> -->

  <!-- Modal Confirmation Delete-->
  <div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Confirmation Delete Temple</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="modal-body">
            <div class="row">
              <label id="text_delete" class="control-label col-md-12" style="margin-bottom: 10px;"></label>
            </div>
              
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-offset-8 col-sm-offset-8 col-xs-offset-6 col-md-2 col-sm-2 col-xs-3">
                  <button class="btn btn-succes " type="button" data-dismiss="modal">Cancel</button>  
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                  <form method="POST" action="#">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <input type="hidden" name="id_produk_delete" id="id_produk_delete" value="">
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
        
      </div>
    </div>
  </div>
  <!-- End Of Modal Confirmation Delete-->
  <!-- Modal Confirmation Accept New Temple -->
  <div class="modal fade" id="modal_confirm_verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Konfirmasi Verifikasi Data Pura</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="modal-body">
            <div class="row">
              <label id="text_verify" class="control-label col-md-12" style="margin-bottom: 10px;"></label>
            </div>
              
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-offset-5 col-sm-offset-5 col-xs-offset-2 col-md-3 col-sm-3 col-xs-5">
                  <button id="btn_cancel" class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>  
                </div>
                <div class="col-md-4 col-sm-4 col-xs-5">
                  <form method="GET" id="form_verify_temple" action="#">
                    {{csrf_field()}}
                    <button id="btn_verify" class="btn btn-success" type="submit">Verifikasi</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Of Modal Confirmation Accept New Temple-->
  <script src="{{asset('public_admin/vendors/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('public_admin/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('public_admin/build/js/custom.js') }}" type="text/javascript"></script>
  <script type="text/javascript" charset="utf8" src="{{asset('public_admin/vendors/datatables/datatables.min.js')}}"></script>

  <script type="text/javascript">
    $(document).ready( function () {
      $('#data').DataTable();
    } );

    //Modal Delete Temple
    $('#modal_confirm_delete').on('show.bs.modal', function (event) {
      console.log('Delete Order begin');

      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id_produk')
      var nama_produk = button.data('nama_produk')

      var modal = $(this)
      modal.find('.modal-body #text_delete').text('Apakah anda yakin akan menghapus Produk dengan ID : ' + id +', dengan nama Produk : '+nama_produk)
      modal.find('.modal-footer #id_produk_delete').val(id)
    })

    //Modal Confirmation Accept Temple
    $('#modal_confirm_verify').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var temple_id = button.data('temple_id')
      var temple_name = button.data('temple_name')
      var type = button.data('type');

      var modal = $(this)
      if (type=="verify") {
        modal.find('.modal-body #text_verify').text('Apakah anda yakin akan memverifikasi Pura : ' + temple_name)
        $('#form_verify_temple').attr('action', "/admin/verify-accept-temple/"+temple_id);  
      }else if(type=="reject"){
        modal.find('.modal-body #text_verify').text('Apakah anda yakin akan untuk tidak memverifikasi Pura : ' + temple_name)
        $('#form_verify_temple').attr('action', "/admin/verify-reject-temple/"+temple_id);  
        modal.find('.modal-body #btn_verify').text('Tidak Verifikasi')
        modal.find('.modal-body #btn_verify').attr('class', 'btn btn-danger')
        modal.find('.modal-body #btn_cancel').attr('class', 'btn btn-primary')
      }
      
    })
  </script>
</body>

</html>