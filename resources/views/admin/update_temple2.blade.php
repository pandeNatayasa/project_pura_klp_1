@extends('layouts.user')

@section('css')
  <!--Dropdzone-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
  <link rel="stylesheet" href="{{asset('css/user.css')}}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
  crossorigin=""></script>
  <script type="text/javascript">
    function delete_element(id) {
      // console.log(id);
      var number_of_card_element = document.getElementById('number_of_card_element').value;
      var max_number_of_card_element = document.getElementById('max_number_of_card_element').value;

      if (number_of_card_element > 1) {
        $('#card_element_'+id).slideUp('medium', function() {
          $(this).remove();
        });
        number_of_card_element--;
        $('#number_of_card_element').val(number_of_card_element);

        // If card_element deleted is max number of card element, then max_number_of_card_element -1
        if (id == max_number_of_card_element) {
          max_number_of_card_element--;
          $('#max_number_of_card_element').val(max_number_of_card_element);
        }
      }
    }

    function enable_add_element() {
      // This is javascript to enable button add element when all input not null
      var element_name = document.getElementById('inputElementName').value;
      var element_god_name = document.getElementById('inputGodName').value;
      var element_description = document.getElementById('inputElementDescription').value;
      var element_position = document.getElementById('inputElementPosition').value;

      // Loop to get all input image because image can more than one
      // First get total of input image element
      var total_image_element = document.getElementById('total_semua_foto_elemen').value;
      var src_image = new Array(total_image_element)
      for (var i = 1; i <= total_image_element; i++) {
        // Get src image every input image element
        src_image[i] = document.getElementById("view_element_image_"+i).src;   
      }

      // Create variable to identified all input element image is required
      var check = 1; // 0 is have input null, 1 is all input element image is required
      for (var i = 1; i <= total_image_element; i++) {
        if (!src_image[i]) {
          check = 0;
        }  
      }

      if (element_name && element_god_name && element_description && element_position && check==1) {
        document.getElementById("btn_add_element").disabled = false;
      }else{
        document.getElementById("btn_add_element").disabled = true;
      }  
    }

    function enable_edit_element() {
      // This is javascript to enable button add element when all input not null
      var element_name = document.getElementById('inputEditElementName').value;
      var element_god_name = document.getElementById('inputEditGodName').value;
      var element_description = document.getElementById('inputEditElementDescription').value;
      var element_position = document.getElementById('inputEditElementPosition').value;
      // var src_image = document.getElementById("view_edit_element_image_1").src; 

      // Loop to get all input image because image can more than one
      // First get total of input image element in modal edit
      var total_image_element = document.getElementById('total_semua_foto_element_in_modal_edit').value;
      var src_image = new Array(total_image_element)
      for (var i = 1; i <= total_image_element; i++) {
        // Get src image every input image element
        src_image[i] = document.getElementById("view_edit_element_image_"+i).src;   
      }

      // Create variable to identified all input element image is required
      var check = 1; // 0 is have input null, 1 is all input element image is required
      for (var i = 1; i <= total_image_element; i++) {
        if (!src_image[i]) {
          check = 0;
        }  
      }

      if (element_name && element_god_name && element_description && element_position && check == 1) {
        document.getElementById("btn_edit_element_in_modal").disabled = false;
      }else{
        document.getElementById("btn_edit_element_in_modal").disabled = true;
      }  
    }

  </script>
@endsection

