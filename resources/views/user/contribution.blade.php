@extends('layouts.user')
@section('css')
    
@endsection

@section('context')
<div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <a href="/" style="color:black"><i class="fa fa-arrow-left"></i></a>
                    {{-- window.history.go(-1); return false; --}}
                </div>
                <div class="text-center text-uppercase">
                    Kontribusi Anda
                </div> 
            </div>  
            <div class="card-body ">
                <div class="container">
                    <div class="row">
                        @foreach ($contribution as $data)
                        <div class="col-6 col-md-3">
                            @if($data->validate_status == '1')
                            <div class="span-verify" style="position: absolute; z-index: 1; right: 0; margin-right: 3px;">
                                <span class="badge badge-success" style=" border-radius: 50%;width: 35px; height: 35px; padding:11px"><i class="fas fa-check"></i></span>
                            </div>
                            @elseif($data->validate_status == '2')
                            <div class="span-verify" style="position: absolute; z-index: 1; right: 0; margin-right: 3px;">
                                <span class="badge badge-danger" style=" border-radius: 50%;width: 35px; height: 35px; padding:11px"><i class="fas fa-times"></i></span>
                            </div>
                            @else
                            <div class="span-verify" style="position: absolute; z-index: 1; right: 0; margin-right: 3px;">
                                <span class="badge badge-primary" style=" border-radius: 50%;width: 35px; height: 35px; padding:11px"><i class="fas fa-sync-alt"></i></span>
                            </div>
                            @endif
                            <div class="card  mt-2" >
                                <img class="card-img-top" src="/user_img/uluwatu.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{$data->temple_name}}</h5>
                                    <p class="card-text">{{$data->priest_name}}</p>
                                    <p class="card-text">{{$data->address}}</p>
                                    <div class="text-center">
                                        <a href="/user/contribution-detail/{{$data->id}}" class="btn btn-default">See Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    
@endsection