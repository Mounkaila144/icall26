<?php


class  CustomerAddressBaseUtils {
    
   
       static function generateCoordinates($site=null)
    {          
        $messages=new mfArray();
        $db=new mfSiteDatabase();
                $db->setParameters(array())
                ->setQuery("SELECT * FROM ".CustomerAddress::getTable(). 
                           " WHERE coordinates=''".                             
                           ";")               
                ->makeSiteSqlQuery($site);            
        if (!$db->getNumRows())
        {                  
             return $messages->push(__("No coordinate has been generated."));
        }
        $addresses=new CustomerAddressCollection(null,$site);
        while ($item=$db->fetchObject('CustomerAddress'))
        {                           
            $addresses[]=$item->loaded()->setSite($site);            
        }     
        $addresses->loaded();
        $addresses->generateCoordinates(true);   
        $messages->push(__("%d coordinates have an error.",$addresses->getNumberOfErrors()));
        $messages->push(__("%d coordinates have been processed.",$addresses->getNumberOfValidAddress()));  
        return $messages;
    }  
}