@section('context')
<div id="addlocation" class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <a href="@if($temple->validate_status == 0) {{ route('show_list_temple_validate') }} @else {{ route('show_list_temple') }} @endif" style="color:black"><i class="fa fa-arrow-left"></i></a>
                {{-- window.history.go(-1); return false; --}}
            </div>
            <div class="text-center">
                UPDATE PURA
            </div> 
        </div>  
        <div class="card-body">
            <div class="container col-md-10">
                <!-- Form List Gambar-->
                {{-- <form class="dz-clickable mb-5 dropzone"  id="addImages" method="POST" action="{{route('temple.store')}}">
                  <div class="dz-default dz-message m-5"><span>Drop/Click here to upload images</span></div>
                </form> --}}
                <form class="form-horizontal form-label-left"  enctype="multipart/form-data"  accept-charset="utf-8" method="POST" action="{{route('admin.update_temple',$temple->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @if($message =    Session::get('success'))
                      <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p>{{$message}}</p>
                      </div>
                    @endif

                    @if($message = Session::get('warning'))
                      <div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p>{{$message}}</p>
                      </div>
                    @endif
                    <!-- Form Nama Pura-->
                    <div class="form-group row">
                        <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Pura<span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control " id="temple_name" name="temple_name" value="{{ $temple->temple_name }}" required>
                        </div>
                    </div>

                    <!-- Form Jenis Pura-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Jenis Pura<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control " required="required" id="temple_type_id" name="temple_type_id">
                            <option value="" disabled selected>Pilih Jenis Pura</option>
                            @foreach($type as $data)
                              @if ($data->id == $temple->TempleType->id)
                                <option value="{{$data->id}}" selected>{{$data->type_name}}</option>
                              @else
                                <option value="{{$data->id}}">{{$data->type_name}}</option>  
                              @endif
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Form Pemangku-->
                    <div class="form-group row">
                        <label for="inputNamePemangku" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Pemangku<span class="required">*</span></label>
                        <div class="col-10 col-sm-8 col-md-8 col-xs-12 pr-0">
                            <input type="text" class="form-control" id="priest_name" name="priest_name" required value="{{ $temple->priest_name }}">
                        </div>
                        <div class="col-2 col-sm-1 text-center">
                            <button id="btn-detail-pemangku" class="btn btn-defaultp-0" type="button"> <i class="fa fa-chevron-up"></i></button>
                        </div>
                    </div>
                    
                    <!-- Form Detail Pemangku-->
                    <div id="detail-pemangku" class="form-group row col-md-12">
                        <span class="col-sm-3 col-md-3"></span>
                        <label for="inputAlamatPemangku" class="col-sm-2 col-md-2 col-xs-12 col-form-label">Alamat<span class="required">*</span></label>
                        <div class="col-sm-7 col-md-7 col-xs-12 mb-2">
                            <input type="text" class="form-control" id="address_priest" name="address_priest" required value="{{ $temple->priest_address }}">
                        </div>
                        <br/>
                        <span class="col-sm-3 col-md-3"></span>
                        <label for="inputNoTelp" class="col-sm-2 col-md-2 col-xs-12 col-form-label">No Telp<span class="required">*</span></label>
                        <div class="col-sm-7 col-md-7 col-xs-12">
                            <input type="text" class="form-control" id="priest_phone" name="priest_phone" required value="{{ $temple->priest_phone }}">
                        </div>
                    </div>

                    <!-- Form Alamat Pura-->
                    <div class="form-group row">
                        <label for="inputAlamatPura" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Alamat Pura <span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12 pr-0">
                            <input type="text" class="form-control" id="inputAlamatPura" name="address" required value="{{ $temple->address }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputLatitude" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Latitude <span class="required">*</span></label>
                        <div class="col-10 col-sm-8 col-md-8 col-xs-12">
                            <input value="{{ $temple->latitude }}" type="text"  class="form-control " name="latitude" id="latitude" value="" required onkeypress="return false;" >
                        </div>
                        <div class="col-2 col-sm-1 text-center">
                            <button data-toggle="modal" data-target="#modal_add_location" class="btn btn-default bg-white p-0"> <img src="/user_img/maps.png" width="35" alt="">
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAlamatPura" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Longitude <span class="required">*</span></label>
                        <div class="col-10 col-sm-8 col-md-8 col-xs-12">
                            <input value="{{ $temple->longitude }}" type="text" class="form-control " name="longitude" id="longitude" value="" required onkeypress="return false;" >  
                        </div>
                    </div>

                    <!-- Form Provinsi-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Provinsi<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control dynamic" required="required" id="province" name="province" data-dependent="city">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach($province as $data)
                              @if ($data->id == $temple->SubDistrict->City->province_id)
                                <option value="{{$data->id}}" selected>{{$data->province_name}}</option>  
                              @else
                                <option value="{{$data->id}}">{{$data->province_name}}</option>
                              @endif
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Form Kabupaten/Kota-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Kota <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <select class="form-control dynamic" required="required" id="city" name="city" data-dependent="subdistrict">
                              <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                              @foreach($cities as $data)
                                @if ($data->id == $temple->SubDistrict->city_id)
                                  <option value="{{$data->id}}" selected>{{$data->city_name}}</option>  
                                @else
                                  <option value="{{$data->id}}">{{$data->city_name}}</option>
                                @endif
                              @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Form Kecamatan-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Kecamatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <select class="form-control" required="required" id="subdistrict" name="sub_district">
                              <option value="" disabled selected>Pilih Kecamatan</option>
                              @foreach($sub_districts as $data)
                                @if ($data->id == $temple->sub_district_id)
                                  <option value="{{$data->id}}" selected>{{$data->sub_district_name}}</option>  
                                @else
                                  <option value="{{$data->id}}">{{$data->sub_district_name}}</option>
                                @endif
                              @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Form Odalan-->
                    <div class="row form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pinanggal Odalan <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12 inline-group">
                        <!-- Tab links -->
                        <div class="tab">
                          <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_sasih" value="sasih" onclick="openOdalanType(event, 'Sasih')" @if ($temple->odalan_type=="sasih") checked @endif > Sasih</div>
                          <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_wuku" value="wuku" onclick="openOdalanType(event, 'Wuku')" @if ($temple->odalan_type=="wuku") checked @endif > Wuku</div>
                          <!-- <button class="tablinks" onclick="openCity(event, 'Sasih')">Sasih</button>
                          <button class="tablinks" onclick="openCity(event, 'Wuku')">Wuku</button> -->
                        </div>  
                        <!-- Tab content -->
                        <div id="Sasih" class="tabcontent">
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Rahinan <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <select id="rahinan" name="rahinan" class="form-control" >
                                <option value="" disabled selected>Pilih Hari Rahinan</option>
                                @if ($temple->odalan_type=="sasih")
                                  aaaaaaaaaaaaaa
                                  @foreach($rahinan as $data)
                                    {{ $data->id }} , {{ $odalan->rahinan_id }}
                                    @if ($data->id == $odalan->rahinan_id)
                                      <option value="{{$data->id}}" selected>{{$data->rahinan_name}}</option>
                                    @else
                                      <option value="{{$data->id}}">{{$data->rahinan_name}}</option>
                                    @endif
                                  @endforeach
                                @else
                                  @foreach($rahinan as $data)
                                    <option value="{{$data->id}}">{{$data->rahinan_name}}</option>
                                  @endforeach
                                @endif
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Sasih <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <select id="sasih" name="sasih" class="form-control" >
                                <option value="" disabled selected>Pilih Sasih</option>
                                @if ($temple->odalan_type=="sasih")
                                  @foreach($sasih as $data)
                                    @if ($data->id == $odalan->sasih_id)
                                      <option value="{{$data->id}}" selected>{{$data->sasih_name}}</option>
                                    @else
                                      <option value="{{$data->id}}">{{$data->sasih_name}}</option>
                                    @endif
                                  @endforeach
                                @else
                                  @foreach($sasih as $data)
                                    <option value="{{$data->id}}">{{$data->sasih_name}}</option>
                                  @endforeach
                                @endif
                              </select>
                            </div>
                          </div>
                        </div>
                        <div id="Wuku" class="tabcontent">
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Samptawara <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <select id="saptawara" name="saptawara" class="form-control" >
                                <option value="" disabled selected>Pilih Saptawara</option>
                                @if ($temple->odalan_type=="wuku")
                                  @foreach($saptawara as $data)
                                    @if ($data->id == $odalan->saptawara_id)
                                      <option value="{{$data->id}}" selected>{{$data->saptawara_name}}</option>
                                    @else
                                      <option value="{{$data->id}}" >{{$data->saptawara_name}}</option>
                                    @endif
                                  @endforeach  
                                @else
                                  @foreach($saptawara as $data)
                                    <option value="{{$data->id}}" >{{$data->saptawara_name}}</option>
                                  @endforeach  
                                @endif
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Pancawara <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <select id="pancawara" name="pancawara" class="form-control" >
                                <option value="" disabled selected>Pilih Pancawara</option>
                                @if ($temple->odalan_type=="wuku")
                                  @foreach($pancawara as $data)
                                    @if ($data->id == $odalan->pancawara_id)
                                      <option value="{{$data->id}}" selected>{{$data->pancawara_name}}</option>
                                    @else
                                      <option value="{{$data->id}}" >{{$data->pancawara_name}}</option>
                                    @endif
                                  @endforeach  
                                @else
                                  @foreach($pancawara as $data)
                                    <option value="{{$data->id}}" >{{$data->pancawara_name}}</option>
                                  @endforeach  
                                @endif
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Wuku <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <select id="wuku" name="wuku" class="form-control" >
                                <option value="" disabled selected>Pilih Wuku</option>
                                @if ($temple->odalan_type=="wuku")
                                  @foreach($wuku as $data)
                                    @if ($data->id == $odalan->wuku_id)
                                      <option value="{{$data->id}}" selected>{{$data->wuku_name}}</option>
                                    @else
                                      <option value="{{$data->id}}">{{$data->wuku_name}}</option>
                                    @endif
                                  @endforeach  
                                @else
                                  @foreach($wuku as $data)
                                    <option value="{{$data->id}}">{{$data->wuku_name}}</option>
                                  @endforeach  
                                @endif
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Form Deskripsi Pura-->
                    <div class="form-group row">
                        <label for="inputDescription" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Sejarah<span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <textarea style="height: 150px;" type="text" class="form-control" id="inputDescription" name="description">{{ $temple->description }}</textarea>
                        </div>
                    </div>
                    @foreach ($temple_images as $data)
                      <div class="form-group row" id="tambah_foto_{{ $loop->iteration }}">
                        <label class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Foto Pura <span class="required">*</span>
                        </label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                          <div class="col-md-12 col-xs-12 " >
                            <img id="image_{{$loop->iteration}}" src="{{ asset($data->image_name) }}" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; ">
                          </div>
                          <input name="foto_pura_{{$loop->iteration}}" id="file_{{$loop->iteration}}" id_input_foto="1" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showImage.call(this)">
                          <span class="text-danger" id='width_{{$loop->iteration}}'>* Max Width: 5128 pixel</span><span class="text-danger" id='height_{{$loop->iteration}}'>, Max Height: 5128 pixel</span>
                          <span class="text-danger" id="response_{{$loop->iteration}}"></span>
                        </div>  
                      </div>
                    @endforeach
                    {{-- <div class="form-group row" id="foto">
                      <label class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Foto Pura <span class="required">*</span>
                      </label>
                      <div class="col-sm-9 col-md-9 col-xs-12">
                        <div class="col-md-12 col-xs-12 " >
                          <img id="image_1" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; ">
                        </div>
                        <input name="foto_pura_1" id="file_1" id_input_foto="1" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showImage.call(this)">
                        <span class="text-danger" id='width_1'>* Max Width: 5128 pixel</span><span class="text-danger" id='height_1'>, Max Height: 5128 pixel</span>
                        <span class="text-danger" id="response_1"></span>
                      </div>  
                    </div> --}}
                    <div style="margin-bottom: 20px;">
                      <div id="tombol_tambah_foto" class="row">
                        <input type="hidden" name="total_semua_foto" id="total_semua_foto" value="{{count($temple_images)}}">
                        <div class="col-md-3"></div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <button name="tambah_foto" class="btn btn-success" type="button" id="tambah_foto">(+) Tambah</button ><button name="hapus_foto" class="btn btn-danger" type="button" id="hapus_foto">(-) Hapus</button>  
                        </div>
                      </div>
                    </div>

                    <!-- Form Element Pura-->
                    <div class="form-group">
                        <label for="">Element<span class="required">*</span></label>
                        <br>
                        <div class="row mb-3 ">
                          <div id="btn-add-element" class="card" style="width: 16rem;height: 18rem; margin-top: 19px">
                            <button data-target="#modal_add_element" data-toggle="modal" type="button" class="btn btn-default bg-white" style="margin-top: auto; margin-bottom: auto; height: 100%; width: 100%">
                                <div class="card-body">
                                    <i class="fas fa-plus fa-3x" ></i>
                                </div>
                            </button>
                          </div>
                            <input type="hidden" name="number_of_card_element" id="number_of_card_element" value="{{ sizeof($temple_element) }}">
                            <input type="hidden" name="max_number_of_card_element" id="max_number_of_card_element" value="{{ sizeof($temple_element) }}">
                            {{-- @for ($i = 1; $i <= sizeof($temple_element) ; $i++)
                              <div class="col-sm-4" id="card_element_{{$i}}" style="margin-top: 20px;">

                                <input type="hidden" name="inputHiddenTotalElementImage_{{$i}}" id="inputHiddenTotalElementImage_{{$i}}" value="{{ $temple_element[$i]['element_name'] }}">

                                <input type="hidden" name="inputHiddenElementName_{{ $i }}" id="inputHiddenElementName_{{ $i }}" value="'+element_name+'">

                                <input type="hidden" name="inputHiddenGodName_{{ $i }}" id="inputHiddenGodName_{{ $i }}" value="'+element_god_name+'">

                                <input type="hidden" name="inputHiddenElementDescription_{{ $i }}" id="inputHiddenElementDescription_{{ $i }}" value="'+element_description+'">

                                <input type="hidden" name="inputHiddenElementPosition_{{ $i }}" id="inputHiddenElementPosition_{{ $i }}" value="'+element_position+'">

                                <div id="element" class="card">
                                  <img class="card-img-top" id="img_element_{{ $i }}" src="{{ asset($temple_element[$i]['image_name']) }}" alt="Card image cap">
                                  <div class="card-body">
                                    <h5 class="card-title" id="card_title_{{ $i }}">{{ $temple_element[$i]['element_name'] }}</h5>
                                    <p id="card_text_{{$loop->iteration}}" class="card-text"> $element->god <br>  $element->element_position }} <br> {{ @if (strlen($element->element_description) > 100) {{substr($element->element_description,0,100) }}@endif... }}</p>
                                    <div class="row ">
                                      <div class="col-sm" id="space_for_btn_edit_{{ $i }}">
                                        <button id="btn_edit_element" data-target="#modal_edit_element" data-toggle="modal" type="button" class="btn btn-primary btn-block btn-sm" data-element_name="'+element_name+'" data-element_god_name="'+element_god_name+'" data-element_description="'+element_description+'" data-element_position="'+element_position+'" data-total_image_element="'+total_image_element+'" data-card_id="{{ $i }}">Ubah</button>
                                      </div>
                                      <div class="col-sm">
                                        <button type="button" id="btn_delete_card_element_'+max_number_of_card_element+'" onclick="delete_element({{ $i }});" class="btn btn-danger btn-block btn-sm">Hapus</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endfor --}}
                            <?php $i = 0 ?>
                            @foreach ($temple_element as $element)
                              <?php $i++ ?>
                              {{-- var total_image_element = document.getElementById('total_semua_foto_elemen').value;
                                for (var i = 1; i <= total_image_element; i++) {
                                  element += '<input type="hidden" name="inputHiddenElement_'+max_number_of_card_element+'_Image_'+i+'" id="inputHiddenElement_'+max_number_of_card_element+'_Image_'+i+'" value="'+src_image[i]+'">';            
                                } 
                                // This is to make enable parsing all image in element to modal
                                for (var i = 1; i <= total_image_element; i++) {
                                  element += ' data-element_image_'+i+'="'+src_image[i]+'"';
                              }--}}
                              <div class="col-sm-4" id="card_element_{{$loop->iteration}}" style="margin-top: 20px;">

                                <input type="hidden" name="inputHiddenTotalElementImage_{{$loop->iteration}}" id="inputHiddenTotalElementImage_{{$loop->iteration}}" value="{{ sizeof($element[0]) }}">

                                <input type="hidden" name="inputHiddenElementName_{{$loop->iteration}}" id="inputHiddenElementName_{{$loop->iteration}}" value="'+element_name+'">

                                <input type="hidden" name="inputHiddenGodName_{{$loop->iteration}}" id="inputHiddenGodName_{{$loop->iteration}}" value="'+element_god_name+'">

                                <input type="hidden" name="inputHiddenElementDescription_{{$loop->iteration}}" id="inputHiddenElementDescription_{{$loop->iteration}}" value="'+element_description+'">

                                <input type="hidden" name="inputHiddenElementPosition_{{$loop->iteration}}" id="inputHiddenElementPosition_{{$loop->iteration}}" value="'+element_position+'">

                                @foreach ($element[0] as $element_image)
                                  <input type="hidden" name="inputHiddenElement_{{ $i }}_Image_{{ $loop->iteration }}" id="inputHiddenElement_{{ $i }}_Image_{{ $loop->iteration }}" value="{{ $element_image->image_name }}">
                                @endforeach

                                <div id="element" class="card">
                                  <img class="card-img-top" id="img_element_{{$loop->iteration}}" src="{{ asset($element['image_name']) }}" alt="Card image cap">
                                  <div class="card-body">
                                    <h5 class="card-title" id="card_title_{{$loop->iteration}}">{{ $element['element_name'] }}</h5>
                                    <p id="card_text_{{$loop->iteration}}" class="card-text">{{ $element['god'] }}<br> {{ $element['element_position'] }} <br> @if (strlen($element['element_description']) > 100) {{substr($element['element_description'],0,100) }}@endif...</p>
                                    <div class="row ">
                                      <div class="col-sm" id="space_for_btn_edit_{{$loop->iteration}}">
                                        <button id="btn_edit_element" data-target="#modal_edit_element" data-toggle="modal" type="button" class="btn btn-primary btn-block btn-sm" data-element_name="{{ $element['element_name'] }}" data-element_god_name="{{ $element['god'] }}" data-element_description="{{ $element['element_description'] }}" data-element_position="{{ $element['element_position'] }}" data-total_image_element="{{ sizeof($element[0]) }}" @foreach ($element[0] as $element_image) data-element_image_{{ $loop->iteration }}="/{{ $element_image->image_name }}" @endforeach data-card_id="{{$loop->iteration}}">Ubah</button>
                                      </div>
                                      <div class="col-sm">
                                        <button type="button" id="btn_delete_card_element_'+max_number_of_card_element+'" onclick="delete_element({{$loop->iteration}});" class="btn btn-danger btn-block btn-sm">Hapus</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                            {{-- <div class="col-sm-4" id="card_element_1" style="margin-top: 20px;">
                                <input type="hidden" name="inputHiddenElementImage" id="inputHiddenElementImage" value="">
                                <input type="hidden" name="inputHiddenElementName" id="inputHiddenElementName" value="">
                                <input type="hidden" name="inputHiddenGodName" id="inputHiddenGodName" value="">
                                <input type="hidden" name="inputHiddenElementDescription" id="inputHiddenElementDescription" value="">
                                <input type="hidden" name="inputHiddenElementPosition" id="inputHiddenElementPosition" value="">
                                <div id="element" class="card">
                                    <img class="card-img-top" src="/user_img/element/element1.1.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Card example</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <div class="row ">
                                            <div class="col-sm">
                                                <a href="#" class="btn btn-primary btn-block btn-sm">Ubah</a>
                                            </div>
                                            <div class="col-sm">
                                                <button type="button" class="btn btn-danger btn-block btn-sm" id="btn_delete_card_element_1" onclick="delete_element(1);">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        
                    </div>
                    
                    <!-- Button Submit-->
                    <button  type="submit" id="addTemple" class="btn btn-primary btn-block">Perbaharui</button>
                </form>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal Maps-->
<div class="modal fade" id="modal_add_location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Posisi Pada Map</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left">
            <div class="row">
                <div class=" form-group col-sm col-md ">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Latitude</label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="show_latitude" name="show_latitude" disabled placeholder="ex: 119.023365" value="" class="form-control col-md-6 col-xs-12">
                  </div>
                </div>
                <div class=" form-group col-sm col-md">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Longitude </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="show_longitude" name="show_longitude" disabled placeholder="ex: 119.023365" value="" class="form-control col-md-6 col-xs-12">
                  </div>
                </div>
            </div>
            <div class="item form-group" >
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tekan pada map ini </label>
              <div id="mymap" class="col-md-12 col-sm-12 col-xs-12">
                
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-2 col-sm-2 float-right">
                <button id="select_position" disabled type="button" class="btn btn-success btn-block" data-dismiss="modal">Pilih</button>
              </div>
            </div>
          </form>                         
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Maps -->

<!-- Modal Element-->
<div class="modal fade" id="modal_add_element" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Element Pura</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- <form action="/event-upload" class="dropzone dz-clickable mb-5" id="addImagesElement" enctype="multipart/form-data">
            <div class="dz-default dz-message m-5"><span>Drop/Click here to upload images</span></div>
          </form> --}}
          <form class="form-horizontal form-label-left">
            <div class="form-group row" id="element_image_1">
              <label class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Foto Elemen <span class="required">*</span>
              </label>
              <div class="col-sm-9 col-md-9 col-xs-12">
                <div class="col-md-12 col-xs-12 " >
                  <img id="view_element_image_1" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; ">
                </div>
                <input name="input_element_image_1" id="input_element_image_1" id_input_foto_elemen="1" status_image="add" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showElementImage.call(this);">
                <span class="text-danger" id='width_1'>* Max Width: 5128 pixel</span><span class="text-danger" id='height_1'>, Max Height: 5128 pixel</span>
                <span class="text-danger" id="response_1"></span>
              </div>  
            </div>
            <div style="margin-bottom: 20px;">
              <div id="tombol_tambah_foto_elemen" class="row">
                <input type="hidden" name="total_semua_foto_elemen" id="total_semua_foto_elemen" value="1">
                <div class="col-md-3"></div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <button name="tambah_foto_elemen" class="btn btn-success" type="button" id="tambah_foto_elemen">(+) Tambah</button ><button name="hapus_foto_elemen" class="btn btn-danger" type="button" id="hapus_foto_elemen">(-) Hapus</button>  
                </div>
              </div>
            </div>
            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Element<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " onchange="enable_add_element();" id="inputElementName" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Dewa<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputGodName" required onchange="enable_add_element();">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Deskripsi<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <textarea type="text" class="form-control " id="inputElementDescription" required onchange="enable_add_element();"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Posis Element<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputElementPosition" required onchange="enable_add_element();">
                </div>
            </div>

            <div class="float-right">
              <button class="btn btn-success" disabled type="button" id="btn_add_element" data-dismiss="modal" >Tambah Element</button>
            </div>
          </form>                         
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Element -->

