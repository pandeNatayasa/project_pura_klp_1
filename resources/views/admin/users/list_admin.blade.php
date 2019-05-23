@extends('admin.layouts.layout_utama')

@section('add_css')
	<!-- Page level plugin CSS-->
   <link rel="stylesheet" type="text/css" href="{{asset('public_admin/vendors/datatables/datatables.min.css')}}">
@endsection

@section('menu_list_admin')
	current-page
@endsection

@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Admin | Administrator <!-- <small>sub title</small> --></h2>
          <ul class="nav navbar-right panel_toolbox">
            <button class="btn btn-primary" data-toggle="modal"  name="add_new_admin" data-target="#modal_add_new_admin" data-toggle="tooltip" data-placement="right">Tambah Admin</button>
          </ul>
          <div class="clearfix"></div>
        </div>
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
            
            <!-- <div class="card-header">
              <i class="fa fa-table"></i> Data admin</div> -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Foto Profille</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>No Telp</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($admin as $data)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <img style="height: 100px;" src="{{ asset($data->profille_image) }}"> </td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->no_telp }}</td>
                        <td>
                          <!-- Edit admin -->
                          <button class="btn btn-primary " data-admin_id="{{$data->id}}" data-admin_profille_image="{{ $data->profille_image }}" data-admin_name="{{$data->name}}" data-admin_no_telp="{{$data->no_telp}}" data-admin_email="{{ $data->email }}" data-toggle="modal"  data-target="#modal_edit_admin" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-edit"></i></button>
                          <!-- End of Edit admin -->
                          {{-- Delete admin --}}
                          <button href="" class="btn btn-danger " data-admin_id="{{$data->id}}" data-admin_name="{{$data->name}}" data-toggle="modal"  name="conrifm_delete" data-target="#modal_confirm_delete" data-toggle="tooltip" data-placement="right" title="Hapus"><i class="fa fa-trash"></i></button>
                          {{-- End of Delete admin --}}
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
<!-- Modal Add New admin-->
<div class="modal fade" id="modal_add_new_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Tambah admin Baru</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" action="{{route('admin.list-admin.store')}}">
          {{csrf_field()}}
          {{-- <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">admin <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="admin_name" name="admin_name" required="required" placeholder="ex: Bali" class="form-control col-md-7 col-xs-12">
            </div>
          </div> --}}
          <div class="item form-group">
              <label for="name" class="control-label">Nama</label>
              <div >
                  <input id="name" type="text" class="form-control" placeholder="Masukkan Nama" name="name" value="{{ old('name') }}" required autofocus>
                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="item form-group">
              <label for="email" >Alamat E-Mail</label>
              <div >
                  <input id="email" type="email" class="form-control" placeholder="Masukkan Alamat Email" name="email" value="{{ old('email') }}" required>
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="item form-group">
              <label for="password" class="control-label">Kata Sandi</label>
              <div >
                  <input id="password" type="password" class="form-control" placeholder="Masukkan Kata Sandi" name="password" required>
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="item form-group">
              <label for="password-confirm" class=" control-label">Konfrimasi Kata Sandi</label>

              <div >
                  <input id="password-confirm" type="password" class="form-control" placeholder="Masukkan Ulang Kata Sandi" name="password_confirmation" required>
              </div>
          </div>
          {{-- <button id="btn-login" type="submit" class="btn btn-primary">Daftar Akun</button> --}}
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4">
              <button type="submit" class="btn btn-primary" data-dismiss="modal">Batal</button>
              <button id="send" type="submit" class="btn btn-success">Daftar Akun</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Add New admin -->
<!-- Modal Edit admin-->
<div class="modal fade" id="modal_edit_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit admin</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" id="form_edit_admin" method="POST" enctype="multipart/form-data"  accept-charset="utf-8">
          {{csrf_field()}}
          <input type="hidden" name="_method" value="PUT">
          {{-- <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">State/admin <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="admin_name_edit" name="admin_name" required="required" value="" class="form-control col-md-7 col-xs-12">
            </div>
          </div> --}}
          <div class="form-group row" id="element_image_1">
            <label class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Foto Profille <span class="required">*</span>
            </label>
            <div class="col-sm-9 col-md-9 col-xs-12">
              <div class="col-md-12 col-xs-12 " >
                <img id="view_profille_image" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; ">
              </div>
              <input name="foto_profille" id="foto_profille" class="form-control col-md-12 col-xs-12" type="file" accept="image/*" onchange="showImage.call(this);">
              <span class="text-danger" id='width'>* Max Width: 5128 pixel</span><span class="text-danger" id='height'>, Max Height: 5128 pixel</span>
              <span class="text-danger" id="response"></span>
            </div>  
          </div>
          <div class="item form-group">
              <label for="name" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama</label>
              <div class="col-sm-9 col-md-9 col-xs-12">
                  <input id="admin_name_edit" type="text" class="form-control" placeholder="Masukkan Nama" name="admin_name_edit" value="" required autofocus>
                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="item form-group">
              <label for="email" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Alamat E-Mail</label>
              <div class="col-sm-9 col-md-9 col-xs-12">
                  <input id="admin_email_edit" type="email" class="form-control" placeholder="Masukkan Alamat Email" name="admin_email_edit" value="" required>
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="item form-group">
              <label for="email" class="col-sm-3 col-md-3 col-xs-12 col-form-label">No Telp</label>
              <div class="col-sm-9 col-md-9 col-xs-12">
                  <input id="admin_no_telp_edit" type="text" class="form-control" placeholder="Masukkan Nomor Telepon" name="admin_no_telp_edit" value="" required>
                  @if ($errors->has('no_telp'))
                      <span class="help-block">
                          <strong>{{ $errors->first('no_telp') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 col-form-label" for="name">Status <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              {{-- <label class="switch">
                <input type="checkbox" name="status">
                <span class="slider"></span>
              </label> --}}
              <select id="status" name="status" class="form-control" >
                <option value="" disabled selected>Pilih Status</option>
                <option id="status_1" value="1">Active</option>
                <option id="status_0" value="0">Non-Active</option>
                <option id="status_2" value="2">Deleted</option>
              </select>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-8 col-sm-4 col-sm-offset-8">
              <button class="btn btn-primary" data-dismiss="modal">Batal</button>
              <button id="send" type="submit" class="btn btn-success">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Edit admin -->
