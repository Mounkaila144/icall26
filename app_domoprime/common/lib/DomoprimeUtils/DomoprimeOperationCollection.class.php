<?php

class DomoprimeOperationCollection extends mfArray  {
     
     function hasFloor()
     {
         return isset($this->collection['floor']);
     }
     
     function getTotalFloor($default=0.0)
     {
          return new FloatFormatter(isset($this->collection['floor'])?$this->collection['floor']:$default);
     }
         
    
     function getTotalWall($default=0.0)
     {
         return new FloatFormatter(isset($this->collection['wall'])?$this->collection['wall']:$default);      
     }
     
     function hasWall()
     {
          return isset($this->collection['wall']);
     }
     
     function hasTop()
     {
          return isset($this->collection['top']);
     }
     
     function getTotalTop($default=0.0)
     {
          return new FloatFormatter(isset($this->collection['top'])?$this->collection['top']:$default);
     }
     
     
     function getTotal()
     {
         return new FloatFormatter($this->collection['top'] + $this->collection['floor'] + $this->collection['wall']);
     }
     
     function hasBoiler()
     {
          return isset($this->collection['boiler']);
     }
     
     function getTotalBoiler()
     {
         return new FloatFormatter(isset($this->collection['boiler'])?$this->collection['boiler']:$default);       
     }
     
     function hasITE()
     {
          return isset($this->collection['ite']);
     }
     
     function getTotalITE()
     {
         return new FloatFormatter(isset($this->collection['ite'])?$this->collection['ite']:$default);       
     }
     
     function hasPack()
     {
          return isset($this->collection['pac']);
     }
     
     function getTotalPack()
     {
         return new FloatFormatter(isset($this->collection['pac'])?$this->collection['pac']:$default);       
     }
}
