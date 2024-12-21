<?php

require_once __DIR__."/FormFilters/ProductItemsApiFormFilter.class.php";
require_once __DIR__."/Formatters/ProductItemFormatterApi.class.php";

class ProductItemListFormatterApi  extends mfFormatterActionApi{
    
   function getHeader()
    {
       
        return array(
                     
            
                      'id'=>array(
                         'label'=>__('ID'),
                         'style'=>'display:none'
                         ),
                  
                     'product_id'=>array('label'=>__('Product'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_product_item_product_list']])
                                        ), 
                     'mark'=>array('label'=>__('Mark'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_product_item_mark_list']])
                                        ), 
                     'title'=>array('label'=>__('Title')), 
                     'coefficient'=>array('label'=>__('Coefficient'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_product_item_coefficient_list']])
                                        ), 
                     'tva_id'=>array('label'=>__('TVA'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_product_item_tva_list']])
                                        ), 
                     'purchasing_price'=>array('label'=>__('Purchasing price'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_product_item_purchasing_price_list']])
                                        ), 
                     'sale_price'=>array('label'=>__('Sale price HT'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_product_item_sale_price_list']])
                                        ), 
                     'unit'=>array('label'=>__('Unit'),
                                               'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_product_item_unit_list']])
                                                  ), 
                     'is_mandatory'=>array('label'=>__('Mandatory ?'),
                                               'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_product_item_is_mandatory_list']])
                                                  ), 
                     'input3'=>array('label'=>__('Thermal resistance'),
                                               'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_product_item_input3_list']])
                                                  ), 
                     'thickness'=>array('label'=>__('Thickness'),
                                               'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_product_item_thickness_list']])
                                                  ), 
                     'description'=>array('label'=>__('Description'),
                                               'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_product_item_description_list']])
                                                   ), 
                      'details'=>array('label'=>__('Acermi'),
                                               'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_product_item_details_list']])
                                                  ), 
                       'is_default'=>array('label'=>__('Default ?'),
                                               'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_product_item_is_default_list']])
                                                  ), 
                       'is_active'=>array('label'=>__('Active ?'),
                                               'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_product_item_is_active_list']])
                                                  ), 
                    
                     'last_password_gen'=>array('label'=>__('Last password generation')), 
                     'has_user_permissions'=>array('label'=>__('Permissions'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_user_permissions']])
                                        ),                                           
                     'manager_id'=>array('label'=>__('Managers/Teams'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_user_list_managers']]),                                     
                                        ), 
                     'status'=>array('label'=>__('Status'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_user_remove']])
                                        ),  
                    );
    }        
    
    function getFilter()
    {
       
        return array(
                     'search'=>array(
                            'product_id'=>array('label'=>__('Product')),                           
 
                               
                      ),
                      'equal'=>array(
                           "is_active"=>array(
                               'label'=>__('Status'),
                               ),
                          
                      ),            
                    );
    }
    
    function process()
    {   
        try
        {
            $this->loadTheme();            
            $this->formFilter= new ProductItemsApiFormFilter($this->getUser());              
            foreach ($this->getHeader() as $field=>$values)
                $this->getWidgets()->pushIf(is_numeric($field)?true:(isset($values[$field]['condition'])?$values[$field]['condition']:true), new mfWidgetFieldApi(is_numeric($field)?$values:$field, is_numeric($field)?array():$values));
             foreach ($this->getFilter() as $field=>$values)
                     $this->getFilterWidgets()->pushIf(is_numeric($field)?true:(isset($values[$field]['condition'])?$values[$field]['condition']:true), new mfWidgetFieldApi(is_numeric($field)?$values:$field, is_numeric($field)?array():$values));
            $this->pager=new ProductItemPager();    
            $this->formFilter->bind($this->getAction()->getRequest()->getPostParameter('filter'));
            if ($this->formFilter->isValid() || $this->getAction()->getRequest()->getPostParameter('filter')==null)
            {        
                // echo $this->formFilter->getQuery()."<br/>";
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUSer()->getCountry());
             //   $this->pager->setParameter('user_id',$this->getUSer()->getGuardUser()->get('id'));
                $this->pager->setPage($this->getAction()->getRequest()->getPostParameter('page'));                    
                $this->pager->execute();                                         
                if (!$this->getWidgets()->isEmpty())
                    $this->data['header']=$this->getWidgets()->toArray();
                
                foreach ($this->pager->getItems() as $item)
                {
                    $this->data['data'][]=$item->toArrayForApi($this->formFilter)->toArray();                                    
                }                  
                $this->data['number_of_items']=array('value'=>$this->pager->getResults(),'text'=>FloatFormatter::getInstance($this->pager->getResults())->getChoices());
                $this->data['schema']=$this->formFilter->getMapping()->getValues()->toArray();
                
                $this->data['schema']['data']=$this->getFilterWidgets()->toArray();
                $this->data['defaults']=$this->formFilter->getDefaults();
                return $this;
            }   
            throw new mfException(__('Filter has some errors.'));
        }
        catch (mfException $e)
        {
         //   var_dump($e->getMessage());
        //    die(__METHOD__);
            $this->data['errors']=$this->formFilter->getErrorSchema()->getErrorsMessage();
        }       
    }
    
  
   

    
   
}

