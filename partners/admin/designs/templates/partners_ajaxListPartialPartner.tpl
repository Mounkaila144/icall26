{messages class="site-errors"}
<h3>{__('Partner')}</h3>    
<div>
  <a href="#" class="btn" id="Partner-New" title="{__('new partner')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{*<img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>*}{__('New partner')}</a>   

</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="Partner"}
<button id="Partner-filter" class="btn-table">{__("Filter")}</button> 
<button id="Partner-init" class="btn-table">{__("Init")}</button>
 <table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
     <thead> 
     <tr class="list-header">    
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="Partner-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Partner-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th class="footable-first-column" data-toggle="true">
            <span>{__('name')|capitalize}</span>    
            <div>
                <a href="#" class="Partner-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Partner-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('post code')|capitalize}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('city')|capitalize}</span>  

        </th>
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('phone')|capitalize}</span>                 
        </th>  
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('state')|capitalize}</span>          
        </th>
        <th data-hide="phone" style="display: table-cell;">{__('actions')|capitalize}</th>
    </tr>
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
       <td>{* id *}</td>
       <td>{* name *}</td>
       <td>{* post code *}</td>
       <td>{* city *}</td>
       <td>{* phone *}</td> 
        <td>{* is_active *}</td> 
       <td>{* actions *}</td>
    </tr>
        {foreach $pager as $item}
    <tr class="Partner list" id="Partner-{$item->get('id')}"> 
        <td class="Partner-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>                           
                    <input class="Partner-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                      
                </td>
            {/if}
            <td><span>{$item->get('id')}</span></td>
            <td>                
                    {$item->get('name')}
            </td>
            <td> 
                {$item->get('postcode')}
            </td>
            <td>{$item->get('city')}
            </td>
            <td>                
                {$item->get('phone')}                   
            </td>  
               <td>                
                {$item->get('is_active')}                   
            </td> 
            <td>               
                <a href="#" title="{__('Edit')}" class="Partner-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a> 
                <a href="#" title="{__('Contacts')}" class="Partner-Contacts" id="{$item->get('id')}">
                     <img  src="{url('/icons/contact16x16.png','picture')}" alt='{__("Contacts")}'/></a> 
                <a href="#" title="{__('Delete')}" class="Partner-Delete" id="{$item->get('id')}"  name="{$item->get('name')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
                </a>               
            </td>
    </tr>    
    {/foreach}  
</table>    
 {if !$pager->getNbItems()}
     <span>{__('No partner')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="Partner-all" /> 
          <a style="opacity:0.5" class="Partner-actions_items" href="#" title="{__('delete')}" id="Partner-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="Partner"} 
  
<script type="text/javascript">
    
        function getSitePartnerFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=Partner-name] option:selected").val()  
                                    },
                                lang: $("img.Partner").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=Partner-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".Partner-order_active").attr("name"))
                 params.filter.order[$(".Partner-order_active").attr("name")] =$(".Partner-order_active").attr("id");   
            $(".Partner-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSitePartnerFilter()
        {
           $(".-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSitePartnerFilterParameters(), 
                            url:"{url_to('partners_ajax',['action'=>'ListPartialPartner'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".Partner-pager .Partner-active").html()?parseInt($(".Partner-pager .Partner-active").html()):1;
           records_by_page=$("[name=Partner-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".Partner-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#Partner-nb_results").html())-n;
           $("#Partner-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#Partner-end_result").html($(".Partner-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#Partner-init").click(function() {   
               $(".-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('partners_ajax',['action'=>'ListPartialPartner'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.Partner-order').click(function() {
                $(".Partner-order_active").attr('class','Partner-order');
                $(this).attr('class','Partner-order_active');
                return updateSitePartnerFilter();
           });
           
            $(".Partner-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSitePartnerFilter();
            });
            
          $("#Partner-filter").click(function() { return updateSitePartnerFilter(); }); 
          
          $("[name=Partner-nbitemsbypage]").change(function() { return updateSitePartnerFilter(); }); 
          
         // $("[name=Partner-name]").change(function() { return updateSitePartnerFilter(); }); 
           
           $(".Partner-pager").click(function () {      
                $(".-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSitePartnerFilterParameters(), 
                                 url:"{url_to('partners_ajax',['action'=>'ListPartialPartner'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#Partner-New").click( function () { 
            $(".dialogs").dialog("destroy").remove();      
            return $.ajax2({                    
                url: "{url_to('partners_ajax',['action'=>'NewPartner'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".Partner-View").click( function () {                    
                return $.ajax2({ data : { Partner : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('partners_ajax',['action'=>'ViewPartner'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
          $(".Partner-Contacts").click( function () {              
                return $.ajax2({ data : { Partner : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('partners_ajax',['action'=>'ListPartnerContact'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".Partner-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Partner: $(this).attr('id') },
                                 url :"{url_to('partners_ajax',['action'=>'DeletePartner'])}",
                                 errorTarget: ".site-errors",    
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deletePartner')
                                       {    
                                          $("tr#Partner-"+resp.id).remove();  
                                          if ($('.Partner').length==0)
                                              return $.ajax2({ url:"{url_to('partners_ajax',['action'=>'ListPartialPartner'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
             $(function () {
		$('.footable').footable();
	});
            
      
 
 </script>    