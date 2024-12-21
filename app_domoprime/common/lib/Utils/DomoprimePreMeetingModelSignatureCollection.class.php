<?php


class DomoprimePreMeetingModelSignatureCollection extends mfArray {
    
    
    function __construct($data = null) {
        $signatures=array();
        if ($data)
        {    
            foreach (explode(";",$data) as $signature)
                $signatures[]=new DomoprimePreMeetingModelSignature($signature);
        }
        parent::__construct($signatures);
    }
     
}
