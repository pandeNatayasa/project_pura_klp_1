@extends('admin.layouts.layout_utama')

@section('add_css')
	<!-- Page level plugin CSS-->
   <link rel="stylesheet" type="text/css" href="{{asset('public_admin/vendors/datatables/datatables.min.css')}}">
@endsection

@section('menu_list_rahinan')
	current-page
@endsection

@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Daftar Rahinan | Administrator <!-- <small>sub title</small> --></h2>
          <ul class="nav navbar-right panel_toolbox">
            <button class="btn btn-primary" data-toggle="modal"  name="add_new_rahinan" data-target="#modal_add_new_rahinan" data-toggle="tooltip" data-placement="right">Tambah Hari Rahinan Baru</button>
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
              <i class="fa fa-table"></i> Data rahinan</div> -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    	<th>No</th>
                    	<th>Rahinan</th>
                    	<th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1;?>
                    @foreach($rahinans as $data)
                  	<tr>
                  		<td>{{$no++}}</td>
                  		<td>{{$data->rahinan_name}}</td>
                  		<td>
                        <!-- Edit rahinan -->
                  			<button class="btn btn-primary" data-rahinan_id="{{$data->id}}" data-rahinan_name="{{$data->rahinan_name}}" data-toggle="modal" name="edit_rahinan" data-target="#modal_edit_rahinan" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-edit"></i></button>
                        <!-- End of Edit rahinan -->
                        <button href="" class="btn btn-danger " data-rahinan_id="{{$data->id}}" data-rahinan_name="{{$data->rahinan_name}}" data-toggle="modal"  name="conrifm_delete" data-target="#modal_confirm_delete" data-toggle="tooltip" data-placement="right" title="Hapus"><i class="fa fa-trash"></i></button>
                          
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
<!-- Modal Add New rahinan-->
<div class="modal fade" id="modal_add_new_rahinan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Buat Hari Rahinan Baru</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" action="{{route('rahinan.store')}}">
          {{csrf_field()}}
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Rahinan <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="rahinan_name" name="rahinan_name" required="required" placeholder="ex: Bali" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-8 col-sm-4 col-sm-offset-8">
              <button type="submit" class="btn btn-primary" data-dismiss="modal">Batal</button>
              <button id="send" type="submit" class="btn btn-success">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Add New rahinan -->
<!-- Modal Edit rahinan-->
<div class="modal fade" id="modal_edit_rahinan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit Hari Rahinan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" id="form_edit_rahinan" method="POST">
          {{csrf_field()}}
          <input type="hidden" name="_method" value="PUT">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Rahinan <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="rahinan_name_edit" name="rahinan_name" required="required" value="" class="form-control col-md-7 col-xs-12">
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
<!-- End of Modal Edit rahinan -->
<!-- Modal Confirmation Delete-->
<div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Konfirmasi Hapus Hari Rahinan</h5>
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
                <button class="btn btn-succes " type="button" data-dismiss="modal">Batal</button>  
              </div>
              <div class="col-md-2 col-sm-2 col-xs-3">
                <form method="POST" id="form_delete_rahinan" >
                {{csrf_field()}}
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger" type="submit">Hapus</button>
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

      //Modal Edit rahinan
      $('#modal_edit_rahinan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var rahinan_name = button.data('rahinan_name') // Extract info from data-* attributes
        var rahinan_id = button.data('rahinan_id')

        console.log(rahinan_name);

        var modal = $(this)
        modal.find('.modal-body #rahinan_name_edit').val(rahinan_name)
        $('#form_edit_rahinan').attr('action', "/admin/rahinan/"+rahinan_id);
      })

      //Modal Delete rahinan
      $('#modal_confirm_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var rahinan_name = button.data('rahinan_name') // Extract info from data-* attributes
        var rahinan_id = button.data('rahinan_id')

        var modal = $(this)
        modal.find('.modal-body #label_delete').text('Apakah anda yakin ingin menghapus provinsi : '+ rahinan_name)
        $('#form_delete_rahinan').attr('action', "/admin/rahinan/"+rahinan_id);
      })
    </script>
@endsection