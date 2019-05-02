$(document).ready(function(){
    var icons = L.icon({
        iconUrl: '/user/temple-icon.png',
        iconSize:     [32, 32], // size of the icon
        iconAnchor:   [30, 30], // point of the icon which will correspond to marker's location
        popupAnchor:  [-15, -30] // point from which the popup should open relative to the iconAnchor
    });	
    
    var user = L.icon({
        iconUrl: '/user/user_loc.png',
        iconSize:     [42, 32], // size of the icon
        iconAnchor:   [30, 30], // point of the icon which will correspond to marker's location
        popupAnchor:  [-15, -30] // point from which the popup should open relative to the iconAnchor
    });	

    var marker;
    var markers = L.markerClusterGroup();
    var map = L.map('map',{
        zoomControl:false
    }).setView([-8.5240574,115.2110998],10);	
    L.tileLayer('https://maps.tilehosting.com/styles/streets/{z}/{x}/{y}.png?key=YrAn6SOXelkLFXHv03o2',{
        attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
    }).addTo(map);
    lc = L.control.locate({
        strings: {
            title: "Show me where I am, yo!"
        }
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

    map.locate({setView: true, maxZoom: 16});

    function onLocationFound(e) {
        // var radius = e.accuracy / 1;
    
        L.marker(e.latlng,{icon:user}).addTo(map)
            // .bindPopup("You are within " + radius + " meters from this point").openPopup();
    
        // L.circle(e.latlng, radius).addTo(map);
        // console.log(e.latlng);

        $("#center").click(function(){
            map.setView(e.latlng,map.getZoom());
        });
    }
    
    map.on('locationfound', onLocationFound);

    function onLocationError(e) {
        alert(e.message);
        $('#center').addClass('disabled');
    }
    
    map.on('locationerror', onLocationError);

    function markerOnClick(e) {
        $('.sidebar-wrapper').show();
      }
    
    map.on('click', function(){
        $('.sidebar-wrapper').hide();
    })
    
    var marker1 = L.marker([-8.708337,115.185124],{icon: icons}).addTo(map).on('click', markerOnClick);
    var marker2 = L.marker([-8.7105212,115.1814639],{icon: icons}).addTo(map).on('click', markerOnClick);
});	

    