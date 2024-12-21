<?php


class DomoprimeAfterWorkModelSignatureCollection extends mfArray {
    
    
    function __construct($data = null) {
        $signatures=array();
        if ($data)
        {    
            foreach (explode(";",$data) as $signature)
                $signatures[]=new DomoprimeAfterWorkModelSignature($signature);
        }
        parent::__construct($signatures);
    }
     
}
