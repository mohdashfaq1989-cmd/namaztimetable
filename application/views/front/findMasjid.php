<!DOCTYPE html>
<html>
<head>

    <title>Find Masjid</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDor5-0fakuLVig3BgA5xX2KqpSfjpzijc&libraries=places"></script>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial,sans-serif;
            background:#f4f6f9;
            overflow:hidden;
        }

        .container{
            display:flex;
            height:100vh;
        }

        /* =========================
        LEFT PANEL
        ========================= */

        .list{
            width:38%;
            overflow-y:auto;
            background:#f5f7fb;
            border-right:1px solid #ddd;
        }

        /* =========================
        TOOLBAR
        ========================= */

        .toolbar{

            padding:18px;
            background:#fff;
            position:sticky;
            top:0;
            z-index:999;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);

        }

        .toolbar input,
        .toolbar select{

            width:100%;
            padding:13px 15px;
            margin-bottom:12px;
            border:1px solid #ddd;
            border-radius:10px;
            font-size:15px;
            outline:none;

        }

        .toolbar button{

            width:100%;
            padding:12px;
            border:none;
            border-radius:10px;
            margin-bottom:10px;
            cursor:pointer;
            font-size:12px;
            font-weight:bold;
            color:#fff;
            transition:0.3s;

        } 

        .toolbar button:hover{
            opacity:0.9;
        }

        .search-btn{
            background:#0d6efd;
        }

        .location-btn{
            background:green;
        }

        .back-btn{

            display:block;
            text-align:center;
            background:#222;
            color:#fff;
            text-decoration:none;
            padding:12px;
            border-radius:10px;
            font-size:12px;

        }

        /* =========================
        CARD
        ========================= */

        .item{

            display:flex;
            gap:15px;
            background:#fff;
            margin:15px;
            padding:12px;
            border-radius:15px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
            transition:0.3s;
            align-items:flex-start;

        }

        .item:hover{

            transform:translateY(-3px);

        }

        /* IMAGE */

        .masjid-image{

            width:140px;
            height:110px;
            border-radius:12px;
            object-fit:cover;
            flex-shrink:0;
            background:#ddd;

        }

        /* CONTENT */

        .card-body{
            flex:1;
        }

        .masjid-title{

            font-size:20px;
            margin-bottom:8px;
            color:#222;
            line-height:1.4;

        }

        .location{

            color:#666;
            line-height:1.6;
            font-size:14px;
            margin-bottom:20px;

        }

        .distance{

            display:inline-block;
            background:#e8f5e9;
            color:green;
            padding:5px 10px;
            border-radius:20px;
            font-size:12px;
            font-weight:bold;
            margin-bottom:12px;

        }

        /* BUTTONS */

        .btn-group{

            display:flex;
            gap:10px;

        }

        .btn{

            flex:1;
            text-align:center;
            
            border-radius:8px;
            text-decoration:none;
            color:#fff;
            font-size:13px;
            font-weight:bold;
            border:none;
            cursor:pointer;

        }

        .btn-map{
            background:#0d6efd;
            padding:9px;
        }

        .btn-direction{
            background:green;
            padding:9px;
        }

        /* MAP */

        .map{
            width:62%;
        }

        /* LOADER */

        #loader{

            display:none;
            text-align:center;
            color:green;
            font-weight:bold;
            padding-top:10px;

        }

        /* SCROLLBAR */

        .list::-webkit-scrollbar{
            width:7px;
        }

        .list::-webkit-scrollbar-thumb{
            background:#ccc;
            border-radius:10px;
        }

        /* MOBILE */

.image-section{

    width:140px;
    flex-shrink:0;
}

.image-btn{

    margin-top:8px;
    padding:9px;
    display:block;
    background:#6f42c1;
    font-size: 10px;
}
.toolbar-buttons{
    display:flex;
    gap:8px;
    margin-bottom:10px;
}

