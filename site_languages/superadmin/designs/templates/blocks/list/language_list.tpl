<div class="ct_language">
 {if sizeof($languages)>1}
    <ul>
        {foreach $languages as $language}
        <li>
            {if $language==$language_active}
                 <img class="language_active" src="{url('/flags/','picture')}{$language}.png" alt="{__($language)}"/> 
            {else}     
                <a href="/{$language}{$referer}"><img class="language_noactive"  src="{url('/flags/','picture')}{$language}.png" alt="{__($language)}"/></a>
            {/if}
        </li>
        {/foreach}
    </ul>{/if}
</div>

