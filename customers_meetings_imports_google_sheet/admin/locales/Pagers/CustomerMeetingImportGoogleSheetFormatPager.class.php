<?php


class CustomerMeetingImportGoogleSheetFormatPager extends Pager
{

    function __construct()
    {
        parent::__construct(array("CustomerMeetingImportGoogleSheetFormat"));
    }
    function getApi()
    {
        return new UtilsGoogleSheetApi();
    }
    protected function fetchObjects($db)
    {
        while ($items = $db->fetchObjects()) {
            $item = $items->getCustomerMeetingImportGoogleSheetFormat();
            $this->items[$item->get('id')] = $item;
        }
    }
}