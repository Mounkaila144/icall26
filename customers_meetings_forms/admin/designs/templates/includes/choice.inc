'<div class="Survey-FormField" id="#0#">'+
    {include file="./includes/types.inc" choice="choice"}+ 
    '<div class="Survey-FormField-ctn" id="#0#">'+
        '<table>'+
             '<tr class="Survey-Request" id="#0#">'+
                '<td>{__('Name')}'+
                '</td>'+
                '<td><input class="formfields Name" size="80" name="name" value=""/>'+
                '</td>'+
            '</tr>'+
            '<tr class="Survey-Request" id="#0#">'+
                '<td>{__('Request')}'+
                '</td>'+
                '<td><input class="formfields Request" size="80" name="request" value=""/>'+
                '</td>'+
            '</tr>'+
           '<tr class="Survey-Answer" id="#0#">'+
            {include file="./includes/ctn-string.inc"}+
            '</tr>'+
        '</table>'+
    '</div>'+
 '</div>'