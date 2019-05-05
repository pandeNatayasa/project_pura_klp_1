@extends('member.layouts.layout_utama')

@section('add_css')
<link href="{{asset('admin/build/css/button_on_off.css')}}" rel="stylesheet">
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
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
  #mymap {top: 10px;bottom: 10px;height: 300px;}
</style>

<!-- This is css and js for map to enable add position on map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
  crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
  crossorigin=""></script>
@endsection

@section('menu_add_product')
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
          <h2>Tambah Pura | Member <!-- <small>sub title</small> --></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form class="form-horizontal form-label-left" enctype="multipart/form-data" method="post" accept-charset="utf-8" method="POST" action="{{route('temple.store')}}">
          {{ csrf_field() }}
            @if($message =    Session::get('success'))
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Pura <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="temple_name" name="temple_name" required placeholder="ex: " class="form-control col-md-6 col-xs-12">
              </div>
            </div>
           <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jenis Pura <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" required="required" id="temple_type_id" name="temple_type_id">
                  <option value="" disabled selected>Pilih Jenis Pura</option>
                  @foreach($temple_type as $data)
                    <option value="{{$data->id}}">{{$data->type_name}}</option>
                  @endforeach
                </select>
              </div>
            </div> 
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pemangku <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" required="required" id="temple_priest_id" name="temple_priest_id">
                  <option value="" disabled selected>Pilih Pemangku</option>
                  @foreach($temple_priest as $data)
                    <option value="{{$data->id}}">{{$data->priest_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
           <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Provinsi <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control dynamic" required="required" id="province" name="province" data-dependent="city">
                  <option value="" disabled selected>Pilih Provinsi</option>
                  @foreach($province as $data)
                    <option value="{{$data->id}}">{{$data->province_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kota <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="city" name="city" class="form-control dynamic" required="required" data-dependent="sub_district">
                  <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kecamatan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="sub_district" name="sub_district" class="form-control" required="required">
                  <option value="" disabled selected>Pilih Kecamatan</option>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pinanggal Odalan<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12 inline-group">
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
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="textarea" required="required" name="address" class="form-control col-md-7 col-xs-12" style="height: 150px;"></textarea>
              </div>
            </div>
            <div class="item form-group" id="foto">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Foto Pura <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="col-md-12 col-xs-12 " >
                  <img id="image_1" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; ">
                </div>
                <input name="foto_pura_1" id="file_1" id_input_foto="1" class="form-control col-md-7 col-xs-12" required="required" type="file" accept="image/*" onchange="showImage.call(this)">
                <span class="text-danger" id='width_1'>* Max Width: 5128 pixel</span><span class="text-danger" id='height_1'>, Max Height: 5128 pixel</span>
                <span class="text-danger" id="response_1"></span>
              </div>  
            </div>
            <div class="item form-group ">
              <div id="tombol_tambah_foto" class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 col-xs-12">
                <input type="hidden" name="total_semua_foto" id="total_semua_foto" value="1">
                <button name="tambah_foto" class="btn btn-success" type="button" id="tambah_foto">(+) Tambah</button ><button name="hapus_foto" class="btn btn-danger" type="button" id="hapus_foto">(-) Hapus</button>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Posisi pada map <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <button type="button" class="btn btn-primary" id="map_position" name="map_position" data-toggle="modal" data-target="#modal_add_location"> Posisi pada Map</button>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button id="send" type="submit" class="btn btn-success">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Shipping Cost-->
<div class="modal fade" id="modal_add_location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Posisi Pada Map</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Latitude <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="latitude" name="latitude" disabled placeholder="ex: 119.023365" value="" class="form-control col-md-6 col-xs-12">
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Longitude <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="longitude" name="longitude" disabled placeholder="ex: 119.023365" value="" class="form-control col-md-6 col-xs-12">
            </div>
          </div>
          <div class="item form-group" >
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tekan pada map ini <span class="required">*</span>
            </label>
            <div id="mymap" class="col-md-12 col-sm-12 col-xs-12">
              
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-2 col-md-offset-10 col-sm-4 col-sm-offset-">
              <button id="selected" type="button" class="btn btn-success" data-dismiss="modal">Pilih</button>
            </div>
          </div>
        </form>                         
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Edit Shipping Cost -->
<!-- /page content -->
@endsection

@section('add_js')
		<!-- validator -->
    <script src="{{asset('admin/vendors/validator/validator.js')}}"></script>

    <script type="text/javascript">
      // Javascript to show image are selected
      function showImage(){
        if( this.files && this.files[0]){
          var obj = new FileReader();
          var total_foto = document.getElementById('total_semua_foto').value;
          console.log(total_foto);

          var id_input_foto = $(this).attr('id_input_foto');

          obj.onload = function(data){
            
            var image = document.getElementById("image_"+id_input_foto);
            
            console.log(id_input_foto);

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

        var isi = '<div class="item form-group" id="tambah_foto_'+total_foto+'">';
        isi +='<label class="control-label col-md-3 col-sm-3 col-xs-12" >Foto Pura <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><div class="col-md-12 col-xs-12 " ><img id="image_'+total_foto+'" class="col-md-offset-3 col-md-5 " style="margin-bottom: 5px; "></div><input name="foto_pura_'+total_foto+'" id="file_'+total_foto+'" id_input_foto="'+total_foto+'" class="form-control col-md-7 col-xs-12" required="required" type="file" accept="image/*" onchange="showImage.call(this)"><span class="text-danger" id="width_'+total_foto+'">* Max Width: 5128 pixel</span><span class="text-danger" id="height_'+total_foto+'">, Max Height: 5128 pixel</span><span class="text-danger" id="response_'+total_foto+'"></span></div>';
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

      // Javascript to make dynamic of city and sub district
      $(document).ready(function(){
        $('.dynamic').change(function(){
          if($(this).val() != ''){
            
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{route('fetch_location')}}",
              method:"POST",
              data:{value:value,_token:_token,dependent:dependent},
              success:function(result)
              {
                $('#'+dependent).html(result);
              },
              error(e)
              {
                console.log(e);
              }
            })  
          }
        });
      });
      // end of dynamic city and sub district

      // Javascript to make dynamic input of odalan type (sasih or wuku)
      function openOdalanType(evt, odalanType) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(odalanType).style.display = "block";
        evt.currentTarget.className += " active";
      }
      // End of dynamic input odalan type

      // Javascript of modal to add location on map
      $('#modal_add_location').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        // var judul = button.data('judul') 

        // var modal = $(this)
        // modal.find('.modal-body #judul').val(judul)
        // modal.find('.modal-body #deskripsi_singkat').text(deskripsi_singkat)
        // modal.find('.modal-body #image').attr('src',image)
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
@endsection
