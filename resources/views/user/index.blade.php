@extends('layouts.user')

@section('css')
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>

    <!--Custome Css-->
    <link rel="stylesheet" href="/css/sidenav.css">
@endsection

@section('context')
    <div class="page-wrapper chiller-theme toggled">
    <!--Sidebar-->
    <nav id="sidebar" class="sidebar-wrapper bg-white loading">
        @foreach($marker as $data)
        @if($data->count('id') != null)
        <!-- Main Sidebar-->
        <div class="dots-loader"></div>
        <div id="sidebar-content{{$data->id}}" class="sidebar-content" >
        <div class="sidebar-menu">
            <div id="carouselElement" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/user_img/uluwatu.jpg" alt="" width="100%" height="200px" >
                    </div>
                    <div class="carousel-item">
                        <img src="/user_img/uluwatu.jpg" alt="" width="100%" height="200px" >
                    </div>
                    <div class="carousel-item">
                        <img src="/user_img/element/element1.1.jpg" alt="" width="100%" height="200px" >
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselElement" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselElement" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <div class="card panorama-360">
                    {{-- <img id="myImg" src="/user_img/element/panorama.jpg" class="pano" style="height: 50px"> --}}
                    <div id="myPano{{$data->id}}" class="pano" style="border-radius: 10px"></div>
                </div>
            </div>
            <div class="card ml-2 mr-2 mt-3 pb-2 pt-1">
                <h5 class="text-center m-0">{{$data->temple_name}}</h5>
                <small class="text-center">{{$data->TempleType->type_name}}</small>
            </div>
            <div class="container mt-3">
                <p><i class="fas fa-map-marker-alt fa-sm mb-2"></i><span class="mx-1"></span> {{$data->address}}</p>
                <p><i class="fas fa-user fa-sm mb-2"></i><span class="mx-1"></span> {{$data->priest_name}}</p>
                <p><i class="fas fa-calendar-week fa-sm mb-2"></i><span class="mx-1"></span> Sasih Kapitu</p>
                <p class="mb-0"><i class="fas fa-landmark fa-sm mb-2"></i><span class="mx-1"></span> Sejarah :</p>
                <small>{{$data->description}}</small>
            </div>
            <div class="container mt-3">
                <p class="mb-1"><img src="/user_img/element.png" width="21" alt="" class="mb-1"><span class="mx-1"></span> Element Pura :</p>
                <div class="row">
                    <div class="element col-4 mb-2 pr-0">
                        <img src="/user_img/element/element1.1.jpg" width="90px" height="50px" alt="Card image">
                    </div>
                    <div class="element2 col-4">
                            <img src="/user_img/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                    </div>
                    <div class="col-4">
                        <a href="#">
                            <img src="/user_img/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="#">
                            <img src="/user_img/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="#">
                            <img src="/user_img/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="#">
                            <img src="/user_img/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Element Sidebar-->
        <div id="myElement" class="myelement hide">
            <div class="sidebar-brand p-1 mx-auto">
                <button class="btn btn-default bg-white btn-sm" id="close-element">
                    <i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i>
                </button>
            </div>
            <div id="carouselElement" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/user_img/element/element1.1.jpg" alt="" width="100%" height="163" >
                    </div>
                    <div class="carousel-item">
                        <img src="/user_img/element/element1.1.jpg" alt="" width="100%" height="163" >
                    </div>
                    <div class="carousel-item">
                        <img src="/user_img/element/element1.1.jpg" alt="" width="100%" height="163" >
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselElement" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselElement" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="card ml-2 mr-2 mt-3 pt-1">
                <h5 class="text-center">Element 1</h5>
            </div>
            <div class="container mt-3">
                <p><img src="/user_img/god.png" width="12" class="mb-2" alt=""/><span class="mx-1"></span> Dewa Siwa</p>
                <p><i class="fas fa-calendar-week fa-sm mb-2"></i><span class="mx-1"></span> Sasih Kapitu</p>
                <p class="mb-0"><i class="fas fa-landmark fa-sm mb-2"></i><span class="mx-1"></span> Deskripsi :</p>
            </div>
        </div>

        <div id="myElement2" class="hide">
            <div class="sidebar-brand p-1 mx-auto">
                <button class="btn btn-default bg-white btn-sm" id="close-element2">
                    <i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>
                </button>
            </div>
            <div>
                <img src="/user_img/uluwatu.jpg" alt="" width="100%" height="163" style="">
            </div>
            <div class="card ml-2 mr-2 mt-3 pt-1">
                <h5 class="text-center">Element 2</h5>
            </div>
            <div class="container mt-3">
                <p><img src="/user_img/god.png" width="12" class="mb-2" alt=""/><span class="mx-1"></span> Dewa Wisnu</p>
                <p><i class="fas fa-calendar-week fa-sm mb-2"></i><span class="mx-1"></span> Sasih Kapitu</p>
                <p class="mb-0"><i class="fas fa-landmark fa-sm mb-2"></i><span class="mx-1"></span> Deskripsi :</p>
            </div>
        </div>
        @endif
        @endforeach
    </nav>

    <!-- Main Content -->
    <main class="page-content p-0" style="height:100%">
        <!-- Show Search Floating-->
        <a id="show-floating-area" class="btn btn-sm btn-dark pt-0 pr-1 pl-1" href="#">
            <i class="fas fa-chevron-right fa-sm"></i>
        </a>
        <!--Login FLoating-->
        <div class="login-floating p-0">
            @auth
                <a id="sidebar-nav" href="#" class="p-0"><img src="/user_img/user.png" width="20px" alt=""></a>
            @else
                <ul class="row  mr-2 p-0 ">
                    <a href="{{ route('member.login') }}" style="color:black">Login</a><span class="mx-2"></span> | <span class="mx-2"></span>
                    <a href="{{ route('member.register') }}"  style="color:black">Register</a>
                </ul>
            @endauth
        </div>
        <!--Search FLoating-->
        <div class="card floating-area p-0 ">
            <div class="card-body row p-2">
            <div class=" col-1 pl-3" style="padding-top: 1px">
                <a id="close-floating-area" href="#" style="color: black">
                    <i class="fas fa-chevron-left fa-lg"></i>
                </a>
            </div>
            <div class="col-8 pr-0">
                <input id="floating-search" class="form-control p-0" id="myInput" type="text">
            </div>
            <div class="col pr-2">
                    <i class="fas fa-search"></i> <span class="px-1"></span> |<span class="px-1"></span> 
                    <a href="#" id="close-sidebar">
                        <i class="fas fa-times pt-1"></i>
                    </a>
                    
            </div>
            </div>
        </div>
        <!-- Maps -->
        <div id="map" class="p-5" style="width:100%;height:100%"></div>
        
        <!-- Navigation Floating-->
        <div class="zoom-button p-0">
            <div class="btn-group-vertical">
                <button class="btn btn-light btn-sm" id="center" type="text"><i  class="fas fa-crosshairs"></i></button> <span class="mb-2"></span>
                <button class="btn btn-light btn-sm" id="zoomin" type="text">[ + ]</button><span  style="border-bottom: 1px solid #000"></span>
                <button class="btn btn-light btn-sm" id="zoomout" type="text">[ - ]</button>
            </div>
        </div>
        <!-- Control Floating-->
        <div class="container fixed-bottom text-center floating-control">
            <div class="btn-group " role="group" aria-label="map-control">
                <button id="s_OSM" type="button" name="mapstyles" value="OSM" class="mapstyles btn btn-default active">Street</button>
                <button id="s_SAT" type="button" name="mapstyles" value="SAT" class="mapstyles btn btn-default">Satelite</button>
                <button id="s_TER" type="button" name="mapstyles" value="TER" class="mapstyles btn btn-default">Terrain</button>
                <button id="s_HIB" type="button" name="mapstyles" value="HIB" class="mapstyles btn btn-default">Hibrid</button>
            </div>
        </div>
        <!--Side Menu Option-->
        <div id="sidebar-option" class="hide p-0">
                <div class="sidebar-brand p-1">
                    <button class="btn btn-default bg-white btn-sm" id="close-sidebar-menu">
                        <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i>
                    </button>
                    <button class="btn btn-default bg-white btn-sm float-right">
                            <a class="btn-off" href="#logoutModal" data-toggle="modal">
                                <i class="fas fa-power-off"></i>
                            </a>
                    </button>
                </div>
                <hr class="mb-3 mt-0"/>
                <div class=" mt-4">
                    <div class="ml-3">
                        <p><img src="/user_img/user-icon.png" width="18" alt="" class="mr-3"><a href="{{ route('user.profile') }}"  style="color:black"> Profil</a></p>
                        <p><img src="/user_img/link.png" width="18" alt="" class="mr-3"><a href="#sharelocModal" data-toggle="modal" style="color:black"> Bagi Lokasi</a></p>
                        <p><img src="/user_img/berkas.png" width="18" alt="" class="mr-3"><a href="/user/contribution" style="color:black"> Kontribusi Anda</a></p>
                        <p><img src="/user_img/add.png" width="18" alt="" class="mr-3"><a href=""><a href="{{ route('add_temple') }}"  style="color:black"> Tambahkan Tempat</a></p>
                    </div>
                    <hr>
                    <div class="ml-3">
                        <p><img src="/user_img/settings.png" width="18" alt="" class="mr-3"><a href=""><a href=""  style="color:black"> Pengaturan</a></p>    
                    </div>
                </div>
        </div>
        
    </main>
