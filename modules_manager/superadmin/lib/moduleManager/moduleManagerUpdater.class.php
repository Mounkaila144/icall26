<?php


class moduleManagerUpdater extends moduleUpdater{
    
    protected $module=null,$update=null,$site=null;
            
    function __construct(ModuleManager $module, $update,Site $site){
        
        $this->module=$model;
        $this->module=$model;
        $this->site=$site;
    }
    
    function getModule(){
        
        return $this->module;
    }
    function getUpdate(){
        
        return $this->update;
    }
    function getSite(){
        
        return $this->site;
    }

    static function getUpdatesForModule($module){
        $updates=new mfArray();
        foreach (glob(mfConfig::get('mf_modules_dir')."/".$module->getName()."/superadmin/updates/*",GLOB_ONLYDIR) as $update){
            $updates[]=end(explode('/', $update));
        }
        return $updates;
    }
    
    function isInstalled(){
        
        if($this->getUpdate()==null){
            throw new mfException('Update not selected.');
        }
        
        //return  mfConfig::get('mf_site_dir')."/frontend/data/domoprime/quotations/contracts/".$this->getContract()->get('id')."/".__("multiple-quotation")."-".$this->getContract()->get('id').".pdf";       
    }
}
