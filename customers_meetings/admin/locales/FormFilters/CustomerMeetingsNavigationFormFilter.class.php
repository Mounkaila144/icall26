<?php

require_once dirname(__FILE__)."/CustomerMeetingsFormFilter.class.php";

class CustomerMeetingsNavigationFormFilter extends CustomerMeetingsFormFilter {

    protected $processed=false,$next_index=0,$previous_index=0,$previous_meeting=null,$next_meeting=null,$count=null;
       
    
    
    function configure()
    {         
       parent::configure();
       $this->setValidator('index',new mfValidatorInteger());
       $this->setDefault('index',0);
    }
    
    function hasPreviousIndex()
    {
        return ($this->previous_index!==false);
    }
    
    function getPreviousIndex()
    {
        return $this->previous_index;
    }
    
    function hasNextIndex()
    {
       return ($this->next_index!=$this->count); 
    }
    
    function getNextIndex()
    {
        return $this->next_index;
    }
       
    function toJson($fields=array())
    {      
        $values=$this->_extractParametersForUrl($fields);     
        $values['token']=$this->getCSRFToken();
        return json_encode($values);
    }
    
                
    protected function getCount()
    {      
        if ($this->count===null)
        {                
            $query=str_replace(";",") as tbl_for_count;","SELECT count(*) FROM (".str_replace("{fields}"," count(".CustomerMeeting::getTableField('id').")",$this->getQuery()));
            $db=mfSiteDatabase::getInstance()
                    ->setParameters()
                    ->setQuery($query)              
                    ->makeSqlQuery(); 
         //   echo $db->getQuery()."<br/>";
            $row=$db->fetchRow();            
            $this->count=$row[0];                
        }
    }
    
    protected function getQueryForIndex()
    {
       return str_replace(";"," LIMIT {index},1;",$this->getQuery());              
    }
    
    
    protected function makeQuery($db,$index)
    {
         $db->setParameters(array('index'=>($index===false?0:$index),'fields'=>CustomerMeeting::getFieldsAndKeyWithTable()))
           ->setQuery($this->getQueryForIndex())               
           ->makeSqlQuery();
      //  echo $db->getQuery()."<br>";
        return $db->getNumRows();
    }        
  
    
    function execute()
    {       
        if ($this->processed==false)
        {    
            $this->getCount();            
            $this->getIndexes();
            $this->getPreviousAndNextMeeting();
            $this->processed=true;            
        }
    }
    
    
    
    protected function getIndexes()
    {
        $idx=$this['index']->getValue();        
        $this->next_index=($idx == $this->count)?$idx:$idx+1;
        $this->previous_index=($idx == 0)?false:$idx-1; 
      //  var_dump($idx,$this->next_index,$this->previous_index);
    }
    
    protected function getPreviousAndNextMeeting()
    {      
        $db=mfSiteDatabase::getInstance();
        if ($this->makeQuery($db,$this->getNextIndex()))              
            $this->next_meeting=$db->fetchObject('CustomerMeeting')->loaded();
        if ($this->makeQuery($db,$this->getPreviousIndex()))              
            $this->previous_meeting=$db->fetchObject('CustomerMeeting')->loaded();
    }
    
     function hasPreviousMeeting()
    {
        return ($this->previous_meeting!=null);
    }
    
    function hasNextMeeting()
    {
        return ($this->next_meeting!=null);
    }
    
    function getPreviousMeeting()
    {
        return $this->previous_meeting;
    }
    
    function getNextMeeting()
    {
        return $this->next_meeting;
    }
    
    
}

