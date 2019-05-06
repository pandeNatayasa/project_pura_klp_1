@extends('layouts.user')

@section('context')
<div id="addlocation" class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <a href="/" style="color:black"><i class="fa fa-arrow-left"></i></a>
                {{-- window.history.go(-1); return false; --}}
            </div>
            <div class="text-center">
                TAMBAH LOKASI PURA
            </div> 
        </div>  
        <div class="card-body">
            <div class="container col-md-10">
<<<<<<< HEAD
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
                    <!-- Form List Gambar-->
                    <div class="card mb-5">
                        <input type="file" id="file-1" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">
                    </div>
=======
                <form action="/event-upload" class="dropzone dz-clickable mb-5" id="addImages" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="jaTC1J0R7xOyZC3cvWWv6nErBYQdr4aogc3OQkD5">
                  <input type="hidden" name="gallery_id" value="7">
                  <div class="dz-default dz-message m-5"><span>Drop/Click here to upload images</span></div>
                </form>
                <form enctype="multipart/form-data">
                    
>>>>>>> abe6946a87d822b64890fc8aaef383f9834648aa
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
                        <label for="inputNamePemangku" class="col-sm-2 col-md-2 col-xs-12 col-form-label">Alamat<span class="required">*</span></label>
                        <div class="col-sm-7 col-md-7 col-xs-12 mb-2">
                            <input type="text" class="form-control" id="address_priest" name="address_priest" required>
                        </div>
                        <br/>
                        <span class="col-sm-3 col-md-3"></span>
                        <label for="inputNamePemangku" class="col-sm-2 col-md-2 col-xs-12 col-form-label">No Telp<span class="required">*</span></label>
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
                            <button data-toggle="modal" data-target="#modal_add_location" class="btn btn-default bg-white p-0"> <img src="/user/maps.png" width="35" alt=""></button>
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
                            <select class="form-control" required="required" id="subdistrict" name="subdistrict">
                              <option value="" disabled selected>Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Form Odalan-->
                    <div class="row form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pinanggal Odalan <span class="required">*</span>
                            </label></label>
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
                                      {{-- @foreach($rahinan as $data)
                                        <option value="{{$data->id}}">{{$data->rahinan_name}}</option>
                                      @endforeach --}}
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sasih <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="sasih" name="sasih" class="form-control" >
                                      <option value="" disabled selected>Pilih Sasih</option>
                                      {{-- @foreach($sasih as $data)
                                        <option value="{{$data->id}}">{{$data->sasih_name}}</option>
                                      @endforeach --}}
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
                                      {{-- @foreach($saptawara as $data)
                                        <option value="{{$data->id}}" >{{$data->saptawara_name}}</option>
                                      @endforeach --}}
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pancawara <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="pancawara" name="pancawara" class="form-control" >
                                      <option value="" disabled selected>Pilih Pancawara</option>
                                      {{-- @foreach($pancawara as $data)
                                        <option value="{{$data->id}}" >{{$data->pancawara_name}}</option>
                                      @endforeach --}}
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Wuku <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="wuku" name="wuku" class="form-control" >
                                      <option value="" disabled selected>Pilih Wuku</option>
                                      {{-- @foreach($wuku as $data)
                                        <option value="{{$data->id}}">{{$data->wuku_name}}</option>
                                      @endforeach --}}
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                    <!-- Form Deskripsi Pura-->
                    <div class="form-group row">
                        <label for="inputDescription" class="col-sm-3 col-md-3 col-xs-12 col-form-label">Deskripsi<span class="required">*</span></label>
                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <textarea type="text" class="form-control" id="inputDescription" name="description"></textarea>
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
                                    <img class="card-img-top" src="/user/element/element1.1.jpg" alt="Card image cap">
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
                    <button type="submit" class="btn btn-primary btn-block">Tambahkan</button>
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Latitude <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="latitude" name="latitude" disabled placeholder="ex: 119.023365" value="" class="form-control col-md-6 col-xs-12">
                  </div>
                </div>
                <div class=" form-group col-sm col-md">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Longitude <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="longitude" name="longitude" disabled placeholder="ex: 119.023365" value="" class="form-control col-md-6 col-xs-12">
                  </div>
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
              <div class="col-md-2 col-md-2 float-right">
                <button id="selected" type="button" class="btn btn-success btn-block" data-dismiss="modal">Pilih</button>
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
          <form action="/event-upload" class="dropzone dz-clickable mb-5" id="addImages" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="jaTC1J0R7xOyZC3cvWWv6nErBYQdr4aogc3OQkD5">
            <input type="hidden" name="gallery_id" value="7">
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
@endsection