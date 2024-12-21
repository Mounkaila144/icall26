<?php
 
class CustomerMeetingFormExportXML  {
    
    const UPPERCASE=1,TRIM=2;
    
    protected $formt=null,$options=array(),$site=null,$parameters=null,
              $filename="",$handler=null,$path="",$name="",$query=null;
    
    function __construct(CustomerMeetingForm $form,$options=array(),$site=null) 
    {
        $this->query= new mfQuery();           
        $this->form=$form;    
        $this->site=$site;
        $this->options=array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'UTF-8','separator'=>';'));    
        $this->configure();
        $this->filename=$this->getDirectory()."/".$this->getName();
    }
    
    function configure()
    {       
        $this->path="/data/exports/forms";
        $this->name="export-form-".date("Y-m-d_H_i_s").".xml";       
    }
       
    function getOption($name,$default=null)
    {
        return array_key_exists($name, $this->options)?$this->options[$name]:$default;
    } 
    
    function setOption($name,$value)
    {
        $this->options[$name]=$value;
        return $this;
    } 
    
    function getOptions()
    {
        return $this->options;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function isDebug()
    {
        return $this->getOption('debug',false);
    }
    
    function debug()
    {
        $this->setOption('debug',true);
        return $this;
    }
    
    function getForm()
    {
        return $this->form;
    }
    
    function getHeader()
    {
        return $this->header;
    }
    
    protected function escape($value="")
    {
        return str_replace('"', '', $value);
    }
    
    protected function formatField($name)
    {
        return '"'.$this->escape($this->encode($name)).'"';
    }
    
    protected function encode($str)
    {     
        return mb_convert_encoding($str ,$this->getOption('charset_to','UTF-8'),$this->getOption('charset_from','UTF-8'));       
    }   
     
    
    function process()
    {   
        // Process column schema for header 
        $this->execute();
    }
  
    function getQuery()
    {
        return $this->query;
    }
         
    function execute()
    {                      
      
        $this->query->select("{fields}")
             ->from(CustomerMeetingFormfield::getTable())
             ->inner(CustomerMeetingFormfieldI18n::getInnerForJoin('formfield_id'))
             ->where(CustomerMeetingFormfield::getTableField('form_id')."='{form_id}' AND lang='{lang}'");
                      
        $db=new mfSiteDatabase();
        $db->setParameters(array('form_id'=>$this->getForm()->get('id'),'lang'=>$this->getOption('lang')))
             ->setObjects(array('CustomerMeetingFormfield','CustomerMeetingFormfieldI18n'))         
            ->setQuery((string)$this->getQuery())               
            ->makeSiteSqlQuery($this->getSite());    
        
        $this->open();
        $this->getItemsFromDatabase($db); 
        $this->close();

    }
    
    protected function getItemsFromDatabase($db)
    {                  
        if (!$db->getNumRows())           
            return $this;  
        $this->outputElement("<?xml version='1.0' encoding='UTF-8'?>");  
        $this->outputElement("<data><form>");
        $this->outputElement('<name value="'.$this->encode($this->getForm()->getI18n()->get('value')).'">'. $this->encode($this->getForm()->get('name')).'</name>');
          $this->outputElement('<fields>'."\n");    
        while ($items = $db->fetchObjects() ) {                           
            $data=new mfArray();
            foreach ($items->getCustomerMeetingFormfield()->toArrayForXml() as $name=>$value)
                 $data[]=$name.'="'.htmlspecialchars($value,ENT_QUOTES).'"';  
            $data_i18n=new mfArray();
            foreach ($items->getCustomerMeetingFormfieldI18n()->toArrayForXml() as $name=>$value)
                 $data_i18n[]=$name."='".htmlspecialchars($value,ENT_QUOTES)."'";  
             $this->outputElement('<field '.$data->implode(" ").'>'."\n".
                     '<i18n '.$data_i18n->implode(" ").'></i18n>'."\n".
                     '</field>'."\n");                          
        } // foreach format
        $this->outputElement('</fields>'."\n");
        $this->outputElement('</form></data>');
    }   
    
    function getFilename()
    {        
        return $this->filename;
    }
    
    function open()
    {              
        mfFileSystem::mkdirs(dirname($this->getFilename()));
        $this->handler=fopen($this->getFilename(),"w+");
    }
    
    function close()
    {
        if ($this->handler)
           fclose ($this->handler);
        return $this;
    }
    
    function getName()
    {
        return $this->name;
    }
    
    function getDirectory()
    {       
        if ($this->getSite())
        {    
            $site_name=($this->getSite() instanceof Site)?$this->getSite()->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name.$this->getPath(); 
        }
        return mfConfig::get('mf_site_app_cache_dir').$this->getPath();        
    }
    
    function getPath()
    {
        return $this->path;
    }
    
    function outputElement($data_xml)
    {            
        $this->writeElement($data_xml."\n");
    }
    
    protected function writeElement($element)
    {
        if ($this->isDebug())
            echo $element."<br/>";
        else        
            fwrite($this->handler,$element);    
    }   
}