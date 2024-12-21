<?php


class UserProfileFunctionCollection extends mfObjectCollection3 {
    
    
    
    function getFunctions()
    {
        $values=new mfArray();
        foreach ($this->collection as $item)
            $values[]=$item->get('function_id');
        return $values;
    }
    
}

