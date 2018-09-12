require('../scss/map.scss');

console.log('MAP INIT');

tomtom.setProductInfo('tracker', '0.1');
var map = tomtom.map('map', {
    key: 'key',
    //source: 'vector',
    basePath: '/tomtom/',
    center: [52.083134, 19.183603],
    zoom: 7
});

var languageLabel = L.DomUtil.create('label');
languageLabel.innerHTML = 'Maps language';
var languageSelector = tomtom.languageSelector.getHtmlElement(tomtom.globalLocaleService, 'maps');
languageLabel.appendChild(languageSelector);
tomtom.controlPanel({
    position: 'bottomright',
    title: 'Settings',
    collapsed: true,
    closeOnMapClick: false
})
    .addTo(map)
    .addContent(languageLabel);

// polygons
/*var polygon = {
    'type': 'FeatureCollection',
    'features': [
        {
            'type': 'Feature',
            'properties': {},
            'geometry': {
                //'type': 'Polygon',
                'type': 'MultiLineString',
                'coordinates': [
                    [
                        [19.313552, 53.270307],
                        [20.871820, 52.664186],
                        [17.329218, 51.687699],
                        [21.624176, 50.415359]
                    ]
                ]
            }
        }
    ]
};
var geoJson = tomtom.L.geoJson(polygon, { style: { color: '#00d7ff', opacity: 0.8 } }).addTo(map);
map.fitBounds(geoJson.getBounds(), { padding: [5, 5] });*/

var clearMap = function() {
    map.eachLayer(function (layer) {
        /*
         * Sprawdzamy czy parametry warstwy sa okreslone
         * Sprawdzamy typ geomtrii, jezeli to MultiLineString (czyli polyline) to usuwamy
         */
        if (layer.feature != undefined && layer.feature.geometry != undefined && layer.feature.geometry.type === 'MultiLineString') {
            map.removeLayer(layer);
        }
    });
};

var loadRouteToMap = function(json) {
    var coordintes = [];

    for (i = 0; i < json.length; i++) {
        coordintes.push([
            json[i].lng,
            json[i].lat
        ]);
    }

    var polyline = {
        'type': 'FeatureCollection',
        'features': [
            {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    //'type': 'Polygon',
                    'type': 'MultiLineString',
                    'coordinates': [
                        coordintes
                    ]
                }
            }
        ]
    };

    clearMap();
    var geoJson = tomtom.L.geoJson(polyline, { style: { color: '#00d7ff', opacity: 0.8 } }).addTo(map);
    map.fitBounds(geoJson.getBounds(), { padding: [5, 5] });
};

var loadRouteFromDB = function(data) {
    var element = $(data.target);
    var route_id = element.data('route-id')

    $.ajax({
      /*method: "POST",
      url: "some.php",
      data: { name: "John", location: "Boston" }*/
      method: 'GET',
      url: '/get_route/' + route_id
    }).done(function(data) {
      loadRouteToMap(data);
    });
};

$('.route-item').click(function(e) {
    loadRouteFromDB(e);
});
