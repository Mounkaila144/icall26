{messages class="site-errors"}
<h3>{__('Forms')}</h3>
<div>
  <a href="#" class="btn" id="CustomerMeetingForms-New" title="{__('New form')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New form')}</a>
 {* <a href="#" class="btn" id="CustomerMeetingForms-Position" title="{__('Positions')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('Positions')}</a> *}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerMeetingForms"}
<button id="CustomerMeetingForms-filter" class="btn-table">{__("Filter")}</button>   <button id="CustomerMeetingForms-init" class="btn-table">{__("Init")}</button>
<div>
    <img class="CustomerMeetingForms" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style>
    <a id="CustomerMeetingForms-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}
</div>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="list-header">
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="CustomerMeetingForms-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetingForms-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>
            <div>
                <a href="#" class="CustomerMeetingForms-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetingForms-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>
            <div>
                <a href="#" class="CustomerMeetingForms-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerMeetingForms-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
       <td>{* id *}</td>
       <td>{* name *}</td>
       <td>{* value *}</td>
       <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="CustomerMeetingForms list" {if $item->hasCustomerMeetingFormI18n()}id="CustomerMeetingForms-{$item->getCustomerMeetingFormI18n()->get('id')}"{/if}>
        <td class="CustomerMeetingForms-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>
                    {if $item->hasCustomerMeetingFormI18n()}
                    <input class="CustomerMeetingForms-selection" type="checkbox" id="{$item->getCustomerMeetingFormI18n()->get('id')}" name="{$item->getCustomerMeetingForm()->get('name')}"/>
                    {/if}
                </td>
            {/if}
            <td><span>{$item->getCustomerMeetingForm()->get('id')}</span></td>
            <td>
                    {$item->getCustomerMeetingForm()->get('name')}
            </td>
            <td>
                {if $item->hasCustomerMeetingFormI18n()}
                     {$item->getCustomerMeetingFormI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}
            </td>
            <td>
                <a href="#" title="{__('edit')}" class="CustomerMeetingForms-View" id="{$item->getCustomerMeetingForm()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>
                {if $item->hasCustomerMeetingFormI18n()}
                <a href="#" title="{__('fields')}" class="CustomerMeetingForms-Fields" id="{$item->getCustomerMeetingForm()->get('id')}">
                    <img  src="{url('/icons/form16x16.png','picture')}" alt='{__("Fields")}'/></a>
                <a href="#" title="{__('delete')}" class="CustomerMeetingForms-Delete" id="{$item->getCustomerMeetingFormI18n()->get('id')}"  name="{$item->getCustomerMeetingFormI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
                {/if}
            </td>
    </tr>
    {/foreach}
</table>
{if !$pager->getNbItems()}
     <span>{__('No form')}</span>
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

        function getSiteCustomerMeetingFormsFilterParameters()
        {
            var params={ filter: {  order : { },
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
           $(".dialogs").dialog("destroy").remove();
           return $.ajax2({ data: getSiteCustomerMeetingFormsFilterParameters(),
                            url:"{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}" ,
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

           {* ===================== L A N G U A G E =============================== *}

            $("#CustomerMeetingForms-ChangeLang").click(function() {
                   $("#dialogListLanguages").dialog("open");
            });

            $("#dialogListLanguages").bind('select',function(event){
                $(".CustomerMeetingForms[name=lang]").attr({
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#CustomerMeetingFormsChangeLang").show();
               updateSiteCustomerMeetingFormsFilter();
            });

          {* =====================  P A G E R  A C T I O N S =============================== *}

           $("#CustomerMeetingForms-init").click(function() {
               $(".dialogs").dialog("destroy").remove();
               $.ajax2({ url:"{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}",
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
                $(".dialogs").dialog("destroy").remove();
                return $.ajax2({ data: getSiteCustomerMeetingFormsFilterParameters(),
                                 url:"{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}

          $("#CustomerMeetingForms-New").click( function () {
            $(".dialogs").dialog("destroy").remove();
            return $.ajax2({
                data : { lang : { lang: $("img.CustomerMeetingForms[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },
                url: "{url_to('customers_meeting_forms_ajax',['action'=>'NewFormI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });

         $(".CustomerMeetingForms-View").click( function () {
                $(".dialogs").dialog("destroy").remove();
                return $.ajax2({ data : { CustomerMeetingFormI18n : {
                                                form_id: $(this).attr('id'),
                                                lang: $("img.CustomerMeetingForms[name=lang]").attr('id')
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('customers_meeting_forms_ajax',['action'=>'ViewFormI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });


          $(".CustomerMeetingForms-Delete").click( function () {
                if (!confirm('{__("Form \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false;
                return $.ajax2({ data :{ CustomerMeetingFormI18n: $(this).attr('id') },
                                 url :"{url_to('customers_meeting_forms_ajax',['action'=>'DeleteFormI18n'])}",
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteFormI18n')
                                       {
                                          $("tr#CustomerMeetingForms-"+resp.id).remove();
                                          if ($('.CustomerMeetingForms').length==0)
                                              return $.ajax2({ url:"{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForms'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-x-settings"});
                                          updateSitePager(1);
                                        }
                                 }
                     });
            });

       $(".CustomerMeetingForms-Fields").click( function () {
                $(".dialogs").dialog("destroy").remove();
                return $.ajax2({ data : { CustomerMeetingFormI18n : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('customers_meeting_forms_ajax',['action'=>'FormFields'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });

     $('.footable').footable();
</script>