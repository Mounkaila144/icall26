<?php

class customers_loginLinkActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {    
                
      $this->user=$this->getUser(); 
    } 
    
    
}
