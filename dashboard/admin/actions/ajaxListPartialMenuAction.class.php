<?php
require_once __DIR__."/../locales/FormFilters/SystemMenuFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/SystemMenuPager.class.php";
require_once __DIR__."/../locales/Forms/SystemMenuNodeForm.class.php";
 
class dashboard_ajaxListPartialMenuAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
      
          $messages = mfMessages::getInstance();       
        $this->user=$this->getUser();
        if (!$request->getRequestParameter('node')) 
        {        
            $form=new SystemMenuNodeForm($this->getUser()->getLanguage(),$request->getPostParameter('SystemMenuNode'));
            if ($request->getPostParameter('SystemMenuNode'))
            {    
                $form->bind($request->getPostParameter('SystemMenuNode'));  
                if (!$form->isValid())    
                {
                     var_dump($form->getErrorSchema()->getErrorsMessage());
                    $messages->addError(__('Form has some errors.'));                
                }
            }
            $this->node =$form->getNode();       
            $request->addRequestParameter('lang', $form->getLanguage());          
        }
        else
        {                        
            $this->node =$request->getRequestParameter('node');                
        }
        if ($this->node->isNotLoaded())        
        {                 
             $this->node=new SystemMenu('root');
             $messages->addError(__("Menu doesn't exist."));
        }   
        $this->formFilter= new SystemMenuFormFilter($this->node,$request->getRequestParameter('lang',$this->getUser()->getLanguage()));                  
        $this->pager=new SystemMenuPager(); 
      //  var_dump($this->node->getFather()->get('id'));
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                   //  echo $this->formFilter->getQuery();
                 //  echo $this->formFilter->getLanguage();
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);   
                    $this->pager->setParameter('lang',(string)$this->formFilter->getLanguage()); 
                    $this->pager->setParameter('lb',$this->node->get('lb'));
                    $this->pager->setParameter('rb',$this->node->get('rb'));
                    $this->pager->setParameter('levelplusone',$this->node->get('level')+1);
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();    
                    //echo mfSiteDatabase::getInstance()->getQuery();
               }      
               else
               {
                   $messages->addError(__('Filter has some errors.'));
                    var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
               }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
