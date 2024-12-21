<?php



class DomoprimeCustomerMeetingFormDocumentClass extends CustomerMeetingFormDocumentBase {
     
    protected static $fields=array('form_document_id','class_id','created_at','updated_at');
    const table="t_domoprime_customers_meetings_forms_documents_class"; 
    protected static $foreignKeys=array('form_document_id'=>'CustomerMeetingFormDocument',                                        
                                        'class_id'=>'DomoprimeClass',                                       
                                       ); 
    protected static $fieldsNull=array('class_id'); 
     
    function __construct($parameters = null, $site = null) {
        if ($parameters instanceof CustomerMeetingFormDocument)
      {        
             $this->setApplicationAndSite(null,$site); 
             $this->getDefaults(); 
             return $this->loadbyFormDocument($parameters);        
      } 
        parent::__construct($parameters, $site);       
    }
    
    protected function loadbyFormDocument($parameters)
    {
        $this->set('form_document_id',$parameters->get('id'));
         $db=mfSiteDatabase::getInstance()
             ->setParameters(array('form_document_id'=>$parameters->get('id')))
             ->setQuery("SELECT * FROM ".self::getTable()." WHERE form_document_id='{form_document_id}'".                       
                        ";")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    function hasClass()
    {
        return (boolean)$this->get('class_id');
    }
    
    function getClass()
    {
       if ($this->_class_id===null)
       {
          $this->_class_id=new DomoprimeClass($this->get('class_id'),$this->getSite());          
       }   
       return $this->_class_id;
    }  
    
    
    function getDocumentForm()
    {
       if ($this->_form_document_id===null)
       {
          $this->_form_document_id=new CustomerMeetingFormDocument($this->get('form_document_id'),$this->getSite());          
       }   
       return $this->_form_document_id;
    }
    
    
}
