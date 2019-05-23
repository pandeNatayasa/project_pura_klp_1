@extends('admin.layouts.layout_utama')

@section('add_css')
	<!-- Page level plugin CSS-->
   <link rel="stylesheet" type="text/css" href="{{asset('public_admin/vendors/datatables/datatables.min.css')}}">
@endsection

@section('menu_list_member')
	current-page
@endsection

@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Member | Administrator <!-- <small>sub title</small> --></h2>
          <ul class="nav navbar-right panel_toolbox">
            <button class="btn btn-primary" data-toggle="modal"  name="add_new_member" data-target="#modal_add_new_member" data-toggle="tooltip" data-placement="right">Tambah Member</button>
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
              <i class="fa fa-table"></i> Data member</div> -->
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
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($member as $data)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <img style="height: 100px;" src="{{ asset($data->profille_image) }}"> </td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->no_telp }}</td>
                        <td>
                          <!-- Edit Member -->
                          <button class="btn btn-primary " data-member_id="{{$data->id}}" data-member_profille_image="{{ $data->profille_image }}" data-member_name="{{$data->name}}" data-member_no_telp="{{$data->no_telp}}" data-member_email="{{ $data->email }}" data-is_activated="{{ $data->is_activated }}" data-toggle="modal"  data-target="#modal_edit_member" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-edit"></i></button>
                          <!-- End of Edit Member -->
                          {{-- Delete Member --}}
                          <button href="" class="btn btn-danger " data-member_id="{{$data->id}}" data-member_name="{{$data->name}}" data-toggle="modal"  name="conrifm_delete" data-target="#modal_confirm_delete" data-toggle="tooltip" data-placement="right" title="Hapus"><i class="fa fa-trash"></i></button>
                          {{-- End of Delete Member --}}
                        </td>
                        <td>
                          @if ($data->is_activated == 1)
                            active
                          @elseif($data->is_activated == 0)
                            Non-active
                          @elseif($data->is_activated == 2)
                            Deleted
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
<!-- Modal Add New member-->
<div class="modal fade" id="modal_add_new_member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Tambah Member Baru</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" action="{{route('list-member.store')}}">
          {{csrf_field()}}
          {{-- <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">member <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="member_name" name="member_name" required="required" placeholder="ex: Bali" class="form-control col-md-7 col-xs-12">
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
<!-- End of Modal Add New member -->
<!-- Modal Edit member-->
<div class="modal fade" id="modal_edit_member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit Member</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" id="form_edit_member" method="POST" enctype="multipart/form-data"  accept-charset="utf-8" >
          {{csrf_field()}}
          <input type="hidden" name="_method" value="PUT">
          {{-- <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">State/member <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="member_name_edit" name="member_name" required="required" value="" class="form-control col-md-7 col-xs-12">
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
                  <input id="member_name_edit" type="text" class="form-control" placeholder="Masukkan Nama" name="member_name_edit" value="" required autofocus>
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
                  <input id="member_email_edit" type="email" class="form-control" placeholder="Masukkan Alamat Email" name="member_email_edit" value="" required>
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
                  <input id="member_no_telp_edit" type="text" class="form-control" placeholder="Masukkan Nomor Telepon" name="member_no_telp_edit" value="" required>
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
<!-- End of Modal Edit member -->
<!-- Modal Confirmation Delete-->
<div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Confirmation Delete member</h5>
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
                <form method="POST" id="form_delete_member" >
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

      //Modal Edit member
      $('#modal_edit_member').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var member_name = button.data('member_name') // Extract info from data-* attributes
        var member_id = button.data('member_id')
        var member_no_telp = button.data('member_no_telp')
        var member_email = button.data('member_email')
        var status = button.data('is_activated')
        var member_profille_image = button.data('member_profille_image')

        var modal = $(this)
        modal.find('.modal-body #member_name_edit').val(member_name)
        modal.find('.modal-body #member_email_edit').val(member_email)
        modal.find('.modal-body #member_no_telp_edit').val(member_no_telp)
        modal.find('.modal-body #view_profille_image').attr('src',"/"+member_profille_image)
        modal.find('.modal-body #status_'+status).attr('selected',true) 
        $('#form_edit_member').attr('action', "/admin/list-member/"+member_id);
      })

      //Modal Delete member
      $('#modal_confirm_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var member_name = button.data('member_name') // Extract info from data-* attributes
        var member_id = button.data('member_id')

        var modal = $(this)
        modal.find('.modal-body #label_delete').text('Apakah anda yakin ingin menghapus member : '+ member_name)
        $('#form_delete_member').attr('action', "/admin/list-member/"+member_id);
      })

      $('#modal_add_new_member').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');sa
      })

      $('#modal_edit_member').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find('#view_profille_image').attr('src', '');
      })

      $('#modal_confirm_delete').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
      })
    </script>
@endsection