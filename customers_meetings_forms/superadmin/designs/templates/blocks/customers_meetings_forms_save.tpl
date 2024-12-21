params.Meeting.extra= { };
$(".CustomerMeetingExtra.Input,.CustomerMeetingExtra.Text").each(function() { 
    if (typeof params.Meeting.extra[$(this).attr('id')] == 'undefined' )
        params.Meeting.extra[$(this).attr('id')]={ };  
    params.Meeting.extra[$(this).attr('id')][$(this).attr('name')]=$(this).val();
});

$(".CustomerMeetingExtra.Checkbox:checked").each(function() { 
    if (typeof params.Meeting.extra[$(this).attr('id')] == 'undefined' )
        params.Meeting.extra[$(this).attr('id')]={ };  
    params.Meeting.extra[$(this).attr('id')][$(this).attr('name')]=1;
});

$(".CustomerMeetingExtra.Select option:selected").each(function() { 
    if (typeof params.Meeting.extra[$(this).attr('id')] == 'undefined' )
        params.Meeting.extra[$(this).attr('id')]={ };  
    params.Meeting.extra[$(this).attr('id')][$(this).attr('name')]=1;
});