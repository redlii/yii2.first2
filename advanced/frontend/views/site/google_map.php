<?php
use yii\helpers\Html;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

$this->title = 'First page';
$this->params['breadcrumbs'][] = $this->title;
?>

<h3>Google map example.</h3>

<?php
$coord = new LatLng(['lat' => 47.8388, 'lng' => 35.139567]);
$map = new Map([
  'center' => $coord,
  'zoom' => 4,
  'disableDoubleClickZoom' => false,
  'draggable' => true,
  'mapMaker' => true,
]);

// lets use the directions renderer 47.849580, 35.106339
$home = new LatLng(['lat' => 47.8388, 'lng' => 35.139567]);
$point2 = new LatLng(['lat' => 47.82289, 'lng' => 35.19031]);
$lessons_point = new LatLng(['lat' => 47.849580, 'lng' => 35.106339]);

// setup just one waypoint (Google allows a max of 8)
$waypoints = [
  new DirectionsWayPoint(['location' => $lessons_point])
];

$directionsRequest = new DirectionsRequest([
  'origin' => $home,
  'destination' => $point2,
  'waypoints' => $waypoints,
  'travelMode' => TravelMode::DRIVING
]);

// Lets configure the polyline that renders the direction
$polylineOptions = new PolylineOptions([
  'strokeColor' => '#FFAA00',
  'draggable' => true
]);

// Now the renderer
$directionsRenderer = new DirectionsRenderer([
  'map' => $map->getName(),
  'polylineOptions' => $polylineOptions
]);

// Finally the directions service
$directionsService = new DirectionsService([
  'directionsRenderer' => $directionsRenderer,
  'directionsRequest' => $directionsRequest
]);

// Thats it, append the resulting script to the map
$map->appendScript($directionsService->getJs());

// Lets add a marker now
$marker = new Marker([
  'position' => $coord,
  'title' => 'Zaporizchya',
]);

// Provide a shared InfoWindow to the marker
$marker->attachInfoWindow(
  new InfoWindow([
    'content' => '<p>Занятия</p>'
  ])
);

// Add marker to the map
$map->addOverlay($marker);

// Now lets write a polygon
$coords = [
  new LatLng(['lat' => 47.8388, 'lng' => 35.139567]),
  new LatLng(['lat' => 47.86289, 'lng' => 35.19031]),
  new LatLng(['lat' => 47.869580, 'lng' => 35.106339]),
  new LatLng(['lat' => 47.849580, 'lng' => 35.116339])
];

$polygon = new Polygon([
  'paths' => $coords
]);

// Add a shared info window
$polygon->attachInfoWindow(new InfoWindow([
  'content' => '<p>This is my super cool Polygon</p>'
]));

// Add it now to the map
/*$map->addOverlay($polygon);*/

// Lets show the BicyclingLayer :)
$bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

// Append its resulting script
$map->appendScript($bikeLayer->getJs());

// Display the map -finally :)
echo $map->display();
?>
