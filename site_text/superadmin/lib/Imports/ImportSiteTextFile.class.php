<?php


class ImportSiteTextFile extends CsvFile {
    
    protected $site=null;
    
    function __construct($file, $site=null) {
        $this->site=$site;
        parent::__construct($file);
    }
   
    function getSite()
    {
        return $this->site;
    }
    
    function process()
    {                         
        SiteText::truncate($this->getSite());                        
        $collection=new SiteTextCollection(null,$this->getSite());   
         
        foreach ($this->getData()  as $line)
        {                
            $item=new SiteText(null,$this->getSite());                        
            $item->add(array(
                'module'=>$line[0],
                'key'=>$line[1],
                'value'=>$line[2],               
            ));
            $collection[]=$item;            
        }
        $collection->save();   
        return $this;
    }
    
}
