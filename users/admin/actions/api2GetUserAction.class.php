<?php
// www.ecosol16.net/admin/api/v2/users/admin/GetUser
 
class users_api2GetUserAction extends mfAction {    
    
       function execute(mfWebRequest $request){
        if (!$this->getUser()->hasCredential([['superadmin','api2_user_get']]))
             $this->forwardTo401Action();
        $response=new mfArray();        
        $item=new User($request->getGetAndPostParameter('id'),'admin');  
        if ($item->isNotLoaded())
            return $response->set('error','user is invalid')->toArray();        
        if (!$item->isAuthorized('view'))
            $this->forwardTo401Action();                 
        $response->set('data',$item->getFormatter()->toArrayForApi2());
        return $response->toArray();
    }
   

}
