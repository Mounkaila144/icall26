<?php


class CustomerMeetingImportGoogleSheetLogPager extends Pager
{

    function __construct()
    {
        parent::__construct(array("CustomerMeetingImportGoogleSheetLog"));
    }

    protected function fetchObjects($db)
    {
        while ($items = $db->fetchObjects()) {
            $item = $items->getCustomerMeetingImportGoogleSheetLog();
            $this->items[$item->get('id')] = $item;
        }
    }
}