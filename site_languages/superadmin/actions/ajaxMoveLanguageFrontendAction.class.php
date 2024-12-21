<?php

class languages_ajaxMoveLanguageFrontendAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $response=array();
        try 
        {     
            $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);     
            if (!$site)  
               throw new mfException(__("thanks to select a site"));  
            $form=new movePositionForm();
            $form->bind($request->getPostParameter('language'));
            if ($form->isValid())
            {
                $item=new Language($form->getValue('id'),'frontend',$site);
                $item->moveTo($form->getValue('node'));
                $item->save();
                $this->getEventDispather()->notify(new mfEvent($item, 'language.change','move')); 
                $response=array("action"=>"moveLanguageFrontend","id"=>$item->get('id'),"info"=>__("position is updated."));
            }   
            else
            {
              $messages->addErrors(array_merge($form->getErrorSchema()->getGlobalErrors(),$form->getErrorSchema()->getErrors()));
            }    
        } catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