.toolbar-buttons button,
.toolbar-buttons a{
    flex:1;
    margin-bottom:0 !important;
    text-align:center;
    padding:12px 8px;
    white-space:nowrap;
}
/* MOBILE */
@media screen and (max-width: 1080px){
    .btn-map { 
        font-size: 10px; 
    }
    .btn-direction {
        font-size: 10px; 
    }
    .masjid-title {
        font-size: 16px; 
    } 
    .masjid-image { 
        height: 90px; 
    }
    .location { 
        font-size: 12px; 
    }
}
@media screen and (max-width: 900px){
    .image-section {
        width: 120px; 
    }
    .btn-map { 
        font-size: 10px; 
    }
    .btn-direction {
        font-size: 10px; 
    }
    .masjid-title {
        font-size: 13px; 
    } 
    .masjid-image{
        width:120px;
        height:90px;
    }
    .location { 
        font-size: 12px; 
    }
}
@media screen and (max-width: 768px){

    body{
        overflow:auto;
    }

    .container{
        flex-direction:column-reverse;
        height:auto;
    }

    .list{
        width:100%;
        border-right:none;
    }

    .map{
        width:100%;
        height:300px;
        position:fixed;
        top:0;
        left:0;
        z-index:999;
    }

    .item{
        gap:10px;
        padding:10px;
        margin:10px;
    }

    .image-section{
        width:160px;
    }
    .image-btn {
        font-size: 10px;
    }

    .masjid-image{
        width:160px;
        height:90px;
    }

    .location{
        font-size:12px;
    }

    .btn-group{
        /*flex-direction:column;*/
    }

    .btn{
        width:100%;
    }
}
/* Small Mobile */
@media screen and (max-width: 480px){
    
    .toolbar-buttons button, .toolbar-buttons a { 
        padding: 8px 8px; 
    }
     
    .card-body { 
        width: 100%;
    }

    .map{
        height:250px;
        min-height:250px;
    }

    .item{
        flex-direction:column;
    }

    .image-section{
        width:100%;
    }

    .masjid-image{
        width:100%;
        height:180px;
    }

    .masjid-title{
        font-size:14px;
    }

    .location{
        font-size:11px;
    }

    .toolbar{
        padding:10px;
    }

    .toolbar input,
    .toolbar select,
    .toolbar button{
        font-size:13px;
    }
}

    </style>

</head>

<body>

<div class="container">

    <!-- LEFT PANEL -->
    <div class="list">

        <div class="toolbar">

            <input type="text" id="search" placeholder="Search masjid or location">
             
            </select>
            <select id="radius">
                <option value="">All Radius</option>
                <option value="2">2 KM</option>
                <option value="5">5 KM</option>
                <option value="10">10 KM</option>
            </select>
            <div class="toolbar-buttons">
                <button class="search-btn" onclick="searchMasjid()">Search</button>
                <button class="location-btn" onclick="getLocation()" > 📍 My Location</button>
                <a href="<?= base_url(); ?>" class="back-btn" > Back to Home </a>
            </div>
                <div id="loader"> Loading... </div>
        </div>

        <!-- RESULT -->
        <div id="listData"></div>

    </div>

    <!-- MAP -->
    <div id="map" class="map"></div>

</div>

<script>

let map;
let markers = [];
let userLat = null;
let userLng = null;
let infoWindow;

// ======================
// INIT MAP
// ======================

function initMap() {

    map = new google.maps.Map(
        document.getElementById('map'),
        {
            zoom: 12,
            center: {
                lat: 29.959694, 
                lng: 77.549057
            }
        }
    );

    infoWindow =
        new google.maps.InfoWindow();

    initAutocomplete();

    loadMasjid();
}

// ======================
// LOAD MASJID
// ======================

