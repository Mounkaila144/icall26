{foreach $sublinks as $link}
    {if $link@last}
        {if $link->get('icon')}<img src="{url($link->get('icon'),'web')}" alt="{$link->get('title')}"/>{/if}
        <span style="font-weight: bold">{$link->get('title')|capitalize}</span> 
    {else}
       <a href="#" id="{url($link->get($urlSource))}" class="sublink">         
          {if $link->get('icon')}<img src="{url($link->get('icon'),'web')}" alt="{$link->get('title')}"/>{/if}
          <span>{$link->get('title')|capitalize}</span> 
        </a>
        <span style="font-weight: bold">{mfConfig::get('view_sublink_separator','>')}</span>
    {/if}
{/foreach}
