$(document).ready(function(){
    //Maps Icon
    var icons = L.icon({
        iconUrl: '/user_img/temple-icon.png',
        iconSize:     [32, 32], // size of the icon
        iconAnchor:   [30, 30], // point of the icon which will correspond to marker's location
        popupAnchor:  [-15, -30] // point from which the popup should open relative to the iconAnchor
    });	
    
    var user = L.icon({
        iconUrl: '/user_img/user_loc.png',
        iconSize:     [42, 32], // size of the icon
        iconAnchor:   [30, 30], // point of the icon which will correspond to marker's location
        popupAnchor:  [-15, -30] // point from which the popup should open relative to the iconAnchor
    });	

    // var marker;
    // var markers = L.markerClusterGroup();
    //Maps Layouts
    var map = L.map('map',{
        zoomControl:false
    }).setView([-8.5240574,115.2110998],15);	
    L.tileLayer('https://maps.tilehosting.com/styles/streets/{z}/{x}/{y}.png?key=YrAn6SOXelkLFXHv03o2',{
        attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
    }).addTo(map);

    //Maps Action
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

    //Maps Controller
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

    //Maps Geo Location
    map.locate({setView: true, maxZoom: 16});

    function onLocationFound(e) {
        // var radius = e.accuracy / 1;
    
        L.marker(e.latlng).addTo(map)
        // .bindPopup("You are within " + radius + " meters from this point").openPopup();
        // L.circle(e.latlng, radius).addTo(map);

        $("#center").click(function(){
            map.setView(e.latlng,map.getZoom(16));
        });
    }
    
    map.on('locationfound', onLocationFound);

    function onLocationError(e) {
        alert(e.message);
        $('#center').addClass('disabled');
    }
    
    map.on('locationerror', onLocationError);

    //Maps Marker
    function markerOnClick(e) {
        $('.sidebar-wrapper').animate({
            width: "360px"
        });;;
        map.setView(e.latlng,map.getZoom());
        console.log(e.latlng);
    }
    
    map.on('click', function(){
        $('.sidebar-wrapper').animate({
            width: "0"
        });;
        $('#myElement').hide();
        $('#myElement2').hide();
    })
    var marker1 = L.marker([-8.708337,115.185124],{icon: icons}).addTo(map).on('click', markerOnClick);
    var marker2 = L.marker([-8.7105212,115.1814639],{icon: icons}).addTo(map).on('click', markerOnClick);

});	

    