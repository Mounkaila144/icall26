 <?php
/*
 * Generated by SuperAdmin Generator date : 25/03/13 16:38:07
 */


class moduleManagerAdminExistsValidator extends mfValidatorString {
 

    
    protected function configure($options,$messages)
    { 
       parent::configure($options,$messages);
       $this->setOption("empty_value",0); // in case of value is null
       $this->addMessage('notexist', __("record ({value}) doesn't exists."));
    }
  
    protected function doIsValid($value) 
    {
        $item=new moduleManagerAdmin($value);       
         if ($item->isNotLoaded())
        {
           if ($value=="" || $value=="0")
           {
               if ($this->getOption('required')==true)
                   throw new mfValidatorError($this, 'required');
               else              
                  return $item;
           }   
           throw new mfValidatorError($this, 'notexist', array('value' => $value));
        }   
        return $item;
    }

}
