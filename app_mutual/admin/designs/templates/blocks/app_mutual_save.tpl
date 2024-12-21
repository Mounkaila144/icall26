params.Meeting.mutual= { };
$(".CustomerMeetingMutualProduct-NewMeeting").each(function() { 
    params.Meeting.mutual[$(this).attr('name')]=$(this).val();
});

$(".CustomerMeetingMutualProduct-NewMeeting option:selected").each(function () { 
    params.Meeting.mutual[$(this).parent().attr("name")] = $(this).val();  
});  