</div>

<!--Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- <div class="modal-body">
                <p>Do You Realy Want To Log Out ?</p>
            </div> --}}
            <div class="modal-footer">
                <a class="btn btn-danger btn-sm" href="{{ route('member.logout') }}">
                        Keluar
                </a>
                {{-- <a href="{{route('member.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a> --}}

                {{-- <form id="logout-form" action="{{ route('member.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form> --}}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            </div>
            </div>
        </div>
    </div>

<!--Shareloc Modal -->
    <div class="modal fade" id="sharelocModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div> --}}
                <div class="modal-body">
                    <div class="card mb-2">
                        <div class="card-body pt-2 pb-2 pl-3">
                            <div class="row ">
                                <div class="col-3">
                                    <img src="/user_img/map-marker.png" width="70px"  alt="">
                                </div>
                                <div class="col-9">
                                    <p>Pura Goa Gong</p>
                                    <p>Jalan Goa Gong no 8 xxx yyy zzz</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-1 pr-1 pt-1">
                            <i class="fa fa-link"></i>
                        </div>
                        <div class="col pl-1">
                            <input type="text" class="form-control form-control-sm" id="sharelink" placeholder="Link">
                        </div>
                        
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-sm">Bagikan Link</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

<!--Add Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Lokasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div> --}}
            <div class="modal-body">
                <div class="card mb-2">
                    <div class="card-body pt-2 pb-2 pl-3">
                        <div class="row ">
                            <div class="col-3">
                                <img src="/user_img/map-marker.png" width="70px"  alt="">
                            </div>
                            <div class="col-9">
                                <p>Pura Goa Gong</p>
                                <p>Jalan Goa Gong no 8 xxx yyy zzz</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pr-1 pt-1">
                        <i class="fa fa-link"></i>
                    </div>
                    <div class="col pl-1">
                        <input type="text" class="form-control form-control-sm" id="sharelink" placeholder="Link">
                    </div>
                    
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-sm">Bagikan Link</button>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Panorama Modal -->
@foreach($marker as $data)
<div id="panoramaModal" class="modal">

    <!-- Modal Content (The Image) -->
    {{-- <img class="modal-img-content" id="img01"> --}}
    <div id="myModalPanos" class="pano" ></div>

    <div class="card map-panorama-360 close-img{{$data->id}}">
        <div id="map1" style="width:100%;height:100%"></div>
    </div>

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
</div>
@endforeach
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/gh/seancoyne/pano/jquery.pano.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.66.2/src/L.Control.Locate.min.js"></script>
    <!--Custome JS-->
    <script src="/js/sidenav.js"></script>
    <script src="/js/maps.js"></script>
@endsection