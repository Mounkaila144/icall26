<?php

class DomoprimeQmacCollection extends mfArray  {
     
     function hasFloor()
     {
         return isset($this->collection['floor']);
     }
     
     function getFloor($default=0.0)
     {
          return new FloatFormatter(isset($this->collection['floor'])?$this->collection['floor']:$default);
     }
         
    
     function getWall($default=0.0)
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
     
     function getTop($default=0.0)
     {
          return new FloatFormatter(isset($this->collection['top'])?$this->collection['top']:$default);
     }
     
}
