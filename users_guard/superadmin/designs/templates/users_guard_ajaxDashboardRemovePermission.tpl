{messages class="errors-tab-dashboard-sites"} 
<h3>{__("Remove permissions")}</h3>
<div>
    <a href="#" class="btn" id="Permissions-Save" style="display:none">
       <i class="fa fa-floppy-o" style=" margin-right: 10px;"></i>{__('Save')}</a>
    <a href="#" class="btn" id="Permissions-Cancel"><i class="fa fa-times" style=" margin-right: 10px;"></i>{__('Cancel')}</a>
</div>
{if $form_sites}
    {format_number_choice('[0]no site|[1]one site|(1,Inf]%s sites',$form_sites->getSelection()->count(),$form_sites->getSelection()->count())}:{$form_sites->getSites()->getHosts()->implode(',')}
{else}
   {format_number_choice('[0]no site|[1]one site|(1,Inf]%s sites',$form->getSelection()->count(),$form->getSelection()->count())}:{$form->getSites()->getHosts()->implode(',')}
{/if}
<div>
    <table>
        <tr>
            <td>
                {__('Permissions')}:
            </td>
            <td>
                <div>{$form.permissions->getError()}</div>
                <textarea  cols="80" rows="8" class="Fields" name="permissions">{$form.permissions}</textarea>
            </td>
        </tr>        
    </table>
    
    </div>    
</div>    

<script type="text/javascript">    
    
      $('#Permissions-Cancel').click(function(){  
            return $.ajax2({ 
                    loading: "#tab-dashboard-site-loading",
                    errorTarget: ".errors-tab-dashboard-sites",  
                    url:"{url_to("site_ajax",["action"=>"ListPartial"])}", 
                    target: "#tab-Dashboard-Site" }); });
      
     $('.Fields').click(function() { $('#Permissions-Save').show(); });
      
    $('#Permissions-Save').click(function(){ 
              var params= { SitesPermission: {                               
                                selection: {$form->getSelection()->toJson()},
                                token :'{$form->getCSRFToken()}'                                
                                } };
             $(".Fields").each(function() { params.SitesPermission[$(this).attr('name')]=$(this).val(); });           
          //   alert("params="+params.toSource()); return;
              return $.ajax2({ data: params,                                
                               loading: "#tab-dashboard-site-loading",
                               errorTarget: ".errors-tab-dashboard-sites",  
                               url: "{url_to("users_guard_ajax",['action'=>'SaveDashboardRemovePermission'])}",
                               target: "#tab-Dashboard-Site"
                               }); 
        });    
             
</script> 
