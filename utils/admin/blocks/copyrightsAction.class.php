<?php

 
class utils_copyrightsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request) {
           $this->year=date("Y");
           $this->tpl=$this->getParameters('tpl','default');
    }
    
}    