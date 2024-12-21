<?php


 
class customers_meetings_forms_ajaxTestAction extends mfAction {
    
        
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        try
        {
            $extra=new CustomerMeetingForms(258);
        
            $extra->setDataFromImport(array("iso"=>array("numberofpeople"=>0,    
                                                         "revenue"=>0    
                                                        ),
                                            "solaire"=> array(
                                                "OBSERVATION"=>" ",
                                                "commentaireclient"=>"",
                                                "EMAIL2"=>"st.jeunet@laposte.net",
                                                        )
                                             )
                                );
        
        
        
            $extra->save();
        }
        catch (mfException $e)
        {
            echo $e->getMessage();
        }
        die(__METHOD__);
   }

}

