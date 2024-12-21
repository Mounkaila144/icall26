<?php

class mfWidgetApi {
    
    protected $field=null,$parameters=null,$object=null;
    
    function __construct($object,$field,$parameters=array()) {
       //  echo "Field1=".$field."<br/>";
        $this->object=$object;
        $this->field=$field;       
        $this->parameters=$parameters;
    }
    
    function getField(){
        return $this->field;
    }
            
    function toArray()
    {        
        $values=new mfArray($this->parameters);      
        //  echo "Field2=".$this->field."<br/>";
        unset($values['condition'],$values['default'],$values['method'],$values['style']);
        if (isset($values['properties']) && !$values['properties'])
            unset($values['properties']);     
              
        $values['name']= $this->field;             
        if (!isset($values['value']))
        {                    
            if ($this->parameters['method'])
            {    
                unset($values['method']);
                $method='get'.$this->parameters['method'];                
                $values['value']=(string)$this->object->$method($this->parameters['parameters']);              
            }
            elseif ($this->parameters['format'])
            {    
                unset($values['format']);
                $method='get'.$this->parameters['format']['method'];
                if ($this->parameters['format']['output'])
                {
                    $output=$this->parameters['format']['output']['method'];
                    $values['value']=(string)$this->object->getFormatter()->$method($this->parameters['format']['parameters'])->$output($this->parameters['format']['output']['options']);  
                }                
                else
                {    
                    $values['value']=(string)$this->object->getFormatter()->$method($this->parameters['format']['parameters']);
                }
            }
            elseif($this->object->isForeignKeyExists($this->field)){                                 
                if ($this->object->get($this->field))
                {                 
                    if ($this->parameters['method'])
                    {                                                           
                        $method =$this->parameters['method'];
                        if (!method_exists($this->object,$method))                                
                            throw new InvalidArgumentException(__('Method [%s] is invalid',$method));                        
                        $values[$this->field]=$this->object->$method()->toArrayForApi($this->parameters['method'])->toArray();
                    }   
                    else
                    {    
                        $values[$this->field]=intval($this->object->get($this->field));
                    }                   
                }
                else
                {
                  $values['value']=isset($this->parameters['default'])?$this->parameters['default']:$this->object->get($this->field);  
                }                  
            }
            elseif (isset($this->parameters['style']))
            {                    
                if (isset($this->parameters['style']['method']))
                {    
                    $method=$this->parameters['style']['method'];                       
                    $values['value']=method_exists(get_class($this->object->getFormatter()),$method)?$this->object->getFormatter()->$method($this->parameters['style']['parameters']):$this->object->$method($this->parameters['style']['parameters']);
                }
                if (isset($this->parameters['style']['parameters']['true']) && $values['value'])
                   $values['style']=is_array($this->parameters['style']['parameters']['true'])?implode(";",$this->parameters['style']['parameters']['true']):$this->parameters['style']['parameters']['true'];
                if (isset($this->parameters['style']['parameters']['false']) && !$values['value'])
                   $values['style']=is_array($this->parameters['style']['parameters']['false'])?implode(";",$this->parameters['style']['parameters']['false']):$this->parameters['style']['parameters']['false'];                
            }
            else
            {

                $values['value']=$this->object->get($this->field);      
            }  
        }
        
        if(isset($this->parameters['default'])){    

            $values['default']=$this->parameters['default'];
        }
        
        if(isset($this->parameters['fields'])){         
            $field_widgets =new mfWidgetApiCollection(); 
            foreach ($this->parameters['fields'] as $field=>$options)
            {  
                if (is_numeric($field))
                {    
                    $field_widgets->setIf(true,$field, new mfWidgetApi($this->object,$options));                                            
                }
                else
                {                      
                   $field_widgets->setIf(isset($options['condition'])?$options['condition']:true,$field, new mfWidgetApi($this->object,$field,$options));                                        
                }
            }        
            unset($values['value']);
            $values['fields']=$field_widgets->toArray();                 
        }       
        return $values->toArray();
    }
    
        
}
