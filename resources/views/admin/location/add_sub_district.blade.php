@extends('admin.layouts.layout_utama')

@section('menu_add_sub_district')
	current-page
@endsection

@section('content')
	<!-- page content -->
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Sub-District | Administrator <!-- <small>sub title</small> --></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate method="POST" action="{{route('add_sub_district_post')}}">
                    {{csrf_field()}}
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
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Province <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="country" class="form-control dynamic" required="required" id="country" data-dependent="city">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach($daftar_provinsi as $data)
                              <option value="{{$data->id}}">{{$data->nama_provinsi}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="city" name="city" class="form-control" required="required">
                            <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Sub-District <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="sub_district" name="sub_district" required="required" placeholder="ex: Banyuwangi" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        <!-- /page content -->
@endsection

@section('add_js')
		<!-- validator -->
  <script src="{{asset('admin/vendors/validator/validator.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.dynamic').change(function(){
        if($(this).val() != ''){
          
          var value = $(this).val();
          var dependent = $(this).data('dependent');
          
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url:"{{route('fetch_city')}}",
            method:"POST",
            data:{value:value,_token:_token,dependent:dependent},
            success:function(result)
            {
              $('#'+dependent).html(result);
            }
          })  
        }
      });
    });
  </script>
@endsection
