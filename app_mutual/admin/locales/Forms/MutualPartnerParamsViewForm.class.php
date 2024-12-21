<?php


class MutualPartnerParamsViewForm extends MutualPartnerParamsBaseForm {
    
    public function configure() {
        parent::configure();
        unset($this['id']);
    }
}


