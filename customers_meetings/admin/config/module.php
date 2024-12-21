<?php

// key=[action]
return array(
    
    "ajaxDeleteIconStatus"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveIconStatusI18n"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteStatusI18n"=>array("mode"=>"json"),
    
    "ajaxConfirmMeeting"=>array("mode"=>"json","helpers"=>array("date"=>null)),
    
    "ajaxCancelMeeting"=>array("mode"=>"json"),
    
    "ajaxConfirmMeetingSchedule"=>array("mode"=>"json"),
    
    "ajaxCancelMeetingSchedule"=>array("mode"=>"json"),
    
    "ajaxDeleteMeetingProduct"=>array("mode"=>"json"),
    
    "ajaxDeleteMeeting"=>array("mode"=>"json"),
    
    "ajaxDeleteMeetingSchedule"=>array("mode"=>"json"),
    
    "ajaxRecycleMeeting"=>array("mode"=>"json"),
    
    "ExportCsvMeetings"=>array("mode"=>"none","helpers"=>array('date'=>null)),
    
    "ajaxDeletesStatus"=>array("mode"=>"json"),
    
    "ajaxDeletesMeeting"=>array("mode"=>"json"),
    
    "ajaxRecyclesMeeting"=>array("mode"=>"json"),
    
    "ajaxGetStateLocks"=>array("mode"=>"json"),
    
    "ajaxReleaseMeetingLock"=>array("mode"=>"json"),
    
    "ajaxDeleteCallback"=>array("mode"=>"json"),
    
    "ajaxChangeSale"=>array("mode"=>"json"),
    
    "ajaxSendEmailModelForSale"=>array("mode"=>"json","helpers"=>array("date"=>null)),
    
    "ajaxSendEmailDefaultModelForSale"=>array("mode"=>"json","helpers"=>array("date"=>null)),        
    
    /*========================== STATUS CALL ============================================= */
    
    "ajaxDeleteIconStatusCall"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveIconStatusCallI18n"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteStatusCallI18n"=>array("mode"=>"json"),
    
    "ajaxDeletesStatusCall"=>array("mode"=>"json"),
    
     /*========================== STATUS LEAD ============================================= */
    
    "ajaxDeleteIconStatusLead"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxSaveIconStatusLeadI18n"=>array("mode"=>"json","helpers"=>array("url"=>null)),
    
    "ajaxDeleteStatusLeadI18n"=>array("mode"=>"json"),
    
    "ajaxDeletesStatusLead"=>array("mode"=>"json"),
    
    
    "ajaxCreateContract"=>array("mode"=>"json"),
    
    "ajaxCreateDefaultProducts"=>array("mode"=>"json"),
   
    "ajaxGenerateCoordinatesFromFilter"=>array("mode"=>"json"),
    
    "ajaxGenerateCoordinates"=>array("mode"=>"json"),
    
     "ajaxDeleteRangeI18n"=>array("mode"=>"json"),
    
      "ajaxDeleteCampaign"=>array("mode"=>"json"),
    
    "ajaxRemoveMeeting"=>array("mode"=>"json"),
    
    "ajaxAutoSaveMeetingForViewMeeting"=>array("mode"=>"json"),  
    
    "ajaxHoldQuoteMeeting"=>array("mode"=>"json"),  
    
    "ajaxFreeQuoteMeeting"=>array("mode"=>"json"),  
    
    "ajaxAutoSaveStatesForMeeting"=>array("mode"=>"json"),  
    
      /*=================================== API ================================*/
    
    "apiListMeeting"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "api2ListMeeting"=>array('mode'=>'json','helpers'=>array('date'=>null,'url'=>null)), //,'always_access'=>true),
    
    "api2NewMeeting"=>array('mode'=>'json'), //,'always_access'=>true),
    
    "api2ListStateMeeting"=>array('mode'=>'json'),
    
    "api2GewMeeting"=>array('mode'=>'json'),
    
    "default"=>array(
               "enabled"=>true,
               "actionEnabled"=>true, 
               "mode"=>'mixed'  // mixed : smarty View/Cache  | file: fichier  | uri
                    ),
    
    
);