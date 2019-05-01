<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Temple Information</title>
    <link rel="icon" href="/user/temple-icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
    <link rel="stylesheet" href="/css/sidenav.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Wendy+One" rel="stylesheet">
    <link rel="stylesheet" href="/css/carousel.css">
 

</head>

<body>
<div class="page-wrapper chiller-theme toggled">
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
        {{-- <div class="sidebar-brand p-2">
            <a class="text-center ">Temple Information</a>
        </div> --}}
        <div class="sidebar-menu">
            <div>
                <img src="/user/uluwatu.jpg" alt="" width="100%" height="200" style="">
            </div>
            <div class="card ml-2 mr-2 mt-3 pt-1">
                <h5 class="text-center">Pura Goa Gong</h5>
            </div>
            <div class="container mt-3">
                <p><i class="fas fa-map-marker-alt fa-sm mb-2"></i><span class="mx-1"></span> Jln Goa Gong no xx, Goa Gong Bukit Jimbaran, Badung, Kuta Selatan</p>
                <p><i class="fas fa-user fa-sm mb-2"></i><span class="mx-1"></span> Jero Mangku Adit</p>
                <p><i class="fas fa-calendar-week fa-sm mb-2"></i><span class="mx-1"></span> Sasih Kapitu</p>
                <p class="mb-0"><i class="fas fa-landmark fa-sm mb-2"></i><span class="mx-1"></span> Sejarah :</p>
                <small>Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</small>
            </div>
            <div class="container mt-3">
                <p class="mb-1"><img src="/user/element.png" width="21" alt="" class="mb-1"><span class="mx-1"></span> Element Pura :</p>
                <div class="row">
                    <div class="element col-4 mb-2 p-1">
                        <img src="/user/element/element1.1.jpg" width="90px" height="50px" alt="Card image">
                    </div>
                    <div class="element2 col-4 p-1">
                            <img src="/user/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                    </div>
                    <div class="col-4 p-1">
                        <a href="#">
                            <img src="/user/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                        </a>
                    </div>
                    <div class="col-4 p-1">
                        <a href="#">
                            <img src="/user/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                        </a>
                    </div>
                    <div class="col-4 p-1">
                        <a href="#">
                            <img src="/user/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                        </a>
                    </div>
                    <div class="col-4 p-1">
                        <a href="#">
                            <img src="/user/uluwatu.jpg" width="90px" height="50px" alt="Card image">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div id="myElement" class="hide">
            <div class="sidebar-brand p-1 mx-auto">
                <button class="btn btn-default bg-white" id="close-element">
                    <i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i>
                </button>
            </div>
            <div>
                <img src="/user/element/element1.1.jpg" alt="" width="100%" height="150" >
            </div>
            <div class="card ml-2 mr-2 mt-3 pt-1">
                <h5 class="text-center">Element 1</h5>
            </div>
            <div class="container mt-3">
                <p><img src="/user/god.png" width="12" class="mb-2" alt=""/><span class="mx-1"></span> Dewa Siwa</p>
                <p><i class="fas fa-calendar-week fa-sm mb-2"></i><span class="mx-1"></span> Sasih Kapitu</p>
                <p class="mb-0"><i class="fas fa-landmark fa-sm mb-2"></i><span class="mx-1"></span> Deskripsi :</p>
            </div>
        </div>

        <div id="myElement2" class="hide">
            <div class="sidebar-brand p-1 mx-auto">
                <button class="btn btn-default bg-white" id="close-element2">
                    <i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>
                </button>
            </div>
            <div>
                <img src="/user/uluwatu.jpg" alt="" width="100%" height="150" style="">
            </div>
            <div class="card ml-2 mr-2 mt-3 pt-1">
                <h5 class="text-center">Element 2</h5>
            </div>
            <div class="container mt-3">
                <p><img src="/user/god.png" width="12" class="mb-2" alt=""/><span class="mx-1"></span> Dewa Wisnu</p>
                <p><i class="fas fa-calendar-week fa-sm mb-2"></i><span class="mx-1"></span> Sasih Kapitu</p>
                <p class="mb-0"><i class="fas fa-landmark fa-sm mb-2"></i><span class="mx-1"></span> Deskripsi :</p>
            </div>
        </div>
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="page-content p-0" style="height:100%">
        {{-- <div class="card p-0" style="background: #DFE9F6;"> --}}
            <div class="login-floating">
                    <ul class="row  mr-2 p-0 ">
                        <a href="{{ route('member.login') }}" style="color:black">Login</a><span class="mx-2"></span> | <span class="mx-2"></span>
                        <a href="{{ route('register') }}"  style="color:black">Register</a>
                    </ul>
            </div>
        {{-- </div> --}}
        <div class="card floating-area p-0 ">
            <div class="card-body row p-2">
            <div class=" col-1 pl-4" style="padding-top: 1px">
                <a id="sidebar-nav" href="#" style="color: black">
                    <i class="fas fa-bars fa-lg"></i>
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
        <div id="map" class="p-5" style="width:100%;height:100%"></div>
        <div class="zoom-button p-0">
            <div class="btn-group-vertical">
                <button class="btn btn-light" id="center" type="text"><i class="fas fa-map-marker"></i></button> <span class="mb-2"></span>
                <button class="btn btn-light" id="zoomin" type="text">[ + ]</button> <span class="mb-1"></span>
                <button class="btn btn-light" id="zoomout" type="text">[ - ]</button>
            </div>
        </div>
        <div class="map-controller p-0">
                <div class="btn-group " role="group" aria-label="map-control">
                    <button id="s_OSM" type="button" name="mapstyles" value="OSM" class="mapstyles btn btn-default active">Street</button>
                    <button id="s_SAT" type="button" name="mapstyles" value="SAT" class="mapstyles btn btn-default">Satelite</button>
                    <button id="s_TER" type="button" name="mapstyles" value="TER" class="mapstyles btn btn-default">Terrain</button>
                    <button id="s_HIB" type="button" name="mapstyles" value="TER" class="mapstyles btn btn-default">Hibrid</button>
                </div>
        </div>
    </main>
    <!-- page-content" -->
</div>
<!-- page-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <script src="/js/sidenav.js"></script>
    <script src="/js/maps.js"></script>

    
</body>

</html>