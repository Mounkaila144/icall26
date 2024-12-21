{messages class="errors"}
 <style>.ui-dialog { font-size: 62.5%; }</style> 
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter}
<button id="filter">{__("Filter")}</button>   <button id="init">{__("Init")}</button>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if} 
        <th>{__('name')}
            <div>
                <a href="#" class="order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a> 
            </div> 
        </th>
         <th>{__('size')}
            <div>
                <a href="#" class="order{$formFilter.order.size->getValueExist('asc','_active')}" id="asc" name="size"><img  src='{url("/icons/sort_asc`$formFilter.order.size->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="order{$formFilter.order.size->getValueExist('desc','_active')}" id="desc" name="size"><img  src='{url("/icons/sort_desc`$formFilter.order.size->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a> 
            </div> 
        </th>
        <th>{__('date')}
            <div>
                <a href="#" class="order{$formFilter.order.time->getValueExist('asc','_active')}" id="asc" name="time"><img  src='{url("/icons/sort_asc`$formFilter.order.time->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="order{$formFilter.order.time->getValueExist('desc','_active')}" id="desc" name="time"><img  src='{url("/icons/sort_desc`$formFilter.order.time->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a> 
            </div> 
        </th>       
        <tr>
            <td></td>
            {if $pager->getNbItems()>5}<td></td>{/if}
            <td><input class="search" type="text" size="5" name="name" value="{$formFilter.search.name}"></td>
            <td></td>
            <td>
               <div>
                   {__('from')}<input class="range" id="time_from" type="text" size="10" name="time[from]" value="{format_date((string)$formFilter.range.time.from|default:$formFilter->getFileTimeMin(),'a')}"/>
                   {__('to')}<input  class="range" id="time_to" type="text" size="10" name="time[to]" value="{format_date((string)$formFilter.range.time.to|default:$formFilter->getFileTimeMax(),'a')}"/>
               </div>
           </td>
        </tr>       
    {foreach $pager as $file}
    <tr class="dialogFileManagerFtpForImport" id="{$file->getName()}">
        <td class="import-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$file@iteration}</td>        
        <td>
            {$file->get('name')|escape}
        </td>
        <td>
            {format_size($file->getSize())}
        </td>
        <td>
            {format_date($file->getTime(),'a')}
        </td>       
    </tr>
    {/foreach}
</table>
{if !$pager->getNbItems()}  
    {__("no result")}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager}
<script type="text/javascript">
    
        $("#dialogFileManagerFtpForImport").data('pager',[{foreach $pager as $item} { name:"{$item->getName('zip')}" },{/foreach}]);   
        
        $("#dialogFileManagerFtpForImport").data('selected',"{(string)$formFilter.selected}");   
                
        function getImportArchiveFilesFilterParameters()
        {
            params={ filter: {  order : { }, 
                                     search: { 
                                               name : $("[name='name']").val(),
                                             }, 
                                     nbitemsbypage: $("[name=nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".order_active").attr("name")] =$(".order_active").attr("id");
            $(".search").each(function(id) { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updateImportArchiveFilesFilter()
        {
          // return $.ajax2({ data: getImportArchiveFilesFilterParameters(), url:"{url('/module/log/List')}" , target: "#middle" });
        }
        
        function updatePager(n)
        {
           page_active=$(".pager .active").html()?parseInt($(".pager .active").html()):1;
           records_by_page=$("[name=nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".imports-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#nb_results").html())-n;
           $("#nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#end_result").html($(".imports-count:last").html());
        }
        
     {JqueryScriptsReady}    
        var dates = $( "#time_from, #time_to" ).datepicker({
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
         $('.order').click(function() {
                $(".order_active").attr('class','order');
                $(this).attr('class','order_active');
                return updateImportArchiveFilesFilter();
         });
            
         $("[name=nbitemsbypage]").change(function() {  return updateImportArchiveFilesFilter();  }); 

        $(".search").keypress(function(event) {
            if (event.keyCode==13)
               return updateImportArchiveFilesFilter();
        });

     //   $("#init").click(function() { $.ajax2({ url: "{url('/module/log/List')}", target : "#middle"}); }); 
      
     //   $("#filter").click(function() { return updateImportArchiveFilesFilter(); }); 
            
        $(".pager").click(function () {
          //   return $.ajax2({ data: getImportArchiveFilesFilterParameters(), url:"{url('module/log/List?')}"+this.href.substring(this.href.indexOf("?")+1, this.href.length) , target: "#middle" });
        });  
        
        // {* PAGER - end *}   

       $(".dialogFileManagerFtpForImport").click(function () { 
            $(".dialogFileManagerFtpForImport").removeClass('selected');
            $(this).addClass('selected');
            $("#dialogFileManagerFtpForImport").data('selected',$(this).attr('id'));
            index=$(".dialogFileManagerFtpForImport.selected").index()-2;  {* 2 : number of <tr> before *}            
            $("#dialogFileManagerFtpForImport").data('object',$("#dialogFileManagerFtpForImport").data('pager')[index]);
        });
      {/JqueryScriptsReady} 
   
       
</script>