<?php

class SessionForSiteFormFilter extends mfFormFilterBase{
    
    function configure()
    {
        $this->setDefaults(array(
            'order'=>array(
                "id"=>"desc",
            ),
            'search'=>array(
                         
            ),
            'nbitemsbypage'=>100,
        ));
        $this->setClass('Session');
        $this->setFields(array("username"=>"User"));
        // Base Query
        $this->setQuery("SELECT {fields} FROM ".Session::getTable().
                        " INNER JOIN ".Session::getOuterForJoin('user_id').
                        " WHERE ".User::getTableField('application')."='admin'".
                            " AND ".Session::getTableField('session')."!=''".
                        ";");
        // Validators
        $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "username"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "ip"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "start_time"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "last_time"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                        ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                            "username"=>new mfValidatorString(array("required"=>false)),  
                            "ip"=>new mfValidatorString(array("required"=>false)),
                            "start_time"=>new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)),
                            "last_time"=>new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)),
                        ),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"250"=>250,"500"=>500,"*"=>"*"))),         
        ));
    }
    
    function _extractParameterForUrl($name)
    {
        if ($name=='search')
        {
            $values=$this['search']->getValue();                       
            if (isset($values['start_time']))
            {
                $values['start_time'] = format_date(date("Y-m-d",strtotime($values['start_time'])),"a");                       
            }                           
            if (isset($values['last_time']))
            {
                $values['last_time'] = format_date(date("Y-m-d",strtotime($values['last_time'])),"a");                       
            }                           
            return $values;
        }   
        return parent::_extractParameterForUrl($name);
    }
}