<!-- Modal Edit Element-->
<div class="modal fade" id="modal_edit_element" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Edit Element Pura</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- <form action="/event-upload" class="dropzone dz-clickable mb-5" id="addImagesElement" enctype="multipart/form-data">
            <div class="dz-default dz-message m-5"><span>Drop/Click here to upload images</span></div>
          </form> --}}
          <form class="form-horizontal form-label-left">
            <input type="hidden" name="card_id_in_modal" id="card_id_in_modal">
            <div class="form-group row" id="element_image_1">
              <label class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Foto Elemen <span class="required">*</span>
              </label>
              <div class="col-sm-9 col-md-9 col-xs-12">
                <div class="col-md-12 col-xs-12 " >
                  <img id="view_edit_element_image_1" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; ">
                </div>
                <input name="input_edit_element_image_1" id="input_edit_element_image_1" id_input_foto_elemen="1" status_image="edit" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showElementImage.call(this);">
                <span class="text-danger" id='width_1'>* Max Width: 5128 pixel</span><span class="text-danger" id='height_1'>, Max Height: 5128 pixel</span>
                <span class="text-danger" id="response_1"></span>
              </div>  
            </div>
            <div style="margin-bottom: 20px;">
              <div id="tombol_tambah_foto_element_in_modal_edit" class="row">
                <input type="hidden" name="total_semua_foto_element_in_modal_edit" id="total_semua_foto_element_in_modal_edit" value="1">
                <div class="col-md-3"></div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <button name="tambah_foto_element_in_modal_edit" class="btn btn-success" type="button" id="tambah_foto_element_in_modal_edit">(+) Tambah</button ><button name="hapus_foto_element_in_modal_edit" class="btn btn-danger" type="button" id="hapus_foto_element_in_modal_edit">(-) Hapus</button>  
                </div>
              </div>
            </div>
            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Element<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " onchange="enable_edit_element();" id="inputEditElementName" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Dewa<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputEditGodName" required onchange="enable_edit_element();">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Deskripsi<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <textarea type="text" class="form-control " id="inputEditElementDescription" required onchange="enable_edit_element();"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Posis Element<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputEditElementPosition" required onchange="enable_edit_element();">
                </div>
            </div>

            <div class="float-right">
              <button class="btn btn-success" disabled type="button" id="btn_edit_element_in_modal" data-dismiss="modal" >Edit Element</button>
            </div>
          </form>                         
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Edit Element -->
    
