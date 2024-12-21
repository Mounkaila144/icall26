{component name="/site/sublink"} 
{messages class="SystemTab-errors"}
<h3>{__("Tabs")}</h3>

<div>
    <a href="#" id="SystemTab-RemoveCacheTab" class="btn">{__('Remove Cache')}</a> 

    <a href="#" id="SystemTab-Save" class="btn" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
</div>
<table class="table-bordered table" style="width: 50%;" id="SystemTab" cellpadding="0" cellspacing="0" >
         <thead>
             <tr class="list-header" style="text-align: center;">                  
                    <th>{__('Position')}</th>
                    <th>{__('Tab')}</th>
                </tr>
            </thead>
            <tbody style="cursor: grab;">
        {foreach $tabs as $tab}
           <tr id="{$tab->get('id')}" class="ui-function-default SystemTab">
                <td class="position">{$tab@iteration}</td>
                <td>
                   {$tab->getI18n()} 
                </td>
            </tr>       
        {/foreach} 
                            </tbody>
    </table>
<script type="text/javascript">
        
    $('#SystemTab-RemoveCacheTab').click(function(){
        //      alert("Params="+params.toSource());   return ;         
          return $.ajax2({                             
                           url: "{url_to('dashboard_ajax',['action'=>'RemoveCacheTab'])}",
                           errorTarget: ".SystemTab-errors",                            
                           success:function(resp){
                           }
                          }); 
    });
    
    $("#SystemTab tbody").sortable({
        cursor: 'grabbing',     
        stop: function (event, ui) {
            $(".position").each(function (id) { $(this).html(id + 1); }); 
            $("#SystemTab-Save").show();
        }
    });
    
    
   

    $('#SystemTab-Save').click(function(){                             
            var  params= {       
                                TabPositions: {    
                                   positions : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };                            
          $(".SystemTab").each(function() {  params.TabPositions.positions.push($(this).attr('id'));  });                    
          return $.ajax2({ data : params,                            
                           errorTarget: ".SystemTab-errors",
                           url : "{url_to('dashboard_ajax',['action'=>'PositionTab'])}",
                           target: "#tab-dashboard-x-settings" }); 
    }); 
     
</script>
    


