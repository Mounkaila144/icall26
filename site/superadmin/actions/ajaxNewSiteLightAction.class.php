<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteNewLightForm.class.php";


class site_ajaxNewSiteLightAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try {
            $this->form = new SiteNewLightForm($request->getPostParameter('Site'));                        
            if ($request->isMethod('POST') && $request->getPostParameter('Site'))
            {  
                $this->form->bind($request->getPostParameter('Site'));
                if ($this->form->isValid()) {                                       
                    $site=new Site($this->form->getHostForSite());
                    if ($site->isLoaded())
                         throw new mfException(__("Site already exists")); // Message d'information
                    $settings= SoapOvhSettings::load();
                    $key=$settings->getSubdomainId($site);
                    $site->set('site_db_name',$settings->get('root_db_name').$key);
                    $site->set('site_db_password',mfTools::generatePassword());
                    $site->set('site_admin_theme',(string)$this->form['site_admin_theme']);    
                    $site->set('site_db_host',$site->get('site_db_name').".mysql.db");
                    $site->set('site_db_login',$site->get('site_db_name'));
                    $site->save();                    
                    try
                    {
                        $soap=new SoapOvh();
                        $soap->login();                                                                                       
                        $soap->databaseCreate($this->getRequest()->getSite()->getSite()->getHostName(),$key,$site->get('site_db_password'),SoapOvhSettings::load()->get('mysql_type'));                      
                        $soap->logout();  
                        
                        $time=time() + 90 ;
                        $db=  mfSiteDatabase::getInstance();
                        do
                        {
                            if ($db->isDatabaseExist($site))  // Test connection + database                          
                                break;
                            sleep(1);
                        }
                        while ($time > time());
                           
            
            
                   /*     $break=false;
                        $time=time() + 60 ;
                        do
                        {
                            $break=($time > time());   
                            if ($break)
                                break;
                            $databases=$soap->databaseList($this->getRequest()->getSite()->getSite()->getHostName()); 
                            
                            foreach ($databases as $db)
                            {
                                if ($db->db==$site->set('site_db_name'))
                                {
                                    $break=false;  break;
                                }
                            }                                                                                        
                        } 
                        while ($break==true);                                                
                        $soap->logout();  
                      //  if (time() > $time)
                      //      throw new mfException(__("Database has not been created."));                        
                        sleep(30);       */
                        
                        SiteUtils::createSite($site);    
                        $soap->login();
                        $soap->subDomainAdd($this->getRequest()->getSite()->getSite()->getHostName(), $site->getSubdomains());  
                        $soap->logout();       
                        $messages->addInfo(__("Site [%s] has been created.", $site->get('site_host')));
                    }
                    catch (SoapFault $e)
                    {
                        $messages->addError($e);
                        $site->delete();
                    }                                                                 
                    $this->forward('site','ajaxListPartial');
                }               
                else
                {                    
                    $messages->addError(__("Form has some errors."));
                }    
            }
        }             
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}

