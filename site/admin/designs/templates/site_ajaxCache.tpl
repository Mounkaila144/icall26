{component name="/site/sublink"} 
<div id="actions">    
    {messages class="site-errors"}
    <h3>{__("site cache management")|capitalize}</h3>
    <table cellpadding="0" spacepadding="0">
         <tr>
            <td>{__('all cache')}</td>
            <td>
                <a href="#" id="SiteClearCache"><img src="{url('/icons/cache.gif','picture')}" alt="{__('Clear cache')}"/></a>
            </td>
        </tr>
        <tr>
            <td>{__('admin')}</td>
            <td>
                <a href="#" id="SiteClearCacheAdmin"><img src="{url('/icons/cache.gif','picture')}" alt="{__('Clear cache admin')}"/></a>
            </td>
        </tr>
        <tr>
            <td>{__('frontend')}</td>
            <td>
                <a href="#" id="SiteClearCacheFrontend"><img src="{url('/icons/cache.gif','picture')}" alt="{__('Clear cache frontend')}"/></a>
            </td>
        </tr>   
    </table>
    <script type="text/javascript">
    
        $('#SiteClearCache').click(function () { 
                return $.ajax2({  errorTarget: ".site-errors",
                                  url: "{url_to('site_ajax',['action'=>'SiteClearCache'])}"});
        });
        
        $('#SiteClearCacheAdmin').click(function () { 
                return $.ajax2({  errorTarget: ".site-errors",
                                  url: "{url_to('site_ajax',['action'=>'SiteClearCacheAdmin'])}"});
        });

        $('#SiteClearCacheFrontend').click(function () { 
            return $.ajax2({  errorTarget: ".site-errors",
                              url: "{url_to('site_ajax',['action'=>'SiteClearCacheFrontend'])}"});
        });
        
  
    </script>
</div>