@endsection

@section('script')
    <script src="/js/add_temple.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
     Dropzone.options.addImages = {
        autoProcessQueue: false,
        url: '{{route("temple.store")}}',
        paramName: 'file',
        uploadMultiple: true,
        init: function () {

            var myDropzone = this;

            // Update selector to match your button
            $("#adddTemple").on("click", function(e) {
              // Make sure that the form isn't actually being sent.
              e.preventDefault();
              e.stopPropagation();
              myDropzone.processQueue();
            });

            this.on('sending', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#addImages').serializeArray();
                $.each(data, function(key, el) {
                    formData.append(el.name, el.value);
                });
                // console.log(data)
            });
        }
    }

    // Javascript to show image are selected
      function showImage(){
        if( this.files && this.files[0]){
          var obj = new FileReader();
          var total_foto = document.getElementById('total_semua_foto').value;
          // console.log(total_foto);

          var id_input_foto = $(this).attr('id_input_foto');

          obj.onload = function(data){
            // console.log(data);
            var image = document.getElementById("image_"+id_input_foto);
            
            // console.log(id_input_foto);

            image.src = data.target.result;
            image.style.display = "block";
          }
          obj.readAsDataURL(this.files[0]);

          // Validate image size
          var _URL = window.URL || window.webkitURL;

          var total_foto = document.getElementById('total_semua_foto').value;

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
         
            $("#width_"+id_input_foto).text("*Image Width: "+imgwidth+" pixel");
            $("#height_"+id_input_foto).text(", Image Height: "+imgheight+" pixel");

            if(imgwidth >= maxwidth || imgheight >= maxheight){
       
              $("#response_"+id_input_foto).text(", Image size must be max Size : "+maxwidth+" X "+maxheight+" pixel");
              $('#file_'+id_input_foto).val('');
            }else{
              $("#response_"+id_input_foto).text("");
            }
          }

          img.onerror = function() {
            $("#response_"+id_input_foto).text("not a valid file: " + file.type);
          }
        }
      }
      // End of show image


      $(document).ready(function(){
       // Javascript to make dymanic input of image temple
       var total_foto = document.getElementById('total_semua_foto').value;
       function tambah_foto(){
        total_foto++;

        var isi = '<div class="form-group row" id="tambah_foto_'+total_foto+'">';
        isi +='<label class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Foto Pura <span class="required">*</span></label><div class="col-sm-9 col-md-9 col-xs-12"><div class="col-md-12 col-xs-12 " ><img id="image_'+total_foto+'" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; "></div><input name="foto_pura_'+total_foto+'" id="file_'+total_foto+'" id_input_foto="'+total_foto+'" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showImage.call(this)"><span class="text-danger" id="width_'+total_foto+'">* Max Width: 5128 pixel</span><span class="text-danger" id="height_'+total_foto+'">, Max Height: 5128 pixel</span><span class="text-danger" id="response_'+total_foto+'"></span></div>';
        isi +='</div>';

        $('#tombol_tambah_foto').before(isi);
        $('#tambah_foto_'+total_foto).slideDown('medium');

        $('#total_semua_foto').val(total_foto);
       }

       function hapus_foto(){
          if (total_foto >1) {
            $('#tambah_foto_'+total_foto).slideUp('medium', function(){
              $(this).remove();
            });
            total_foto--;
            $('#total_semua_foto').val(total_foto);  
          }
          
       }

       $('#tambah_foto').click(function(){
          tambah_foto();
       });

       $('#hapus_foto').click(function(){
          hapus_foto();
       });
      });
      // End of dynamic input of image temple

      // Javascript to make dymanic input image of element temple in modal add element
      $(document).ready(function(){
       function tambah_foto_elemen(){
        var total_foto_elemen = document.getElementById('total_semua_foto_elemen').value;
        total_foto_elemen++;

        var isi = '<div class="form-group row" id="element_image_'+total_foto_elemen+'">';
        isi +='<label class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Foto Elemen <span class="required">*</span></label><div class="col-sm-9 col-md-9 col-xs-12"><div class="col-md-12 col-xs-12 " ><img id="view_element_image_'+total_foto_elemen+'" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; "></div><input name="input_element_image_'+total_foto_elemen+'" id="input_element_image_'+total_foto_elemen+'" id_input_foto_elemen="'+total_foto_elemen+'" status_image="add" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showElementImage.call(this);"><span class="text-danger" id="width_'+total_foto_elemen+'">* Max Width: 5128 pixel</span><span class="text-danger" id="height_'+total_foto_elemen+'">, Max Height: 5128 pixel</span><span class="text-danger" id="response_'+total_foto_elemen+'"></span></div>';
        isi +='</div>';

        $('#tombol_tambah_foto_elemen').before(isi);
        $('#element_image_'+total_foto_elemen).slideDown('medium');

        $('#total_semua_foto_elemen').val(total_foto_elemen);

        // This is for update status disable of btn add element in modal add element
        enable_add_element();
       }

       function hapus_foto_elemen(){
        var total_foto_elemen = document.getElementById('total_semua_foto_elemen').value;
          if (total_foto_elemen >1) {
            $('#element_image_'+total_foto_elemen).slideUp('medium', function(){
              $(this).remove();
            });
            total_foto_elemen--;
            $('#total_semua_foto_elemen').val(total_foto_elemen);  

            // This is for update status disable of btn add element in modal add element
            enable_add_element();
          }
          
       }

       $('#tambah_foto_elemen').click(function(){
          tambah_foto_elemen();
       });

       $('#hapus_foto_elemen').click(function(){
          hapus_foto_elemen();
       });
      });
      // End of dynamic input image of element temple in modal add element

      // Javascript to make dymanic input image of element temple in modal edt element
      $(document).ready(function(){
       function tambah_foto_elemen_in_modal_edit(){
        var total_foto_elemen = document.getElementById('total_semua_foto_element_in_modal_edit').value;
        total_foto_elemen++;

        var isi = '<div class="form-group row" id="element_image_'+total_foto_elemen+'">';
        isi +='<label class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Foto Elemen <span class="required">*</span></label><div class="col-sm-9 col-md-9 col-xs-12"><div class="col-md-12 col-xs-12 " ><img id="view_edit_element_image_'+total_foto_elemen+'" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; "></div><input name="input_edit_element_image_'+total_foto_elemen+'" id="input_edit_element_image_'+total_foto_elemen+'" id_input_foto_elemen="'+total_foto_elemen+'" status_image="edit" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showElementImage.call(this);"><span class="text-danger" id="width_'+total_foto_elemen+'">* Max Width: 5128 pixel</span><span class="text-danger" id="height_'+total_foto_elemen+'">, Max Height: 5128 pixel</span><span class="text-danger" id="response_'+total_foto_elemen+'"></span></div>';
        isi +='</div>';

        $('#tombol_tambah_foto_element_in_modal_edit').before(isi);
        $('#element_image_'+total_foto_elemen).slideDown('medium');

        $('#total_semua_foto_element_in_modal_edit').val(total_foto_elemen);

        // This is for update status disable of btn add element in modal add element
        enable_edit_element();
       }

       function hapus_foto_element_in_modal_edit(){
        var total_foto_elemen = document.getElementById('total_semua_foto_element_in_modal_edit').value;
          if (total_foto_elemen >1) {
            $('#element_image_'+total_foto_elemen).slideUp('medium', function(){
              $(this).remove();
            });
            total_foto_elemen--;
            $('#total_semua_foto_element_in_modal_edit').val(total_foto_elemen);  

            // This is for update status disable of btn add element in modal add element
            enable_edit_element();
          }
          
       }

       $('#tambah_foto_element_in_modal_edit').click(function(){
          tambah_foto_elemen_in_modal_edit();
       });

       $('#hapus_foto_element_in_modal_edit').click(function(){
          hapus_foto_element_in_modal_edit();
       });
      });
      // End of dynamic input image of element temple in modal edit

      // Javascript to make dynamic card element
      $(document).ready(function(){
        function add_element(element_name, element_god_name, element_description, element_position, src_image) {
          var number_of_card_element = document.getElementById('number_of_card_element').value;
          var max_number_of_card_element = document.getElementById('max_number_of_card_element').value;
          number_of_card_element ++;
          max_number_of_card_element ++;

          var element = '<div class="col-sm-4" id="card_element_'+max_number_of_card_element+'" style="margin-top: 20px;">';

          // Loop to save all input image to input hidden
          var total_image_element = document.getElementById('total_semua_foto_elemen').value;
          for (var i = 1; i <= total_image_element; i++) {
            element += '<input type="hidden" name="inputHiddenElement_'+max_number_of_card_element+'_Image_'+i+'" id="inputHiddenElement_'+max_number_of_card_element+'_Image_'+i+'" value="'+src_image[i]+'">';            
          }

          if(element_description.length > 100){
            var description_in_card =  element_description.substr(0,100) 
            var element_description = description_in_card + "..."
          }   
          
          element += '<input type="hidden" name="inputHiddenTotalElementImage_'+max_number_of_card_element+'" id="inputHiddenTotalElementImage_'+max_number_of_card_element+'" value="'+total_image_element+'"><input type="hidden" name="inputHiddenElementName_'+max_number_of_card_element+'" id="inputHiddenElementName_'+max_number_of_card_element+'" value="'+element_name+'"><input type="hidden" name="inputHiddenGodName_'+max_number_of_card_element+'" id="inputHiddenGodName_'+max_number_of_card_element+'" value="'+element_god_name+'"><input type="hidden" name="inputHiddenElementDescription_'+max_number_of_card_element+'" id="inputHiddenElementDescription_'+max_number_of_card_element+'" value="'+element_description+'"><input type="hidden" name="inputHiddenElementPosition_'+max_number_of_card_element+'" id="inputHiddenElementPosition_'+max_number_of_card_element+'" value="'+element_position+'"><div id="element" class="card"><img class="card-img-top" id="img_element_'+max_number_of_card_element+'" src="'+src_image[1]+'" alt="Card image cap"><div class="card-body"><h5 class="card-title" id="card_title_'+max_number_of_card_element+'">'+element_name+'</h5><p id="card_text_'+max_number_of_card_element+'" class="card-text">'+element_god_name+' <br> '+element_position+' <br>'+ element_description +'</p><div class="row "><div class="col-sm" id="space_for_btn_edit_'+max_number_of_card_element+'"><button id="btn_edit_element" data-target="#modal_edit_element" data-toggle="modal" type="button" class="btn btn-primary btn-block btn-sm" data-element_name="'+element_name+'" data-element_god_name="'+element_god_name+'" data-element_description="'+element_description+'" data-element_position="'+element_position+'" data-total_image_element="'+total_image_element+'"';

          // This is to make enable parsing all image in element to modal
          for (var i = 1; i <= total_image_element; i++) {
            element += ' data-element_image_'+i+'="'+src_image[i]+'"';
          }
          
          // Concat with end of modal
          element += 'data-card_id="'+max_number_of_card_element+'">Ubah</button></div><div class="col-sm"><button type="button" id="btn_delete_card_element_'+max_number_of_card_element+'" onclick="delete_element('+max_number_of_card_element+');" class="btn btn-danger btn-block btn-sm">Hapus</button></div></div></div></div></div>';

          var position = max_number_of_card_element-1;
          if (position == 0) {
            // If card element is first of card
            $('#max_number_of_card_element').after(element); // This is mining set position element after max_number_of_card id
          }else{
            // If card element is not first of card
            $('#card_element_'+position).after(element);  // This is mining set position element after card_element id of last card
          }
          $('#card_element_'+max_number_of_card_element).slideDown('medium');

          $('#number_of_card_element').val(number_of_card_element);
          $('#max_number_of_card_element').val(max_number_of_card_element);

          // console.log("clicked");          
        }

        // This is function to add element in modal_add_element
        $('#btn_add_element').click(function(){

          var element_name = document.getElementById('inputElementName').value;
          var element_god_name = document.getElementById('inputGodName').value;
          var element_description = document.getElementById('inputElementDescription').value;
          var element_position = document.getElementById('inputElementPosition').value;

          // First get total of input image element
          // Loop to get all input image because image can more than one
          var total_image_element = document.getElementById('total_semua_foto_elemen').value;
          var src_image = new Array(total_image_element)
          for (var i = 1; i <= total_image_element; i++) {
            // Get src image every input image element
            src_image[i] = document.getElementById("view_element_image_"+i).src;   
          }
          // console.log(src_image);
          // var src_image = document.getElementById("view_element_image_1").src;

          add_element(element_name, element_god_name, element_description, element_position, src_image);

          // Clear all input in modal ad_element
          document.getElementById("btn_add_element").disabled = true;
          document.getElementById('inputElementName').value = '';
          document.getElementById('inputGodName').value = '';
          document.getElementById('inputElementDescription').value = '';
          document.getElementById('inputElementPosition').value = '';
          document.getElementById("view_element_image_1").src = '';
          document.getElementById("input_element_image_1").value = '';
          $('#modal_add_element').modal('hide');
        });

        // This is function to edit element in modal_edit_element when btn edit clicked in every card
        $('#btn_edit_element_in_modal').click(function(){
          var element_name = document.getElementById('inputEditElementName').value;
          var element_god_name = document.getElementById('inputEditGodName').value;
          var element_description = document.getElementById('inputEditElementDescription').value;
          var element_position = document.getElementById('inputEditElementPosition').value;
          var src_image = document.getElementById("view_edit_element_image_1").src;
          var card_id = document.getElementById('card_id_in_modal').value;

          // This is source code to edit inputhidden in their card element
          document.getElementById('inputHiddenElementName_'+card_id).value = element_name;
          document.getElementById('inputHiddenGodName_'+card_id).value = element_god_name;
          document.getElementById('inputHiddenElementDescription_'+card_id).value = element_description;
          document.getElementById('inputHiddenElementPosition_'+card_id).value = element_position;

          // This is source code to edit inputHidden of image in their card
          // First get total of input image element
          // Loop to get all input image because image can more than one
          var total_image_element = document.getElementById('total_semua_foto_element_in_modal_edit').value;
          var total_image_element_in_card = document.getElementById('inputHiddenTotalElementImage_'+card_id).value;
          // console.log("total_image_element : "+total_image_element);
          var src_image = new Array(total_image_element)
          for (var i = 1; i <= total_image_element; i++) {
            // Get src image every input image element
            src_image[i] = document.getElementById("view_edit_element_image_"+i).src;   
            // console.log("src_image "+i+" : "+src_image[i])

            // When add new image element in modal edit element, then add new tag input of hidden image in their card
            if (i>total_image_element_in_card) {
              // Add new tag input to save new image of element
              var newInputHiddenImage = ' <input type="hidden" name="inputHiddenElement_'+card_id+'_Image_'+i+'" id="inputHiddenElement_'+card_id+'_Image_'+i+'" value="'+src_image[i]+'">';

              $('#inputHiddenTotalElementImage_'+card_id).before(newInputHiddenImage);
            }else{
              document.getElementById('inputHiddenElement_'+card_id+'_Image_'+i).value = src_image[i];     
            }
          }
          // Delete tag input image in card when their deleted in modal edit element
          for (total_image_element_in_card; total_image_element_in_card > total_image_element; total_image_element_in_card--) {
            document.getElementById('inputHiddenElement_'+card_id+'_Image_'+total_image_element_in_card).remove();
          }
          document.getElementById('inputHiddenTotalElementImage_'+card_id).value = total_image_element;

          // This is source code to edit their card
          document.getElementById('img_element_'+card_id).src = src_image[1];
          document.getElementById('card_title_'+card_id).innerHTML = element_name;
          if(element_description.length > 100){
            var description_in_card =  element_description.substr(0,100) 
            var element_description = description_in_card + "..."
          }   
          var text = element_god_name+' <br> '+element_position+' <br> '+element_description;
          document.getElementById('card_text_'+card_id).innerHTML = text;

          var button_edit = '<button id="btn_edit_element" data-target="#modal_edit_element" data-toggle="modal" type="button" class="btn btn-primary btn-block btn-sm" data-element_name="'+element_name+'" data-element_god_name="'+element_god_name+'" data-element_description="'+element_description+'" data-element_position="'+element_position+'" data-total_image_element="'+total_image_element+'"';
          // This is to make enable parsing all image in in modal edit element to card of their element
          for (var i = 1; i <= total_image_element; i++) {
            button_edit += ' data-element_image_'+i+'="'+src_image[i]+'" ';
          }
          button_edit += ' data-card_id="'+card_id+'">Ubah</button> ';

          document.getElementById('space_for_btn_edit_'+card_id).innerHTML = button_edit;

          // console.log("card_id : "+card_id);

          // Clear all input in modal edit_element
          document.getElementById("btn_edit_element_in_modal").disabled = true;
          document.getElementById('inputEditElementName').value = '';
          document.getElementById('inputEditGodName').value = '';
          document.getElementById('inputEditElementDescription').value = '';
          document.getElementById('inputEditElementPosition').value = '';
          document.getElementById("view_edit_element_image_1").src = '';
          document.getElementById("input_edit_element_image_1").value = '';
          document.getElementById('total_semua_foto_element_in_modal_edit').value = 1;
          if (total_image_element > 1) {
            for (var i = 2; i <= total_image_element; i++) {
              // Remove another tag input image than first tag input of image
              $('#element_image_'+i).slideUp('medium', function(){
                $(this).remove();
              });
            } 
          }
          $('#modal_edit_element').modal('hide');
        });
      });
      
      // This is function to show image in modal edit and modal add element
      function showElementImage(){
        if( this.files && this.files[0]){
          var obj = new FileReader();
          // var total_foto = document.getElementById('total_semua_foto').value;
          // console.log(total_foto);

          var id_input_foto = $(this).attr('id_input_foto_elemen');
          var status_image = $(this).attr('status_image');

          obj.onload = function(data){
            
            if (status_image == 'add') {
              // This is for modal add element
              var image = document.getElementById("view_element_image_"+id_input_foto);  
            }else if(status_image == 'edit'){
              // This is for modal edit element
              var image = document.getElementById("view_edit_element_image_"+id_input_foto);  
            }

            image.src = data.target.result;
            image.style.display = "block";

            if (status_image == 'add') {
              // This is javascript to enable button add element when all input not null in modal ad element
              // Call function enable_add_element
              enable_add_element();
            }else if(status_image == 'edit'){
              // This is javascript to enable button edit element when all input not null in modal edit element
              // Call function enable_edit_element
              enable_edit_element()
            }
          }
          obj.readAsDataURL(this.files[0]);

          // Validate image size
          var _URL = window.URL || window.webkitURL;

          // var total_foto = document.getElementById('total_semua_foto').value;

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
         
            $("#width_"+id_input_foto).text("*Image Width: "+imgwidth+" pixel");
            $("#height_"+id_input_foto).text(", Image Height: "+imgheight+" pixel");

            if(imgwidth >= maxwidth || imgheight >= maxheight){
       
              $("#response_"+id_input_foto).text(", Image size must be max Size : "+maxwidth+" X "+maxheight+" pixel");
              $('#file_'+id_input_foto).val('');
            }else{
              $("#response_"+id_input_foto).text("");
            }
          }

          img.onerror = function() {
            $("#response_"+id_input_foto).text("not a valid file: " + file.type);
          }
        }
      }
      // End of show image

      //Modal Edit Element
      $('#modal_edit_element').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var element_name = button.data('element_name') // Extract info from data-* attributes
        var element_god_name = button.data('element_god_name')
        var element_description = button.data('element_description')
        var element_position = button.data('element_position')
        var card_id = button.data('card_id')
        var total_image_element = button.data('total_image_element')

        // Get all image
        var src_image = new Array(total_image_element)
        for (var i = 1; i <= total_image_element; i++) {
          // Get src image every input image element
          src_image[i] = button.data("element_image_"+i);   
        }

        // console.log("modal : "+src_image)
        
        // This is to set all input in modal edit element
        var modal = $(this)
        modal.find('.modal-body #inputEditElementName').val(element_name)
        modal.find('.modal-body #inputEditGodName').val(element_god_name)
        modal.find('.modal-body #inputEditElementDescription').val(element_description)
        modal.find('.modal-body #inputEditElementPosition').val(element_position)
        modal.find('.modal-body #card_id_in_modal').val(card_id)

        document.getElementById('view_edit_element_image_1').src = src_image[1]

        if (total_image_element > 1) {
          for (var i = 2; i <= total_image_element; i++) {
            var isi = '<div class="form-group row" id="element_image_'+i+'">';
            isi +='<label class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Foto Elemen <span class="required">*</span></label><div class="col-sm-9 col-md-9 col-xs-12"><div class="col-md-12 col-xs-12 " ><img id="view_edit_element_image_'+i+'" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; " src="'+src_image[i]+'"></div><input name="input_edit_element_image_'+i+'" id="input_edit_element_image_'+i+'" id_input_foto_elemen="'+i+'" status_image="edit" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showElementImage.call(this);"><span class="text-danger" id="width_'+i+'">* Max Width: 5128 pixel</span><span class="text-danger" id="height_'+i+'">, Max Height: 5128 pixel</span><span class="text-danger" id="response_'+i+'"></span></div>';
            isi +='</div>';

            // console.log("i : "+i);

            $('#tombol_tambah_foto_element_in_modal_edit').before(isi);
            $('#element_image_'+i).slideDown('medium');
          }
        }
        $('#total_semua_foto_element_in_modal_edit').val(total_image_element);
        // This is for update status disable of btn edit element in modal edit element
        enable_edit_element();  
        
        // This is to enable btn to save edit element
        document.getElementById("btn_edit_element_in_modal").disabled = false;
      })

      // This is to clean all input of modal add element when close the modal add element
      $('#modal_add_element').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find('#view_element_image_1').attr('src', '');

        // Remove tag input of image when more than 1
        var total_image_element = document.getElementById('total_semua_foto_elemen').value;
        var total_image_element_backup = total_image_element;
        if (total_image_element > 1) {
          for (var i = 2; i <= total_image_element; i++) {
            // Remove another tag input image than first tag input
            $('#element_image_'+i).slideUp('medium', function(){
              $(this).remove();
            });
            total_image_element_backup--;
          } 
          $('#total_semua_foto_elemen').val(total_image_element_backup);   
        }
        // console.log(total_image_element);
      })

      // This is to clean all input of modal edit element when close the modal edit element
      $('#modal_edit_element').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        
        // Remove tag input of image when more than 1 in modal edit element
        var total_image_element = document.getElementById('total_semua_foto_element_in_modal_edit').value;
        var total_image_element_backup = total_image_element;
        if (total_image_element > 1) {
          for (var i = 2; i <= total_image_element; i++) {
            // Remove another tag input image than first tag input of image
            $('#element_image_'+i).slideUp('medium', function(){
              $(this).remove();
            });
            total_image_element_backup--;
          } 
          $('#total_semua_foto_element_in_modal_edit').val(total_image_element_backup);   
        }
        document.getElementById('total_semua_foto_element_in_modal_edit').value = 1;
        $(this).find('#view_edit_element_image_1').attr('src', '');
      })
    </script>
@endsection