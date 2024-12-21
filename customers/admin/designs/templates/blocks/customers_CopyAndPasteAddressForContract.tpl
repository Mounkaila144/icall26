<a href="javascript:void(0);" id="CopyAddressCustomerClipboard"><i class="fa fa-copy"/></a>
<span class="copiedtext" style="display:none;">{__('Copied!')}</span>
<script type="text/javascript">
 
 $("#CopyAddressCustomerClipboard").click(function (){ 
        window.addEventListener('copy',copyToClipBoard);  
        document.execCommand("copy"); 
                
 });
 
    function copyToClipBoard(e){
            e.preventDefault();
            if (e.clipboardData) 
                e.clipboardData.setData('text/plain', "{$contract->getCustomer()->getAddress()->getFullAddressEscape()}");
            else if (window.clipboardData) 
                window.clipboardData.setData('Text', "{$contract->getCustomer()->getAddress()->getFullAddressEscape()}");
                        
          $(".copiedtext").show(1000);
            var temp = setInterval( function(){
            $(".copiedtext").hide(1000);
            window.removeEventListener('copy',copyToClipBoard);
            clearInterval(temp);
          }, 700 );
          
    }
 

</script>