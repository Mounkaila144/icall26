<?php

class site_ajaxClearCacheSuperAdminAction extends mfAction {

    function execute(mfWebRequest $request) {
      $messages=mfMessages::getInstance(); 
      SiteCacheAdmin::clearCacheSiteApplication(mfConfig::getSuperadmin('host'), 'superadmin');     
      $messages->addInfo(__("Cache superadmin is cleared."));      
      return array("info"=>$messages->getDecodedInfos());      
    }

}

