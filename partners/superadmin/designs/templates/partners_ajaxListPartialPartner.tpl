{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Partner')}</h3>    
<div>
  <a href="#" id="{$site->getSiteID()}-Partner-New" title="{__('new partner')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New partner')}</a>   

</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-Partner"}
<button id="{$site->getSiteID()}-Partner-filter">{__("Filter")}</button> 
<button id="{$site->getSiteID()}-Partner-init">{__("Init")}</button>
 <table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-Partner-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-Partner-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th>
            <span>{__('name')|capitalize}</span>    
            <div>
                <a href="#" class="{$site->getSiteID()}-Partner-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-Partner-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
         <th>
            <span>{__('post code')|capitalize}</span>               
        </th>
        <th>
            <span>{__('city')|capitalize}</span>  

        </th>
           <th>
            <span>{__('phone')|capitalize}</span>                 
        </th>  
        <th>
            <span>{__('state')|capitalize}</span>          
        </th>
        <th>{__('actions')|capitalize}</th>
    </tr> 
    {* search/equal/range *}
     <tr>
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
    <tr class="{$site->getSiteID()}-Partner" id="{$site->getSiteID()}-Partner-{$item->get('id')}"> 
        <td class="{$site->getSiteID()}-Partner-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>                           
                    <input class="{$site->getSiteID()}-Partner-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                      
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
                <a href="#" title="{__('Edit')}" class="{$site->getSiteID()}-Partner-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a> 
                <a href="#" title="{__('Contacts')}" class="{$site->getSiteID()}-Partner-Contacts" id="{$item->get('id')}">
                     <img  src="{url('/icons/contact16x16.png','picture')}" alt='{__("Contacts")}'/></a> 
                <a href="#" title="{__('Delete')}" class="{$site->getSiteID()}-Partner-Delete" id="{$item->get('id')}"  name="{$item->get('name')}">
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
        <input type="checkbox" id="{$site->getSiteID()}-Partner-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-Partner-actions_items" href="#" title="{__('delete')}" id="Partner-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-Partner"} 
  
<script type="text/javascript">
    
        function getSite{$site->getSiteKey()}PartnerFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name={$site->getSiteID()}-Partner-name] option:selected").val()  
                                    },
                                lang: $("img.{$site->getSiteID()}-Partner").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name={$site->getSiteID()}-Partner-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-Partner-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-Partner-order_active").attr("name")] =$(".{$site->getSiteID()}-Partner-order_active").attr("id");   
            $(".{$site->getSiteID()}-Partner-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}PartnerFilter()
        {
           $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSite{$site->getSiteKey()}PartnerFilterParameters(), 
                            url:"{url_to('partners_ajax',['action'=>'ListPartialPartner'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-Partner-pager .Partner-active").html()?parseInt($(".{$site->getSiteID()}-Partner-pager .Partner-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-Partner-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-Partner-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-Partner-nb_results").html())-n;
           $("#{$site->getSiteID()}-Partner-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-Partner-end_result").html($(".{$site->getSiteID()}-Partner-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-Partner-init").click(function() {   
               $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('partners_ajax',['action'=>'ListPartialPartner'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-Partner-order').click(function() {
                $(".{$site->getSiteID()}-Partner-order_active").attr('class','{$site->getSiteID()}-Partner-order');
                $(this).attr('class','{$site->getSiteID()}-Partner-order_active');
                return updateSite{$site->getSiteKey()}PartnerFilter();
           });
           
            $(".{$site->getSiteID()}-Partner-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}PartnerFilter();
            });
            
          $("#{$site->getSiteID()}-Partner-filter").click(function() { return updateSite{$site->getSiteKey()}PartnerFilter(); }); 
          
          $("[name={$site->getSiteID()}-Partner-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}PartnerFilter(); }); 
          
         // $("[name=Partner-name]").change(function() { return updateSite{$site->getSiteKey()}PartnerFilter(); }); 
           
           $(".{$site->getSiteID()}-Partner-pager").click(function () {      
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSite{$site->getSiteKey()}PartnerFilterParameters(), 
                                 url:"{url_to('partners_ajax',['action'=>'ListPartialPartner'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-Partner-New").click( function () { 
            $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove();      
            return $.ajax2({                    
                url: "{url_to('partners_ajax',['action'=>'NewPartner'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });
         
         $(".{$site->getSiteID()}-Partner-View").click( function () {                    
                return $.ajax2({ data : { Partner : $(this).attr('id') },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('partners_ajax',['action'=>'ViewPartner'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
         
          $(".{$site->getSiteID()}-Partner-Contacts").click( function () {              
                return $.ajax2({ data : { Partner : $(this).attr('id') },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('partners_ajax',['action'=>'ListPartnerContact'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                    
         
          $(".{$site->getSiteID()}-Partner-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Partner: $(this).attr('id') },
                                 url :"{url_to('partners_ajax',['action'=>'DeletePartner'])}",
                                 errorTarget: ".{$site->getSiteID()}-site-errors",    
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deletePartner')
                                       {    
                                          $("tr#{$site->getSiteID()}-Partner-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-Partner').length==0)
                                              return $.ajax2({ url:"{url_to('partners_ajax',['action'=>'ListPartialPartner'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
 
 </script>    