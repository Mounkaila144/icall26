<?php


class DomoprimeMigrationBillingModelEngine   {
   
    protected $site=null;
     
    function __construct($site=null) {
        $this->site=$site;
    }
    
    
    
    function getModels()
    {
        if ($this->models===null)
        {
            $this->models=new DomoprimeBillingModelI18nCollection(null,$this->getSite());
             $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT * FROM ".  DomoprimeBillingModelI18n::getTable().                                                                         
                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite()); 
            if (!$db->getNumRows())
                return $this->models;      
            while ($item=$db->fetchObject('DomoprimeBillingModelI18n'))
            {
              $this->models[$item->get('model_id')]=$item->loaded()->setSite($this->getSite());
            }     
            $this->models->loaded();        
        }
        return $this->models;
    }           
        
    function getSite()
    {
        return $this->site;
    }
    
     
    function migrate1()
    {
        $variables=array(
            "{\$contract.forms.RENSEIGNEMENTINSTALLATION.SURFACEM"=>"{\$contract.request.surface_home",
            "{\$contract.forms.RENSEIGNEMENTINSTALLATION.TYPEDENERGIE"=>"{\$contract.request.previous_energy.value",
               "{\$meeting.forms.RENSEIGNEMENTINSTALLATION.SURFACEM"=>"{\$meeting.request.surface_home",
            "{\$meeting.forms.RENSEIGNEMENTINSTALLATION.TYPEDENERGIE"=>"{\$meeting.request.previous_energy.value"
        );
        foreach ($this->getModels() as $model)
        {
             $model->set('body',strtr($model->get('body'), $variables));                      
        }   
        $this->getModels()->save();
        return $this;
    }
    
    
}
