<?php

class MutualPartnerBase extends Partner {
    
    protected $_params = null;
    
    function getParams()
    {
        if($this->_params==null)
            $this->_params = new MutualPartnerParams(array("financial_partner_id"=>$this->get("id")), $this->getSite());
        return $this->_params;
    }
    
    function setParams($params)
    {
        $this->_params = $params;
        return $this;
    }
    
    public static function getMutualsForSelect()
    {
        $values=new mfArray();
        $db = mfSiteDatabase::getInstance();
        $db->setParameters(array())              
            ->setQuery("SELECT ".MutualPartner::getFieldsAndKeyWithTable()." FROM ".MutualPartner::getTable(). 
                       " ORDER BY ". MutualPartner::getTableField('name')." ASC".
                       ";")               
            ->makeSqlQuery(); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('MutualPartner'))
        {
            $values[$item->get('id')]=$item;
        }    
        return $values;
    }
    
    public static function getProductsWithMutual(CustomerMeeting $meeting,$site=null)
    {
        /*
         *  SELECT * FROM `t_mutual_product` 
            INNER JOIN `t_partners_company` ON `t_partners_company`.id= `t_mutual_product`.financial_partner_id 
            LEFT JOIN `t_customers_meeting_mutual_products` ON `t_mutual_product`.`id`= 
               `t_customers_meeting_mutual_products`.`product_id`
            WHERE `t_customers_meeting_mutual_products`.`meeting_id`='{meeting_id}'
        */
        $values = new MutualPartnerCollection(null, $site);
        $db = mfSiteDatabase::getInstance();
        $db->setObjects(array('MutualProduct','MutualPartner','CustomerMeetingMutualProduct'))              
           ->setParameters(array("meeting_id"=>$meeting->get("id")))              
           ->setQuery("SELECT {fields} FROM ".MutualProduct::getTable(). 
                       " INNER JOIN  ".MutualProduct::getOuterForJoin("financial_partner_id").
                       " LEFT JOIN ".CustomerMeetingMutualProduct::getInnerForJoin("product_id").
                       " WHERE ".CustomerMeetingMutualProduct::getTableField("meeting_id")."='{meeting_id}'".
                       " OR ".CustomerMeetingMutualProduct::getTableField("meeting_id")." IS NULL".
                       " ORDER BY ". MutualProduct::getTableField('name')." ASC".
                       ";")               
            ->makeSqlQuery(); 
        //  echo $db->getQuery();
        if (!$db->getNumRows())
            return $values;
        while ($items=$db->fetchObjects())
        {
            $item = $items->getMutualPartner();
            if(isset($values[$item->get('id')]))
                $item=$values[$item->get('id')];
            if($items->hasCustomerMeetingMutualProduct())
            {
                $selcted_product = $items->getCustomerMeetingMutualProduct();
                $selcted_product->setProduct($items->getMutualProduct());
                $item->addSelectedProduct($selcted_product);
            }
            else
                $item->addProduct($items->getMutualProduct());
            $values[$item->get('id')] = $item;
        }    
        return $values;
    }
    
    public static function getSelectedAndUnselectedProductsWithMutual(CustomerMeeting $meeting,$site=null)
    {
        /*
         *  SELECT * FROM t_mutual_product 
            INNER JOIN t_partners_company ON t_partners_company.id=t_mutual_product.financial_partner_id 
            LEFT JOIN t_customers_meeting_mutual_products ON t_customers_meeting_mutual_products.product_id=t_mutual_product.id 
                AND t_customers_meeting_mutual_products.meeting_id='{meeting_id}' OR t_customers_meeting_mutual_products.meeting_id IS NULL 
            ORDER BY t_mutual_product.name ASC
        */
        $values = new MutualPartnerCollection(null,$site);
        $db = mfSiteDatabase::getInstance() 
           ->setObjects(array('MutualProduct','MutualPartner','CustomerMeetingMutualProduct'))              
           ->setParameters(array("meeting_id"=>$meeting->get("id")))              
           ->setQuery("SELECT {fields} FROM ".MutualProduct::getTable(). 
                       " INNER JOIN  ".MutualProduct::getOuterForJoin("financial_partner_id").
                       " LEFT JOIN ".CustomerMeetingMutualProduct::getInnerForJoin("product_id").
                       " AND (".CustomerMeetingMutualProduct::getTableField("meeting_id")."='{meeting_id}'".
                       " OR ".CustomerMeetingMutualProduct::getTableField("meeting_id")." IS NULL)".
                       " ORDER BY ". MutualProduct::getTableField('name')." ASC".
                       ";")               
            ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($items=$db->fetchObjects())
        {
            $item = $items->getMutualPartner();
            if(isset($values[$item->get('id')]))
                $item=$values[$item->get('id')];
            if($items->hasCustomerMeetingMutualProduct())
            {
                $selcted_product = $items->getCustomerMeetingMutualProduct();
                $selcted_product->setProduct($items->getMutualProduct());
                $item->addSelectedProduct($selcted_product);
            }
            else
            {
                $item->addProduct($items->getMutualProduct());
            }
            $values[$item->get('id')] = $item;
        }    
        return $values;
    }
    
    public static function getProductsWithMutualNoMeeting($site=null)
    {
        /*
         *  SELECT * FROM `t_mutual_product` 
            INNER JOIN `t_partners_company` ON `t_partners_company`.id= `t_mutual_product`.financial_partner_id 
        */
        $values = new MutualPartnerCollection(null, $site);
        $db = mfSiteDatabase::getInstance();
        $db->setObjects(array('MutualProduct','MutualPartner'))                     
           ->setQuery("SELECT {fields} FROM ".MutualProduct::getTable(). 
                       " INNER JOIN  ".MutualProduct::getOuterForJoin("financial_partner_id").
                       " ORDER BY ". MutualProduct::getTableField('name')." ASC".
                       ";")               
            ->makeSqlQuery(); 
        if (!$db->getNumRows())
            return $values;
        while ($items=$db->fetchObjects())
        {
            $item = $items->getMutualPartner();
            if(isset($values[$item->get('id')]))
                $item=$values[$item->get('id')];
            
            $item->addProduct($items->getMutualProduct());
            
            $values[$item->get('id')] = $item;
        }
        return $values;
    }
    
    function addSelectedProduct(CustomerMeetingMutualProduct $product)
    {
        if($this->selected_products===null)
            $this->selected_products=new CustomerMeetingMutualProductCollection(null, $this->getSite());
        if(!isset($this->selected_products[$product->get('id')]))
            $this->selected_products[$product->get('id')] = $product;
    }
    
    function getSelection()
    {
        return $this->selected_products;
    }
    
    function hasSelectedProducts()
    {
        return (boolean)$this->selected_products;
    }
    
    public static function getMutuals($products,$site=null)
    {
        $values=new mfArray();
        $db = mfSiteDatabase::getInstance();
        $db->setParameters(array())              
            ->setQuery("SELECT ".MutualPartner::getFieldsAndKeyWithTable()." FROM ".MutualPartner::getTable(). 
                       " ORDER BY ". MutualPartner::getTableField('name')." ASC".
                       ";")               
            ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('MutualPartner'))
        {
            $values[$item->get('id')]=$item;
        }    
        return $values;
    }
    
    function __toString() {
        return ucfirst($this->get('name'));
    }
    
    function toJsonForSelect()
    {
        $item = new mfArray();
        foreach(array('id','name') as $field)
            $item[$field] = $this->get($field);
        return $item->toJson();
    }
    
    function toArray($fields = array()) {
        return new mfArray(parent::toArray($fields));
    }
    
    function toArray2($fields = array()) {
        $item_array = new mfArray();
        foreach($fields as $field)
            $item_array[$field] = $this->get($field);
        return $item_array;
    }
    
    function addProduct(MutualProduct $product)
    {
        if($this->products===null)
            $this->products = new MutualProductCollection(null,$this->getSite());
        if(!isset($this->products[$product->get('id')]))
            $this->products[$product->get('id')] = $product;
        return $this->products;
    }
    
    function getProducts()
    {
        if($this->products===null)
            $this->products = new MutualProductCollection(null,$this->getSite());
        return $this->products;
    }
    
}
