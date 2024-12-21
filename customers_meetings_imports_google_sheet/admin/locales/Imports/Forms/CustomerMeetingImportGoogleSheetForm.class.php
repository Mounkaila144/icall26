<?php

class CustomerMeetingImportGoogleSheetForm extends mfForm {


    function __construct($defaults = array()) {
        $this->settings=CustomerMeetingSettings::load();

        parent::__construct($defaults);
    }


    function getSettings()
    {
        return $this->settings;
    }


    function configure()
    {
        $this->language=$this->getSettings()->get('language','FR');
        $this->setOption('disabledCSRF',true);
        $this->setValidators(array(
            "id"=>new mfValidatorInteger(array("required"=>false)),
            "firstname"=>new mfValidatorString(array("max_length"=>"255","trim"=>true)),
            "lastname"=>new mfValidatorString(array("max_length"=>"255","trim"=>true)),
            "phone"=>new mfValidatorPhoneString(array("max_length"=>"20")),
            "mobile"=>new mfValidatorPhoneString(array("max_length"=>"20","required"=>false)),
            "mobile2"=>new mfValidatorPhoneString(array("max_length"=>"20","required"=>false)),
            "address"=>new mfValidatorString(array("max_length"=>"255")),
            "address2"=>new mfValidatorString(array("max_length"=>"255","required"=>false)),
            "email"=>new mfValidatorString(array("required"=>false)),
            "postcode"=>new mfValidatorString(array("max_length"=>"10","trim"=>true)),
            "city"=>new mfValidatorString(array("max_length"=>"255","trim"=>true)),
            "sale1"=>new mfValidatorString(array("max_length"=>"64","required"=>false,'trim'=>true)),
            "sale2"=>new mfValidatorString(array("max_length"=>"64","required"=>false,'trim'=>true)),
            "telepro"=>new mfValidatorString(array("max_length"=>"64","required"=>false,'trim'=>true)),
            "state"=>new mfValidatorString(array("max_length"=>"64","required"=>false)),
            "callstatus"=>new mfValidatorString(array("max_length"=>"64","required"=>false)),
            "date_rdv"=>new mfValidatorI18nDate(array('date_format'=>'a','empty_value'=>null)),
            "time_rdv"=>new mfValidatorTime(array("time_format"=>"/^(?P<hour>[0-1][0-9]|2[0-3]):(?P<minute>[0-5][0-9])(:(?P<seconds>[0-5][0-9]))?$/",'empty_value'=>null),array('bad_format'=>__('{value} is bad format'))),
            "turnover"=>new mfValidatorI18nNumber(array('required'=>false)),
            "date_created_at"=>new mfValidatorI18nDate(array('date_format'=>'a',"required"=>false),array('bad_format'=>__('{value} is bad format'))),
            "time_created_at"=>new mfValidatorTime(array("time_format"=>"/^(?P<hour>[0-1][0-9]|2[0-3]):(?P<minute>[0-5][0-9])$/","required"=>false,'empty_value'=>null),array('bad_format'=>__('{value} is bad format'))),
            "created_at"=>new mfValidatorI18nDate(array("with_time"=>true,'date_format'=>'aHM',"required"=>false,'empty_value'=>null),array('bad_format'=>__('{value} is bad format'))),
            "creation_at"=>new mfValidatorI18nDate(array("with_time"=>true,'date_format'=>'aHM',"required"=>false,'empty_value'=>null),array('bad_format'=>__('{value} is bad format'))),
            "date_time_rdv"=>new mfValidatorI18nDate(array("with_time"=>true,'date_format'=>'aHM',"required"=>false,'empty_value'=>null),array('bad_format'=>__('{value} is bad format'))),
            "remarks"=>new mfValidatorString(array("max_length"=>"4096","required"=>false)),
            "products"=>new mfValidatorVariablesForImport(array("required"=>false,"upper"=>true,"separator"=>",")),
        ));
        $this->validatorSchema->setOption('keep_fields_unused',true);
        // $this->validatorSchema->setOption('field_missing_i18n',true);
        $this->validatorSchema->setMessage('field_missing',__('The field is missing.'));
        // propagate form to other module
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'meeting.import.google.sheet.model'));
    }

    function getFieldsI18n()
    {
        $fields = array(
            "id", "firstname", "lastname", "phone", "mobile", "mobile2", "address", "address2", "email", "postcode", "city", "sale1", "sale2", "telepro",
            "state", "callstatus", "date_rdv", "turnover", "time_rdv", "date_created_at", "time_created_at", "created_at","creation_at", "date_time_rdv", "remarks", "products"
        );

        $values=array(""=>__("-- Not affected --"));
        foreach ($fields as $field)
        {
            $values[$field]=__($field,array(),'import','customers_meetings_imports_google_sheet').($this->$field->getOption('required')?"*":"");
        }
        asort($values);
        return $values;
    }

    function reconfigure()
    {
        if ($this->hasDefault('date_time_rdv'))
            unset($this['time_rdv'],$this['date_rdv']);
        else
            unset($this['date_time_rdv']);
        if (($this->hasDefault('created_at')))
            unset($this['date_created_at'],$this['time_created_at']);
        else
            unset($this['created_at']);
    }

    function getCustomerMeeting()
    {
        if($this->getValue('id') !== null){

            return $this->getCustomerMeetingUpdateMode();
        }
        else
            return $this->getCustomerMeetingInsertMode();
    }

    protected function getCustomerMeetingInsertMode()
    {
        //$params=array('in_at'=>$this->getMeetingDateTime(),'phone'=>$this->getValue('phone'));

        $meeting=new CustomerMeeting();
       // if ($meeting->isLoaded())
            //return $meeting;
        $this->setState($meeting);
        $this->setCallStatus($meeting);
        $this->setCallCenter($meeting);
        $this->setCampaign($meeting);
        $this->setType($meeting);
        $this->setSale1($meeting);
        $this->setSale2($meeting);
        $this->setTelepro($meeting);
        $this->setAssistant($meeting);
        $this->setCustomer($meeting);
        $this->setQualification($meeting);
        $this->setCreatedDateTime($meeting);
        $this->setCreationDate($meeting);
        $this->setCallback($meeting);
        if ($this->getSettings()->hasPolluter())
            $this->setPolluter($meeting);
        if ($this->getSettings()->hasRegistration())
            $meeting->register();
        $meeting->add(array('remarks'=>$this->getValue('remarks'),
            'turnover'=>$this->getValue('turnover')
        ));

        return $meeting;
    }
    protected function getCustomerMeetingUpdateMode()
    {

        //updates
        if(empty($this->getValue('id')))
            return $this->getCustomerMeetingInsertMode();

        $meeting=new CustomerMeeting($this->getValue('id'));

        if ($meeting->isNotLoaded())
            return $this->getCustomerMeetingInsertMode();

        $this->setState($meeting);
        $this->setCallStatus($meeting);
        $this->setCallCenter($meeting);
        $this->setCampaign($meeting);
        $this->setType($meeting);
        $this->setSale1($meeting);
        $this->setSale2($meeting);
        $this->setTelepro($meeting);
        $this->setAssistant($meeting);
        $this->setCustomer($meeting);
        $this->setQualification($meeting);
        $this->setCreatedDateTime($meeting);
        $this->setCreationDate($meeting);
        $this->setCallback($meeting);
        if ($this->getSettings()->hasPolluter())
            $this->setPolluter($meeting);
        if ($this->getSettings()->hasRegistration())
            $meeting->register();
        $meeting->add(array('remarks'=>$this->getValue('remarks'),
            'turnover'=>$this->getValue('turnover')
        ));
        return $meeting;
    }

    function getMeetingDateTime()
    {
        if ($this->hasValidator('date_time_rdv'))
        {
            return $this->getValue('date_time_rdv');
        }
        else
        {
            if ($this->getValue('date_rdv') && $this->getValue('time_rdv'))
                return $this->getValue('date_rdv')." ".$this->getValue('time_rdv');
            else
            {
                if($this->getValue('date_rdv'))
                    return $this->getValue('date_rdv');
                return null;
            }
        }
    }
    function hasField($field)
    {
        return isset($this->values[$field]);
    }

    function setCreatedDateTime($meeting)
    {
        if ($this->hasField('date_created_at') || $this->hasField('created_at'))
        {
            $meeting->set('created_at',$this->getCreatedDateTime());
        }
    }
    function setCreationDate($meeting)
    {
        if ($this->hasField('creation_at'))
        {
            $meeting->set('creation_at',$this->getValue('creation_at'));
        }
    }

    function setState($meeting)
    {
        if ($this->hasField('state') && $this->getValue('state'))
        {
            $state_i18n=new CustomerMeetingStatusI18n(array('lang'=>$this->language,'value'=>$this->getValue('state')));
            if ($state_i18n->isNotLoaded())
                $state_i18n->set('status_id', $state_i18n->getCustomerMeetingStatus()->save())->save();
            $meeting->set('state_id',$state_i18n->get('status_id'));
        }
    }

    function setCallcenter($meeting)
    {
        if ($this->hasField('callcenter') && $this->getValue('callcenter'))
        {
            $callcenter=new CallCenter(array('name'=>$this->getValue('callcenter')));
            if ($callcenter->isNotLoaded())
                $callcenter->save();
            $meeting->set('callcenter_id',$callcenter);
        }
    }

    function setCallback($meeting)
    {
        if ($this->hasField('callback_at') && $this->getValue('callback_at'))
        {
            $meeting->set('callback_at',$this->getValue('callback_at'));
        }
    }

    function setCallStatus($meeting)
    {
        if ($this->hasField('callstatus') && $this->getValue('callstatus'))
        {
            $state_i18n=new CustomerMeetingStatusCallI18n(array('lang'=>$this->language,'value'=>$this->getValue('callstatus')));
            if ($state_i18n->isNotLoaded())
                $state_i18n->set('status_id', $state_i18n->getStatus()->save())->save();
            $meeting->set('status_call_id',$state_i18n->get('status_id'));
        }
    }

    function setType($meeting)
    {
        if ($this->hasField('type') && $this->getValue('type'))
        {
            $type_i18n=new CustomerMeetingTypeI18n(array('lang'=>$this->language,'value'=>$this->getValue('type')));
            if ($type_i18n->isNotLoaded())
                $type_i18n->set('type_id', $type_i18n->getType()->save())->save();
            $meeting->set('type_id',$type_i18n->get('type_id'));
        }
    }

    function setCampaign($meeting)
    {
        if ($this->hasField('campaign') && $this->getValue('campaign'))
        {
            $campaign=new CustomerMeetingCampaign(array('name'=>$this->getValue('campaign')));
            $campaign->save();
            $meeting->set('campaign_id',$campaign);
        }
    }

    function setCustomer($meeting)
    {
        $customer=new Customer();
        $customer->set('lastname',$this->getValue('lastname'));
        $customer->set('firstname',$this->getValue('firstname'));
        if ($customer->isNotLoaded())
        {
            $customer->add(array('mobile'=>$this->getValue('mobile'),
                'email'=>$this->getValue('email'),
                'phone'=>$this->getValue('phone')))->save();
        }
        else
        {      // Update if existing
            if ($this->getValue('email'))
                $customer->set('email',$this->getValue('email'));
            if ($this->getValue('mobile'))
                $customer->set('mobile',$this->getValue('mobile'));
        }
        if ($this->getValue('mobile2'))
            $customer->set('mobile2',$this->getValue('mobile2'));
        foreach (array('address1'=>'address','city','postcode','address2') as $name=>$value)
        {
            if ($this->getValue($value))
                $customer->getAddress()->set(is_numeric($name)?$value:$name,$this->getValue($value));
        }
        $customer->getAddress()->save();
        $customer->save();
        $meeting->set('customer_id',$customer);
    }

    function setSale1($meeting)
    {
        if ($this->hasField('sale1') && $this->getValue('sale1'))
        {
            $user=new User(array('name'=>$this->getValue('sale1'),'admin'));
            if ($user->isNotLoaded())
                throw new ImportException(ImportException::ERROR_IMPORT,__("Sale1 doesn't exist."));
            //$user->save();
            $meeting->set('sales_id',$user);
        }
    }

    function setSale2($meeting)
    {
        if ($this->hasField('sale2') && $this->getValue('sale2'))
        {
            $user=new User(array('name'=>$this->getValue('sale2'),'admin'));
            if ($user->isNotLoaded())
                throw new ImportException(ImportException::ERROR_IMPORT,__("Sale2 doesn't exist."));
            $meeting->set('sale2_id',$user);
        }
    }

    function setTelepro($meeting)
    {
        if ($this->hasField('telepro') && $this->getValue('telepro'))
        {
            $user=new User(array('name'=>$this->getValue('telepro'),'admin'));
            if ($user->isNotLoaded())
                throw new ImportException(ImportException::ERROR_IMPORT,__("Telepro doesn't exist."));
            $meeting->set('telepro_id',$user);
        }

    }

    function setAssistant($meeting)
    {
        if ($this->hasField('assistant') && $this->getValue('assistant'))
        {
            $user=new User(array('name'=>$this->getValue('assistant'),'admin'));
            if ($user->isNotLoaded())
                throw new ImportException(ImportException::ERROR_IMPORT,__("Assistant doesn't exist."));
            $meeting->set('assistant_id',$user);
        }
    }


    function setQualification($meeting)
    {
        if ($this->hasField('qualification') && $this->getValue('qualification'))
        {
            $meeting->set('is_qualified',$this->getValue('qualification'));
        }
    }

    function setProducts($meeting)
    {
        if ($this->hasField('products') && $this->getValue('products'))
        {
            $products=$this->getValue('products');
            if ($unknowns=ProductUtils::getUnknownProducts($products))
                throw new ImportException(ImportException::ERROR_IMPORT,__("Products %s don't exist.",implode(',',$unknowns)));
            $product_list=ProductUtils::getProducts($products);
            $collection=new CustomerMeetingProductCollection();
            foreach ($product_list as $product)
            {
                $item=new CustomerMeetingProduct();
                $item->add(array('meeting_id'=>$meeting,'product_id'=>$product));
                $collection[]=$item;
            }
            $collection->save();
        }
    }
    function getCreatedDateTime()
    {
        if ($this->hasValidator('date_created_at'))
        {
            if ($this->getValue('date_created_at') && $this->getValue('time_created_at'))
                return $this->getValue('date_created_at')." ".$this->getValue('time_created_at');
            return null;
        }
        else
            return $this->getValue('created_at');
    }
    function setPolluter($meeting)
    {
        if ($this->hasField('polluter') && $this->getValue('polluter'))
        {
            $polluter=new PartnerPolluterCompany(array('name'=>$this->getValue('polluter')));
            if ($polluter->isNotLoaded())
                $polluter->save();
            $meeting->set('polluter_id',$polluter);
        }
    }

}

