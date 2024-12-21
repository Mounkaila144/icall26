<div class="ct_language">
 {if sizeof($languages)>1}
    <ul>
        {foreach $languages as $language}
        <li>
            {if $language->get('code')==$language_active}
               <img class="language_active" src='{url("/flags/`$language->get("code")`.png","picture")}' alt="{__($language->get('code'))}"/> 
            {else}     
                <a href="/{$language->get('code')}{$referer}">
                      <img class="language_noactive"  src='{url("/flags/`$language->get("code")`.png","picture")}' alt="{__($language->get('code'))}"/> 
                </a> 
            {/if}
        </li>
        {/foreach}
    </ul>{/if}
</div>

