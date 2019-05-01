@extends('member.layouts.layout_utama')

@section('add_css')
<link href="{{asset('admin/build/css/button_on_off.css')}}" rel="stylesheet">
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
                <select class="form-control" required="required" id="temple_type" name="temple_type">
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
                <select class="form-control dynamic" required="required" id="province" name="province" data-dependent="city">
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
                <button class="btn btn-primary" id="map_position" name="map_position"> Posisi pada Map</button>
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

<!-- /page content -->
@endsection

@section('add_js')
		<!-- validator -->
    <script src="{{asset('admin/vendors/validator/validator.js')}}"></script>

    <script type="text/javascript">
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

          //Validasi ukuran image
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

      $(document).ready(function(){

       //untuk form dinamis foto product
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
              }
            })  
          }
        });
      });
    </script>
@endsection
