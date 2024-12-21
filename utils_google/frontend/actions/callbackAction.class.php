<?php

// formulaire 

class utils_google_callbackAction extends mfActions {
    function execute(mfWebRequest $request) {
        try {
            $form= new UtilsGoogleForm();
            $form->bind($request->getGetParameters());

            if ($form->isValid())
            {
                list($baseUri, $state) = explode('|',$form->getValue('state'));
                //var_dump($baseUri .'?code=' . urlencode($form->getValue('code')) . '&state='.urlencode($state));
                $this->redirect($baseUri .'?code=' . urlencode($form->getValue('code')) . '&state='.urlencode($state));
            }else{
                 echo "<pre>"; var_dump($form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
            }
        } catch (mfException $e) {
            echo $e->getMessage();
        }
    }
}