<!-- Modal Confirmation Delete-->
<div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Confirmation Delete admin</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="row">
            <label class="control-label col-md-12" id="label_delete"></label>
          </div>
            
          <div class="modal-footer">
            <div class="row">
              <div class="col-md-offset-8 col-sm-offset-8 col-xs-offset-6 col-md-2 col-sm-2 col-xs-3">
                <button class="btn btn-succes " type="button" data-dismiss="modal">Cancel</button>  
              </div>
              <div class="col-md-2 col-sm-2 col-xs-3">
                <form method="POST" id="form_delete_admin" >
                {{csrf_field()}}
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>  
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Confirmation Delete-->
@endsection	

@section('add_js')
	<script type="text/javascript" charset="utf8" src="{{asset('public_admin/vendors/datatables/datatables.min.js')}}"></script>

  <!-- validator -->
  <script src="{{asset('public_admin/vendors/validator/validator.js')}}"></script>

    <script type="text/javascript">
      $(document).ready( function () {
        $('#data').DataTable();
      } );

      // Javascript to show image are selected
      function showImage(){
        if( this.files && this.files[0]){
          var obj = new FileReader();

          obj.onload = function(data){
            // console.log(data);
            var image = document.getElementById("view_profille_image");

            image.src = data.target.result;
            image.style.display = "block";
          }
          obj.readAsDataURL(this.files[0]);

          // Validate image size
          var _URL = window.URL || window.webkitURL;

          var file = $(this)[0].files[0];

          img = new Image();
          var imgwidth = 0;
          var imgheight = 0;
          var maxwidth = 5128;
          var maxheight = 5128;

          img.src = _URL.createObjectURL(file);
          img.onload = function() {
            imgwidth = this.width;
            imgheight = this.height;
         
            $("#width").text("*Image Width: "+imgwidth+" pixel");
            $("#height").text(", Image Height: "+imgheight+" pixel");

            if(imgwidth >= maxwidth || imgheight >= maxheight){
       
              $("#response").text(", Image size must be max Size : "+maxwidth+" X "+maxheight+" pixel");
              // $('#foto_profille').val('');
            }else{
              $("#response").text("");
            }
          }

          img.onerror = function() {
            $("#response").text("not a valid file: " + file.type);
          }
        }
      }
      // End of show image

      //Modal Edit admin
      $('#modal_edit_admin').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var admin_name = button.data('admin_name') // Extract info from data-* attributes
        var admin_id = button.data('admin_id')
        var admin_no_telp = button.data('admin_no_telp')
        var admin_email = button.data('admin_email')
        var status = button.data('is_activated')
        var admin_profille_image = button.data('admin_profille_image')

        var modal = $(this)
        modal.find('.modal-body #admin_name_edit').val(admin_name)
        modal.find('.modal-body #admin_email_edit').val(admin_email)
        modal.find('.modal-body #admin_no_telp_edit').val(admin_no_telp)
        modal.find('.modal-body #view_profille_image').attr('src',"/"+admin_profille_image)
        modal.find('.modal-body #status_'+status).attr('selected',true) 
        $('#form_edit_admin').attr('action', "/admin/list-admin/"+admin_id);
      })

      //Modal Delete admin
      $('#modal_confirm_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var admin_name = button.data('admin_name') // Extract info from data-* attributes
        var admin_id = button.data('admin_id')

        var modal = $(this)
        modal.find('.modal-body #label_delete').text('Apakah anda yakin ingin menghapus admin : '+ admin_name)
        $('#form_delete_admin').attr('action', "/admin/list-admin/"+admin_id);
      })

      $('#modal_add_new_admin').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');sa
      })

      $('#modal_edit_admin').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find('#view_profille_image').attr('src', '');
      })

      $('#modal_confirm_delete').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
      })
    </script>
@endsection