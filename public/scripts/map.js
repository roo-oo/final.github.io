//Islam Arua IS-1606

var marker1;
var marker2;
var marker3;
var marker4;

var map;
function initialize() {
var mapOptions = {
zoom: 6,
center: new google.maps.LatLng(43.344789, 76.9110114),
mapTypeId:google.maps.MapTypeId.TERRAIN
};
map = new google.maps.Map(document.getElementById('map'),
mapOptions);

}


google.maps.event.addDomListener(window, 'load', initialize);