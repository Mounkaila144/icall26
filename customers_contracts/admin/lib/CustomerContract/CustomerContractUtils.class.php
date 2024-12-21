<?php



class CustomerContractUtils extends CustomerContractUtilsBase {
  
    
  /*  static function getSalesUsers1ForSelect($user)
    {
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('telepro_id'=>$user->getGuardUser()->get('id')))
                ->setQuery("SELECT ".User::getFieldsAndKeyWithTable()." FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_1_id').   
                           " WHERE telepro_id={telepro_id}".
                           " ORDER BY lastname ASC;")               
                ->makeSqlQuery(); 
        if (!$db->getNumRows())
            return array();
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
           $users[$user->get('id')]=(string)$user;
        }     
        return $users;
    }    */  
    
}

