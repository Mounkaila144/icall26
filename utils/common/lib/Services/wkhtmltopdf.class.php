<?php


class wkhtmltopdf extends SystemWkhtmltopdf {
    
    public function __construct($options = array(),$site=null) {
          
        $this->site=$site;       
        parent::__construct($options);
        $this->initialize();                 
    }
    
    public function initialize()
    {
        $this->configure();
        mfFileSystem::mkdirs($this->getDirectory());
        $this->setOption('view',array('template_path'=>$this->getOption('template_path',"pdf"))); 
               
     /*   parent::__construct($this->getOption('orientation','P'), 
                            $this->getOption('format','A4'),'en', 
                            $this->getOption('unicode',true), 
                            $this->getOption('encoding','UTF-8'), 
                            $this->getOption('marges',array(5, 5, 5, 8))); */
        
        //  var_dump($this->getOptions());
        return $this;
    }
    
    function configure()
    {
      
    }
    
    public function debug($value=true)
    {
      $this->setOption('debug',$value);
      return $this;
    }  
    
    function execute() {
        $this->setOption('input', $this->getTemplateFile()->getFile());
        $this->setOption('output', $this->getOption('filename')->getFile());
        $this->setOption('log', " > ".$this->getLogFile()->getFile()); //." 2>&1 & echo $!");            
        parent::execute();             
    }
    
    function getDirectory()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/data/pdf/wkhtmltopdf";
    }
    
    function getUid()
    {
        return $this->uid=$this->uid===null?mfTools::generateUniqueId():$this->uid;
    } 
    
    function getOutputFile()
    {
        return $this->output_file=$this->output_file===null?new File($this->getDirectory()."/".$this->getUid()."/output.pdf"):$this->output_file;
    } 
    
    function getLogFile()
    {
        return $this->log_file=$this->log_file===null?new File($this->getDirectory()."/".$this->getUid()."/log.txt"):$this->log_file;
    }
    
    function getTemplateFile()
    {
        return $this->tpl_file=$this->tpl_file===null?new File($this->getDirectory()."/".$this->getUid()."/".$this->getOption('filename')->getFilename().".html"):$this->tpl_file;
    }
    
     public function createPDF($moduleName,$actionName,$parameters=array())
    {                            
       $pdfView=mfViewService::getInstance('pdf');
       $pdfView->setOptions($this->getOption('view'));       
       $content=$pdfView->render($moduleName,$actionName,$parameters);            
       if ($this->getOption('debug',false))
       {    
           echo $content; 
           return $this;
       }          
       // save tpl output
       $this->getTemplateFile()->putContent($content);       
       $this->execute();        
       mfFileSystem::net_rmdir($this->getDirectory());
       return $this;
    }   
}
