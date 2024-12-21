{messages class="{$site->getSiteID()}-site-errors"}
{if $log->isExist()}
    <div><strong>{$log->get('name')}</strong>
        <a href="#" class="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')|capitalize}</a>
    </div>
    <textarea rows="20" cols="250" readonly style="resize: none;">{$log->getContent()}</textarea>
{else}
   <a href="#" class="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')|capitalize}</a>
{/if}
<script type="text/javascript">
        
        $('.{$site->getSiteID()}-Cancel').click(function(){           
           $.ajax2( { url:"{url_to('site_ajax',['action'=>'ListPartialLog'])}", 
                      errorTarget: ".{$site->getSiteID()}-site-errors",                        
                      target: "#{$site->getSiteID()}-actions"});
        });

</script> 