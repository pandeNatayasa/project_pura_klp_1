@extends('admin.layouts.layout_utama')

@section('add_css')
	<!-- Page level plugin CSS-->
   <link rel="stylesheet" type="text/css" href="{{asset('public_admin/vendors/datatables/datatables.min.css')}}">
@endsection

@section('menu_list_sub_district')
	current-page
@endsection

@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Sub District | Administrator <!-- <small>sub title</small> --></h2>
          <ul class="nav navbar-right panel_toolbox">
            <button class="btn btn-primary " data-toggle="modal"  name="add_city" data-target="#modal_add_sub_district" data-toggle="tooltip" data-placement="right" title="Add">Add City</button>
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
                      <th>Sub-District</th>
                    	<th>City/District</th>
                    	<th>Province</th>
                    	<th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1;?>
                    @foreach($sub_districts as $data)
                  	<tr>
                  		<td>{{$no++}}</td>
                      <td>{{$data->sub_district_name}}</td>
                  		<td>{{$data->City->city_name}}</td>
                  		<td>{{$data->City->Province->province_name}}</td>
                  		<td>
                        <!-- Edit Province -->
                        {{csrf_field()}}
                  			<button class="btn btn-primary " data-sub_district_id="{{$data->id}}" data-sub_district_name="{{$data->sub_district_name}}" data-city_id="{{$data->city_id}}" data-province_id="{{$data->City->province_id}}" data-toggle="modal"  name="edit_city" data-target="#modal_edit_sub_district" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-edit"></i></button>
                        <button href="" class="btn btn-danger " data-sub_district_id="{{$data->id}}" data-sub_district_name="{{$data->sub_district_name}}" data-toggle="modal"  name="conrifm_delete" data-target="#modal_confirm_delete" data-toggle="tooltip" data-placement="right" title="Hapus"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="modal_add_sub_district" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Sub-District</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" action="{{route('sub-district.store')}}">
          {{csrf_field()}}
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Province <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="province" class="form-control dynamic" id="province" name="province" data-dependent="city">
                <option value="" disabled selected>Pilih Provinsi</option>
                @foreach($provinces as $data)
                  <option id="{{$data->id}}" value="{{$data->id}}">{{$data->province_name}}</option> 
                @endforeach
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="city" class="form-control" name="city">
                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sub-District <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="sub_district_name" name="sub_district_name" required="required" value="" class="form-control col-md-7 col-xs-12">
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
<div class="modal fade" id="modal_edit_sub_district" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit Sub-District</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">                         
        <form class="form-horizontal form-label-left" novalidate method="POST" id="form_edit_sub_district" >
          {{csrf_field()}}
          <input type="hidden" name="_method" value="PUT">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Province <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control dynamic_in_edit" id="edit_in_province" name="province" data-dependent="city">
                <option value="" disabled selected>Pilih Provinsi</option>
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="edit_in_city" class="form-control" name="city">
                <option value="" disabled selected>Pilih Kabupaten/Kota</option>
              </select>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sub-District <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="sub_district" name="sub_district_name" required="required" value="" class="form-control col-md-7 col-xs-12">
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
            <h5 class="modal-title" >Confirmation Delete Sub-District</h5>
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
                  <form method="POST" enctype="multipart/form-data" id="form_delete_sub_district" >
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

    $(document).ready(function(){
      $('.dynamic').change(function(){
        if($(this).val() != ''){
          
          var value = $(this).val();
          var dependent = $(this).data('dependent');

          console.log(dependent);

          var _token = $('input[name="_token"]').val();
          $.ajax({
            url:"{{route('fetch_data')}}",
            method:"POST",
            data:{value:value,_token:_token,dependent:dependent},
            success:function(result)
            {
              $('#city').html(result);
            }
          })  
        }
      });

      $('.dynamic_in_edit').change(function(){
        if($(this).val() != ''){
          
          var value = $(this).val();
          var dependent = $(this).data('dependent');

          console.log(dependent);

          var _token = $('input[name="_token"]').val();
          $.ajax({
            url:"{{route('fetch_location_sub_district')}}",
            method:"POST",
            data:{value:value,_token:_token,dependent:dependent},
            success:function(result)
            {
              $('#edit_in_city').html(result);
            }
          })  
        }
      });
    });

    //Modal Edit Kecamatan
    $('#modal_edit_sub_district').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var sub_district_name = button.data('sub_district_name') // Extract info from data-* attributes
      var sub_district_id = button.data('sub_district_id')
      var city_id = button.data('city_id')
      var province_id = button.data('province_id')

      var _token = $('input[name="_token"]').val();

      $.ajax({
        url:"{{route('fetch_province_in_edit')}}",
        method:"POST",
        data:{_token:_token,province_id:province_id},
        success:function(result)
        {
          $('#edit_in_province').html(result);
        },
        error:function(e) {
          console.log(e);
        }
      });        

      $.ajax({
        url:"{{route('fetch_city_in_edit')}}",
        method:"POST",
        data:{_token:_token,sub_district_id:sub_district_id,category:'city'},
        success:function(result)
        {
          $('#edit_in_city').html(result);
        },
        error:function(e) {
          console.log(e);
        }
      });

      var action = '/admin/sub-district/'+sub_district_id;

      var modal = $(this)
      modal.find('.modal-body #sub_district_id').val(sub_district_id)
      modal.find('.modal-body #sub_district').val(sub_district_name)
      $('#form_edit_sub_district').attr('action', action);
    })

    //Modal Delete Kecamatan
    $('#modal_confirm_delete').on('show.bs.modal', function (event) {
      console.log('Delete City begin');

      var button = $(event.relatedTarget) 
      var sub_district_name = button.data('sub_district_name')
      var sub_district_id = button.data('sub_district_id')

      var modal = $(this)
      modal.find('.modal-body #label_delete').text('Apakah anda yakin ingin menghapus Kecamatan : '+ sub_district_name)
      $('#form_delete_sub_district').attr('action', "/admin/sub-district/"+sub_district_id);
    })
  </script>
@endsection