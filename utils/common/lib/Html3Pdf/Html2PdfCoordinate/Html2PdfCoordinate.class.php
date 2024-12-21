<?php

	
class Html2PdfCoordinate {
    
    protected $x=0,$y=0,$k=0,$width=0,$height=0,$page_dim=null,$mm = null,$pt = null,$page=1;
    
    
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
    
    public function getInMM()
    {
        return $this->mm;
    }
    
    public function setInMM($coordinate)
    {
        $this->mm = $coordinate;
        return $this;
    }
    
    
    public function getInPt()
    {
        return $this->pt;
    }
    
    public function setInPt($coordinate)
    {
        $this->pt = $coordinate;
        return $this;
    }
    
    public function calculateCordinates()
    {
        $x1_pt = $this->x*$this->k;
        $y1_pt = $this->page_dim['h']-($this->y*$this->k);
        $x2_pt = ($this->x+$this->width)*$this->k;
        $y2_pt = $this->page_dim['h']-(($this->y+$this->height)*$this->k);
        $this->setInPt(new Html2PdfRectangle(array(
            "x1" => intval(round($x1_pt ,0 , PHP_ROUND_HALF_UP)),
            "y1" => intval(round($y1_pt,0 , PHP_ROUND_HALF_UP)),
            "x2" => intval(round($x2_pt,0 , PHP_ROUND_HALF_UP)),
            "y2" => intval(round($y2_pt,0 , PHP_ROUND_HALF_UP)),
        )));
        $this->setInMM(new Html2PdfRectangle(array(
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
    
    
    function getCoordinatesAndPage()
    {
        return $this->getInPt()->sortForPdf()->implode()."|".$this->getPage();
    }
}
