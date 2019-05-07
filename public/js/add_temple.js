//Odalan
function openOdalanType(evt, odalanType) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(odalanType).style.display = "block";
    evt.currentTarget.className += " active";
}

//Pemangku
$(document).ready(function(){
    $('#btn-detail-pemangku').click(function(){
        if( $('#btn-detail-pemangku i').attr('class') == 'fa fa-chevron-up'){
            $('#btn-detail-pemangku i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
            $('#detail-pemangku').slideUp()
            
        }else{
            $('#btn-detail-pemangku i').removeClass('fa-chevron-down').addClass('fa-chevron-up')
            $('#detail-pemangku').slideDown()
        }
        
    })
})

//Location
$(document).ready(function(){
    $('.dynamic').change(function(){
        if($(this).val() != ''){
            
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"/fetch_data",
            method:"POST",
            data:{value:value,_token:_token,dependent:dependent},
            success:function(result)
            {
                $('#'+dependent).html(result);
            },
            error(e)
            {
                console.log(e);
            }
            })  
        }
    });
});

//Image Upload
$(document).ready(function(){
    $("div#myId").dropzone({ url: "/file/post" });
})

//Maps
$(document).ready(function(){
    var mymap = L.map('mymap',{
        zoomControl:false
    }).setView([-8.8013433,115.1652095],17);

    var marker;

    // //Maps Geo Location
    // map.locate({setView: true, maxZoom: 16});

    // function onLocationFound(e) {
    //     // var radius = e.accuracy / 1;
    
    //     L.marker(e.latlng).addTo(map)
    //     // .bindPopup("You are within " + radius + " meters from this point").openPopup();
    //     // L.circle(e.latlng, radius).addTo(map);

    //     $("#center").click(function(){
    //         map.setView(e.latlng,map.getZoom(16));
    //     });
    // }
    
    // map.on('locationfound', onLocationFound);

    // function onLocationError(e) {
    //     alert(e.message);
    //     $('#center').addClass('disabled');
    // }
    
    // map.on('locationerror', onLocationError);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoidHJpb3B1dHJhcCIsImEiOiJjam00ajRzbHMweXg2M2xxdDVwNHo4NmhiIn0.m9AganPvwoRN0HhmUJk0xg'
    }).addTo(mymap);

    var popup = L.popup();
    // function onMapClick(e) {
    //     popup
    //     .setLatLng(e.latlng)
    //     .setContent("Lokasi yang dipilih: " + e.latlng.toString())
    //     .openOn(mymap);
    // }
    // mymap.on('click', onMapClick);

    mymap.on('mousemove',function(e){
        $("#latitude").val(e.latlng.lat);
        $("#longitude").val(e.latlng.lng);
    });

    mymap.on('click',function(e){
        if(marker){
            mymap.removeLayer(marker);
        }

        marker = L.marker(e.latlng).addTo(mymap);
        document.getElementById("latitude").value = marker.lat; 
        document.getElementById("longitude").value = marker.lng; 
    });
});