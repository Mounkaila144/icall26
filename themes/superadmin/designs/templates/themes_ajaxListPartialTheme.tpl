{messages class="errors"}
<h3>{__("Themes list for frontend")}</h3>
<div>
    <a id="AddTheme" title="{__('add theme')}" href="#">
       <img  src="{url('/icons/new.gif','picture')}" alt="{__('add theme')}"/>{__('Add Theme')|capitalize}
    </a>    
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter}
<button id="filter">{__("Filter")}</button>   <button id="init">{__("Init")}</button>        
<table cellpadding="0" cellspacing="0"> 
    <tr>
        <th></th>
        <th></th>       
    </tr>
    {foreach $pager as $item}        
    <tr class="themes" id="themes-{$item->get('id')}">
        <td>           
            {if $item->get('preview')}<img  height="100" width="100" src="{$item->getPreview()->getURL()}" alt="{__($item->getName())}"/>{/if}
            <div>{__($item->getName())}</div>
        </td>       
        <td>
             <a href="#" class="ChangeIsActive" name="{$item->get('is_active')}" id="{$item->get('id')}">
                    <img src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__($item->get("is_active"))}' title='{__($item->get("is_active"))}'/>
                </a>  
             <a href="#" title="{__('delete')}" class="Delete" id="{$item->get('id')}" name="{__($item->getName())}" >
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
             </a>    
        </td>        
    </tr>
    {/foreach}
</table>
{if !$pager->getNbItems()}  
    {__("no result")}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager}

<script type="text/javascript">        

        function changeThemeIsActiveState(resp) 
        {
            $.each(resp.selection?resp.selection:[resp.id], function (id) { 
                //sel="a.ChangeIsActive#"+this;
                sel="a.ChangeIsActive[id="+this+"]";
                if (resp.state=='YES'||resp.state=='NO') 
                {    
                    $(sel+" img").attr({
                        src :"{url('/icons/','picture')}"+resp.state+".gif",
                        alt : (resp.state=='YES'?'{__("YES")}':'{__("NO")}'),
                        title : (resp.state=='YES'?'{__("YES")}':'{__("NO")}')
                    });
                    $(sel).attr("name",resp.state);
                }
            });  
        }
            
        function getThemesFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                search : { },
                                equal : { },
                                nbitemsbypage: $("[name=nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                             }};
            if ($(".order_active").attr("name"))
                    params.filter.order[$(".order_active").attr("name")] =$(".order_active").attr("id");   
            $(".search").each(function(id) { params.filter.search[this.name] =this.value; });   
            return params;                  
        }
        
        function updateThemesFilter()
        {
           return $.ajax2({ data: getThemesFilterParameters(), url:"{url_to('themes_ajax_themes',['action'=>'ListPartialTheme'])}" , target: "#actions" });      
        }
        
        function updatePager(n)
        {
           page_active=$(".pager .active").html()?parseInt($(".pager .active").html()):1;
           records_by_page=$("[name=nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".themes-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#nb_results").html())-n;
           $("#nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#end_result").html($(".themes-count:last").html());
        }
        
        {JqueryScriptsReady}   
  
        // {* PAGER - begin *}
        $('.order').click(function() {
            $(".order_active").attr('class','order');
            $(this).attr('class','order_active');
            return updateThemesFilter();
        });
        
        $("[name=nbitemsbypage]").change(function() { return updateThemesFilter(); }); 
                 
        $("#filter").click(function() { return updateThemesFilter(); });        

        $(".pager").click(function () {
            return $.ajax2({ data: getThemesFilterParameters(), url:"{url_to('themes_ajax_themes',['action'=>'ListPartialTheme'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),target: "#actions"});
        });
        
        $("#init").click(function() { 
            $.ajax2({ url:"{url_to('themes_ajax_themes',['action'=>'ListPartialTheme'])}",target: "#actions"});
        });
        
        $("#AddTheme").click(function() { 
            $.ajax2({ url:"{url_to('themes_ajax_themes',['action'=>'AddTheme'])}",target: "#actions"});
        });
        
        $(".ChangeIsActive").click( function () {                 
                return $.ajax2({ data: { Theme : { id: $(this).attr('id'), value: $(this).attr('name'), token: '{mfForm::getToken("ChangeForm")}' } },
                                 url: "{url_to('themes_ajax_themes',['action'=>'ChangeIsActiveTheme'])}",
                                 success: function(resp) {
                                               if (resp.action=='ChangeIsActiveTheme')
                                                    changeThemeIsActiveState(resp);
                                          }
                });    
        }); 
     
        $(".Delete").click( function () { 
                if (!confirm('{__("Theme \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Theme: $(this).attr('id') },
                                 url :"{url_to('themes_ajax_themes',['action'=>'DeleteTheme'])}",
                                 success : function(resp) {
                                       if (resp.action=='deleteTheme')
                                       {    
                                          $("tr#themes-"+resp.id).remove();  
                                          if ($('.themes').length==0)
                                              return $.ajax2({ url:"{url_to('themes_ajax_themes',['action'=>'ListPartialTheme'])}",target: "#actions"});
                                          updatePager(1);
                                        }       
                                 }
                     });                         
                return false;
            });
  {/JqueryScriptsReady}  
 
</script>        