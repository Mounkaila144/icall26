{messages class="site-errors"}
<h3>{__('Fields for document [%s]',$document->get('name'))}</h3>   
{if $document->isLoaded()}
<div>
  <a href="#" class="btn" id="CustomerMeetingForms-New" title="{__('New form')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New field')}</a> 
  <a href="#" class="btn" id="CustomerMeetingFormDocument-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('Cancel')}</a>      
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerMeetingForms"}
<div>
        <button style="width:135px" id="CustomerMeetingForms-filter" class="btn-table">{__("Filter")}</button>
        <button style="width:135px" id="CustomerMeetingForms-init" class="btn-table">{__("Init")}</button>
    </div>
<div class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">  
    <thead>
    <tr class="list-header">    
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}    
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Field')}</span>                
        </th>                   
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Operation')}</span>                
        </th>
         <th class="footable-first-column" data-toggle="true">
            <span>{__('Value')}</span>                
        </th>
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}                    
       <td>{* name *}</td>      
       <td>{* name *}</td>     
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="CustomerMeetingForms list" id="CustomerMeetingForms-{$item->get('id')}"> 
        <td class="CustomerMeetingForms-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                   
                    <input class="CustomerMeetingForms-selection" type="checkbox" id="{$item->get('id')}" name=""/>   
               
                </td>
            {/if}   
             <td>                
                {$item->getFormField()->getI18n()->get('request')}
            </td>                         
            <td>                
                {$item->getOperation()}
            </td> 
             <td>                
                {$item->get('value')}   
            </td> 
            <td>               
                <a href="#" title="{__('Edit')}" class="CustomerMeetingForms-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                    
                <a href="#" title="{__('Delete')}" class="CustomerMeetingForms-Delete" id="{$item->get('id')}"  name="">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
                </a>               
            </td>
    </tr>    
    {/foreach}    
</table>  
</div>
{if !$pager->getNbItems()}
     <span>{__('No field')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="CustomerMeetingForms-all" /> 
          <a style="opacity:0.5" class="CustomerMeetingForms-actions_items" href="#" title="{__('delete')}" id="CustomerMeetingForms-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerMeetingForms"}

<script type="text/javascript">
    
        $('.buttonSlide').click(function(){        $('#body').toggleClass('close-slide');   });
        
        function getSiteCustomerMeetingFormsFilterParameters()
        {
            var params={ CustomerMeetingFormDocument : '{$document->get('id')}',
                         filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=CustomerMeetingForms-name] option:selected").val()  
                                    },
                                lang: $("img.CustomerMeetingForms").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=CustomerMeetingForms-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".CustomerMeetingForms-order_active").attr("name"))
                 params.filter.order[$(".CustomerMeetingForms-order_active").attr("name")] =$(".CustomerMeetingForms-order_active").attr("id");   
            $(".CustomerMeetingForms-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteCustomerMeetingFormsFilter()
        {           
           return $.ajax2({ data: getSiteCustomerMeetingFormsFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialFieldForDocument'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading", 
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".CustomerMeetingForms-pager .CustomerMeetingForms-active").html()?parseInt($(".CustomerMeetingForms-pager .CustomerMeetingForms-active").html()):1;
           records_by_page=$("[name=CustomerMeetingForms-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerMeetingForms-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#CustomerMeetingForms-nb_results").html())-n;
           $("#CustomerMeetingForms-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#CustomerMeetingForms-end_result").html($(".CustomerMeetingForms-count:last").html());
        }
        
         
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#CustomerMeetingForms-init").click(function() {                 
               $.ajax2({ 
                         data : { CustomerMeetingFormDocument : '{$document->get('id')}' },
                         url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialFieldForDocument'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.CustomerMeetingForms-order').click(function() {
                $(".CustomerMeetingForms-order_active").attr('class','CustomerMeetingForms-order');
                $(this).attr('class','CustomerMeetingForms-order_active');
                return updateSiteCustomerMeetingFormsFilter();
           });
           
            $(".CustomerMeetingForms-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteCustomerMeetingFormsFilter();
            });
            
          $("#CustomerMeetingForms-filter").click(function() { return updateSiteCustomerMeetingFormsFilter(); }); 
          
          $("[name=CustomerMeetingForms-nbitemsbypage]").change(function() { return updateSiteCustomerMeetingFormsFilter(); }); 
          
         // $("[name=CustomerMeetingForms-name]").change(function() { return updateSiteCustomerMeetingFormsFilter(); }); 
           
           $(".CustomerMeetingForms-pager").click(function () {                     
                return $.ajax2({ data: getSiteCustomerMeetingFormsFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialFieldForDocument'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#CustomerMeetingForms-New").click( function () {               
            return $.ajax2({       
                data : { CustomerMeetingFormDocument : '{$document->get('id')}' },
                url: "{url_to('app_domoprime_ajax',['action'=>'NewFieldForDocument'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });                
         
         $(".CustomerMeetingForms-View").click( function () {                
                return $.ajax2({ data : { CustomerMeetingFormDocumentField : $(this).attr('id')  },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewFieldForDocument'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".CustomerMeetingForms-Delete").click( function () { 
                if (!confirm('{__("Form \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ CustomerMeetingFormDocumentField: $(this).attr('id') },
                                 url :"{url_to('customers_meeting_forms_document_ajax',['action'=>'DeleteField'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteField')
                                       {    
                                          $("tr#CustomerMeetingForms-"+resp.id).remove();  
                                          if ($('.CustomerMeetingForms').length==0)
                                              return $.ajax2({  data : { CustomerMeetingFormDocument : '{$document->get('id')}' },
                                                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialFieldForDocument'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
      

        $(".CustomerMeetingForms-Fields").click( function () {               
                return $.ajax2({ data : { CustomerMeetingFormDocument : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialFieldForDocument'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
          $('#CustomerMeetingFormDocument-Cancel').click(function(){                           
             return $.ajax2({ url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialDocument'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
</script>   
{else}
    {__('Document is invalid.')}
{/if}    

