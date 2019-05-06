@extends('admin.layouts.layout_utama')

@section('add_css')
	<!-- Page level plugin CSS-->
   <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/datatables/datatables.min.css')}}">
@endsection

@section('menu_list_city')
	current-page
@endsection

@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>List City | Administrator <!-- <small>sub title</small> --></h2>
          <ul class="nav navbar-right panel_toolbox">
            <button class="btn btn-primary " data-toggle="modal" name="add_city" data-target="#modal_add_city" data-toggle="tooltip" data-placement="right" title="Add">Add City</button>
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
                    	<th>City/District</th>
                    	<th>Province</th>
                    	<th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1;?>
                    @foreach($cities as $data)
                  	<tr>
                  		<td>{{$no++}}</td>
                  		<td>{{$data->city_name}}</td>
                  		<td>{{$data->Province->province_name}}</td>
                  		<td>
                        <!-- Edit Province -->
                  			<button class="btn btn-primary " data-city_id="{{$data->id}}" data-city_name="{{$data->city_name}}" data-province_id="{{$data->province_id}}" data-toggle="modal"  name="edit_city" data-target="#modal_edit_city" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-edit"></i></button>
                        <!-- End of Edit Province -->
                        <button href="" class="btn btn-danger " data-city_id="{{$data->id}}" data-city_name="{{$data->city_name}}" data-toggle="modal"  name="conrifm_delete" data-target="#modal_confirm_delete" data-toggle="tooltip" data-placement="right" title="Hapus"><i class="fa fa-trash"></i></button>
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
<!-- Modal to Add New City-->
<div class="modal fade" id="modal_add_city" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add New City/District</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" action="{{route('city.store')}}">
          {{csrf_field()}}
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Province <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="province" name="province">
                @foreach($provinces as $data)
                  <option id="{{$data->id}}" value="{{$data->id}}">{{$data->province_name}}</option> 
                @endforeach
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">City/District <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="city" name="city" required="required" value="" class="form-control col-md-7 col-xs-12">
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
<!-- End of Modal to Add City-->
<!-- Modal City Edited-->
<div class="modal fade" id="modal_edit_city" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit City/District</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" >
          {{csrf_field()}}
          <input type="hidden" id="city_id" name="city_id" value="">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Province <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="province" name="province">
                @foreach($provinces as $data)
                  <option id="{{$data->id}}" value="{{$data->id}}">{{$data->province_name}}</option> 
                @endforeach
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">City/District <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="city" name="city" required="required" value="" class="form-control col-md-7 col-xs-12">
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
<!-- End of Modal City Edited -->
<!-- Modal Confirmation Delete-->
  <div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Confirmation Delete City</h5>
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
                    <input type="hidden" id="city_id_delete" name="city_id_delete" value="">
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
      $('#modal_edit_city').on('show.bs.modal', function (event) {
        console.log('Edit City begin');

        var button = $(event.relatedTarget) // Button that triggered the modal
        var city_name = button.data('city_name') // Extract info from data-* attributes
        var province_id = button.data('province_id')
        var city_id = button.data('city_id')

        var modal = $(this)
        modal.find('.modal-body #city_id').val(city_id)
        modal.find('.modal-body #city').val(city_name)
        modal.find('.modal-body #province #'+province_id).attr('selected',true)
      })

      //Modal Delete Province
      $('#modal_confirm_delete').on('show.bs.modal', function (event) {
        console.log('Delete City begin');

        var button = $(event.relatedTarget) 
        var city_name = button.data('city_name')
        var city_id = button.data('city_id')

        var modal = $(this)
        modal.find('.modal-body #label_delete').text('Apakah anda yakin ingin menghapus kota : '+ city_name)
        modal.find('.modal-body #city_id_delete').val(city_id)
      })
    </script>
@endsection