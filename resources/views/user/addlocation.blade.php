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
                <form>
                    <div class="card mb-5">
                        Gambar
                    </div>
                    <div class="form-group row">
                        <label for="inputNamePura" class="col-sm-2 col-form-label">Nama Pura</label>
                        <div class="col-sm-1 pt-2">
                                :
                        </div> 
                        <div class="col-sm-9">
                            <input type="text" class="form-control " id="inputNamePura">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputAlamatPura" class="col-sm-2 col-form-label">Alamat Pura</label>
                        <div class="col-sm-1 pt-2">
                                :
                        </div>  
                        <div class="col-sm-8 pr-0">
                            <input type="text" class="form-control" id="inputAlamatPura">
                        </div>
                        <div class="col-sm-1 text-center">
                            <button class="btn btn-default bg-white p-0"> <img src="/user/maps.png" width="35" alt=""></button>
                        </div>
                        
                    </div>

                    <div class="form-group row">
                        <label for="inputNamePemangku" class="col-sm-2 col-form-label">Pemangku</label>
                        <div class="col-sm-1 pt-2">
                                :
                        </div> 
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputNamePemangku">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputOdalan" class="col-sm-2 col-form-label">Odalan</label>
                        <div class="col-sm-1 pt-2">
                                :
                        </div> 
                        <div class="col-sm-9">
                            <input type="text" class="form-control " id="inputOdalan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputDescription" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-1 pt-2">
                                :
                        </div> 
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="inputDescription"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Element</label>
                        <br>
                        <div class="text-right mb-3">
                            <button class="btn btn-outline-info"><i class="fa fa-plus"></i></button>
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
                    
                    
                    <button type="submit" class="btn btn-primary btn-block">Tambahkan</button>
                </form>
            </div>
            
        </div>
    </div>
</div>
    
@endsection