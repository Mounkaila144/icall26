<link rel="stylesheet" href="{url('/css/leaflet.css','web')}">
<script src="{url('/js/leaflet.js','web')}"></script>

{if $error}
    <span class="text-danger text-center fs-24">{$error}</span>
{else}
    <h1 class="text-center text-primary my-4 display-4">{__('Localization with OpenstreetMap')} </h1>
    <div class="map-container">
        <div style="height: 60vh;" id="map-{$key_id}"></div>
    </div>
    <script>
        var macarte = L.map("map-{$key_id}").setView([{$lat}, {$lon}], {$zoom});
        L.tileLayer("{$url}", {
            attribution: "{__('Data © OpenStreetMap/ODbL - Rendered by OSM France')}",
            minZoom: 1,
            maxZoom: 20
        }).addTo(macarte);
        L.marker([{$lat}, {$lon}], {
            icon: L.icon({
                iconUrl: "{$icon}",
                iconSize: [38, 38],
                iconAnchor: [22, 94],
                popupAnchor: [-3, -76]
            })
        }).addTo(macarte).openTooltip();

    </script>
{/if}
