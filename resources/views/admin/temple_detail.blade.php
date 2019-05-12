<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Validasi</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin=""></script>

    <!-- Bootstrap -->
    <link type="text/css" href="{{ asset('public_admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--Font Awesome -->
    <link type="text/css" href="{{ asset('public_admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public_admin/vendors/datatables/datatables.min.css')}}">
    <!-- Custom Theme Style -->
    <link type="text/css" href="{{ asset('public_admin/build/css/custom.css') }}" rel="stylesheet">

    <link href="{{asset('public_admin/build/css/button_on_off.css')}}" rel="stylesheet">
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
      .tabcontent {
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
      }
      #mymap {top: 10px; margin-bottom: 20px;height: 300px;}
    </style>

    <!-- This is css and js for map to enable add position on map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
      crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
      crossorigin=""></script>
  </head>  
<body>  
  <div class="top_nav">
    <div class="nav_menu">
      <nav>
        <a class="brand" href="{{ route('show_temple_detail',$temple->id) }}">Detail Data Pura </a>
        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="{{ route('show_list_temple_validate') }}" class="user-profile" aria-expanded="false">
              Back To Daftar Data Pura
            </a>
          
        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->
  <div class="container">
    
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-offset-1 col-sm-offset-1 col-md-10 col-sm-10 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Detail Data Pura | Admin <!-- <small>sub title</small> --></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal form-label-left" >
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Pura <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="temple_name" name="temple_name" placeholder="ex: " class="form-control col-md-6 col-xs-12" value="{{ $temple->temple_name }}" disabled>
                </div>
              </div>
             <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jenis Pura <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" required="required" id="temple_type_id" name="temple_type_id">
                    <option value="{{ $temple->TempleType->id }}" selected>{{ $temple->TempleType->type_name }}</option>  
                  </select>
                </div>
              </div> 
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pemangku <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" required="required" id="temple_priest_id" name="temple_priest_id">
                    <option value="{{ $temple->id }}" selected>{{ $temple->priest_name }}</option>  
                  </select>
                </div>
              </div>
             <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Provinsi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control dynamic" required="required" id="province" name="province" data-dependent="city">
                    <option value="{{ $temple->SubDistrict->City->province_id }}" selected>{{ $temple->SubDistrict->City->Province->province_name }}</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="city" name="city" class="form-control dynamic" required="required" data-dependent="sub_district">
                    <option value="{{ $temple->SubDistrict->City->id }}" selected>{{ $temple->SubDistrict->City->city_name }}</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kecamatan <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="sub_district" name="sub_district" class="form-control" required="required">
                    <option value="{{ $temple->sub_district_id }}" selected>{{ $temple->SubDistrict->sub_district_name }}</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pinanggal Odalan<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12 inline-group">
                  <!-- Tab links -->
                  <div class="tab">
                    <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_sasih" value="sasih" @if ($temple->odalan_type=="sasih") checked @else disabled @endif> Sasih</div>
                    <div class="radio-inline input-odalan"><input type="radio" name="odalan_type" id="odalan_wuku" value="wuku" @if ($temple->odalan_type=="wuku") checked @else disabled @endif> Wuku</div>
                    <!-- <button class="tablinks" onclick="openCity(event, 'Sasih')">Sasih</button>
                    <button class="tablinks" onclick="openCity(event, 'Wuku')">Wuku</button> -->
                  </div>  
                  @if ($temple->odalan_type=="sasih")
                  <!-- Tab content -->
                    <div id="Sasih" class="tabcontent">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Rahinan </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select id="rahinan" name="rahinan" class="form-control" >
                            <option value="{{ $odalan->rahinan_id }}">{{ $odalan->Rahinan->rahinan_name }}</option>  
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sasih </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select id="sasih" name="sasih" class="form-control" >
                            <option value="{{ $odalan->sasih_id }}">{{ $odalan->Sasih->sasih_name }}</option>  
                          </select>
                        </div>
                      </div>
                    </div>
                  @elseif ($temple->odalan_type=="wuku")
                    <div id="Wuku" class="tabcontent">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Samptawara </label>
                        <div class="col-md- col-sm-8 col-xs-12">
                          <select id="saptawara" name="saptawara" class="form-control" >
                            <option value="{{ $odalan->saptawara_id }}" >{{ $odalan->Saptawara->saptawara_name }}</option>  
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pancawara </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select id="pancawara" name="pancawara" class="form-control" >
                            <option value="{{ $odalan->pancawara_id }}" >{{ $odalan->Pancawara->pancawara_name }}</option>  
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Wuku </label>
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
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Alamat <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="textarea" required="required" disabled name="address" class="form-control col-md-7 col-xs-12" style="height: 150px;"> {{ $temple->address }} </textarea>
                </div>
              </div>
              @foreach ($temple_images as $data)
                <div class="item form-group" id="foto">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Foto Pura <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-md-12 col-xs-12 " >
                      <img id="image_1" src="{{ asset($data->image_name) }}" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; ">
                    </div>
                  </div>  
                </div>
              @endforeach
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Posisi pada map <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="item form-group" >
                    <div id="mymap" class="col-md-12 col-sm-12 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Latitude <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="latitude" name="latitude" disabled value="{{ $temple->latitude }}" class="form-control col-md-6 col-xs-12">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Longitude <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="longitude" name="longitude" disabled value="{{ $temple->longitude }}" class="form-control col-md-6 col-xs-12">
                    </div>
                  </div>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-2 col-md-offset-10">
                  <a href="{{ route('admin.update_temple',$temple->id) }}"><button id="send" type="button" class="btn btn-block btn-success">Edit</button></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- /page content -->
  <script src="{{asset('public_admin/vendors/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('public_admin/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('public_admin/build/js/custom.js') }}" type="text/javascript"></script>
  <script type="text/javascript" charset="utf8" src="{{asset('public_admin/vendors/datatables/datatables.min.js')}}"></script>
	<!-- validator -->
  <script src="{{asset('public_admin/vendors/validator/validator.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      // Javascript of modal to add location on map
      $('#modal_add_location').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        // var judul = button.data('judul') 

        // var modal = $(this)
        // modal.find('.modal-body #judul').val(judul)
        // modal.find('.modal-body #deskripsi_singkat').text(deskripsi_singkat)
        // modal.find('.modal-body #image').attr('src',image)
      });
    });
    // End of modal

    $(document).ready(function(){
      var mymap = L.map('mymap',{
        zoomControl:false
      }).setView([-8.8013433,115.1652095],17);

      var marker;

      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoidHJpb3B1dHJhcCIsImEiOiJjam00ajRzbHMweXg2M2xxdDVwNHo4NmhiIn0.m9AganPvwoRN0HhmUJk0xg'
        }).addTo(mymap);

      var popup = L.popup();
      // function onMapClick(e) {
      //     popup
      //     .setLatLng(e.latlng)
      //     .setContent("Lokasi yang dipilih: " + e.latlng.toString())
      //     .openOn(mymap);
      // }
      // mymap.on('click', onMapClick);

      mymap.on('mousemove',function(e){
          $("#latitude").val(e.latlng.lat);
          $("#longitude").val(e.latlng.lng);
        });
      
      mymap.on('click',function(e){
        if(marker){
          mymap.removeLayer(marker);
        }

        marker = L.marker(e.latlng).addTo(mymap); 
        
      });
    });
  </script>
</body>

</html>
