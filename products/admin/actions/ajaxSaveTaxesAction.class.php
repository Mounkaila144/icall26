<?php

require_once dirname(__FILE__)."/../locales/Forms/TaxViewForm.class.php";
 
 
class products_ajaxSaveTaxesAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
            
        try
        {        
                $this->item=new Tax($request->getPostParameter('Taxes'));                
                $this->form = new TaxViewForm();
                if ($this->item->isNotLoaded())
                    return ;                             
                $this->form->bind($request->getPostParameter('Taxes'));
                if ($this->form->isValid()) 
                {
                    $this->item->add($this->form->getValues());    
                    if ($this->item->isExist())
                        throw new mfException (__("Taxes already exists"));
                    $this->item->save();                        
                    $messages->addInfo(__("Taxes [%s] has been saved.",$this->item->get('description').'('.format_pourcentage($this->item->get('rate')).')'));
                    $this->forward('products','ajaxListPartialTaxes');
                }
                else
                {
                    $this->item->add($request->getPostParameter('Taxes'));    // Repopulate
                  //  $messages->addErrors($this->form->getErrorSchema()->getErrors()); // For debug only
                   $messages->addError(__("Form has some errors."));
                }                  
        }
        catch (mfException $e)
        {
          //  var_dump(mfSiteDatabase::getInstance()->getQuery());
            $messages->addError($e);
        }      
    }

}

