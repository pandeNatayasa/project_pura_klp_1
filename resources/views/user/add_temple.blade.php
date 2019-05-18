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
      var src_image = document.getElementById("view_element_image_1").src; 

      // console.log('nama element : '+element_name);
      // console.log('dewa element : '+element_god_name);
      // console.log('deskripsi element : '+element_description);
      // console.log('posisi element : '+element_position);
      // console.log('src_image : '+src_image);

      if (element_name && element_god_name && element_description && element_position && src_image) {
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
      var src_image = document.getElementById("view_edit_element_image_1").src; 

      // console.log('nama element : '+element_name);
      // console.log('dewa element : '+element_god_name);
      // console.log('deskripsi element : '+element_description);
      // console.log('posisi element : '+element_position);
      // console.log('src_image : '+src_image);

      if (element_name && element_god_name && element_description && element_position && src_image) {
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
                <a href="{{ route('user') }}" style="color:black"><i class="fa fa-arrow-left"></i></a>
                {{-- window.history.go(-1); return false; --}}
            </div>
            <div class="text-center">
                TAMBAH LOKASI PURA
            </div> 
        </div>  
        <div class="card-body">
            <div class="container col-md-10">
                <!-- Form List Gambar-->
                {{-- <form class="dz-clickable mb-5 dropzone"  id="addImages" method="POST" action="{{route('temple.store')}}">
                  <div class="dz-default dz-message m-5"><span>Drop/Click here to upload images</span></div>
                </form> --}}
                <form class="form-horizontal form-label-left"  enctype="multipart/form-data"  accept-charset="utf-8" method="POST" action="{{route('temple.store')}}">
                    {{ csrf_field() }}
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
                            <input type="text" class="form-control " id="temple_name" name="temple_name" required>
                        </div>
                    </div>

                    <!-- Form Jenis Pura-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Jenis Pura<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control " required="required" id="temple_type_id" name="temple_type_id">
                            <option value="" disabled selected>Pilih Jenis Pura</option>
                            @foreach($type as $data)
                              <option value="{{$data->id}}">{{$data->type_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Form Pemangku-->
                    <div class="form-group row">
                        <label for="inputNamePemangku" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Pemangku<span class="required">*</span></label>
                        <div class="col-10 col-sm-8 col-md-8 col-xs-12 pr-0">
                            <input type="text" class="form-control" id="priest_name" name="priest_name" required>
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
                            <input type="text" class="form-control" id="address_priest" name="address_priest" required>
                        </div>
                        <br/>
                        <span class="col-sm-3 col-md-3"></span>
                        <label for="inputNoTelp" class="col-sm-2 col-md-2 col-xs-12 col-form-label">No Telp<span class="required">*</span></label>
                        <div class="col-sm-7 col-md-7 col-xs-12">
                            <input type="text" class="form-control" id="priest_phone" name="priest_phone" required>
                        </div>
                    </div>

                    <!-- Form Alamat Pura-->
                    <div class="form-group row">
                        <label for="inputAlamatPura" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Alamat Pura <span class="required">*</span></label>
                        <div class="col-10 col-sm-8 col-md-8 col-xs-12 pr-0">
                            <input type="text" class="form-control" id="inputAlamatPura" name="address" required>
                        </div>
                        <div class="col-2 col-sm-1 text-center">
                            <button data-toggle="modal" data-target="#modal_add_location" class="btn btn-default bg-white p-0"> <img src="/user_img/maps.png" width="35" alt="">
                              <input type="hidden" name="latitude" id="latitude" value="" required>
                              <input type="hidden" name="longitude" id="longitude" value="" required>  
                            </button>
                        </div>
                    </div>

                    <!-- Form Provinsi-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Provinsi<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control dynamic" required="required" id="province" name="province" data-dependent="city">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach($province as $data)
                              <option value="{{$data->id}}">{{$data->province_name}}</option>
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
                            </select>
                        </div>
                    </div>

                    <!-- Form Kecamatan-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Kecamatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <select class="form-control" required="required" id="subdistrict" name="sub_district">
                              <option value="" disabled selected>Pilih Kecamatan</option>
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
                          <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_sasih" value="sasih" onclick="openOdalanType(event, 'Sasih')"> Sasih</div>
                          <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_wuku" value="wuku" onclick="openOdalanType(event, 'Wuku')"> Wuku</div>
                          <!-- <button class="tablinks" onclick="openCity(event, 'Sasih')">Sasih</button>
                          <button class="tablinks" onclick="openCity(event, 'Wuku')">Wuku</button> -->
                        </div>  
                        <!-- Tab content -->
                        <div id="Sasih" class="tabcontent">
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rahinan <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="rahinan" name="rahinan" class="form-control" >
                                <option value="" disabled selected>Pilih Hari Rahinan</option>
                                @foreach($rahinan as $data)
                                  <option value="{{$data->id}}">{{$data->rahinan_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sasih <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="sasih" name="sasih" class="form-control" >
                                <option value="" disabled selected>Pilih Sasih</option>
                                @foreach($sasih as $data)
                                  <option value="{{$data->id}}">{{$data->sasih_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        <div id="Wuku" class="tabcontent">
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Samptawara <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="saptawara" name="saptawara" class="form-control" >
                                <option value="" disabled selected>Pilih Saptawara</option>
                                @foreach($saptawara as $data)
                                  <option value="{{$data->id}}" >{{$data->saptawara_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pancawara <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="pancawara" name="pancawara" class="form-control" >
                                <option value="" disabled selected>Pilih Pancawara</option>
                                @foreach($pancawara as $data)
                                  <option value="{{$data->id}}" >{{$data->pancawara_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Wuku <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="wuku" name="wuku" class="form-control" >
                                <option value="" disabled selected>Pilih Wuku</option>
                                @foreach($wuku as $data)
                                  <option value="{{$data->id}}">{{$data->wuku_name}}</option>
                                @endforeach
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
                            <textarea type="text" class="form-control" id="inputDescription" name="description"></textarea>
                        </div>
                    </div>

                    <div class="form-group row" id="foto">
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
                    </div>
                    <div style="margin-bottom: 20px;">
                      <div id="tombol_tambah_foto" class="row">
                        <input type="hidden" name="total_semua_foto" id="total_semua_foto" value="1">
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
                                    <i class="fa fa-plus fa-xl"></i>
                                </div>
                            </button>
                          </div>
                            
                            <input type="hidden" name="number_of_card_element" id="number_of_card_element" value="0">
                            <input type="hidden" name="max_number_of_card_element" id="max_number_of_card_element" value="0">
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
                    <button  type="submit" id="addTemple" class="btn btn-primary btn-block">Tambahkan</button>
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
                <input name="input_element_image_1" id="input_element_image_1" id_input_foto="1" status_image="add" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showElementImage.call(this);">
                <span class="text-danger" id='width_1'>* Max Width: 5128 pixel</span><span class="text-danger" id='height_1'>, Max Height: 5128 pixel</span>
                <span class="text-danger" id="response_1"></span>
              </div>  
            </div>
            {{-- <div style="margin-bottom: 20px;">
              <div id="tombol_tambah_foto" class="row">
                <input type="hidden" name="total_semua_foto" id="total_semua_foto" value="1">
                <div class="col-md-3"></div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <button name="tambah_foto" class="btn btn-success" type="button" id="tambah_foto">(+) Tambah</button ><button name="hapus_foto" class="btn btn-danger" type="button" id="hapus_foto">(-) Hapus</button>  
                </div>
              </div>
            </div> --}}
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
                <input name="input_edit_element_image_1" id="input_edit_element_image_1" id_input_foto="1" status_image="edit" class="form-control col-md-12 col-xs-12" required="required" type="file" accept="image/*" onchange="showElementImage.call(this);">
                <span class="text-danger" id='width_1'>* Max Width: 5128 pixel</span><span class="text-danger" id='height_1'>, Max Height: 5128 pixel</span>
                <span class="text-danger" id="response_1"></span>
              </div>  
            </div>
            {{-- <div style="margin-bottom: 20px;">
              <div id="tombol_tambah_foto" class="row">
                <input type="hidden" name="total_semua_foto" id="total_semua_foto" value="1">
                <div class="col-md-3"></div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <button name="tambah_foto" class="btn btn-success" type="button" id="tambah_foto">(+) Tambah</button ><button name="hapus_foto" class="btn btn-danger" type="button" id="hapus_foto">(-) Hapus</button>  
                </div>
              </div>
            </div> --}}
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
       var total_foto = 1;
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

      // Javascript to make dynamic card element
      $(document).ready(function(){
        function add_element(element_name, element_god_name, element_description, element_position, src_image) {
          var number_of_card_element = document.getElementById('number_of_card_element').value;
          var max_number_of_card_element = document.getElementById('max_number_of_card_element').value;
          number_of_card_element ++;
          max_number_of_card_element ++;

          var element = '<div class="col-sm-4" id="card_element_'+max_number_of_card_element+'" style="margin-top: 20px;">';

          element += '<input type="hidden" name="inputHiddenElementImage_'+max_number_of_card_element+'" id="inputHiddenElementImage_'+max_number_of_card_element+'" value="'+src_image+'"><input type="hidden" name="inputHiddenElementName_'+max_number_of_card_element+'" id="inputHiddenElementName_'+max_number_of_card_element+'" value="'+element_name+'"><input type="hidden" name="inputHiddenGodName_'+max_number_of_card_element+'" id="inputHiddenGodName_'+max_number_of_card_element+'" value="'+element_god_name+'"><input type="hidden" name="inputHiddenElementDescription_'+max_number_of_card_element+'" id="inputHiddenElementDescription_'+max_number_of_card_element+'" value="'+element_description+'"><input type="hidden" name="inputHiddenElementPosition_'+max_number_of_card_element+'" id="inputHiddenElementPosition_'+max_number_of_card_element+'" value="'+element_position+'"><div id="element" class="card"><img class="card-img-top" id="img_element_'+max_number_of_card_element+'" src="'+src_image+'" alt="Card image cap"><div class="card-body"><h5 class="card-title" id="card_title_'+max_number_of_card_element+'">'+element_name+'</h5><p id="card_text_'+max_number_of_card_element+'" class="card-text">'+element_god_name+' <br> '+element_position+' <br> '+element_description+'</p><div class="row "><div class="col-sm" id="space_for_btn_edit_'+max_number_of_card_element+'"><button id="btn_edit_element" data-target="#modal_edit_element" data-toggle="modal" type="button" class="btn btn-primary btn-block btn-sm" data-element_name="'+element_name+'" data-element_god_name="'+element_god_name+'" data-element_description="'+element_description+'" data-element_position="'+element_position+'" data-element_image="'+src_image+'" data-card_id="'+max_number_of_card_element+'">Ubah</button></div><div class="col-sm"><button type="button" id="btn_delete_card_element_'+max_number_of_card_element+'" onclick="delete_element('+max_number_of_card_element+');" class="btn btn-danger btn-block btn-sm">Hapus</button></div></div></div></div></div>';

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
          var src_image = document.getElementById("view_element_image_1").src;

          // console.log('nama element : '+element_name);
          // console.log('dewa element : '+element_god_name);
          // console.log('deskripsi element : '+element_description);
          // console.log('posisi element : '+element_position);
          // console.log('src_image : '+src_image);

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

          console.log(src_image);

          // This is source code to edit inputhidden in their card element
          document.getElementById('inputHiddenElementImage_'+card_id).value = src_image;
          document.getElementById('inputHiddenElementName_'+card_id).value = element_name;
          document.getElementById('inputHiddenGodName_'+card_id).value = element_god_name;
          document.getElementById('inputHiddenElementDescription_'+card_id).value = element_description;
          document.getElementById('inputHiddenElementPosition_'+card_id).value = element_position;

          // This is source code to edit their card
          document.getElementById('img_element_'+card_id).src = src_image;
          document.getElementById('card_title_'+card_id).innerHTML = element_name;
          var text = element_god_name+' <br> '+element_position+' <br> '+element_description;
          document.getElementById('card_text_'+card_id).innerHTML = text;
          var button_edit = '<button id="btn_edit_element" data-target="#modal_edit_element" data-toggle="modal" type="button" class="btn btn-primary btn-block btn-sm" data-element_name="'+element_name+'" data-element_god_name="'+element_god_name+'" data-element_description="'+element_description+'" data-element_position="'+element_position+'" data-element_image="'+src_image+'" data-card_id="'+card_id+'">Ubah</button>';
          document.getElementById('space_for_btn_edit_'+card_id).innerHTML = button_edit;

          console.log("card_id : "+card_id);

          // Clear all input in modal edit_element
          document.getElementById("btn_edit_element_in_modal").disabled = true;
          document.getElementById('inputEditElementName').value = '';
          document.getElementById('inputEditGodName').value = '';
          document.getElementById('inputEditElementDescription').value = '';
          document.getElementById('inputEditElementPosition').value = '';
          document.getElementById("view_edit_element_image_1").src = '';
          document.getElementById("input_edit_element_image_1").value = '';
          $('#modal_edit_element').modal('hide');
        });
      });
      
      // This is function to show image in modal edit and add element
      function showElementImage(){
        if( this.files && this.files[0]){
          var obj = new FileReader();
          // var total_foto = document.getElementById('total_semua_foto').value;
          // console.log(total_foto);

          var id_input_foto = $(this).attr('id_input_foto');
          var status_image = $(this).attr('status_image');

          obj.onload = function(data){
            
            if (status_image == 'add') {
              // This is for modal add element
              var image = document.getElementById("view_element_image_"+id_input_foto);  
            }else if(status_image == 'edit'){
              // This is for modal edit element
              var image = document.getElementById("view_edit_element_image_"+id_input_foto);  
            }
            
            // console.log(id_input_foto);

            image.src = data.target.result;
            image.style.display = "block";

            if (status_image == 'add') {
              // This is javascript to enable button add element when all input not null
              var element_name = document.getElementById('inputElementName').value;
              var element_god_name = document.getElementById('inputGodName').value;
              var element_description = document.getElementById('inputElementDescription').value;
              var element_position = document.getElementById('inputElementPosition').value;
              var src_image = document.getElementById("view_element_image_"+id_input_foto).src; 

              if (element_name && element_god_name && element_description && element_position && src_image) {
                document.getElementById("btn_add_element").disabled = false;
              }else{
                document.getElementById("btn_add_element").disabled = true;
              }    
            }else if(status_image == 'edit'){
              // This is javascript to enable button edit element when all input not null
              var element_name = document.getElementById('inputEditElementName').value;
              var element_god_name = document.getElementById('inputEditGodName').value;
              var element_description = document.getElementById('inputEditElementDescription').value;
              var element_position = document.getElementById('inputEditElementPosition').value;
              var src_image = document.getElementById("view_edit_element_image_"+id_input_foto).src; 

              if (element_name && element_god_name && element_description && element_position && src_image) {
                document.getElementById("btn_edit_element").disabled = false;
              }else{
                document.getElementById("btn_edit_element").disabled = true;
              }    
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
        var element_image = button.data('element_image')
        var card_id = button.data('card_id');

        // console.log(element_image)

        // This is to set all input in modal edit element
        var modal = $(this)
        modal.find('.modal-body #inputEditElementName').val(element_name)
        modal.find('.modal-body #inputEditGodName').val(element_god_name)
        modal.find('.modal-body #inputEditElementDescription').val(element_description)
        modal.find('.modal-body #inputEditElementPosition').val(element_position)
        modal.find('.modal-body #card_id_in_modal').val(card_id)
        document.getElementById('view_edit_element_image_1').src = element_image

        // This is to enable btn to save edit element
        document.getElementById("btn_edit_element_in_modal").disabled = false;
      })
    </script>
@endsection