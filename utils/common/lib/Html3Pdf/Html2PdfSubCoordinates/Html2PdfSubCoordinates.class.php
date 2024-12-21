<?php

	
class Html2PdfSubCoordinates extends mfArray {
    
    
    public function sortForPdf()
    {
        return new mfArray(array(
            "x1"=> $this->collection["x1"],
            "y2"=> $this->collection["y2"],
            "x2"=> $this->collection["x2"],
            "y1"=> $this->collection["y1"],
        ));
    }
}
