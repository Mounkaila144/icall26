<link rel="stylesheet" href="{url('/css/leaflet.css','web')}">
<script src="{url('/js/leaflet.js','web')}"></script>

<div class="map-container">
    <div style="height: 60vh;" id="map-{$key_id}"></div>
</div>

<script>
    var macarte;
    var mapInitialized = false;

    function initializeMap() {
        if (mapInitialized) {
            macarte.invalidateSize();
            return;
        }
        mapInitialized = true;

        macarte = L.map("map-{$key_id}").setView(
            [{$map->get('lat')}, {$map->get('lng')}],
                {$zoom}
        );

        L.tileLayer("{$url}", {
            attribution: "{__('Data © OpenStreetMap/ODbL - Rendered by OSM France')}",
            minZoom: 1,
            maxZoom: 20
        }).addTo(macarte);

        L.marker([{$map->get('lat')}, {$map->get('lng')}], {
            icon: L.icon({
                iconUrl: "{$icon}",
                iconSize: [38, 38],
                iconAnchor: [22, 94],
                popupAnchor: [-3, -76]
            })
        }).addTo(macarte).openTooltip();
    }

    $('a[href="#tab-customer-contracts-openstreetmaps-{$key_id}"]').on('click', function () {
        function initializeMapWhenVisible() {
            if ($("#map-{$key_id}").is(":visible")) {
                initializeMap();
            } else {
                setTimeout(initializeMapWhenVisible, 50);
            }
        }
        initializeMapWhenVisible();
    });

</script>