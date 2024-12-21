<div class="modal-header">
    <h5 class="modal-title">Google OAuth Configuration</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" id="Modal-Dialog-Config-ctn">
    {foreach $settings->getConfigs()->get('web') as $name=>$config}
        {if $name=='redirect_uris'}                    
            {$name} :<br> {foreach $config as $uri}
                {$uri@iteration} : {$uri}<br>
                        {/foreach}
        {else}
            {$name} : {$config}<br>
        {/if}    
    {/foreach}    
</div>
<div class="modal-footer">
</div> 
