<?php

class languages_ajaxDashboardMoveLanguageAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $response=array();
        try {          
            $form=new movePositionForm();
            $form->bind($request->getPostParameter('language'));
            if ($form->isValid())
            {
                $item=new Language($form->getValue('id'));
                $item->moveTo($form->getValue('node'));
                $item->save();
                $this->getEventDispather()->notify(new mfEvent($item, 'language.change','move')); 
                $response=array("action"=>"moveLanguage","id"=>$item->get('id'),"info"=>__("position is updated."));
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

