<?php

class ThemeFormFilter extends mfFormFilterBase {
 
    function configure()
    {
        $this->setDefaults(array(
            'order'=>array(
                            "application"=>"asc",                        
            ),
            'search'=>array(
                         
            ),
            'nbitemsbypage'=>"*",
       ));
       // Base Query
       $this->setQuery("SELECT * FROM ".ThemeFrontend::getTable()." WHERE application='frontend';");
       // Validators 
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "is_active"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                          
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorInteger(array("required"=>false)),
                            "name"=>new mfValidatorString(array("required"=>false)),                          
                           ),array("required"=>false)),
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
       
    }
    
 
}

class themes_ajaxListAction extends mfAction {

    
    function execute(mfWebRequest $request) {
         $messages = mfMessages::getInstance();       
        $this->pager=new Pager('ThemeFrontend');
        $this->formFilter=new ThemeFormFilter();
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));    
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {               
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($this->request->getGetParameter('page'));
                $this->pager->execute();   
            }
            else
            {               
                $messages->addErrors(array_merge($this->formFilter->getErrorSchema()->getGlobalErrors(),
                                      $this->formFilter->getErrorSchema()->getErrors()));
            }    
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }      

    }

}

