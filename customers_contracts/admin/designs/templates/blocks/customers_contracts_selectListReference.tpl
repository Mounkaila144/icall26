<div class="ui-widget input-group customers_contracts-dropdown">
    <input id="SearchCustomerContract" type="text" class="autocomplet-input">
    <i id="SearchSpinner" class="search-spinner fas fa-sync-alt fa-spin"></i>
    <ul id="AutoCompleteCustomerContract" class="autocomplete-customers_contracts">        
    </ul>
    <div class="input-group-btn">
        <button type="button" class="btn btn-customers_contracts dropdown-toggle" data-toggle="dropdown" aria-haspopup="trdue" aria-expanded="false">
            {__('reference')}
        </button>
        <ul id="CustomerContractSelect" style="height: 230px;overflow-y: scroll;" data-next-page="{$pager->getNextPage()}" data-page="{$pager->getPage()}" data-last-page="{$pager->getLastPage()}" class="dropdown-menu scrollable-menu">
            {foreach $pager as $item}   
                <li>
                    <a href="#" class="CustomerContracts Select" id="{$item->get('id')}">{$item->get('reference')}</a>
                </li>
            {/foreach}
	</ul>
    </div>
</div>
<script type="text/javascript">
                     
 {JqueryScriptsReady}
     
    $("#CustomerContractSelect").data('last_scroll',0);
   
    $(".CustomerContracts.Select").off('click');
   
{*    $(document).on('click',".CustomerContracts.Select",function () {
        return $.ajax2({ data : { CustomerContract: $(this).attr('id') },
            loading: "#tab-dashboard-customers_contracts-loading",                              
            target: "#actions",
            url: "{url_to('customers_contracts_ajax',['action'=>'Dashboard'])}" 
        }); 
    });*}
         
    $(".dropdown-menu").mouseleave(function(){
        $(".input-group-btn").removeClass("open");
    });      
                      
    /*$("#CustomerContractSelect").scroll(function (event) {  
        if ($("#CustomerContractSelect").attr('data-page') == $("#CustomerContractSelect").attr('data-last-page'))
            return ;       
        if ($(this).scrollTop() > $("#CustomerContractSelect").data('last_scroll'))
        {		 		
            //  console.log('DOWN');                   
            if (!$("#CustomerContractSelect").hasClass('isBusy'))
            {    
                $("#CustomerContractSelect").addClass('isBusy') ;
                $.ajax2({  
                    loading: "#tab-dashboard-customers_contracts-loading",                                                        
                    url: "{url_to('customers_contracts_ajax',['action'=>'ListPartialContractReferenceForSelect'])}?page="+$("#CustomerContractSelect").attr('data-next-page'),
                    success : function (resp) { 
                        $("#CustomerContractSelect").removeClass('isBusy');
                        $("#CustomerContractSelect").attr('data-next-page',resp.next_page);
                        $("#CustomerContractSelect").attr('data-page',resp.page);
                        $.each(resp.items,function(id,obj) { $("#CustomerContractSelect").append('<li><a href="#" class="CustomerContracts Select" id="'+obj.customers_contracts_id+'">'+obj.customers_contracts_host+'</a></li>'); });
                    }
                }); 
            }
        }               
        $("#CustomerContractSelect").data('last_scroll',$(this).scrollTop());       
    });*/
         
    
    
 {/JqueryScriptsReady}
     
</script>     