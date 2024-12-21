<?php


class User extends UserBase {
    
    public function getPicture()
    {
      if (!$this->get('_picture'))      
      {    
       /*  $this->_picture=new PictureObject(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('picture'),
                 "urlAdmin"=>"restrictive/".$this->getSite()->get('site_host')."/".$this->application."/data/users/".$this->get('id')."/",
                 "url"=>"restrictive/data/users/".$this->get('id')."/",
                 "parameters"=>array("urlType"=>"url")
             )); */
         if ($this->get('application')=='superadmin')
         {    
          $this->_picture=new PictureObject2(array(
                 "path"=>$this->getDirectory(),
                 "urlPath"=>url_to("users_guard_restrictive_user_access_file",array(
                                                                                     "user"=>$this->get('id'),
                                                                                     "file"=>"",                                                                                    
                                                                                    )),
                 "picture"=>$this->get('picture'),                
                 "url"=>url_to("users_guard_restrictive_user_access_file",array(                                                                                
                                                                                     "user"=>$this->get('id'),
                                                                                     "file"=>$this->get('picture'),                                                                                  
                                                                                    )),    
             ));
         }
         else
         {           
            $this->_picture=new PictureObject2(array(
                    "path"=>$this->getDirectory(),
                    "urlPath"=>url_to("users_guard_restrictive_user_access_file",array( "site"=>$this->getSite()->getHost(),
                                                                                        "user"=>$this->get('id'),
                                                                                        "file"=>"",   
                                                                                        "application"=>$this->get('application'),    
                                                                                       )),
                    "picture"=>$this->get('picture'),
                    "url"=>url_to("users_guard_restrictive_user_access_file",array( "site"=>$this->getSite()->getHost(),
                                                                                        "application"=>$this->get('application'),
                                                                                        "user"=>$this->get('id'),
                                                                                        "file"=>$this->get('picture'),                                                                                   
                                                                                       )),            
             ));   
         }
      }   
      return $this->_picture;     
    }
    
    static function getFirstSuperAdmin()
    {                         
        $db = mfSiteDatabase::getInstance()->setParameters(array())
                    ->setQuery("SELECT id FROM ".User::getTable().
                               " WHERE application='superadmin' ".
                               " ORDER BY ".User::getTableField('id').
                               " LIMIT 0,1 ".
                               ";")
                    ->makeSqlQuerySuperAdmin();
            if(!$db->getNumRows())
                return false;
            $row=$db->fetchArray();
        return $row[0];
    }
    
  
    
   
}

