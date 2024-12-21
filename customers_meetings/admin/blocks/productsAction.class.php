<?php


class customers_meetings_productsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
        $this->meeting=$this->getParameter('meeting');          
    } 
    
    
}

