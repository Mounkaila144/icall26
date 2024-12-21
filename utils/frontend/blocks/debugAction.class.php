<?php

 
class utils_debugActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {       
        $this->getUser()->getStorage()->write('debug',($request->getGetParameter('debug')=="true"));
        if ($request->getGetParameter('debug')=="true")
            echo "<!-- Debug ON -->";       
        return mfView::NONE; 
    }
    
}    