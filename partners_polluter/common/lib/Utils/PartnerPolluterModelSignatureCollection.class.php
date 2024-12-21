<?php


class PartnerPolluterModelSignatureCollection extends mfArray {
    
    
    function __construct($data = null) {
        $signatures=array();
        if ($data)
        {    
            foreach (explode(";",$data) as $signature)
                $signatures[]=new PartnerPolluterModelSignature($signature);
        }
        parent::__construct($signatures);
    }
     
}
