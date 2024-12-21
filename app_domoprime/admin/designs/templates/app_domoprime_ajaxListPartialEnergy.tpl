{messages class="site-errors"}
<h3>{__('Energy')}</h3>    
<div>
  <a href="#" class="btn" id="DomoprimeEnergy-New" title="{__('New energy')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New energy')}</a>     
 
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeEnergy"}
<button id="DomoprimeEnergy-filter" class="btn-table">{__("Filter")}</button>   <button id="DomoprimeEnergy-init" class="btn-table">{__("Init")}</button>
<div>       
    <img class="DomoprimeEnergy" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="DomoprimeEnergy-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<div  class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">  
    <thead>
    <tr class="list-header">    
    <th>#</th>
        <th>&nbsp;</th>            
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>    
            <div>
                <a href="#" class="DomoprimeEnergy-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomoprimeEnergy-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>      
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="DomoprimeEnergy-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomoprimeEnergy-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th data-hide="phone" style="display: table-cell;">{__('actions')|capitalize}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
  <td></td> 
       <td>{* name *}</td>
       <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeEnergy list" {if $item->hasI18n()}id="DomoprimeEnergy-{$item->getI18n()->get('id')}"{/if} name="DomoprimeEnergy-{$item->get('id')}"> 
        <td class="DomoprimeEnergy-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
           
                <td>        
                    {if $item->hasI18n()}
                    <input class="DomoprimeEnergy-selection" type="checkbox" id="{$item->get('id')}" name="{$item->getI18n()->get('value')}"/>   
                    {/if}
                </td>
              
            <td>                
                    {$item->get('name')}
            </td>                 
            <td>
                {if $item->hasI18n()}
                     {$item->getI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="DomoprimeEnergy-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasI18n()}<a href="#" title="{__('delete')}" class="DomoprimeEnergy-Delete" id="{$item->getI18n()->get('id')}"  name="{$item->getI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>   
</div>
{if !$pager->getNbItems()}
     <span>{__('No energy')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeEnergy-all" /> 
          <a style="opacity:0.5" class="DomoprimeEnergy-actions_items" href="#" title="{__('Delete')}" id="DomoprimeEnergy-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeEnergy"}
<script type="text/javascript">
 
        function getSiteDomoprimeEnergyFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=DomoprimeEnergy-name] option:selected").val()  
                                    },
                                lang: $("img.DomoprimeEnergy").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=DomoprimeEnergy-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeEnergy-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeEnergy-order_active").attr("name")] =$(".DomoprimeEnergy-order_active").attr("id");   
            $(".DomoprimeEnergy-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeEnergyFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeEnergyFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeEnergy-pager .DomoprimeEnergy-active").html()?parseInt($(".DomoprimeEnergy-pager .DomoprimeEnergy-active").html()):1;
           records_by_page=$("[name=DomoprimeEnergy-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeEnergy-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeEnergy-nb_results").html())-n;
           $("#DomoprimeEnergy-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomoprimeEnergy-end_result").html($(".DomoprimeEnergy-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#DomoprimeEnergy-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".DomoprimeEnergy[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#DomoprimeEnergyChangeLang").show();
               updateSiteDomoprimeEnergyFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeEnergy-init").click(function() {   
             
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.DomoprimeEnergy-order').click(function() {
                $(".DomoprimeEnergy-order_active").attr('class','DomoprimeEnergy-order');
                $(this).attr('class','DomoprimeEnergy-order_active');
                return updateSiteDomoprimeEnergyFilter();
           });
           
            $(".DomoprimeEnergy-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeEnergyFilter();
            });
            
          $("#DomoprimeEnergy-filter").click(function() { return updateSiteDomoprimeEnergyFilter(); }); 
          
          $("[name=DomoprimeEnergy-nbitemsbypage]").change(function() { return updateSiteDomoprimeEnergyFilter(); }); 
          
         // $("[name=DomoprimeEnergy-name]").change(function() { return updateSiteDomoprimeEnergyFilter(); }); 
           
           $(".DomoprimeEnergy-pager").click(function () {      
               
                return $.ajax2({ data: getSiteDomoprimeEnergyFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimeEnergy-New").click( function () { 
            
            return $.ajax2({
                data : { lang : { lang: $("img.DomoprimeEnergy[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewEnergyI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });                
         
         $(".DomoprimeEnergy-View").click( function () { 
                  
                return $.ajax2({ data : { DomoprimeEnergyI18n : { 
                                                energy_id: $(this).attr('id'),
                                                lang: $("img.DomoprimeEnergy[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewEnergyI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".DomoprimeEnergy-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeEnergyI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteEnergyI18n'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteEnergyI18n')
                                       {    
                                          $("tr#DomoprimeEnergy-"+resp.id).remove();  
                                          if ($('.DomoprimeEnergy').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
    
     $("#DomoprimeEnergy-all").click(function () {                
               $(".DomoprimeEnergy-selection").prop("checked",$(this).prop("checked"));             
               $(".DomoprimeEnergy-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
          });
    
    $(".DomoprimeEnergy-selection").click(function (){               
                $(".DomoprimeEnergy-actions_items").css('opacity',($(".DomoprimeEnergy-selection:checked").length?'1':'0.5'));
          });
          
    $("#DomoprimeEnergy-Delete").click( function () { 
             var params={ selection : {  } };
             text="";
             $(".DomoprimeEnergy-selection:checked").each(function (id) { 
                params.selection[id]=this.id;
                text+=this.name+",\n";
             });
             if ($.isEmptyObject(params.selection))
                return ;
             if (!confirm('{__('Status \u000A\u000A"#0#"\u000A\u000A will be deleted. Confirm ?')}'.format(text.substring(0,text.lastIndexOf(","))))) 
                 return false; 
             return $.ajax2({ 
                     data: params,                     
                     url: "{url_to('app_domoprime_ajax',['action'=>'DeletesEnergy'])}",
                     errorTarget: ".site-errors",     
                     loading: "#tab-site-x-settings-loading",
                     success: function(resp) {
                            if (resp.action=='DeletesEnergy')
                            {   
                                if ($(".DomoprimeEnergy").length-resp.parameters.length==0)
                                {    
                                  return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}",
                                                   errorTarget: ".dashboard-site-errors",     
                                                    loading: "#tab-site-x-settings-loading",                    
                                                    target: "#actions" });
                                }    
                                $.each(resp.parameters, function () {  $("tr[name=DomoprimeEnergy-"+this+"]").remove(); });
                                updateSitePager(resp.parameters.length); 
                                $("input#DomoprimeEnergy-all").attr("checked",false);                                    
                            }       
                         }
             });
          });
          
    // $('.footable').footable();
	   
    
</script>    