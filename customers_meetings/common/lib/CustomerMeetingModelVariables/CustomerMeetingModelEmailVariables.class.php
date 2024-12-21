<?php


class CustomerMeetingModelEmailVariables extends UtilsModelVariables {
    
    function configure($dictionnary='dictionary')
    {
       $this->variables= array(
           'meeting.remarks'=>__('remarks','',$dictionnary),
           'meeting.see_with'=>__('see with','',$dictionnary),             
         //  'meeting.in_at'=>__('date','',$dictionnary),          
           'meeting.state'=>__('state','',$dictionnary),        
           'meeting.sale_1'=>__('sale 1','',$dictionnary),
           'meeting.sale_2'=>__('sale 2','',$dictionnary),
           'meeting.telepro'=>__('telepro','',$dictionnary),                              
           'meeting.is_confirmed'=>__('confirmed','',$dictionnary),
         //  'meeting.created_at'=>__('creation date','',$dictionnary),
         //  'meeting.updated_at'=>__('update date','',$dictionnary),
           'meeting.products'=>__('proposed products','',$dictionnary),
           'meeting.created_at.ddmmyyyy'=>__('creation date DD/MM/YYYY','',$dictionnary),  
           // 'meeting.created_at.ddmmyy'=>__('creation date DD/MM/YY','',$dictionnary),
           'meeting.updated_at.ddmmyyyy'=>__('update date DD/MM/YYYY','',$dictionnary),  
          //  'meeting.updated_at.ddmmyy'=>__('update date DD/MM/YY','',$dictionnary),     
           'meeting.in_at.ddmmyyyy'=>__('date DD/MM/YYYY','',$dictionnary),           
           'meeting.in_at.time'=>__('time','',$dictionnary),  
           'meeting.teams'=>__('teams','',$dictionnary),  
          //  'meeting.updated_at.ddmmyy'=>__('update date DD/MM/YY','',$dictionnary),  
        );   
    }
    
   
    
  
         
}


