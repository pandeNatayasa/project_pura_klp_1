@extends('admin.layouts.layout_utama')

@section('add_css')
	<!-- Page level plugin CSS-->
   <link rel="stylesheet" type="text/css" href="{{asset('public_admin/vendors/datatables/datatables.min.css')}}">
@endsection

@section('menu_list_saptawara')
	current-page
@endsection

@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Saptawara | Administrator <!-- <small>sub title</small> --></h2>
          <ul class="nav navbar-right panel_toolbox">
            <button class="btn btn-primary " data-toggle="modal"  name="add_saptawara" data-target="#modal_add_saptawara" data-toggle="tooltip" data-placement="right" title="Add">Add Saptawara</button>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <!-- isi data -->
          <div class="card mb-3">
            @if($message = Session::get('success'))
              <div class="alert alert-success">
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
              <i class="fa fa-table"></i> Data Province</div> -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    	<th>No</th>
                    	<th>Saptawara</th>
                    	<th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1;?>
                    @foreach($saptawaras as $data)
                  	<tr>
                  		<td>{{$no++}}</td>
                  		<td>{{$data->saptawara_name}}</td>
                  		<td>
                        <!-- Edit Province -->
                        {{csrf_field()}}
                  			<button class="btn btn-primary " data-saptawara_id="{{$data->id}}" data-saptawara_name="{{$data->saptawara_name}}" data-toggle="modal"  name="edit_saptawara" data-target="#modal_edit_saptawara" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-edit"></i></button>
                        <button href="" class="btn btn-danger " data-saptawara_id="{{$data->id}}" data-saptawara_name="{{$data->saptawara_name}}" data-toggle="modal"  name="conrifm_delete" data-target="#modal_confirm_delete" data-toggle="tooltip" data-placement="right" title="Hapus"><i class="fa fa-trash"></i></button>
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
<!-- Modal of Add Sub District-->
<div class="modal fade" id="modal_add_saptawara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Saptawara</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" action="{{route('saptawara.store')}}">
          {{csrf_field()}}
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Saptawara <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="saptawara_name" name="saptawara_name" required="required" value="" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-8 col-sm-4 col-sm-offset-8">
              <button type="submit" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              <button id="send" type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Add Sub District -->
<!-- Modal Edit Province-->
<div class="modal fade" id="modal_edit_saptawara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit Saptawara</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" id="form_edit_saptawara" >
          {{csrf_field()}}
          <input type="hidden" name="_method" value="PUT">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Saptawara <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="saptawara" name="saptawara_name" required="required" value="" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-8 col-sm-4 col-sm-offset-8">
              <button type="submit" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              <button id="send" type="submit" class="btn btn-success">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Edit Province -->
<!-- Modal Confirmation Delete-->
  <div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Confirmation Delete saptawara</h5>
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
                  <form method="POST" enctype="multipart/form-data" id="form_delete_saptawara" >
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

    //Modal Edit Kecamatan
    $('#modal_edit_saptawara').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var saptawara_name = button.data('saptawara_name') // Extract info from data-* attributes
      var saptawara_id = button.data('saptawara_id')
      var saptawara_id = button.data('saptawara_id')
      var province_id = button.data('province_id')

      var action = '/admin/saptawara/'+saptawara_id;

      var modal = $(this)
      modal.find('.modal-body #saptawara_id').val(saptawara_id)
      modal.find('.modal-body #saptawara').val(saptawara_name)
      $('#form_edit_saptawara').attr('action', action);
    })

    //Modal Delete Kecamatan
    $('#modal_confirm_delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var saptawara_name = button.data('saptawara_name')
      var saptawara_id = button.data('saptawara_id')

      var modal = $(this)
      modal.find('.modal-body #label_delete').text('Apakah anda yakin ingin menghapus Kecamatan : '+ saptawara_name)
      $('#form_delete_saptawara').attr('action', "/admin/saptawara/"+saptawara_id);
    })
  </script>
@endsection