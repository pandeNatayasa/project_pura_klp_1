@extends('layouts.user')

@section('css')
  <!--Dropdzone-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
  <link rel="stylesheet" href="{{asset('css/user.css')}}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
  crossorigin=""></script>
  <style type="text/css">
    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
      padding-left: 20px;
    }

    /* Style the buttons inside the tab */
    .input-odalan {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 10px 10px;
      transition: 0.3s;
      font-size: 17px;
    }

    /* Style the tab content */
    .tabcontent-odalan {
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }
    #mymap {top: 10px; margin-bottom: 20px;height: 300px;}
  </style>
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
                <form class="form-horizontal form-label-left" action="">
                    <!-- Form Nama Pura-->
                    <div id="temple-img-detail" class="card mb-3">
                        <div class="card-body">
                            @foreach ($temple_images as $images)
                                <img src="/{{$images->image_name}}" alt="" width="150px">
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Pura<span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control " id="temple_name" name="temple_name" value="{{$temple->temple_name}}" disabled>
                        </div>
                    </div>

                    <!-- Form Jenis Pura-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Jenis Pura<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control " id="temple_type" name="temple_type" value="{{$temple->TempleType->type_name}}" disabled>
                        </div>
                    </div>

                    <!-- Form Pemangku-->
                    <div class="form-group row">
                        <label for="inputNamePemangku" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Pemangku<span class="required">*</span></label>
                        <div class="col-10 col-sm-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control" id="priest_name" name="priest_name" value="{{$temple->priest_name}}" disabled>
                        </div>
                        {{-- <div class="col-2 col-sm-1 text-center">
                            <button id="btn-detail-pemangku" class="btn btn-defaultp-0" type="button"> <i class="fa fa-chevron-up"></i></button>
                        </div> --}}
                    </div>
                    
                    <!-- Form Detail Pemangku-->
                    <div id="detail-pemangku" class="form-group row col-md-12">
                        <span class="col-sm-3 col-md-3"></span>
                        <label for="inputAlamatPemangku" class="col-sm-2 col-md-2 col-xs-12 col-form-label">Alamat<span class="required">*</span></label>
                        <div class="col-sm-7 col-md-7 col-xs-12 mb-2">
                            <input type="text" class="form-control" id="address_priest" name="address_priest" value="{{$temple->priest_address}}" disabled>
                        </div>
                        <br/>
                        <span class="col-sm-3 col-md-3"></span>
                        <label for="inputNoTelp" class="col-sm-2 col-md-2 col-xs-12 col-form-label">No Telp<span class="required">*</span></label>
                        <div class="col-sm-7 col-md-7 col-xs-12">
                            <input type="text" class="form-control" id="priest_phone" name="priest_phone" value="{{$temple->priest_phone}}" disabled>
                        </div>
                    </div>

                    <!-- Form Alamat Pura-->
                    <div class="form-group row">
                        <label for="inputAlamatPura" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Alamat Pura <span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control" id="inputAlamatPura" name="address" value="{{$temple->address}}" disabled>
                        </div>
                        {{-- <div class="col-2 col-sm-1 text-center">
                            <button data-toggle="modal" data-target="#modal_add_location" class="btn btn-default bg-white p-0"> <img src="/user_img/maps.png" width="35" alt="">
                              <input type="hidden" name="latitude" id="latitude" value="" required>
                              <input type="hidden" name="longitude" id="longitude" value="" required>  
                            </button>
                        </div> --}}
                    </div>
                    <div class="form-group row">
                        <label for="inputLatitude" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Latitude <span class="required">*</span></label>
                        <div class="col-10 col-sm-8 col-md-8 col-xs-12">
                            <input type="text"  class="form-control " name="latitude" id="latitude" value="{{ $temple->latitude }}" disabled onkeypress="return false;">
                        </div>
                        <div class="col-2 col-sm-1 text-center">
                            <button data-toggle="modal" type="button" data-target="#modal_detail_location" data-latitude="{{ $temple->latitude }}" data-longitude="{{ $temple->longitude }}" class="btn btn-default bg-white p-0"> <img src="/user_img/maps.png" width="35" alt="">
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAlamatPura" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Longitude <span class="required">*</span></label>
                        <div class="col-10 col-sm-8 col-md-8 col-xs-12">
                            <input type="text" class="form-control " name="longitude" id="longitude" value="{{ $temple->longitude }}" disabled onkeypress="return false;">  
                        </div>
                    </div>
                    <!-- Form Provinsi-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label" >Provinsi<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" id="province" name="province" value="{{$temple->SubDistrict->City->Province->province_name}}" disabled>
                        </div>
                    </div>

                    <!-- Form Kabupaten/Kota-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Kota <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <input type="text" class="form-control" id="city" name="city" value="{{$temple->SubDistrict->City->city_name}}" disabled>
                        </div>
                    </div>

                    <!-- Form Kecamatan-->
                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Kecamatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <input type="text" class="form-control" id="sub_district" name="sub_district" value="{{$temple->SubDistrict->sub_district_name}}" disabled>
                        </div>
                    </div>

                    <!-- Form Odalan-->
                    <div class="row form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pinanggal Odalan <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12 inline-group">
                        <!-- Tab links -->
                        <div class="tab">
                          <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_sasih" value="sasih" @if ($temple->odalan_type=="sasih") checked @else disabled @endif> Sasih</div>
                          <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_wuku" value="wuku" @if ($temple->odalan_type=="wuku") checked @else disabled @endif> Wuku</div>
                          <!-- <button class="tablinks" onclick="openCity(event, 'Sasih')">Sasih</button>
                          <button class="tablinks" onclick="openCity(event, 'Wuku')">Wuku</button> -->
                        </div>  
                        <!-- Tab content -->
                        @if ($temple->odalan_type=="sasih")
                        <!-- Tab content -->
                          <div id="Sasih" class="tabcontent-odalan">
                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Rahinan </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <select id="rahinan" name="rahinan" class="form-control" >
                                  <option value="{{ $odalan->rahinan_id }}">{{ $odalan->Rahinan->rahinan_name }}</option>  
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Sasih </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <select id="sasih" name="sasih" class="form-control" >
                                  <option value="{{ $odalan->sasih_id }}">{{ $odalan->Sasih->sasih_name }}</option>  
                                </select>
                              </div>
                            </div>
                          </div>
                        @elseif ($temple->odalan_type=="wuku")
                          <div id="Wuku" class="tabcontent-odalan">
                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Samptawara </label>
                              <div class="col-md- col-sm-8 col-xs-12">
                                <select id="saptawara" name="saptawara" class="form-control" >
                                  <option value="{{ $odalan->saptawara_id }}" >{{ $odalan->Saptawara->saptawara_name }}</option>  
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Pancawara </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <select id="pancawara" name="pancawara" class="form-control" >
                                  <option value="{{ $odalan->pancawara_id }}" >{{ $odalan->Pancawara->pancawara_name }}</option>  
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="name">Wuku </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <select id="wuku" name="wuku" class="form-control" >
                                  <option value="{{ $odalan->wuku_id }}">{{ $odalan->Wuku->wuku_name }}</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        @endif
                      </div>
                    </div>

                    <!-- Form Deskripsi Pura-->
                    <div class="form-group row">
                        <label for="inputDescription" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Sejarah<span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <textarea type="text" class="form-control" style="height: 150px;" id="inputDescription" name="description" disabled>{{$temple->description}}</textarea>
                        </div>
                    </div>
                    
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 pl-0" for="name">Elements <span class="required">*</span>
                    </label>
                    <div class="row">
                        @foreach ($elements as $elem)
                        <div class="col-6 col-md-3">
                            <div class="card " >
                                <img class="card-img-top" src="{{ asset($elem->image_name) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{$elem->element_name}}</h5>
                                    <p class="card-text">{{$elem->god}}</p>
                                    <p class="card-text">{{$elem->element_position}}</p>
                                    <div class="text-center">
                                        <a href="" data-toggle="modal" data-target="#modal_detail_element" data-element_id="{{ $elem->id }}" data-element_name="{{ $elem->element_name }}" data-god_name="{{ $elem->god }}" data-element_position="{{ $elem->element_position }}" data-element_description="{{ $elem->element_description }}" class="btn btn-default">See temple</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    </div>
                    <a href="{{ route('admin.update_temple',$temple->id) }}" style="margin-top: 20px;" type="button" class="btn btn-primary btn-block">Perbaharui</a>
                </form>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal Maps-->
