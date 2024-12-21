<?php

class SiteLogFilesFormFilter extends mfFilesFormFilter {
 
    protected $site=null;
    
    function __construct($site) {
        $this->site=$site;
        parent::__construct();
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function configure()
    {
        $this->setDefaults(array(
            'order'=>array(
                            "time"=>"desc",
                            
            ),
            'search'=>array(
                          
            ),
            'range'=>array(
                //  "time"=>array("from"=>null,"to"=>date("Y-m-d",time()+3600*24))
            ),
            'nbitemsbypage'=>"20",
       ));
       $this->setDirectory(mfConfig::get('mf_log_dir'));
       // Base Query      
       $this->setQuery("*system_error_".str_replace(".","_",$this->getSite()->getHost()).".log"); 
       // Validators 
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "time"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "size"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "extension"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "name"=>new mfValidatorString(array("required"=>false)),
                           ),array("required"=>false)),
            'range'=>new mfValidatorSchema(array(
                               "time"  =>new mfValidatorI18nDateRangeCompare(array('required'=>false))
                           ),array("required"=>false)),
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
    
 
}


class site_ajaxListPartialLogAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function preExecute() {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');       
    }
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();    
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->pager=new PagerFiles();
        $this->formFilter=new SiteLogFilesFormFilter($this->site);
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));    
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {
              $this->pager->setFiles($this->formFilter->getFiles());
              $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
              $this->pager->setPage($this->request->getGetParameter('page'));
              $this->pager->execute();           
            }                  
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }       
    }
    
    
 
	
	
}

