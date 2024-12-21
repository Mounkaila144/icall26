{messages class="TextI18n-errors"}
<div>
    <a id="TextI18n-New" href="#"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('new text')|capitalize}</a>
</div> 
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="TextI18n"}
<button id="TextI18n-filter">{__("Filter")}</button>   <button id="TextI18n-init">{__("Init")}</button>
<table cellpadding="0" cellspacing="0">
     <tr>
        <th>#</th>          
         <th>{__('lang')}
               <div>
              <a href="#" class="TextI18n-order{$formFilter.order.lang->getValueExist('asc','_active')}" id="asc" name="lang"><img  src='{url("/icons/sort_asc`$formFilter.order.lang->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="TextI18n-order{$formFilter.order.lang->getValueExist('desc','_active')}" id="desc" name="lang"><img  src='{url("/icons/sort_desc`$formFilter.order.lang->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>
         
         <th>{__('key')}
               <div>
              <a href="#" class="TextI18n-order{$formFilter.order.key->getValueExist('asc','_active')}" id="asc" name="key"><img  src='{url("/icons/sort_asc`$formFilter.order.key->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
              <a href="#" class="TextI18n-order{$formFilter.order.key->getValueExist('desc','_active')}" id="desc" name="key"><img  src='{url("/icons/sort_desc`$formFilter.order.key->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
             </div> 
         </th>    
         <th>{__('text')}</th>
          <th>{__('actions')}</th>
     </tr>
     <tr>
            <td>{* # *}</td>          
            <td>{* lang *}
                  {html_options_format class="TextI18n-equal" name="lang" options=$formFilter->equal.lang->getOption('choices') selected=(string)$formFilter.equal.lang format="country"}
            </td>
            <td>{* key *}</td>       
            <td>{* text *}</td>    
            <td>{* actions *}</td>
        </tr>       
        {foreach $pager as $item}
        <tr class="TextI18n">
            <td class="TextI18n-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>           
            <td>{* lang *}                
                <img  src='{url("/flags/`$item->get("lang")|default:"__"`.png","picture")}' title="{format_country($item->get('lang'))}" />
            </td>
            <td>{* key *}
                {$item->get('key')}
            </td>
            <td>{* text *}
                 {$item->get('text')|truncate:50}
            </td>             
            <td>{* actions *}
                 <a href="#" title="{__('edit')}"  class="TextI18n-View"  id="{$item->get('lang')}" name="{$item->get('key')}">
                      <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/>
                 </a> 
            </td>
        </tr>
        {/foreach}
</table>
{if !$pager->getNbItems()}  
     {__("no result")}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="TextI18n"}
<script type="text/javascript">
     
        function getTextI18nFilterParameters()
        {
            params={ filter: {  order : { },                                                                         
                                equal : {                                                                                          
                                     lang : $(".TextI18n-equal[name=lang] option:selected").val(),                                                                                                                                                                                                             
                                        },                                            
                                nbitemsbypage: $("[name=TextI18n-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                             }};
            if ($(".TextI18n-order_active").attr("name"))
                    params.filter.order[$(".TextI18n-order_active").attr("name")] =$(".TextI18n-order_active").attr("id");                                      
            return params;                  
        }
        
        function updateTextI18nFilter()
        {
           return $.ajax2({ data: getTextI18nFilterParameters(), 
                            url:"{url_to('utils_ajax_textI18n',['class'=>$class,'action'=>'ListTextI18n'])}", 
                            target: "#TextI18n-actions" });
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
            $('.TextI18n-order').click(function() {
                $(".TextI18n-order_active").attr('class','TextI18n-order');
                $(this).attr('class','TextI18n-order_active');
                return updateTextI18nFilter();
            });        
            
            $("[name=TextI18n-nbitemsbypage]").change(function() { return updateTextI18nFilter(); }); 
                                 
            $(".TextI18n-equal[name=lang]").change(function() { return updateTextI18nFilter(); }); 
                
            $("#TextI18n-filter").click(function() { return updateTextI18nFilter(); }); 

            $("#TextI18n-init").click(function() { 
                        return $.ajax2({ url:"{url_to('utils_ajax_textI18n',['class'=>$class,'action'=>'ListTextI18n'])}",
                                         target: "#TextI18n-actions"}); 
            }); 

            $(".TextI18n-pager").click(function () {
                return $.ajax2({ data: getTextI18nFilterParameters(), 
                                 url:"{url_to('utils_ajax_textI18n',['class'=>$class,'action'=>'ListTextI18n'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 target: "#TextI18n-actions"});
            });
         
         // {* PAGER - end *}   

         // {* ACTIONS - begin *}           

            $(".TextI18n-View").click( function () {               
               return $.ajax2({ data : { textI18n: { lang: this.id,key: this.name } },
                                url:"{url_to('utils_ajax_textI18n',['class'=>$class,'action'=>'ViewTextI18n'])}",
                                target: "#TextI18n-actions"});
            });

            $("#TextI18n-New").click( function () {                
                return $.ajax2({ url: "{url_to('utils_ajax_textI18n',['class'=>$class,'action'=>'NewTextI18n'])}",
                                 target: "#TextI18n-actions"
               });
            }); 
                
             
</script>
