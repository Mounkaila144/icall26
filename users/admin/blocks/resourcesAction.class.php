<?php


class users_resourcesActionComponent extends mfActionComponent {
     
   
    
    function execute(mfWebRequest $request) 
    {                                   
          /*if (!$this->getUser()->isEmployee()) 
              return mfView::NONE;*/
          $this->user=$this->getUser();
          $this->_request=$request;
    }    
                    
}    