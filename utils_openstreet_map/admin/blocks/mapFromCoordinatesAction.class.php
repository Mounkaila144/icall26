<?php
class utils_openstreet_map_mapFromCoordinatesActionComponent extends mfActionComponent {

    function execute(mfWebRequest $request) {
        $this->url = UtilOpenStreetMapApi::BASE_TILE_URL;
        $this->key_id = $this->getParameter('id');
        $this->icon = $this->getParameter('icon');
        $this->zoom = $this->getParameter('zoom');
        $this->error = null; // Initialisez l'erreur à null
       if ($this->hasParameter('lat') && $this->getParameter('lat') && $this->hasParameter('lon') && $this->getParameter('lon')) {
            $this->lat = $this->getParameter('lat');
            $this->lon = $this->getParameter('lon');
        } else {
            $this->error = __('coordinates is empty');
        }
    }
}

