<?php

class DomoprimeSurfaceCollection extends mfArray  {
     
     function hasSurfaceFloor()
     {
         return isset($this->collection['surface_floor']);
     }
     
     function getSurfaceFloor($default=0.0)
     {
          return new FloatFormatter(isset($this->collection['surface_floor'])?$this->collection['surface_floor']:$default);
     }
         
    
     function getSurfaceWall($default=0.0)
     {
         return new FloatFormatter(isset($this->collection['surface_wall'])?$this->collection['surface_wall']:$default);      
     }
     
     function hasSurfaceWall()
     {
          return isset($this->collection['surface_wall']);
     }
     
     function hasSurfaceTop()
     {
          return isset($this->collection['surface_top']);
     }
     
     function getSurfaceTop($default=0.0)
     {
          return new FloatFormatter(isset($this->collection['surface_top'])?$this->collection['surface_top']:$default);
     }
     
}
