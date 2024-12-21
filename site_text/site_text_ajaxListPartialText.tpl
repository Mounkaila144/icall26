{messages class="site-errors"}
<h3>{__('Texts')}</h3>    
<div>
  <a href="#" class="btn" id="SiteText-New" title="{__('New text')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New text')}</a>   
  <a href="#" class="btn" id="SiteText-Import" title="{__('Import')}" ><i class="fa fa-upload" style="margin-right:10px;"></i>{__('Import')}</a>  
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="SiteText"}
<button id="SiteText-filter" class="btn-table" >{__("Filter")}</button>   <button id="SiteText-init" class="btn-table">{__("Init")}</button> 

<div class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th> 
    {if $user->hasCredential([['superadmin','settings_texts_list_display_module']])} 
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Module')}</span>    
            <div>
                <a href="#" class="Text-order{$formFilter.order.module->getValueExist('asc','_active')}" id="asc" name="module"><img  src='{url("/icons/sort_asc`$formFilter.order.module->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Text-order{$formFilter.order.module->getValueExist('desc','_active')}" id="desc" name="module"><img  src='{url("/icons/sort_desc`$formFilter.order.module->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>  
    {/if} 
    {if $user->hasCredential([['superadmin','settings_texts_list_display_key']])} 
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Key')}</span>      
            <div>
                <a href="#" class="Text-order{$formFilter.order.key->getValueExist('asc','_active')}" id="asc" name="key"><img  src='{url("/icons/sort_asc`$formFilter.order.key->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Text-order{$formFilter.order.key->getValueExist('desc','_active')}" id="desc" name="key"><img  src='{url("/icons/sort_desc`$formFilter.order.key->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
    {/if}
    <th data-hide="phone" style="display: table-cell;">
        <span>{__('Value')}</span>      
        <div>
            <a href="#" class="Text-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
            <a href="#" class="Text-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
        </div>
    </th>         
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>
     {*  {if $pager->getNbItems()>5}<td></td>{/if} *}
     {*  <td>{* id *} {* </td> *}
       {if $user->hasCredential([['superadmin','settings_texts_list_display_module']])}
            <td>{* module *}
                <input class="SiteText-search inputWidth form-control" placeholder="{__('module')}" type="text" size="8" name="module" value="{$formFilter.search.module}">
            </td>     
       {/if}
       {if $user->hasCredential([['superadmin','settings_texts_list_display_key']])} 
            <td>{* key *}
                <input class="SiteText-search inputWidth form-control" placeholder="{__('key')}" type="text" size="8" name="key" value="{$formFilter.search.key}">
            </td>
       {/if}
       <td>{* value *}
           <input class="SiteText-search inputWidth form-control" placeholder="{__('value')}" type="text" size="8" name="value" value="{$formFilter.search.value}">
       </td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="SiteText list" id="{$item->get('id')}"> 
        <td class="SiteText-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>  
        {if $user->hasCredential([['superadmin','settings_texts_list_display_module']])}
            <td>                
                    {$item->get('module')|escape}
            </td> 
        {/if}
        {if $user->hasCredential([['superadmin','settings_texts_list_display_key']])}
            <td>     {$item->get('key')|escape} 
            </td>
        {/if}
            <td>
                   {$item->get('value')|escape} 
            </td>            
            <td>
                    <a href="#" title="{__('Edit')}" class="SiteText-View" id="{$item->get('id')}">
                         <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>
                    <a href="#" title="{__('Delete')}" class="SiteText-Delete" id="{$item->get('id')}"  name="{$item->get('key')}">
                       <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
                    </a> 
            </td>
    </tr>    
    {/foreach}    
</table>
</div>    
{if !$pager->getNbItems()}
     <span>{__('No text')}</span>
{else}
  
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="SiteText"}
<script type="text/javascript">
 
        function getSiteTextFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: {  },                                                                                                                                    
                                nbitemsbypage: $("[name=SiteText-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".SiteText-order_active").attr("name"))
                 params.filter.order[$(".Text-order_active").attr("name")] =$(".Text-order_active").attr("id");   
            $(".SiteText-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteTextFilter()
        {          
           return $.ajax2({ data: getSiteTextFilterParameters(), 
                            url:"{url_to('site_text_ajax',['action'=>'ListPartialText'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSiteTextPager(n)
        {
           page_active=$(".SiteText-pager .SiteText-active").html()?parseInt($(".SiteText-pager .SiteText-active").html()):1;
           records_by_page=$("[name=SiteText-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".SiteText-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#SiteText-nb_results").html())-n;
           $("#SiteText-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#SiteText-end_result").html($(".SiteText-count:last").html());
        }
        
           
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#SiteText-init").click(function() {               
               $.ajax2({ url:"{url_to('site_text_ajax',['action'=>'ListPartialText'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.SiteText-order').click(function() {
                $(".SiteText-order_active").attr('class','SiteText-order');
                $(this).attr('class','SiteText-order_active');
                return updateSiteTextFilter();
           });
           
            $(".SiteText-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteTextFilter();
            });
            
          $("#SiteText-filter").click(function() { return updateSiteTextFilter(); }); 
          
          $("[name=SiteText-nbitemsbypage]").change(function() { return updateSiteTextFilter(); }); 
          
            
           $(".SiteText-pager").click(function () {                    
                return $.ajax2({ data: getSiteTextFilterParameters(), 
                                 url:"{url_to('site_text_ajax',['action'=>'ListPartialText'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#SiteText-New").click( function () {         
            return $.ajax2({                           
                url: "{url_to('site_text_ajax',['action'=>'NewText'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
          $("#SiteText-Import").click( function () {         
            return $.ajax2({                           
                url: "{url_to('site_text_ajax',['action'=>'ImportText'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".SiteText-View").click( function () {                  
                return $.ajax2({ data : { SiteText : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('site_text_ajax',['action'=>'ViewText'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".SiteText-Delete").click( function () { 
                if (!confirm('{__("Text \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ SiteText: $(this).attr('id') },
                                 url :"{url_to('site_text_ajax',['action'=>'DeleteText'])}",
                                 errorTarget: "site-errors",     
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteText')
                                       {    
                                          $(".SiteText.list[id="+resp.id+"]").remove();  
                                          if ($('.SiteText.list').length==0)
                                              return  updateSiteTextFilter();
                                          updateSiteTextPager(1);
                                        }       
                                 }
                     });                                        
            });
            

         
  {* $('.footable').footable(); *}
	
</script>    
