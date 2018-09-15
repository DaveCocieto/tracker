require('../scss/map.scss');

console.log('MAP INIT');

var map = 0;

var initMap = function() {
    tomtom.setProductInfo('tracker', '0.1');
    map = tomtom.map('map', {
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
};

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
    var geoJson = tomtom.L.geoJson(polyline, { style: { color: '#08ff00', opacity: 1, weight: 6 } }).addTo(map);
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

var toggleRoutesContainer = function(data) {
    if ($('#routes-container').is(':hidden')) {
        $('#routes-container').show();
        $(data.target).html('Zwiń');
    } else {
        $('#routes-container').hide();
        $(data.target).html('Rozwiń');
    }
};

initMap();

$('.route-item').click(function(e) {
    loadRouteFromDB(e);
});

$('.routes-container-close').click(function(e) {
    toggleRoutesContainer(e);
});
