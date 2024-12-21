<?php

class utils_DateFromAndToFromMonthsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                           
            foreach (array('class','from','to') as $field)
                $this->$field=$this->getParameter($field);
            $this->months=new mfArray();
            $day=new Day();
            $day=$day->getMonthSub($this->getParameter('start',12));
            for($i=0;$i < $this->getParameter('length',13);$i++)
            {                
                $this->months[]=$day;                    
                $day=$day->getMonthAdd(1);
            }                   
    } 
    
    
}