@extends('admin.layouts.layout_utama')

@section('add_css')
	<!-- Page level plugin CSS-->
   <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/datatables/datatables.min.css')}}">
@endsection

@section('menu_list_province')
	current-page
@endsection

@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Province | Administrator <!-- <small>sub title</small> --></h2>
          <ul class="nav navbar-right panel_toolbox">
            <button class="btn btn-primary" data-toggle="modal"  name="add_new_province" data-target="#modal_add_new_province" data-toggle="tooltip" data-placement="right">Add New Province</button>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <!-- isi data -->
          <div class="card mb-3">
            @if($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{$message}}</p>
              </div>
            @endif

            @if($message = Session::get('warning'))
              <div class="alert alert-warning">
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
                    	<th>Province</th>
                    	<th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1;?>
                    @foreach($provinces as $data)
                  	<tr>
                  		<td>{{$no++}}</td>
                  		<td>{{$data->province_name}}</td>
                  		<td>
                        <!-- Edit Province -->
                  			<button class="btn btn-primary" data-province_id="{{$data->id}}" data-province_name="{{$data->province_name}}" data-toggle="modal" name="edit_province" data-target="#modal_edit_province" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-edit"></i></button>
                        <!-- End of Edit Province -->
                        <button href="" class="btn btn-danger " data-province_id="{{$data->id}}" data-province_name="{{$data->province_name}}" data-toggle="modal"  name="conrifm_delete" data-target="#modal_confirm_delete" data-toggle="tooltip" data-placement="right" title="Hapus"><i class="fa fa-trash"></i></button>
                          
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
<!-- Modal Add New Province-->
<div class="modal fade" id="modal_add_new_province" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add New Province</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" action="{{route('province.store')}}">
          {{csrf_field()}}
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">State/Province <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="province" name="province" required="required" placeholder="ex: Bali" class="form-control col-md-7 col-xs-12">
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
<!-- End of Modal Add New Province -->
<!-- Modal Edit Province-->
<div class="modal fade" id="modal_edit_province" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit Province</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST">
          {{csrf_field()}}
          <input type="hidden" name="id_provinsi" id="id_provinsi" value="">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">State/Province <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="edit_province" name="edit_province" required="required" value="" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-8 col-sm-4 col-sm-offset-8">
              <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
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
          <h5 class="modal-title" >Confirmation Delete Province</h5>
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
                <form method="POST" enctype="multipart/form-data" >
                {{csrf_field()}}
                  <input type="hidden" id="id_provinsi_delete" name="id_provinsi_delete" value="">
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
	<script type="text/javascript" charset="utf8" src="{{asset('admin/vendors/datatables/datatables.min.js')}}"></script>

  <!-- validator -->
  <script src="{{asset('admin/vendors/validator/validator.js')}}"></script>

    <script type="text/javascript">
      $(document).ready( function () {
        $('#data').DataTable();
      } );

      //Modal Edit Province
      $('#modal_edit_province').on('show.bs.modal', function (event) {
        console.log('Edit Province begin');

        var button = $(event.relatedTarget) // Button that triggered the modal
        var province_name = button.data('province_name') // Extract info from data-* attributes
        var province_id = button.data('province_id')

        console.log(province_name);

        var modal = $(this)
        modal.find('.modal-body #edit_province').val(province_name)
        modal.find('.modal-body #id_provinsi').val(province_id)
      })

      //Modal Delete Province
      $('#modal_confirm_delete').on('show.bs.modal', function (event) {
        console.log('Delete Province begin');

        var button = $(event.relatedTarget) // Button that triggered the modal
        var province_name = button.data('province_name') // Extract info from data-* attributes
        var province_id = button.data('province_id')

        var modal = $(this)
        modal.find('.modal-body #label_delete').text('Apakah anda yakin ingin menghapus provinsi : '+ province_name)
        modal.find('.modal-body #id_provinsi_delete').val(province_id)
      })
    </script>
@endsection