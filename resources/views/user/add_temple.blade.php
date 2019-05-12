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
                        <div class="text-right mb-3">
                            <button data-target="#elementModal" data-toggle="modal" class="btn btn-outline-info"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div id="element" class="card">
                                    <img class="card-img-top" src="/user_img/element/element1.1.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <div class="row ">
                                            <div class="col-sm">
                                                <a href="#" class="btn btn-primary btn-block btn-sm">Ubah</a>
                                            </div>
                                            <div class="col-sm">
                                                <a href="#" class="btn btn-danger btn-block btn-sm">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<div class="modal fade" id="elementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Element Pura</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/event-upload" class="dropzone dz-clickable mb-5" id="addImagesElement" enctype="multipart/form-data">
            <div class="dz-default dz-message m-5"><span>Drop/Click here to upload images</span></div>
          </form>
          <form class="form-horizontal form-label-left">
            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Element<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputNamePura" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Nama Dewa<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputNamePura" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Deskripsi<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <textarea type="text" class="form-control " id="inputNamePura" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputNamePura" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Posis Element<span class="required">*</span></label>
                <div class="col-sm-9 col-md-9 col-xs-12">
                    <input type="text" class="form-control " id="inputNamePura" required>
                </div>
            </div>

            <div class="float-right">
              <button class="btn btn-success">Tambah Element</button>
            </div>
          </form>                         
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Element -->
    
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
                console.log(data)
            });
        }
    }

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
    </script>
@endsection