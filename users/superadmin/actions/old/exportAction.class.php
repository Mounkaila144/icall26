<?php

class users_exportAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {   
       $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
       $this->forwardIf(!$site,"sites","Admin");
       $type=$request->getGetParameter('type');
       if ($type=='csv')
       {
           $export=new userCSVExport(array("lang"=>$this->getUser()->getLanguage()),$site);
           $export->output();
       }    
       elseif ($type=='pdf')
       {
              $users_pdf = new userPDF(array("lang"=>$this->getUser()->getLanguage()),$site);
            //  $users_pdf->debug();
              $users_pdf->output();
       }    
       die();
       return mfView::NONE;       
    }

}

