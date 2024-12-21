<?php


class UserProfileGroupCollection extends mfObjectCollection3 {
    
 
    
    function getGroups()
    {
        $values=new mfArray();
        foreach ($this->collection as $item)
            $values[]=$item->get('group_id');
        return $values;
    }
}

