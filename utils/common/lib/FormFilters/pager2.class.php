<?php


class pager2 extends pagerBase{
    
    function __construct($class, $nb_items_by_page = 10) {
        parent::__construct($class, $nb_items_by_page);
    }


    protected function getCountQuery()
    {
        if ($this->query_for_count)
         return $this->query_for_count;     
     //  keep only select (*) from .... (remove order,...)       
     if (preg_match("#^SELECT(.*) GROUP BY (.*) (ORDER BY(.*))?$#si",$this->query,$matches))
     {   // Remove group by            
         $query= preg_replace("/^SELECT(.*)FROM/is","SELECT count(distinct(".$matches[2].")) as count FROM ","SELECT ".$matches[1].";");                    
         return $query;
     }      
     // Case of GROUP BY as no ORDER
     if (preg_match("#^SELECT(.*) GROUP BY (.*);$#si",$this->query,$matches))
     {         
         $query= preg_replace("/^SELECT(.*)FROM/is","SELECT count(distinct(".$matches[2].")) as count FROM ","SELECT ".$matches[1].";");                    
         return $query;         
     } 

     if (preg_match("#^SELECT(.*)(,\(SELECT(.*) FROM (.*))? FROM(.*)$#si",$this->query,$matches))
     {             
         $query=$this->query
                 ->select()
                 ->from($matches[5]);    
     }        
     else
     {       
        $query=$this->query;  
     }               
 //       echo "Query=".$query."<br/>";
     $query= preg_replace("/ORDER BY(.*)/i",";", $query);      
     $query= strtr($query,array("{fields}"=>"*","{fields},"=>""));   
       // CHECK IF SUB QUERY IN WHERE CLAUSE EXISTS  
     if (preg_match("#^SELECT (.*) FROM (.*) (FROM(.*))?;$#si",$query,$matches))   // CHECK IF SUB QUERY IN WHERE CLAUSE EXISTS  
     {                    
            //$query="SELECT count(*) as count FROM ".$matches[2].$matches[3].";";
            $query= $this->query
                    ->select("count(*) as count")
                    ->from($matches[2].$matches[3]);
     } 
     elseif (preg_match("#^SELECT (.*) FROM(.*);$#si",$query,$matches)) // Case 2
     {       
         $query= $this->query
                    ->select("count(*) as count")
                    ->from($matches[2]);
             //$query="SELECT count(*) as count FROM ".$matches[2].";";   
     }       

     return $query; 
    }
    
}
