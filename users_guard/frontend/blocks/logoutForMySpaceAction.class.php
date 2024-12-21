<?php

class userGuard_logoutForMySpaceActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {    
        if (!$this->getUser()->isAuthentificated())
            return mfView::NONE;
    } 
    
    
}
