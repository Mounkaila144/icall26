<?php


class CustomerMeetingExportFormField extends mfArray {
    
    
    function __toString() {
        return (string)$this->collection['text'];
    }
    
}
