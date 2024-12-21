{messages class="site-errors"}
<h3>{__('User profile')}</h3>    
<div>
  {if $user->hasCredential([['superadmin','admin','settings_user_profile_new']])}    
      <a href="#" id="UserProfile-New" class="btn" title="{__('new profile')}" >
      <i class="fa fa-plus" style="margin-right:10px;"></i>
      {*<img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>*}{__('New profile')}</a>   
  {/if}
  {if $user->hasCredential([['superadmin']])}
        <a id="UserProfile-Import" href="#" class="btn" title="{__('Import')}" ><i class="fa fa-download" style="margin-right:10px;"></i>
          {__('Import')}</a> 
    {/if}
</div>
{* {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="UserProfile"}
<button id="UserProfile-filter" class="btn-table">{__("Filter")}</button>   <button id="UserProfile-init" class="btn-table">{__("Init")}</button> *}
<div>       
    <img class="UserProfile" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="UserProfile-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<div class="containerDivResp">
<table class="tabl-list  footable table" cellspacing="0">    
    <thead>
        <tr class="list-header">
    <th data-hide="phone" style="display: table-cell;">#</th>     
        </th>
           <th class="footable-first-column" data-toggle="true">
            <span>{__('id')}</span>      
            
        </th>   
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('profile')|capitalize}</span>      
            <div>
                <a href="#" class="UserProfile-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="UserProfile-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>                  
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>  
</thead>
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>
       <td> </td>    
       <td>{* value *}</td>      
        <td>{* value *}</td>              
    </tr>   
    {foreach $pager as $item}
    <tr class="UserProfile list" {if $item->hasI18n()}id="UserProfile-{$item->getI18n()->get('id')}"{/if}> 
        <td class="UserProfile-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>         
            <td>                
                     {$item->get('id')}                
            </td>  
            <td>
                {if $item->hasI18n()}
                     {$item->getI18n()}
                {else}
                    {__('----')}
                {/if}    
            </td>             
            <td>      
                 {if $user->hasCredential([['superadmin','admin','settings_user_profile_view']])}  
                <a href="#" title="{__('edit')}" class="UserProfile-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {/if}
               {if $user->hasCredential([['superadmin']])} 
               <a target="_blank" href="{url_to('users',['action'=>'ExportProfile'])}?Profile={$item->get('id')}" title="{__('Export')}" class="Export"><img  src="{url('/icons/export.gif','picture')}" alt='{__("Export")}'/></a>
               {/if}               
                {if $user->hasCredential([['superadmin']])} 
                    <a  href="#" title="{__('Re affect')}" id="{$item->get('id')}" class="ReAffectProfile"><img  src="{url('/icons/change16x16.png','picture')}" alt='{__("Re Affect")}'/></a>
                {/if}
                {if $user->hasCredential([['superadmin','admin','settings_user_profile_delete']])}  
                       {if $item->hasI18n()}<a href="#" title="{__('delete')}" class="UserProfile-Delete" id="{$item->getI18n()->get('id')}"  name="{$item->getI18n()}">
                          <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                       </a>
                   {/if}
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table> 
</div>
{if !$pager->getNbItems()}
     <span>{__('No profile')}</span>
{/if}    
<script type="text/javascript">
 
        function getSiteUserProfileFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=UserProfile-name] option:selected").val()  
                                    },
                                lang: $("img.UserProfile").attr('id'),                                                                                                               
                            //    nbitemsbypage: $("[name=UserProfile-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".UserProfile-order_active").attr("name"))
                 params.filter.order[$(".UserProfile-order_active").attr("name")] =$(".UserProfile-order_active").attr("id");   
            $(".UserProfile-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteUserProfileFilter()
        {        
           return $.ajax2({ data: getSiteUserProfileFilterParameters(), 
                            url:"{url_to('users_ajax',['action'=>'ListPartialProfile'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".UserProfile-pager .UserProfile-active").html()?parseInt($(".UserProfile-pager .UserProfile-active").html()):1;
           records_by_page=$("[name=UserProfile-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".UserProfile-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#UserProfile-nb_results").html())-n;
           $("#UserProfile-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#UserProfile-end_result").html($(".UserProfile-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#UserProfile-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".UserProfile[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#UserProfileChangeLang").show();
               updateSiteUserProfileFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#UserProfile-init").click(function() {                
               $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartialProfile'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.UserProfile-order').click(function() {
                $(".UserProfile-order_active").attr('class','UserProfile-order');
                $(this).attr('class','UserProfile-order_active');
                return updateSiteUserProfileFilter();
           });
           
            $(".UserProfile-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteUserProfileFilter();
            });
            
          $("#UserProfile-filter").click(function() { return updateSiteUserProfileFilter(); }); 
          
          $("[name=UserProfile-nbitemsbypage]").change(function() { return updateSiteUserProfileFilter(); }); 
                   
           
           $(".UserProfile-pager").click(function() {                   
                return $.ajax2({ data: getSiteUserProfileFilterParameters(), 
                                 url:"{url_to('users_ajax',['action'=>'ListPartialProfile'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
  {if $user->hasCredential([['superadmin','settings_user_profile_new']])}    
          $("#UserProfile-New").click( function() {            
            return $.ajax2({
                data : { lang : { lang: $("img.UserProfile[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('users_ajax',['action'=>'NewProfileI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         {/if}
     
{if $user->hasCredential([['superadmin','settings_user_profile_view']])}
         $(".UserProfile-View").click( function() {                   
                return $.ajax2({ data : { UserProfileI18n : { 
                                                profile_id: $(this).attr('id'),
                                                lang: $("img.UserProfile[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('users_ajax',['action'=>'ViewProfileI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
{/if}         
          $(".UserProfile-Delete").click( function() { 
                if (!confirm('{__("Profile \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ UserProfileI18n: $(this).attr('id') },
                                 url :"{url_to('users_ajax',['action'=>'DeleteProfileI18n'])}",
                                 errorTarget: ".dashboard-site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action!='DeleteProfileI18n') return;                                       
                                        $("tr#UserProfile-"+resp.id).remove();  
                                        if ($('.UserProfile').length==0)
                                            return $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartialProfile'])}",
                                                             errorTarget: ".site-errors",
                                                             target: "#tab-dashboard-site-x-settings"});
                                        updateSitePager(1);                                         
                                 }
                     });                                        
            });
    
        $("#UserProfile-Import").click( function () {              
                return $.ajax2({ loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('users_ajax',['action'=>'ImportProfile'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                  

        $(".ReAffectProfile").click( function () { 
             return $.ajax2({   data :{ id: $(this).attr('id') },
                                url:"{url_to('users_ajax',['action'=>'ReAffectProfile'])}" , 
                                loading: "#tab-site-dashboard-x-settings-loading",
                                errorTarget: ".site-errors",
                                target: "#actions"
                              });
        });
</script>    