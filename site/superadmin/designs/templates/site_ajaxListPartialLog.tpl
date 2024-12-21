{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__("logs")}</h3>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-log"}
<button id="{$site->getSiteID()}-log-filter">{__("Filter")}</button>   <button id="{$site->getSiteID()}-log-init">{__("Init")}</button>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if} 
        <th>{__('name')}
            <div>
                <a href="#" class="{$site->getSiteID()}-log-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-log-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a> 
            </div> 
        </th>
         <th>{__('size')}
            <div>
                <a href="#" class="{$site->getSiteID()}-log-order{$formFilter.order.size->getValueExist('asc','_active')}" id="asc" name="size"><img  src='{url("/icons/sort_asc`$formFilter.order.size->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-log-order{$formFilter.order.size->getValueExist('desc','_active')}" id="desc" name="size"><img  src='{url("/icons/sort_desc`$formFilter.order.size->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a> 
            </div> 
        </th>
        <th>{__('date')}
            <div>
                <a href="#" class="{$site->getSiteID()}-log-order{$formFilter.order.time->getValueExist('asc','_active')}" id="asc" name="time"><img  src='{url("/icons/sort_asc`$formFilter.order.time->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-log-order{$formFilter.order.time->getValueExist('desc','_active')}" id="desc" name="time"><img  src='{url("/icons/sort_desc`$formFilter.order.time->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a> 
            </div> 
        </th>
        <th>{__('actions')}</th>
        <tr>
            <td></td>
            {if $pager->getNbItems()>5}<td></td>{/if}
            <td><input class="{$site->getSiteID()}-log-search" type="text" size="5" name="name" value="{$formFilter.search.name}"></td>
            <td></td>
            <td>
               <div>
                   {__('from')}<input class="{$site->getSiteID()}-log-range" id="time_from" type="text" size="10" name="time[from]" value="{format_date((string)$formFilter.range.time.from|default:$formFilter->getFileTimeMin(),'a')}"/>
                   {__('to')}<input  class="{$site->getSiteID()}-log-range" id="time_to" type="text" size="10" name="time[to]" value="{format_date((string)$formFilter.range.time.to|default:$formFilter->getFileTimeMax(),'a')}"/>
               </div>
           </td>
        </tr>       
    {foreach $pager as $log}
    <tr class="{$site->getSiteID()}-log" id="{$site->getSiteID()}-log-{$log->getName('log')}">
        <td class="{$site->getSiteID()}-log-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$log@iteration}</td>
        {if $pager->getNbItems()>5}
            <td>  
               <input class="{$site->getSiteID()}-log-selection" type="checkbox" id="{$log->getName('log')}"/>
            </td>
        {/if}
        <td>
            {$log->get('name')|escape}
        </td>
        <td>
            {format_size($log->getSize())}
        </td>
        <td>
            {format_date($log->getTime(),'a')}
        </td>
        <td>
            <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-log-View" id="{$log->getName('log')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
            <a href="#" title="{__('delete')}" class="{$site->getSiteID()}-log-Delete" id="{$log->getName('log')}" name="{$log->get('name')}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a> 
        </td>
    </tr>
    {/foreach}
</table>
{if !$pager->getNbItems()}  
    {__("no result")}
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="{$site->getSiteID()}-log-all" />  
        <a href="#" title="{__('delete')}" id="{$site->getSiteID()}-log-Delete" style="opacity:0.5" class="{$site->getSiteID()}-log-actions_items"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-log"}

<script type="text/javascript">
    
        function get{$site->getSiteKey()}LogFilterParameters()
        {
            params={ filter: {  order : { }, 
                                     search: { 
                                               name : $("[name={$site->getSiteID()}-log-name]").val(),
                                             }, 
                                     nbitemsbypage: $("[name={$site->getSiteID()}-log-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".{$site->getSiteID()}-log-order_active").attr("name")] =$(".{$site->getSiteID()}-log-order_active").attr("id");
            $(".{$site->getSiteID()}-log-search").each(function() { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function update{$site->getSiteKey()}LogFilter()
        {
           return $.ajax2({ data: get{$site->getSiteKey()}LogFilterParameters(), 
                            url:"{url_to('site_ajax',['action'=>'ListPartialLog'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions" });
        }
        
        function update{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-log-pager .{$site->getSiteID()}-log-active").html()?parseInt($(".{$site->getSiteID()}-log-pager .{$site->getSiteID()}-log-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-log-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-log-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-log-nb_results").html())-n;
           $("#{$site->getSiteID()}-log-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-log-end_result").html($(".{$site->getSiteID()}-log-count:last").html());
        }
        
        
        var dates = $( ".{$site->getSiteID()}-log-range#time_from, .{$site->getSiteID()}-log-range#time_to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "time_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
        // {* PAGER - begin *}
         $('.{$site->getSiteID()}-log-order').click(function() {
                $(".{$site->getSiteID()}-log-order_active").attr('class','{$site->getSiteID()}-log-order');
                $(this).attr('class','{$site->getSiteID()}-log-order_active');
                return update{$site->getSiteKey()}LogFilter();
         });
            
         $("[name={$site->getSiteID()}-log-nbitemsbypage]").change(function() {  return update{$site->getSiteKey()}LogFilter();  }); 

        $(".{$site->getSiteID()}-log-search").keypress(function(event) {
            if (event.keyCode==13)
               return update{$site->getSiteKey()}LogFilter();
        });

        $("#{$site->getSiteID()}-log-init").click(function() { $.ajax2({ 
                            url: "{url_to('site_ajax',['action'=>'ListPartialLog'])}", 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"}); 
        }); 

        $("#{$site->getSiteID()}-log-all").click(function () {  $(".selection").attr("checked",($(this).attr("checked")=="checked"));  });

        $("#{$site->getSiteID()}-log-filter").click(function() { return update{$site->getSiteKey()}LogFilter(); }); 
            
        $(".{$site->getSiteID()}-log-pager").click(function () {
             return $.ajax2({   data: get{$site->getSiteKey()}LogFilterParameters(), 
                                url:"{url_to('site_ajax',['action'=>'ListPartialLog'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length) , 
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                target: "#{$site->getSiteID()}-actions" });
        });  
        
        // {* PAGER - end *}   

        // {* ACTIONS - begin *} 
            
        $('.{$site->getSiteID()}-log-View').click(function(){
          $.ajax2( { data : { name: $(this).attr('id') } , 
                     url:"{url_to('site_ajax',['action'=>'ViewLog'])}",
                     errorTarget: ".{$site->getSiteID()}-site-errors",
                     loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                     target: "#{$site->getSiteID()}-actions" });
        });
        
        $('.{$site->getSiteID()}-log-Delete').click(function(){
          if (!confirm("{__('Log file [#0#.log] will be deleted. Confirm ?')}".format(this.id))) 
                return false; 
          return $.ajax2({ data : { name: this.id } ,
                    url: "{url_to('site_ajax',['action'=>'DeleteLog'])}",
                    errorTarget: ".{$site->getSiteID()}-site-errors",
                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                          
                    success :function(resp) { 
                                if (resp.action=="deleteLog" && resp.id)
                                {    
                                    $("#{$site->getSiteID()}-log-"+resp.id).remove();
                                    update{$site->getSiteKey()}Pager(1); 
                                }    
                    }
                  }); 
        });
        
        $("#{$site->getSiteID()}-Delete").click( function () { 
                 var params={ selection : {  } };
                 text="";
                 $(".selection:checked").each(function (id) { 
                    params.selection[id]=this.id;
                    text+=this.id+",\n";
                 });
                 if ($.isEmptyObject(params.selection))
                    return ;
                 if (!confirm("{__('logs :\u000A\u000A\"#0#\"\u000A\u000A will be deleted. Confirm ?')}".format(text.substring(0,text.lastIndexOf(","))))) 
                     return false; 
                 return $.ajax2({ data: params,
                                  url : "{url_to('site_ajax',['action'=>'DeletesLog'])}",
                                  errorTarget: ".{$site->getSiteID()}-site-errors",
                                  loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                          
                                  success: function(resp) {
                                    if (resp.action=='deleteLogs')
                                    {                                    
                                        if ($(".{$site->getSiteID()}-log").length-resp.selection.length==0)
                                           return update{$site->getSiteKey()}LogFilter();
                                        $.each(resp.selection, function () {  $("tr#log-"+this).remove(); });   
                                        update{$site->getSiteKey()}Pager(resp.selection.length); 
                                        $("input#{$site->getSiteID()}-all").attr("checked",false);           
                                    }       
                                  }
                 });    
                 return false;
            });
            
            $(".{$site->getSiteID()}-selection,#{$site->getSiteID()}-all").click(function (){               
                $(".{$site->getSiteID()}-actions_items").css('opacity',($(".{$site->getSiteID()}-selection:checked").length?'1':'0.5'));
            });
   
    
</script>