<?php


class DomoprimeAssetNewForm extends DomoprimeAssetBaseForm {
      

    function configure()
    {
        parent::configure();
        unset($this['id']);
    }


}
