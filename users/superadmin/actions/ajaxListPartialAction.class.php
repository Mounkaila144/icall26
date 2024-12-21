<?php

require_once dirname(__FILE__)."/../locales/Pagers/UserPager.class.php";

class users_ajaxListPartialAction extends mfAction {
    
 const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->formFilter= new UsersFormFilter();
        $this->pager=new UserPager();  
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {               
                    //echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUSer()->getCountry());
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->executeSite($this->site);  
                }                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
      //  var_dump($this->pager->getItems());
    }

}

