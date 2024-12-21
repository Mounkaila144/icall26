<?php





class languages_ajaxDashboardNewLanguageAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
     //   if (!$request->isXmlHttpRequest())
     //       $this->redirect("/superadmin/languages");
        $messages = mfMessages::getInstance();
        
        // @TODO Mettre plutot les languages qui reste (language save - langugaeAuthorized
        $this->languages = languageUtilsAdmin::getLanguages();
        $form=new multipleLanguageNewForm($request->getPostParameter('selection'));
        $form->bind($request->getPostParameter('selection'));
        try
        {
            if ($form->isValid())
            {
                $languagesCollection = new LanguageCollection($form->getValue('languages'));
                $languagesCollection->save();
                $this->getEventDispather()->notify(new mfEvent($languagesCollection, 'languages.change','new')); 
                $messages->addInfo(__("languages added"));
                $this->forward('languages','ajaxDashboardListPartial');
            }   
            else
            {
                if ($request->getPostParameter('selection')!=null)
                    $messages->addErrors($form->getErrorSchema()->getErrors());
            }    
        } catch (mfException $e) {
            $messages->addError($e);
        } 
        
    }

}