<div class="modal fade" id="modal_detail_location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="item form-group" >
              <div id="mymap" class="col-md-12 col-sm-12 col-xs-12">
              </div>
            </div>
          </form>                         
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Maps -->

<!-- Modal Element-->
<div class="modal fade" id="modal_detail_element" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="col-md-12 col-xs-12 " id="view_element_image">
                  <img id="view_element_image_1" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; ">
                </div>
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
                    <input type="text" class="form-control " id="inputElementName" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Dewa<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputGodName" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Deskripsi<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <textarea type="text" style="height: 150px;" class="form-control " id="inputElementDescription" disabled></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Posis Element<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputElementPosition" disabled>
                </div>
            </div>
          </form>                         
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Element -->
    
@endsection

@section('script')
  <script type="text/javascript">
    // $(document).ready(function(){
        var mymap = L.map('mymap',{
          zoomControl:false
        }).setView([-8.5240574,115.2110998],17);

        var marker;

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          maxZoom: 20,
          id: 'mapbox.streets',
          accessToken: 'pk.eyJ1IjoidHJpb3B1dHJhcCIsImEiOiJjam00ajRzbHMweXg2M2xxdDVwNHo4NmhiIn0.m9AganPvwoRN0HhmUJk0xg'
          }).addTo(mymap);

    //Modal Detail Location
    $('#modal_detail_location').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var longitude = button.data('longitude') 
      var latitude = button.data('longitude')

      var a = -8.5240574
      console.log(typeof a)
      
      $(document).ready(function(){
        // var popup = L.popup();

        var icons = L.divIcon({
                    iconSize:null,
                    html:'<div class="map-label"><img src="/user_img/marker.png" width="25px" ></img></div>'
                });

        marker = L.marker([latitude, longitude],{icon: icons})
        mymap.addLayer(marker);    
      });
    });

    //Modal Detail Element
    $('#modal_detail_element').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var element_name = button.data('element_name') 
      var element_position = button.data('element_position')
      var element_description = button.data('element_description')
      var god_name = button.data('god_name')
      var element_id = button.data('element_id')

      console.log(element_id)

      // Here ajax to request all image of element
      $.ajax({
          url: "/temple-element-detail/"+element_id,
          type: "get",
          dataType: 'json',
          success: function (response){

              var element_image_string = ""
              response.forEach(function(element) {
                  element_image_string += '<img src="/'+element.image_name+'" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; ">';
              });

              document.getElementById('view_element_image').innerHTML = element_image_string;
          },
          error: function(e) {
              console.log("error : "+ e)
          }
      });

      // This is to set data in modal detail element
      var modal = $(this)
      modal.find('.modal-body #inputElementName').val(element_name)
      modal.find('.modal-body #inputGodName').val(god_name)
      modal.find('.modal-body #inputElementDescription').val(element_description)
      modal.find('.modal-body #inputElementPosition').val(element_position)
      // modal.find('.modal-body #card_id_in_modal').val(card_id)

    });
  </script>
@endsection