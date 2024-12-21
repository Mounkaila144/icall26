<?php


class DomoprimeQuotationChecker {
    
    protected $action=null,$data=null,$user=null;
    
    function __construct(mfAction $action,$site=null) {
        $this->action=$action;
        $this->site=$site;
        $this->data=new mfArray();
        $this->user=$action->getUser();
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getAction()
    {
        return $this->action;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function get($name,$default=null)
    {
        return isset($this->data[$name])?$this->data[$name]:$default;
    }        
    
    function getSettings()
    {
       return $this->settings=$this->settings===null? new DomoprimeIsoSettings(null,$this->getSite()):$this->settings; 
    }
    
  /*  function process()
    {
       foreach (array('total_gross_sale_fee_file_without_tax',
                      'total_gross_tax',
                      'tax_fee_file',
                      'total_fee_file_without_tax',
                      'total_gross_sale_without_tax',
                      'total_gross_sale_fee_file_with_tax',
                      'total_gross_sale_fee_file_minus_prime_with_tax',
                      'total_gross_sale_with_tax',
                      'global_sale_with_tax',
                ) as $field)
       {
           $this->data[$field]= mfString::getInstance($this->getAction()->quotation[$field])->toFloat()->getValue();
       }          
       $total_ttc= $this->get('total_gross_sale_fee_file_without_tax') + $this->get('total_gross_tax') + $this->get('tax_fee_file');
       if (round($total_ttc,5) != round($this->get('total_gross_sale_fee_file_with_tax'),5))
           throw new mfException(__("Quotation total is incoherent. [%s] [%s]",array($total_ttc,$this->get('total_gross_sale_fee_file_with_tax')),'messages','app_domoprime_iso'));
       $restincharge= $this->get('total_gross_sale_fee_file_with_tax') - $this->get('total_gross_sale_fee_file_minus_prime_with_tax');
       if ($restincharge != $this->getSettings()->getRestInCharge())
           throw new mfException(__("Quotation rest in charge is incoherent. [%s] [%s]",array($restincharge,$this->getSettings()->getRestInCharge()),'messages','app_domoprime_iso'));      
       if ($this->get('total_gross_sale_with_tax') != $this->get('global_sale_with_tax') && $this->getUser()->hasCredential(array(array('app_domoprime_quotation_checker_total_prime'))))
           throw new mfException(__("Quotation total prime is incoherent. [%s] [%s]",array($this->get('total_gross_sale_with_tax'),$this->get('global_sale_with_tax')),'messages','app_domoprime_iso'));      
       return $this;
    }*/
    /*

3: que le total ttc moin la prime = retsre a payer
2: que tva cumule  + le ht = au ttc
1: que la tva a 5.5 + tva a 20 = total ttc 
     */
    
    function process()
    {
       foreach (array('total_sale_and_adder_and_fee_with_tax',
                       'total_sale_with_tax',
                      'total_sale_and_adder_and_fee_without_tax',
                      'tax_fee_file',
                      'total_fee_file_without_tax',
                      'rest_to_pay_with_tax',
                      'total_sale_and_adder_and_fee_tax',
                      'total_sale_and_adder_and_fee_with_tax',
                      'total_sale_and_adder_tax',                      
                ) as $field)
       {
           $this->data[$field]= mfString::getInstance($this->getAction()->quotation[$field])->toFloat()->getValue();
       }         
       //1 
       $total_tax= $this->get('total_sale_and_adder_tax') + $this->get('tax_fee_file');
       if (round($total_tax,5) != round($this->get('total_sale_and_adder_and_fee_tax'),5))
           throw new mfException(__("Quotation tax total is incoherent. [%s] [%s]",array($total_ttc,$this->get('total_sale_and_adder_and_fee_with_tax')),'messages','app_domoprime_iso'));
       // 2
       $total_ttc= $this->get('total_sale_and_adder_and_fee_without_tax') + $this->get('total_sale_and_adder_tax') + $this->get('tax_fee_file');
       if (round($total_ttc,5) != round($this->get('total_sale_and_adder_and_fee_with_tax'),5))
           throw new mfException(__("Quotation total is incoherent. [%s] [%s]",array($total_ttc,$this->get('total_sale_and_adder_and_fee_with_tax')),'messages','app_domoprime_iso'));
       //3      
       $restincharge= $this->get('total_sale_and_adder_and_fee_with_tax') - $this->get('total_sale_with_tax');
       if ($restincharge != $this->get('rest_to_pay_with_tax'))
           throw new mfException(__("Quotation rest in charge is incoherent. [%s] [%s]",array($restincharge,$this->get('rest_to_pay_with_tax')),'messages','app_domoprime_iso'));          
       // 0
       foreach (array('top','wall','floor') as $type)
       {                        
          $this->data['products_'.$type.'_total_sale_price_with_tax']= mfString::getInstance($this->getAction()->products[$type]['total_sale_price_with_tax'])->toFloat()->getValue(); 
       }  
       $total = $this->get('products_top_total_sale_price_with_tax') + $this->get('products_wall_total_sale_price_with_tax') + $this->get('products_floor_total_sale_price_with_tax');
       if (  $total !=  $this->get('total_sale_with_tax'))
          throw new mfException(__("Quotation total sale is incoherent. [%s] [%s]",array($total,$this->get('total_sale_with_tax')),'messages','app_domoprime_iso'));           
              
       return $this;
    }
}
