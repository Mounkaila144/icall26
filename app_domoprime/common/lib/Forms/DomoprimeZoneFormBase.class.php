<?php


class DomoprimeZoneFormBase extends mfForm {

    function configure()
    {
        $this->setValidators(array(
                "id"=>new mfValidatorInteger(),  
                "code"=>new mfValidatorString(),
                "dept"=>new  mfValidatorString(),
                "sector_id"=>new mfValidatorChoice(array('key'=>true,'required'=>true,'choices'=>array(""=>__("---"))+DomoprimeSector::getSectorForSelect())),
                "region_id"=>new mfValidatorChoice(array('key'=>true,'required'=>true,'choices'=>array(""=>__("---"))+DomoprimeRegion::getRegionForSelect())),
            )
        );
    }


}



