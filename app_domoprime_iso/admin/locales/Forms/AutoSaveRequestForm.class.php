<?php

class AutoSaveRequestForm extends mfForm {
    
     function getSettings()
     {
         return $this->settings=$this->settings===null?new DomoprimeIsoSettings():$this->settings;
     }
     
    function setValidatorForField($field)
    {
        if ($field=='energy_id')
            $this->setValidator('value',new mfValidatorCHoice(array('key'=>true,'choices'=>DomoprimeEnergy::getEnergyForI18nSelect())));
        elseif ($field=='previous_energy_id')
              $this->setValidator('value',new mfValidatorCHoice(array('key'=>true,'choices'=>DomoprimePreviousEnergy::getEnergyForI18nSelect())));
        elseif ($field=='occupation_id')
            $this->setValidator('value',new mfValidatorCHoice(array('key'=>true,'choices'=> DomoprimeOccupation::getOccupationForI18nSelect())));
        elseif ($field=='layer_type_id')
            $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'choices'=> PartnerLayerCompany::getLayersByNameForSelect())));
        elseif ($field=='more_2_years')
            $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'choices'=> array('YES'=>__("YES"),'NO'=>__("NO")))));
         elseif ($field=='pricing_id')
            $this->setValidator('value',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>DomoprimeIsoCumacPrice::getPricingForSelect()->unshift(array(''=>'')))));
        elseif (in_array($field,array('item_top','item_wall','item_floor')))
        {        
            $field=str_replace("item_","",$field);
            if ($this->getSettings()->get('surface_'.$field.'_product'))
            {
                $method='get'.ucfirst($field).'Product';
                $this->setValidator('value', new mfValidatorChoice(array('choices'=>$this->getSettings()->$method()->getProductItemsForSelect()->unshift(array(''=>''))->toArray(),'required'=>false,'key'=>true)));
            }
        } 
    }
    
    function configure()
    {
        $this->setValidators(array(
            'id'=>new ObjectExistsValidator('CustomerContract',array('key'=>false)),
            'field'=>new mfValidatorChoice(array('choices'=>array('item_top','item_wall','item_floor','pricing_id','energy_id','occupation_id','more_2_years','layer_type_id','previous_energy_id')))            
        ));
        $this->setValidatorForField($this->getDefault('field'));
    }
    
    function getFieldI18n()
    {
        return __("field_".$this['field']->getValue());
    }
    
    function getContract()
    {
        return $this['id']->getValue();
    }
    
    function getProduct()
    {
        if ($this->product===null)
        {    
             $field=str_replace("item_","",$this['field']->getValue());
            if ($this->getSettings()->get('surface_'.$field.'_product'))
            {
                $method='get'.ucfirst($field).'Product';
                $this->product=$this->getSettings()->$method();
            }
        }
        return $this->product;
    }
    
    function getValue()
    {
        return $this['value']->getValue();
    }        
    
    function getContractProductItem()
    {        
        return $this->item=$this->item===null?new CustomerContractProductItem(array('product'=>$this->getProduct(),'contract'=>$this->getContract())):$this->item;
    }
    
    function process()
    {
        if (in_array($this['field']->getValue(),array('energy_id','pricing_id','occupation_id','more_2_years','layer_type_id')))
        {        
            $request=new DomoprimeCustomerRequest($this->getContract());
            $request->set($this['field']->getValue(),$this->getValue());
            $request->save();
        }
        if (in_array($this['field']->getValue(),array('item_top','item_wall','item_floor')))
        {            
             if ($this->getValue())
                $this->getContractProductItem()->set('item_id',$this->getValue())->save(); 
             else
                $this->getContractProductItem()->set('item_id',$this->getValue())->delete();  
        }        
        return $this;
    }
}

