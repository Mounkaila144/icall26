<?php


class ImportPermissionsForGroupProcess extends CsvFile {
    
    protected $file=null,$group=null;
    
    function __construct(Group $group, mfValidatedFile $file) {   
        $this->group=$group;
        parent::__construct($file->getTempName());
    }
    
    function getGroup()
    {
        return $this->group;
    }
    
    function getSite()
    {
        return $this->getGroup()->getSite();
    }
    
    function process()
    {        
       PermissionUtils::ImportPermissionsForExistingGroup($this->getGroup(),$this->getDataFromColumn(0,$this->getFile()));        
       return $this;
    }
    
}
