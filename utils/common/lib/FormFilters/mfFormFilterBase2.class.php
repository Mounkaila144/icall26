<?php

class mfFormFilterBase2 extends mfFormFilterBase{
    
    function __construct($query=null) {

        if($query instanceof mfQuery)
            $this->query=$query;
        else 
            $this->query= mfQuery::getInstance ();
        
        
        parent::__construct();
    }
    
   protected function findFieldClass($fieldName)
    {
        if (!isset($this->fields[$fieldName]))
            return $this->getClass();
        foreach ($this->fields[$fieldName] as $field)
        {
            if (is_string($field))
            {
                return $field;
            }     
            else
            {
                if (isset($field['class']))
                    return $field['class'];
                return $this->getClass();
            }    
        }   
        
    }        
    
    protected function checkClass($class,$fieldName)
    {
        if (!class_exists($class))
               throw new mfException(sprintf("FormFilter Error : Object [%s] for field [%s] doesn't exist.",$class,$fieldName));            
    }       
    
    protected function clearParameters()
    {
        $this->having_parameters=array();
        $this->where_parameters=array(); 
    }
    
    protected function hasHavingParameters()
    {
        return (boolean)$this->having_parameters;
    }
    
    protected function hasWhereParameters()
    {
        return (boolean)$this->where_parameters;
    }
    
    
    protected function setFieldNameAndValueParameter($mode,$fieldName,$operation,$value="")
    {
       $value=$this->getFieldNameAndValue($mode,$fieldName,$operation,$value);      
       if (in_array($fieldName,$this->havings_fields)) 
       {
           $this->having_parameters[]=$value;           
       } 
       else
       {
          $this->where_parameters[]=$value; 
       }    
       return $this;
    }
    
    protected function getHavingParameters($remove=0)
    {
        if ($remove!=0 && $this->having_parameters)
        {
            end($this->having_parameters); 
            $last=key($this->having_parameters);
            $this->having_parameters[$last]=substr($this->having_parameters[$last], 0, $remove);
        }    
        return $this->having_parameters;
    }
    
    protected function getWhereParameters($remove=0)
    {
        if ($remove!=0 && $this->where_parameters)
        {
            end($this->where_parameters);  
            $last=key($this->where_parameters);
            $this->where_parameters[$last]=substr($this->where_parameters[$last], 0, $remove);
        }    
        return $this->where_parameters;
    }
    
    protected function getFieldNameAndValue($mode,$fieldName,$operation,$value="")
    {               
        $operation=strtr($operation, array("{value}"=>$value)); 

        if (!isset($this->fields[$fieldName]))                 
            return ($this->getTable()?"`".$this->getTable()."`.`".$fieldName."`":"`".$fieldName."`").$operation;          
        if (is_array($this->fields[$fieldName]))
        {                                
            $class=isset($this->fields[$fieldName]['class'])?$this->fields[$fieldName]['class']:$this->getClass();                         
            if ($class==="")
            {                  
                return $fieldName.$operation;
            }                 
            $this->checkClass($class, $fieldName);               
            if (isset($this->fields[$fieldName][$mode]['conditions']))
            {                    
                $value=($mode=='range')?$operation:$value;
                $field=strtr($this->fields[$fieldName][$mode]['conditions'], array("{".$fieldName."}"=>$value));                 
                return $field;
            }   

            if (isset($this->fields[$fieldName]['field']))
                 $fieldName=$this->fields[$fieldName]['field'];
            $field=$class::getTableField($fieldName).$operation;           
            return $field;          
        }   
        else
        {               
            if ($this->fields[$fieldName]=='alias')
                   return $fieldName.$operation;

            $class=$this->fields[$fieldName]; 
            $this->checkClass($class);           
            return $class::getTableFieldEscape($fieldName).$operation; 
        }                 
   
    }      
    
    
    protected function getFieldName($operation,$fieldName)
    {

        $fieldOperation=null;  

        if (isset($this->fields[$fieldName]))
        {           
            if (is_array($this->fields[$fieldName]))
            {        

                if (is_string(current($this->fields[$fieldName])))
                {  
                    
                    if (isset($this->fields[$fieldName]['class']))
                    {                       
                        $class=isset($this->fields[$fieldName]['class'])?$this->fields[$fieldName]['class']:$this->getClass(); 
                        return null;
                    }   
                    else
                    {
                        $class=current($this->fields[$fieldName]);
                        $fieldName=key($this->fields[$fieldName]);                                    
                    }
                }   
                else
                {    
                    $class=isset($this->fields[$fieldName]['class'])?$this->fields[$fieldName]['class']:$this->getClass();               
                    $fieldOperation=isset($this->fields[$fieldName][$operation])?$this->fields[$fieldName][$operation]:null;                                          
                }                                              
            }   
            else
            {  
               if ($this->fields[$fieldName]=='alias')
                   return $fieldName;

               $class=$this->fields[$fieldName];
            }  
            if (!class_exists($class))
               throw new mfException(sprintf("FormFilter Error : Object [%s] for field [%s] doesn't exist.",$class,$fieldName));
            
            if ($fieldOperation)
            {
              return str_ireplace("{field}", $class::getTableField($fieldName) , $fieldOperation) ;              
            }
            return $class::getTableField($fieldName);
        }   
        return ($this->getTable())?"`".$this->getTable()."`.`". $fieldName."`":"`".$fieldName."`";
    }            

