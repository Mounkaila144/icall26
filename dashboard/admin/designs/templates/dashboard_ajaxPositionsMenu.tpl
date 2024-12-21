 
<div class="row">
    <div class="col-12">
 
        <a id="Cancel" class="btn btn-primary "  href="#">
            <i class="fa fa-times" style="margin-right:10px;"></i> {__('Cancel')}
          
        </a>
    </div>
</div>

{if $item_i18n->getMenu()->isLoaded()}
    <div class="card w-100">
        <div class="card-title p-2 pt-3 m-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <table id="Menus" cellpadding="0" cellspacing="0" class="table">
                                    <thead>
                                        <tr>
                                            <th width="10px"></th> 
                                            <th>{__('Position')}</th>
                                            <th>{__('Title')}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {foreach $item_i18n->getMenu()->getChilds() as $menu}
                                            <tr id="{$menu->get('id')}" class="Menus" style="background-color:lightblue" >
                                                <td><i class="fa fa-arrows-alt"></i></td>                                    
                                                <td>{$menu@iteration}</td> 
                                                <td>
                                                    <div class="pull-left" >
                                                        {* [{$menu->get('id')}]*}
                                                        {$menu->getI18n()} {* [{$menu->get('lb')}] - [{$menu->get('rb')}] *}
                                                    </div> 
                                                </td>
                                                <td>
                                                     <a href="#" title="{__('edit')}" class="SubMenus" id="{$menu->get('id')}">
                                                       <i class="fa fa-folder"/></a>
                                                </td>
                                            </tr>
                                            
                                       
                                         {foreach $menu->getChilds() as $menu1}
                                            <tr id="{$menu1->get('id')}" class="Menus-{$menu->get('id')}">
                                                <td><i class="fa fa-arrows-alt"></i></td>                                    
                                                <td>{$menu1@iteration}</td> 
                                                <td>
                                                    <div class="pull-left">
                                                        {* [{$menu->get('id')}]*}
                                                        {$menu1->getI18n()}  {* [{$menu->get('lb')}] - [{$menu->get('rb')}] *}
                                                    </div> 
                                                </td>
                                            </tr>
                                        
                                        {/foreach}
                                        
                                        {/foreach}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    
    $("#Menus tbody").sortable({
        cursor: 'move',
        start: function (event, ui) {
            $(ui.item).addClass('selected');
        },
        stop: function (event, ui) {
            $(".position").each(function (id) {  $(this).html(id + 1); });     
            var params = {
                        SystemMenuPositions: {
                            node : ui.item.attr('id'),
                            sibling_id : ui.item.next().attr('id'),
                            token: '{mfForm::getToken('MoveMenuForm')}'
                        }
               };
            $.ajax2({
            data: params,
            url: "{url_to('dashboard_ajax',['action'=>'MoveMenu'])}",
        });
        },
         helper: function(e, tr)
        {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index)
            {
              $(this).width($originals.eq(index).width());
            });
            return $helper;
        },
    });
   

    $("#Cancel").click(function () {
        return $.ajax2({
            url: "{url_to('dashboard_ajax',['action'=>'ListPartialMenu'])}",
            spinner: "#spinner-cancel",
            target: "#tab-dashboard-x-settings"
        });
    });

    $('.SubMenus').click(function () {
      $(".Menus-"+$(this).attr('id')).toggle();
    });
</script>

{else}
    {__('Menu is invalid.')}
{/if}    