<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Temple Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
    <link rel="stylesheet" href="/css/sidenav.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="/css/carousel.css">
 

</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand p-2">
        <a class="text-center ">Temple Information</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-menu">
        <div style="padding:10px">
            <img src="/img/uluwatu.jpg" alt="" width="100%" style="">
        </div>
        <div class="card ml-2 mr-2 pt-1">
            <h5 class="text-center">Pura Goa Gong</h5>
        </div>
        <div class="p-3">
            <p>Jln Goa Gong no xx</p>
            <p>Sejarah Pura :</p>
            <small>Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</small>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-4 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="/img/uluwatu.jpg" alt="Card image">
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" src="/img/uluwatu.jpg" alt="Card image">
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" src="/img/uluwatu.jpg" alt="Card image">
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" src="/img/uluwatu.jpg" alt="Card image">
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" src="/img/uluwatu.jpg" alt="Card image">
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" src="/img/uluwatu.jpg" alt="Card image">
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- sidebar-content  -->
    {{-- <div class="sidebar-footer">
      
    </div> --}}
  </nav>
  <!-- sidebar-wrapper  -->
    <main class="page-content p-0" style="height:100%">
        <div id="header-maps" class="card p-0" style="">
            <div class="card-header text-center">
                Temple Maps
            </div>
        </div>
        <div id="map" class="p-5" style="width:100%;height:92%"></div>
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
    <script src="/js/carousel.js"></script>

    <script>
            $(document).ready(function(){
                var icons = L.icon({
                    iconUrl: 'https://i.ibb.co/7nRsYY4/pet-insurance.png',
                    iconSize:     [32, 32], // size of the icon
                    iconAnchor:   [38, 32], // point of the icon which will correspond to marker's location
                    popupAnchor:  [0, -42] // point from which the popup should open relative to the iconAnchor
                });		
                var marker;
                var markers = L.markerClusterGroup();
                var map = L.map('map',{
                    zoomControl:false
                }).setView([-8.5240574,115.2110998],11);	
                L.tileLayer('https://maps.tilehosting.com/styles/streets/{z}/{x}/{y}.png?key=YrAn6SOXelkLFXHv03o2',{
                    attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
                }).addTo(map);

                map.on('mousemove',function(e){
                    $("#lat").val(e.latlng.lat);
                    $("#lng").val(e.latlng.lng);
                });

                $("#zoomin").click(function(){
                    map.zoomIn(1);
                });
                $("#zoomout").click(function(){
                    map.zoomOut(1);
                });
                $("#center").click(function(){
                    map.setView([-8.5240574,115.2110998],map.getZoom());
                });


                $("#s_OSM").prop("checked",true);	
                $("#s_OSM").on("change",function(){
                    L.tileLayer('https://maps.tilehosting.com/styles/streets/{z}/{x}/{y}.png?key=YrAn6SOXelkLFXHv03o2',{
                        attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
                    }).addTo(map);					
                });

                $("#s_GSM").on("change",function(){
                    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                        maxZoom: 20,
                        subdomains:['mt0','mt1','mt2','mt3']
                    }).addTo(map);
                });

                $("#s_SAT").on("change",function(){
                    L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
                        maxZoom: 20,
                        subdomains:['mt0','mt1','mt2','mt3']
                    }).addTo(map);
                });

                $("#s_TER").on("change",function(){
                    L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
                        maxZoom: 20,
                        subdomains:['mt0','mt1','mt2','mt3']
                    }).addTo(map);
                });

                $("#s_HIB").on("change",function(){
                    L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
                        maxZoom: 20,
                        subdomains:['mt0','mt1','mt2','mt3']
                    }).addTo(map);
                });			
            });	
        </script>
        
    
</body>

</html>