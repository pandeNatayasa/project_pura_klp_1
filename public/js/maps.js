$(document).ready(function(){
    //Maps Icon
    // var icons = L.icon({
    //     iconUrl: '/user_img/temple-icon.png',
    //     iconSize:     [32, 32], // size of the icon
    //     iconAnchor:   [30, 30], // point of the icon which will correspond to marker's location
    //     popupAnchor:  [-15, -30] // point from which the popup should open relative to the iconAnchor
    // });	

    var marker;
    var markers = L.markerClusterGroup();
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

    // var marker = L.marker([-8.708337,115.185124],{icon: icons, title: 'Pura Goa Gong',alt:'Pura Goa Gong'}).addTo(map).on('click', markerOnClick);
    // var marker = L.marker([-8.7105212,115.1814639],{icon: icons, title: 'Pura Goa Gong'}).addTo(map).on('click', markerOnClick);
    // markers.addLayer(marker);

    function markerClick(e) {
        // console.log(" here ajas to load data and view in side bar");
        var html_icon = e.sourceTarget._icon.innerHTML; // this is html of icons with type string

        // This is proccess to get temple_id from html_icon
        var array_html = html_icon.split('temple_id="');
        // console.log("arry_html[1] : "+array_html[1]);
        var array_temple_id = array_html[1].split('"');
        var temple_id = array_temple_id[0]
        // console.log("temple id : "+temple_id);
        // End of proccess to get temple_id

        // This ajax to load data from database and view in sidebar
        $.ajax({
            url: "/temple-detail/"+temple_id,
            type: "get",
            dataType: 'json',
            success: function (response){
                // var temple_name = response[0];
                // console.log(response);
                // console.log(response[1]);
                // console.log(response[2]);
                // console.log(response.temple_name)
                var temple = response[0];
                var temple_image = response[1];
                var odalan = response[2];
                var temple_type = response[3];
                var temple_element = response[4];

                // Foreach image of temple and set in sidebar info
                var temple_image_string = "";
                var i = 0;
                temple_image.forEach(function(element) {
                    // console.log(element.image_name);
                    if (i == 0) {
                        // console.log(temple_image[i].image_name)
                        temple_image_string += '<div class="carousel-item active"><img src="'+element.image_name+'" alt="" width="100%" height="200px" ></div>';    
                    }else{
                        temple_image_string += '<div class="carousel-item"><img src="'+element.image_name+'" alt="" width="100%" height="200px" ></div>';    
                    }
                    i++;
                });
                document.getElementById('sidebar_image_temple').innerHTML = temple_image_string;

                // This is to set side bar info
                document.getElementById('sidebar_temple_name').innerHTML = temple.temple_name;
                document.getElementById('sidebar_temple_type').innerHTML = response[3].type_name;
                document.getElementById('icon_address_of_temple').innerHTML = response[0].address;
                document.getElementById('icon_priest_name').innerHTML = response[0].priest_name;

                // Check if odalan type is sasih or wuku
                if (temple.odalan_type == 'sasih') {
                    var odalan_string = odalan.rahinan_name+", Sasih "+odalan.sasih_name ;
                }
                if(temple.odalan_type == 'wuku'){
                    var odalan_string = odalan.saptawara_name+" "+odalan.pancawara_name +", Wuku "+odalan.wuku_name;
                }

                document.getElementById('icon_odalan').innerHTML = odalan_string;
                document.getElementById('space_for_temple_description').innerHTML = response[0].description;                            

                // Setting temple element
                var temple_element_string = "";
                temple_element.forEach(function(element){
                    temple_element_string += '<div class="element_image col-4 mb-2 pr-0" element_id="'+element.id+'" element_name="'+element.element_name+'" element_description="'+element.element_description+'" element_god="'+element.god+'" onclick="view_element_detail.call(this)"><img src="/'+element.image_name+'" width="90px" height="50px" alt="Card image"></div>';
                });
                document.getElementById('sidebar_temple_element').innerHTML = temple_element_string;

            },
            error: function(e) {
                console.log("error : "+ e)
            }
        });
    }

    //Load Marker From Database
    $.ajax({
        url: "/loadMarker",
        type: "get",
        dataType: 'json',
        success: function (response){
            $.each(response, function(i,item){

                //Panorama 360
                $("#myPano"+response[i].id).pano({
                    img: "/user_img/element/panorama.jpg",
                });
            
                var modal = document.getElementById('panoramaModal');
                
                $('#myPano'+response[i].id).click(function(){
                    modal.style.display = "block";
                    var imagin = this.style.backgroundImage.replace('url("','').replace('")','');
                    $("#myModalPanos").pano({
                        img: imagin,
                });
                    console.log(imagin)
                })

                var span = document.getElementsByClassName("close-img"+response[i].id)[0];
                
                span.onclick = function() { 
                    modal.style.display = "none";
                }

                //Maps Marker
                map.on('click', function(){
                    $('.sidebar-wrapper').animate({
                        width: "0"
                    });
                    $('#myElement').hide();
                    $('#myElement2').hide();
                })

                function markerOnClick(e) {
                    markerClick(e)

                    $('.sidebar-wrapper').animate({
                        width: "360px"
                    });;;
                    map.setView([response[i].latitude, response[i].longitude],map.getZoom());
                }

                var icons = L.divIcon({
                    iconSize:null,
                    html:'<div class="map-label"><img src="/user_img/marker.png" width="25px" temple_id="'+response[i].id+'"></img><div class="map-label-content ml-1">'+response[i].temple_name+'</div></div>'
                });
                marker = L.marker([response[i].latitude, response[i].longitude],{icon: icons}).on('click', markerOnClick)
                markers.addLayer(marker);
                // console.log(response)
            });
        },
        error: function(e){
            console.log("error"+ e)
        }
    });
    map.addLayer(markers);	


    //Map Image Zoom
    var maps = L.map('map1',{
        zoomControl:false
    }).setView([-8.5240574,115.2110998],12);	
    L.tileLayer('https://maps.tilehosting.com/styles/streets/{z}/{x}/{y}.png?key=YrAn6SOXelkLFXHv03o2').addTo(maps);

    maps.locate({setView: true, maxZoom: 20});

});	

    