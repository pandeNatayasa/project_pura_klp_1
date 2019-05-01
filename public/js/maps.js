$(document).ready(function(){
    var icons = L.icon({
        iconUrl: '/user/temple-icon.png',
        iconSize:     [32, 32], // size of the icon
        iconAnchor:   [30, 30], // point of the icon which will correspond to marker's location
        popupAnchor:  [-15, -30] // point from which the popup should open relative to the iconAnchor
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


    // $("#s_OSM").prop("checked",true);	
    $("#s_OSM").on("click",function(){
        L.tileLayer('https://maps.tilehosting.com/styles/streets/{z}/{x}/{y}.png?key=YrAn6SOXelkLFXHv03o2',{
            attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
        }).addTo(map);					
    });

    // $("#s_GSM").on("change",function(){
    //     L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    //         maxZoom: 20,
    //         subdomains:['mt0','mt1','mt2','mt3']
    //     }).addTo(map);
    // });

    $("#s_SAT").on("click",function(){
        L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map);
    });

    $("#s_TER").on("click",function(){
        L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map);
    });

    $("#s_HIB").on("click",function(){
        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map);
    });
    
    var marker1 = L.marker([-8.708337,115.185124],{icon: icons}).addTo(map).bindPopup(
    "<b>Pura Goa Gong</b></br>"+
    "Alamat : Jl. Pura Mertasari I No.1, Pemecutan Klod, Kuta, Kabupaten Badung, Bali 80361</br>"+
    "Telp : 0812-1981-1988</br>").openPopup();
    });	