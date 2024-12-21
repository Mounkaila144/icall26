<?php

	
class PdfToTextCoordinate {
    
    protected $x=0,$y=0,$k=0,$width=0,$height=0,$page_dim=null,$page=1;
    
    protected $coordinates_mm = null;
    
    protected $coordinates_pt = null;
    
    
    function __construct($x,$y,$k,$width,$height,$page_dim,$page) {
        $this->x = $x;
        $this->y = $y;
        $this->k = $k;
        $this->width = $width;
        $this->height = $height;
        $this->page_dim = $page_dim;
        $this->page = $page;
        $this->calculateCordinates();
    }
    
    public function getCoordinatesInMM()
    {
        return $this->coordinates_mm;
    }
    
    public function setCoordinatesInMM($coordinate)
    {
        $this->coordinates_mm = $coordinate;
        return $this;
    }
    
    
    public function getCoordinatesInPt()
    {
        return $this->coordinates_pt;
    }
    
    public function setCoordinatesInPt($coordinate)
    {
        $this->coordinates_pt = $coordinate;
        return $this;
    }
    
    public function calculateCordinates()
    {
        $x1_pt = $this->x*$this->k;
        $y1_pt = $this->page_dim['h']-($this->y*$this->k);
        $x2_pt = ($this->x+$this->width)*$this->k;
        $y2_pt = $this->page_dim['h']-(($this->y+$this->height)*$this->k);
        $this->setCoordinatesInPt(new PdfToTextSubCoordinates(array(
            "x1" => intval(round($x1_pt,0 , PHP_ROUND_HALF_UP)),
            "y1" => intval(round($y1_pt,0 , PHP_ROUND_HALF_UP)),
            "x2" => intval(round($x2_pt,0 , PHP_ROUND_HALF_UP)),
            "y2" => intval(round($y2_pt,0 , PHP_ROUND_HALF_UP)),
        )));
        $this->setCoordinatesInMM(new PdfToTextSubCoordinates(array(
            "x1" => $this->x,
            "y1" => ($this->page_dim['hk']-$this->y),
            "x2" => ($this->x+$this->width),
            "y2" => ($this->page_dim['hk']-($this->y+$this->height)),
        )));   
    }
    
    public function getPage()
    {
        return $this->page;
    }
}
