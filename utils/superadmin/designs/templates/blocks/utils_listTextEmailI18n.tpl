{messages class="TextEmailI18n-errors"}
<div>
    <a id="TextEmailI18n-New" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('new text')|capitalize}</a>
</div> 
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="TextEmailI18n"}
<button id="TextEmailI18n-filter">{__("Filter")}</button>   <button id="TextEmailI18n-init">{__("Init")}</button>
<table cellpadding="0" cellspacing="0">
     <tr>
        <th>#</th>          
         <th>{__('language')|capitalize}
               <div>
              <a href="#" class="TextEmailI18n-order{$formFilter.order.lang->getValueExist('asc','_active')}" id="asc" name="lang"><img  src='{url("/icons/sort_asc`$formFilter.order.lang->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="TextEmailI18n-order{$formFilter.order.lang->getValueExist('desc','_active')}" id="desc" name="lang"><img  src='{url("/icons/sort_desc`$formFilter.order.lang->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         
         <th>{__('name')|capitalize}
               <div>
              <a href="#" class="TextEmailI18n-order{$formFilter.order.key->getValueExist('asc','_active')}" id="asc" name="key"><img  src='{url("/icons/sort_asc`$formFilter.order.key->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="TextEmailI18n-order{$formFilter.order.key->getValueExist('desc','_active')}" id="desc" name="key"><img  src='{url("/icons/sort_desc`$formFilter.order.key->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>    
         <th>{__('subject')|capitalize}</th>
         <th>{__('body')|capitalize}</th>
          <th>{__('actions')|capitalize}</th>
     </tr>
     <tr>
            <td>{* # *}</td>          
            <td>{* lang *}
                  {html_options_format class="TextEmailI18n-equal" name="lang" options=$formFilter->equal.lang->getOption('choices') selected=(string)$formFilter.equal.lang format="country"}
            </td>
            <td>{* key *}</td>    
            <td>{* subject *}</td>    
            <td>{* body *}</td>    
            <td>{* actions *}</td>
        </tr>       
        {foreach $pager as $item}
        <tr class="TextEmailI18n">
            <td class="TextI18n-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>           
            <td>{* lang *}                
                <img  src='{url("/flags/`$item->get("lang")|default:"__"`.png","picture")}' title="{format_country($item->get('lang'))}" />
            </td>
            <td>{* key *}
                {$item->get('key')}
            </td>
             <td>{* subject *}
                 {$item->get('subject')|truncate:50|escape}
            </td>     
            <td>{* body *}
                 {$item->get('body')|truncate:50|escape}
            </td>             
            <td>{* actions *}
                 <a href="#" title="{__('edit')}"  class="TextEmailI18n-View"  id="{$item->get('lang')}" name="{$item->get('key')}">
                      <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/>
                 </a> 
            </td>
        </tr>
        {/foreach}
</table>        
{if !$pager->getNbItems()}  
     {__("no result")}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="TextEmailI18n"}
<script type="text/javascript">
     
        function getTextEmailI18nFilterParameters()
        {
            var params={ filter: {  module : "{$formFilter.module}",
                                order : { },                                                                         
                                equal : {                                                                                          
                                     lang : $(".TextEmailI18n-equal[name=lang] option:selected").val(),                                                                                                                                                                                                             
                                        },                                            
                                nbitemsbypage: $("[name=TextEmailI18n-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                             }};
            if ($(".TextEmailI18n-order_active").attr("name"))
                    params.filter.order[$(".TextEmailI18n-order_active").attr("name")] =$(".TextEmailI18n-order_active").attr("id");                                      
            return params;                  
        }
        
        function updateTextEmailI18nFilter()
        {
           return $.ajax2({ data: getTextEmailI18nFilterParameters(), 
                            url:"{url_to('utils_ajax_textemaili18n',['action'=>'List'])}", 
                            target: "#TextEmailI18n-actions" });
        }
        
   {*     function updateTextI18nPager(n)
        {
           page_active=$(".TextI18n-pager .active").html()?parseInt($(".TextI18n-pager .active").html()):1;
           records_by_page=$("[name=TextI18n-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".TextI18n-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#TextI18n-nb_results").html())-n;
           $("#TextI18n-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#TextI18n-end_result").html($(".TextI18n-count:last").html());
        }
          *}  
                                                                                                                                                       
            // {* PAGER - begin *}
            $('.TextEmailI18n-order').click(function() {
                $(".TextEmailI18n-order_active").attr('class','TextEmailI18n-order');
                $(this).attr('class','TextEmailI18n-order_active');
                return updateTextEmailI18nFilter();
            });        
            
            $("[name=TextEmailI18n-nbitemsbypage]").change(function() { return updateTextEmailI18nFilter(); }); 
                                 
            $(".TextEmailI18n-equal[name=lang]").change(function() { return updateTextEmailI18nFilter(); }); 
                
            $("#TextEmailI18n-filter").click(function() { return updateTextEmailI18nFilter(); }); 

            $("#TextEmailI18n-init").click(function() { 
                   var  params={ filter: {  module : "{$formFilter.module}",
                                            order : { {foreach $formFilter->getDefault('order') as $name=>$value} {$name}: "{$value}", {/foreach} },
                                            token:'{$formFilter->getCSRFToken()}' } };
                        return $.ajax2({ data : params,
                                         url:"{url_to('utils_ajax_textemaili18n',['action'=>'List'])}",
                                         target: "#TextEmailI18n-actions" }); 
            }); 

            $(".TextEmailI18n-pager").click(function () {
                return $.ajax2({ data: getTextI18nFilterParameters(), 
                                 url:"{url_to('utils_ajax_textemaili18n',['action'=>'List'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 target: "#TextEmailI18n-actions"});
            });
         
         // {* PAGER - end *}   

         // {* ACTIONS - begin *}           

            $(".TextEmailI18n-View").click( function () {               
               return $.ajax2({ data : { textEmailI18n: { lang: this.id,key: this.name,module:"{$formFilter.module}" } },
                                url:"{url_to('utils_ajax_textemaili18n',['action'=>'View'])}",
                                target: "#TextEmailI18n-actions"});
            });

            $("#TextEmailI18n-New").click( function () {                
                return $.ajax2({ 
                                 data : { module: "{$formFilter.module}" },
                                 url: "{url_to('utils_ajax_textemaili18n',['action'=>'New'])}",
                                 target: "#TextEmailI18n-actions"
               });
            }); 
                
             
</script>
