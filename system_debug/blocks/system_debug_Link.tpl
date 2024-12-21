<div class="topIcon">
{*<li class="user-function">*}
    {if $user->hasCredential([['superadmin_debug']])}
    <a id="SystemDebug-Btn" href="#" title="{__('Debug On')}"><i style="color:#ff0000" class="fa fa-smile-o" ></i></a>
    {else}
    <a id="SystemDebug-Btn" href="#" title="{__('Debug Off')}"><i style="color:#00ff00" class="fa fa-smile-o" ></i></a>
    {/if}
{*</li>*}
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#SystemDebug-Btn").click(function () {
            return $.ajax2({  
                            url:"{url_to('system_debug_ajax',['action'=>'Debug'])}" , 
                            success: function (resp)
                                    {
                                        if (resp.action=='Debug')
                                        {                                            
                                            $("#SystemDebug-Btn").attr('title',resp.text);   
                                            $("#SystemDebug-Btn i").css('color',(resp.debug=='YES'?"#ff0000":"#00ff00")); 
                                        }    
                                    }
                        });
        });
    });
</script>