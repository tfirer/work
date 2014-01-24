$(document).ready(function(){
    google.maps.event.addDomListener(window, 'load', initialize);

    $('#submit_create').click(function(){
        submit_create();
    });

    $('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
});

var map, lastPosition, currentPosition, directionsService, totalDistance;
var positionArray = new Array();
var markerArray   = new Array();
var displayArray  = new Array();
var distanceArray = new Array();

function initialize() {
    directionsService = new google.maps.DirectionsService();
    var mapOptions = {
        zoom: 16,
        center: new google.maps.LatLng(40.7148015692,-73.8667058945),
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    google.maps.event.addListener(map, 'click', function(e) {
        placeMarker(e.latLng);
    });
    initSearch();
}

function placeMarker(position) {
    if (lastPosition == null) {
        lastPosition = position;
        //alert('Success add start point, then add end point');
    } else {
        currentPosition = position;
        drawDirections(lastPosition, currentPosition);
    }
    positionArray.push(position);
    //console.log(positionArray);
    drawMarker(position);
    lastPosition = position;
}

function drawMarker(position) {
    var marker = new google.maps.Marker({
        position: position,
        map: map
    });
    markerArray.push(marker);
}

function drawDirections(start, end) {
    var polylineOptions = {
        strokeColor: "#0099FF" ,
        strokeOpacity: 0.8 ,
        strokeWeight: 4 ,
    };
    var rendererOptions = {
        map: map ,
        draggable: false ,
        polylineOptions: polylineOptions ,
        hideRouteList: true ,
        suppressMarkers: true ,
        preserveViewport: true ,
    };
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.WALKING
    };

    var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
    directionsDisplay.setMap(map);
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            pushDistance(response.routes[0].legs[0].distance.value);
            //showSteps(response);
        }
    });
    displayArray.push(directionsDisplay);
    lastPosition = currentPosition;
}

function showSteps(directionResult) {
    var myRoute = directionResult.routes[0].legs[0];
    countDistance(myRoute.distance);

    for (var i = 0; i < myRoute.steps.length; i++) {
        var position = myRoute.steps[i].start_location;
        // positionArray.push(position);
        var marker = new google.maps.Marker({
            position: position ,
            map: map
        });
    }
}

function pushDistance(value) {
    distanceArray.push(parseInt(value));
    updateDistance();
}

function updateDistance() {
    totalDistance = 0;
    for (var i = 0; i < distanceArray.length; i++) {
        totalDistance += distanceArray[i];
    };
    document.getElementById('total').innerHTML = totalDistance + " m";
}

function Undo() {
    var marker = markerArray.pop();
    var display = displayArray.pop();
    distanceArray.pop();
    positionArray.pop();
    marker.setMap(null);
    display.setMap(null);
    lastPosition = positionArray[positionArray.length - 1];
    updateDistance();
}

function Reset() {
    for (var i = 0; i < markerArray.length; i++) {
        markerArray[i].setMap(null);
    }

    for (var i = 0; i < displayArray.length; i++) {
        displayArray[i].setMap(null);
    }

    markerArray   = new Array();
    displayArray  = new Array();
    positionArray = new Array();
    distanceArray = new Array();
    lastPosition  = null;
    updateDistance();
}

function submit_create() {
    /*
    ** JSON.stringify(array)
    ** decode positionArray to json_string like '[[lat, lng],[lat, lng],[lat, lng]]'
    */
    if (positionArray.length == 0) {
        alert('Please draw your route first.');
        return;
    }
    var route = new Array();
    for (var index in positionArray) {
        var p = new Array(positionArray[index]['nb'], positionArray[index]['ob']);
        route.push(p);
    }
    $('#route').val(JSON.stringify(route));
    $('#gps_lat').val(positionArray[0]['nb']);
    $('#gps_lng').val(positionArray[0]['ob']);
    $('#total_distance').val(totalDistance);
    document.activityForm.submit();
}

function initSearch() {
    var markers = [];
    var input = (document.getElementById('pac-input'));
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var searchBox = new google.maps.places.SearchBox((input));
    google.maps.event.addListener(searchBox, 'places_changed', function() {
        var places = searchBox.getPlaces();

        for (var i = 0, marker; marker = markers[i]; i++) {
            marker.setMap(null);
        }

        // For each place, get the icon, place name, and location.
        markers = [];
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0, place; place = places[i]; i++) {
            var image = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(20, 20)
            };

            // Create a marker for each place.
            var marker = new google.maps.Marker({
                map: map,
                icon: image,
                title: place.name,
                position: place.geometry.location
            });

            markers.push(marker);

            bounds.extend(place.geometry.location);
        }

        map.fitBounds(bounds);
    });
    google.maps.event.addListener(map, 'bounds_changed', function() {
        var bounds = map.getBounds();
        searchBox.setBounds(bounds);
    });
}