function loadMasjid(query = "") {

    let radius =
        document.getElementById("radius").value;

    let url =
        `<?= base_url('masjid/search'); ?>?q=${query}&radius=${radius}`;

    if (
        userLat !== null &&
        userLng !== null
    ) {

        url += `&lat=${userLat}`;

        url += `&lng=${userLng}`;
    }

    showLoader();

    fetch(url)

    .then(res => res.json())

    .then(data => {

        hideLoader();

        // remove old markers
        markers.forEach(marker => {

            marker.setMap(null);

        });

        markers = [];

        // no result
        if (data.length === 0) {

            document.getElementById("listData")
                .innerHTML =
                "<p style='padding:20px;'>No masjid found</p>";

            return;
        }

        let listHtml = "";

        // loop
        data.forEach((m, i) => {

            // ======================
            // MAP MARKER
            // ======================

            let marker =
                new google.maps.Marker({

                    position: {

                        lat: parseFloat(m.lat),

                        lng: parseFloat(m.lng)

                    },

                    map: map,

                    title: m.name
                });

            // popup
            marker.addListener("click", () => {

                infoWindow.setContent(`

                    <div>

                        <b>${m.name}</b><br>

                        ${m.address}<br>

                        ${m.city || ''}

                        ${m.state || ''}

                    </div>

                `);

                infoWindow.open(map, marker);

            });

            markers.push(marker);

            // ======================
            // CARD HTML
            // ======================

            listHtml += `

            <div class="item">
                <div class="image-section">
                ${
                    m.image
                    ?
                    `
                    <img
                        src="<?= base_url('uploads/images/') ?>${m.image}"
                        class="masjid-image"
                    >
                    <a
                        href="<?= base_url('masjid/view/') ?>${m.id}"
                        class="btn image-btn" target="_blank"
                    >
                        About Masjid / Jamat Time Board
                    </a>
                    `
                    :
                    `
                    <img
                        src="https://via.placeholder.com/300x300?text=Masjid"
                        class="masjid-image"
                    >
                    `
                }
</div>
                <div class="card-body">

                    <h3 class="masjid-title">

                        ${m.name}

                    </h3>

                    <div class="location">

                        📍 ${m.address}<br>

                        🏙️ ${m.city || ''}<br>

                        🗺️ ${m.state || ''}

                    </div>

                    ${
                        m.distance
                        ?
                        `
                        <div class="distance">

                            ${parseFloat(m.distance).toFixed(2)}
                            KM Away

                        </div>
                        `
                        :
                        ''
                    }

                    <div class="btn-group">

                        <button
                            class="btn btn-map"
                            onclick="focusMap(${i})"
                        >
                            Show Map
                        </button>

                        <a
                            class="btn btn-direction"
                            target="_blank"

                            href="https://www.google.com/maps/dir/?api=1&destination=${m.lat},${m.lng}"
                        >
                            Direction
                        </a>

                    </div>

                </div>

            </div>

            `;
        });

        document.getElementById("listData")
            .innerHTML = listHtml;

    })

    .catch(error => {

        hideLoader();

        console.log(error);

        alert("Something went wrong");

    });

}

// ======================
// FOCUS MAP
// ======================

function focusMap(index) {

    let marker = markers[index];

    map.setCenter(
        marker.getPosition()
    );

    map.setZoom(16);

    google.maps.event.trigger(
        marker,
        'click'
    );
}

// ======================
// GET LOCATION
// ======================

function getLocation() {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(

            position => {

                userLat =
                    position.coords.latitude;

                userLng =
                    position.coords.longitude;

                let userPosition = {

                    lat: userLat,

                    lng: userLng
                };

                new google.maps.Marker({

                    position: userPosition,

                    map: map,

                    title: "Your Location",

                    icon:"https://maps.google.com/mapfiles/ms/icons/blue-dot.png"

                });

                map.setCenter(userPosition);

                map.setZoom(14);

                loadMasjid();

            },

            () => {

                alert(
                    "Location access denied"
                );

            }
        );

    } else {

        alert(
            "Geolocation not supported"
        );
    }
}

// ======================
// SEARCH
// ======================

function searchMasjid() {

    let q =
        document.getElementById("search").value;

    loadMasjid(q);
}

// ======================
// AUTOCOMPLETE
// ======================

function initAutocomplete() {

    const autocomplete =
        new google.maps.places.Autocomplete(

            document.getElementById('search')
        );

    autocomplete.addListener(
        'place_changed',

        function () {

            let place =
                autocomplete.getPlace();

            if (place.geometry) {

                map.setCenter(
                    place.geometry.location
                );

                userLat =
                    place.geometry.location.lat();

                userLng =
                    place.geometry.location.lng();

                loadMasjid();
            }
        }
    );
}

// ======================
// LOADER
// ======================

function showLoader() {

    document.getElementById("loader")
        .style.display = "block";
}

function hideLoader() {

    document.getElementById("loader")
        .style.display = "none";
}

// ======================
// PAGE LOAD
// ======================

window.onload = initMap;

</script>

</body>
</html>