<?php


class usersGroupsPermissionsForm extends mfForm {

    function configure() { 
         
         $user_id=$this->getDefault('user');
         if ($user_id)
         {
             $this->setValidators(array(
                 
                 "user"=>new mfValidatorInteger(),
                 "userPermission"=>new mfValidatorSchemaForEach(
                                                                // Attention à l'appel à revoir 
                                        new mfValidatorChoice(array("choices"=>userPermissionUtils::getPermissionsUserbyUserList2($user_id))), 
                                                              count($this->getDefault('userPermission')),
                                                              array("required"=>false)
                                   ),
                 "groupPermission"=>new mfValidatorSchemaForEach(
                                        new mfValidatorChoice(array("choices"=>userPermissionUtils::getPermissionsGroupByUserList2($user_id))),
                                                              count($this->getDefault('groupPermission')),
                                                              array("required"=>false)
                                   )
                 
             ));
          
      //   $this->setValidator('user',new mfValidatorInteger());
      //   $this->setValidator('userPermission',new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices"=>userPermissionUtils::getPermissionsUserbyUserList($user_id))), count($this->getDefault('userPermission')),array("required"=>false)));
      //   $this->setValidator('groupPermission',new mfValidatorSchemaForEach(new mfValidatorChoice(array("choices"=>userPermissionUtils::getPermissionsGroupByUserList($user_id))),count($this->getDefault('groupPermission')),array("required"=>false))); 
         }
    }
}