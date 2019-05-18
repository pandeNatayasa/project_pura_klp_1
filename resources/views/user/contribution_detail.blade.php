@extends('layouts.user')

@section('css')
  <!--Dropdzone-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
  <link rel="stylesheet" href="{{asset('css/user.css')}}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
  crossorigin=""></script>
@endsection

@section('context')
<div id="addlocation" class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <a href="#" onclick="window.history.back();" style="color:black"><i class="fa fa-arrow-left"></i></a>
                {{-- window.history.go(-1); return false; --}}
            </div>
            <div class="text-center text-uppercase">
                Detail Pura
            </div> 
        </div>  
        <div class="card-body">
            <div class="container col-md-10">
                <!-- Form List Gambar-->
                {{-- <form class="dz-clickable mb-5 dropzone"  id="addImages" method="POST" action="{{route('temple.store')}}">
                  <div class="dz-default dz-message m-5"><span>Drop/Click here to upload images</span></div>
                </form> --}}
                <form class="form-horizontal form-label-left"  enctype="multipart/form-data"  accept-charset="utf-8" method="POST" action="">
                    <!-- Form Nama Pura-->
                    <div class="form-group row">
                        <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Pura<span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control " id="temple_name" name="temple_name" value="{{$details->temple_name}}" required>
                        </div>
                    </div>

                    <!-- Form Jenis Pura-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Jenis Pura<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control " required="required" id="temple_type_id" name="temple_type_id">
                            <option value="" disabled selected>Pilih Jenis Pura</option>
                            {{-- @foreach($type as $data)
                              <option value="{{$data->id}}">{{$data->type_name}}</option>
                            @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <!-- Form Pemangku-->
                    <div class="form-group row">
                        <label for="inputNamePemangku" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Pemangku<span class="required">*</span></label>
                        <div class="col-10 col-sm-8 col-md-8 col-xs-12 pr-0">
                            <input type="text" class="form-control" id="priest_name" name="priest_name" value="{{$details->priest_name}}" required>
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
                            <input type="text" class="form-control" id="address_priest" name="address_priest" value="{{$details->priest_address}}" required>
                        </div>
                        <br/>
                        <span class="col-sm-3 col-md-3"></span>
                        <label for="inputNoTelp" class="col-sm-2 col-md-2 col-xs-12 col-form-label">No Telp<span class="required">*</span></label>
                        <div class="col-sm-7 col-md-7 col-xs-12">
                            <input type="text" class="form-control" id="priest_phone" name="priest_phone" value="{{$details->priest_phone}}" required>
                        </div>
                    </div>

                    <!-- Form Alamat Pura-->
                    <div class="form-group row">
                        <label for="inputAlamatPura" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Alamat Pura <span class="required">*</span></label>
                        <div class="col-10 col-sm-8 col-md-8 col-xs-12 pr-0">
                            <input type="text" class="form-control" id="inputAlamatPura" name="address" value="{{$details->address}}" required>
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
                            {{-- @foreach($province as $data)
                              <option value="{{$data->id}}">{{$data->province_name}}</option>
                            @endforeach --}}
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
                          <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_sasih" value="sasih"> Sasih</div>
                          <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_wuku" value="wuku"> Wuku</div>
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
                              </select>
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sasih <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="sasih" name="sasih" class="form-control" >
                                <option value="" disabled selected>Pilih Sasih</option>
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
                              </select>
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pancawara <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="pancawara" name="pancawara" class="form-control" >
                                <option value="" disabled selected>Pilih Pancawara</option>
                              </select>
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Wuku <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="wuku" name="wuku" class="form-control" >
                                <option value="" disabled selected>Pilih Wuku</option>
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
                            <textarea type="text" class="form-control" id="inputDescription" name="description">{{$details->description}}</textarea>
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
                    <input type="text" class="form-control " id="inputElementName" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Dewa<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputGodName">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Deskripsi<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <textarea type="text" class="form-control " id="inputElementDescription"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Posis Element<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputElementPosition" >
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
                    <input type="text" class="form-control " id="inputEditElementName" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Dewa<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputEditGodName" required >
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Deskripsi<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <textarea type="text" class="form-control " id="inputEditElementDescription" required ></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Posis Element<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputEditElementPosition" required>
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
@endsection