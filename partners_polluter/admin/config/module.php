<?php

// key=[action]
return array(
    
     
    "ajaxSaveLogo"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteLogo"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
      
    "ajaxSaveSignature"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteSignature"=>array("mode"=>"json","helpers"=>array("url"=>null)),
        
    "ajaxSavePicture"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeletePicture"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "PreviewModel"=>array('mode'=>'none'),
    
    "ajaxDeleteModel"=>array("mode"=>"json"),       
    
    "PreviewDocModelPdf"=>array('mode'=>'none'),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);