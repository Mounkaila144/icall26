<?php
require_once dirname(__FILE__).'/../locales/FormFilters/SiteForServicesFormFilter.class.php';

class site_services_ListAction extends mfAction{
    
    public function execute(mfWebRequest $request) {
        //echo '========================= list ====================';
        $messages = mfMessages::getInstance();          
        $this->user=$this->getUser();
        $this->formFilter= new SiteForServicesFormFilter($this->getUser()); 
        try
        {            
                //var_dump($request->getPostParameters());
                //die(__METHOD__);
               $this->formFilter->bind($request->getPostParameters());
               if ($this->formFilter->isValid()||$request->getPostParameters()==null)
               {     
                   $this->formFilter->setParameter('user_id',$this->getUser()->getGuardUser()->get('id')); 
                   //echo "<!-- ".$this->formFilter->getQuery()." -->"; //"<br/>";        
                   $this->formFilter->execute();
                   //var_dump($this->formFilter->getItems());
                   $response=array('status'=>'OK','items'=>$this->formFilter->getItems());
               }           
               else 
              {
                  $messages->addError(__("Filter has some errors."));
                  //echo "<!-- "; var_dump($this->formFilter->getErrorSchema()->getErrorsMessage()); echo "-->";
                  $response=array('errors'=>$this->formFilter->getErrorSchema()->getErrorsMessage()); 
                  //var_dump($response);          
                   //die(__METHOD__);
              }
//              var_dump($response);
        }
        catch (Exception $e)
        {
            $messages->addError($e);
            return array('error'=>$messages->getDecodedErrors());
        }  
        return $response;  
    }

}