    protected function buildOrderQuery($values) { 
        $order = array();
        foreach ($values as $fieldName => $value) {
            if (in_array($fieldName,$this->exclude_fields))
                continue;
            $value = (string) $value;
            if ($value != null) {              
                $order[]= $this->getQuery()->orderby($value);
            }
        }
        if (!$order)
            return;
        

    }

    protected function buildSearchQuery($values) {        
        foreach ($values as $fieldName => $value) {                        
            if (in_array($fieldName,$this->exclude_fields) || (array_key_exists($fieldName,$this->fields) && $this->fields[$fieldName]===null))
                continue;
            $value=(string) $value;
            if ($value != null) {

                $value = strtr($value, array('*' => "%%", '?' => "_", "%" => "\%", "_" => "\_"));
                $value=str_replace("%","%%",$value);             
                $this->getQuery()->where("$fieldName LIKE {value}")
                                 ->setParameter("value","%%$value%%");
            }
        }     
        $this->insertParametersInQuery();       
    }

    protected function buildComparaisonQuery($values) {
        
        foreach ($values as $fieldName => $value) {
            if (in_array($fieldName,$this->exclude_fields) || (isset($this->fields[$fieldName]) && $this->fields[$fieldName]===null))
                continue;
            $value = $value->getValue();
            if ($value != null)
            {    
             $this->setFieldNameAndValueParameter('comparaison', $fieldName," {value} ", $this->escape($value['op']) . " " . $this->escape($value['value']) ); 
            }
        }
        $this->insertParametersInQuery();       
    }

    protected function buildRangeQuery($values) {        
        foreach ($values as $fieldName => $value) {           
            if (in_array($fieldName,$this->exclude_fields) || (array_key_exists($fieldName,$this->fields) && $this->fields[$fieldName]===null))
                continue;
            $value = $value->getValue();            
            if ($value != null) 
            {
                $keys_from=array_intersect(array('from','min'),array_keys($value));
                $keys_to=array_intersect(array('to','max'),array_keys($value));
                $key_from=current($keys_from)?current($keys_from):'from';
                $key_to=current($keys_to)?current($keys_to):'to';                                    
                $from = $this->escape((string) $value[$key_from]);
                $to = $this->escape((string) $value[$key_to]);                
                if ($from > $to)
                    list($from, $to) = array($to, $from);               
                if ($from!='' || $to!='')
                {    
                    if ($from || $from==='0')
                    {                           
                        $this->setFieldNameAndValueParameter('range', $fieldName,">='{value}' AND ", $from); // Laisser 4 charac a la fin                          
                    }                    
                    else
                    {            
                       $this->setFieldNameAndValueParameter('range', $fieldName," IS NULL OR  ");// Laisser 4 charac a la fin                       
                    }    
                    if ($to || $to==='0')
                    {                           
                       $this->setFieldNameAndValueParameter('range', $fieldName,"<='{value}' AND ",$to);// Laisser 4 charac a la fin                     
                    }                   
                }
            }
        }            
        $this->insertParametersInQuery("","(",") ",-4);               
    }

    protected function buildEqualQuery($values) {            
        foreach ($values as $fieldName => $value) {
            if (in_array($fieldName,$this->exclude_fields) || (array_key_exists($fieldName,$this->fields) && $this->fields[$fieldName]===null))
                continue;
            $value=(string) $value;
            if ($value != null) {             
                if ($value=='IS_NULL')
                    $condition=" IS NULL";
                elseif ($value=='IS_NOT_NULL')
                    $condition=" IS NOT NULL";
                elseif ($value=='IS_NOT_EMPTY')
                    $condition="!=''";
                elseif ($value=='IS_EMPTY')
                    $condition="=''";
                else    
                    $condition="='".$this->escape($value)."'";
                $this->setFieldNameAndValueParameter('equal', $fieldName,"{value}", $condition);                         
            }
        }        
        $this->insertParametersInQuery();        
    }
    
    protected function buildInQuery($values) {                       
        foreach ($values as $fieldName => $items) {          
            if (in_array($fieldName,$this->exclude_fields) || (array_key_exists($fieldName,$this->fields) && $this->fields[$fieldName]===null))
            {
                continue;
            }    
            $items=$items->getValue();            
            if (is_array($items))
            {                     
                $this->setFieldNameAndValueParameter('in', $fieldName," IN('{value}')", implode("','",$items)); 
            }    
            elseif ($items)
            {              
                $this->setFieldNameAndValueParameter('in', $fieldName," IN('{value}')", $items); 
            }    
        }
        $this->insertParametersInQuery();     
    }
    
    protected function replaceHavingParameters($query)
    {
            $this->having= $query->getHaving();

             
    }   
  

    protected function getFunctionsQuery() {
        foreach ($this->getValidatorSchema()->getFields() as $validatorName) {
            $method = 'build' . ucfirst($validatorName) . 'Query';           
            if (method_exists($this, $method)) {               
                $this->$method($this[$validatorName]);
            }
        }
    }

    protected function _getQuery()
    {
        return parent::getQuery();
    }        
    
    function getQuery(){
        return $this->query;   
        
    }

    function escape($str)
    {
      return str_replace(array("\\","\0","\n","\r","\x1a","'",'"'),
                         array("\\\\","\\0","\\n","\\r","\Z","\'",'\"'),$str);
    } 
    
   function getWhere($operation="")
    {                       
        $this->getQuery();                        
        if ($this->where)
            return $operation." ".$this->where;
        return "";
    }
    
    function getHaving()
    {       
        $this->getQuery();    
        return $this->having;
    }
    
}

