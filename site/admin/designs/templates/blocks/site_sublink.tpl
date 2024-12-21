<div class="sublinks_site">    
    {messages class="sublinks-site-errors"}
    {foreach $sublinks as $link}
    {if $link@last}       
        {if $link->get('icon')}<img src="{url($link->get('icon'),'web')}" alt="{__($link->get('title'))}"/>{/if}
        <span style="font-weight: bold">{__($link->get('title'))|capitalize}</span> 
    {elseif $link@first}
    {else}    
       <a href="#" name="{$link->getRoute()}" class="sublink">         
          {if $link->get('icon')}<img src="{url($link->get('icon'),'web')}" alt="{__($link->get('title'))}"/>{/if}
          <span>{__($link->get('title'))|capitalize}</span> 
        </a>
        <span style="font-weight: bold">{mfConfig::get('view_sublink_separator','>')}</span>
    {/if}
{/foreach}
</div>
<script type="text/javascript">
      
          $('.sublink').click(function() {  return $.ajax2({                   
                      loading: "#tab-site-dashboard-x-settings-loading",                   
                      errorTarget: ".sublinks-site-errors", 
                      url:$(this).attr('name'),
                      target: "#tab-dashboard-x-settings"}); 
          });
    
</script>    


