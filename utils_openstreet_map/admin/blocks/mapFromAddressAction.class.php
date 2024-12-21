<?php
require_once __DIR__ . "/../locales/Forms/OpenstreetMapCalculateCoordinatesForm.class.php";

class utils_openstreet_map_mapFromAddressActionComponent extends mfActionComponent
{

    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        try {
            $this->url = UtilOpenStreetMapApi::BASE_TILE_URL;
            $this->icon = $this->getParameter('icon');
            $this->zoom = $this->getParameter('zoom');
            $this->error = null;
            $this->key_id = $this->getParameter('id');

            if ($this->hasParameter('address') && $this->getParameter('address')) {
                $this->map = new OpenstreetMapAddress();
                $this->map->add(array('address' => $this->getParameter('address')));
                $this->map->calculateCoordinates();
            } else {
                $this->error = __('Adresse is empty');
            }
        } catch (mfException $e) {
            $messages->addError($e);
        }
    }
}
