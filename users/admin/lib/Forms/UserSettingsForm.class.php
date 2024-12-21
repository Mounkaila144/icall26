<?php



 class UserSettingsForm extends UserSettingsBaseForm {
 
   
  
     function configure()
     {   
         $this->setValidators(array(
                'nb_uppercase'=>new mfValidatorInteger(array('required'=>false)),
            'nb_numbers'=>new mfValidatorInteger(array('required'=>false)),
            'length_of_pass'=>new mfValidatorInteger(array('required'=>false)),
            'nb_of_specific_chars'=>new mfValidatorInteger(array('required'=>false)),
            'list_of_specific_chars'=>new mfValidatorSpecialChars(array('required'=>false)),
         ));
         if ($this->getUser()->hasCredential(array(array('superadmin','settings_user_groups'))))
         {                     
            $this->addValidators(array(
               "telepro_groups"=>new mfValidatorChoice(array('required'=>false,'multiple'=>true,'key'=>true,'choices'=>array(""=>"")+GroupUtils::getAdminGroupsForSelect($this->getSite())->toArray())),
               "sales_groups"=>new mfValidatorChoice(array('required'=>false,'multiple'=>true,'key'=>true,'choices'=>array(""=>"")+GroupUtils::getAdminGroupsForSelect($this->getSite())->toArray())),
            ));
         }
         if ($this->getUser()->hasCredential(array(array('superadmin','settings_user_profiles'))))
         {        
            $this->addValidators(array(
               "telepro_profiles"=>new mfValidatorChoice(array('required'=>false,'multiple'=>true,'key'=>true,'choices'=>UserProfile::getProfilesI18nForSelect()->unshift(array(""=>""))->toArray())),
               "sale_profiles"=>new mfValidatorChoice(array('required'=>false,'multiple'=>true,'key'=>true,'choices'=>UserProfile::getProfilesI18nForSelect()->unshift(array(""=>""))->toArray())),
            ));
         }
         $this->setValidator("default_team_id",new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>UserTeamUtils::getTeamsForSelect())));
         
     }
    
 
}


