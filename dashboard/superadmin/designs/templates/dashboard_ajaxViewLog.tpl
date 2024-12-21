{messages class="errors"}
{if $log}
    <div><strong>{$log->get('name')}</strong>
        <a href="#" class="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')|capitalize}</a>
    </div>
    <textarea rows="20" cols="250" readonly style="resize: none;">{$log->getContent()}</textarea>
{else}
   <a href="#" class="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')|capitalize}</a>
{/if}
<script type="text/javascript">
        
        $('.Cancel').click(function(){           
           $.ajax2( { url:"{url_to('dashboard_ajax',['action'=>'ListLog'])}" , 
                      loading: "#tab-dashboard-superadmin-loading",
                      errorTarget: ".dashboard-superadmin-errors",
                      target: "#tab-dashboard-superadmin-content"});
        });

</script> 