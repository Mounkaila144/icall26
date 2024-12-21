<?php


class ImportFileGroupProcess extends CsvFile {
    
    protected $file=null,$group=null;
    
    function __construct(File $file,Group $group=null,$site=null) {   
        if ($group===null)
        {
           $group = new Group(array('name'=>$file->getFilename()),'admin',$site);
           $group->set('is_active','YES');
           $group->save();
        }    
        $this->group=$group;        
        parent::__construct($file->getFile());
    }
    
    function getGroup()
    {
        return $this->group;
    }
    
    
    function process()
    {        
        PermissionUtilsBase::ImportPermissionsForGroup($this->getGroup(),$this->getDataFromColumn(0));        
    }
    
    static function createFromDirectory($directory,$site=null)
     {
       foreach (glob($directory."/*.csv") as $file)
       {                   
           $csv=new ImportFileGroupProcess(new File($file),null,$site);
           $csv->process();       
       }  
     } 
    
}
