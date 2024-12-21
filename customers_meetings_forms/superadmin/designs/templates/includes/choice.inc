'<div class="Survey-FormField" id="#0#">'+
    {include file="./includes/types.inc" choice="choice"}+ 
    '<div class="Survey-FormField-ctn" id="#0#">'+
        '<table class="form-full-style tab-form">'+
             '<tr class="Survey-Request full-with" id="#0#">'+
                 '<td class="label">{__('Name')}'+
                '</td>'+
                '<td><input class="formfields Name" size="20" name="name" value=""/>'+
                '</td>'+
            '</tr>'+
            '<tr class="Survey-Request" id="#0#">'+
                '<td class="label">{__('Request')}'+
                '</td>'+
                '<td><input class="formfields Request" size="80" name="request" value=""/>'+
                '</td>'+
            '</tr>'+
           '<tr class="Survey-Answer full-with" id="#0#">'+
            {include file="./includes/ctn-string.inc"}+
            '</tr>'+
        '</table>'+
    '</div>'+
 '</div>'