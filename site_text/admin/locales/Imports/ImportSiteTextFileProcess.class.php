<?php


class ImportSiteTextFileProcess extends CsvFile {
    
   
    
    function __construct($file) {            
        parent::__construct($file->getTempName());
    }
    
    
    function process()
    {      
        SiteText::truncate();                        
        $collection=new SiteTextCollection();                        
        foreach ($this->getData()  as $line)
        {      
            $item=new SiteText();
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
