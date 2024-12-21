<?php


class ServicesZapierClientPager extends Pager
{

    function __construct()
    {
        parent::__construct(array("ServicesZapierClient"));
    }
    protected function fetchObjects($db)
    {
        while ($items = $db->fetchObjects()) {
            $item = $items->getServicesZapierClient();
            $this->items[$item->get('client_id')] = $item;
        }
    }
}