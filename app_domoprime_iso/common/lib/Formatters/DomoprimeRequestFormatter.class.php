<?php


class DomoprimeRequestFormatter extends mfFormatter {
    
    protected $settings=null;
    
    function __construct($value = null) {
        parent::__construct($value);
        $this->settings=DomoprimeSettings::load($value->getSite());
    }
    
    function getCreatedAt()
    {
        return new DateFormatter($this->getValue()->get('created_at'));
    }
        
    
    function getRevenue()
    {
        return new FloatFormatter($this->getValue()->get('revenue'));
    }
    
    function getNumberOfFiscal()
    {
        return new FloatFormatter($this->getValue()->get('number_of_fiscal'));
    }
    
    function getNumberOfPeople()
    {
        return new FloatFormatter($this->getValue()->get('number_of_people'));
    }
    
     function getNumberOfParts()
    {
        return new FloatFormatter($this->getValue()->get('number_of_parts'));
    }
    
    function getSurfaceWall()
    {
        return new FloatFormatter($this->getValue()->get('surface_wall'));
    }
    
    function getSurfaceTop()
    {
        return new FloatFormatter($this->getValue()->get('surface_top'));
    }
    
    function getSurfaceFloor()
    {
        return new FloatFormatter($this->getValue()->get('surface_floor'));
    }
    
    function getInstallSurfaceWall()
    {
        return new FloatFormatter($this->getValue()->get('install_surface_wall'));
    }
    
    function getInstallSurfaceTop()
    {
        return new FloatFormatter($this->getValue()->get('install_surface_top'));
    }
    
    function getInstallSurfaceFloor()
    {
        return new FloatFormatter($this->getValue()->get('install_surface_floor'));
    }
    
    function getParcelSurface()
    {
        return new FloatFormatter($this->getValue()->get('parcel_surface'));
    }
    
    function getParcelNumber()
    {
        return $this->getValue()->get('parcel_number');
    }
    
     function getParcelReference()
    {
        return $this->getValue()->get('parcel_reference');
    }
    
    function getNumberOfChildren()
    {
        return new FloatFormatter($this->getValue()->get('number_of_children'));
    }
       
     function getITESurface()
    {
        return new FloatFormatter($this->getValue()->get('surface_ite'));
    }
    
     function getBoilerQuantity()
    {
        return new FloatFormatter($this->getValue()->get('boiler_quantity'));
    }
    
     function getPackQuantity()
    {
        return new FloatFormatter($this->getValue()->get('pack_quantity'));
    }
    
     function getSurfaceHome()
    {
        return new FloatFormatter($this->getValue()->get('surface_home'));
    }
    
    
     function getCEF()
    {
        return  new FloatFormatter($this->getValue()->getCEF());
    }
        
    function getCEFProject()
    {
      return  new FloatFormatter($this->getValue()->getCEFProject());
    }
    
    function getCEP()
    {
        return  new FloatFormatter($this->getValue()->getCEP());
    }
    
    
    function getCEPProject()
    {
         return  new FloatFormatter($this->getValue()->getCEPProject());
    }
    
    function getPowerConsumption()
    {
       return  new FloatFormatter($this->getValue()->getPowerConsumption());
    }
    
    function getEconomy()
    {
          return  new FloatFormatter($this->getValue()->getEconomy());  
    }
    
    function getCefMinusCefProject()
    {
          return  new FloatFormatter($this->getValue()->getCefMinusCefProject());
    }
}
