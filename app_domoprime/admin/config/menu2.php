<?php return array (
  'menu' => 
  array (
    'site.dashboard' => 
    array (
      'childs' => 
      array (
        'site_domoprime' => '',
      ),
    ),
  ),
  'items' => 
  array (
    'site_domoprime' => 
    array (
      'title' => 'ISO',
      'route_ajax' => 
      array (
        'site_ajax' => 
        array (
          'action' => 'Home',
        ),
      ),
      'enabled' => true,
      'childs' => 
      array (
        'site_domoprime.00_zone' => NULL,
        'site_domoprime.10_energy' => NULL,
        'site_domoprime.15_documents' => NULL,
        'site_domoprime.20_class' => NULL,
        'site_domoprime.25_quotation_model' => '',
        'site_domoprime.28_billing_model' => '',
        'site_domoprime.29_asset_model' => '',
        'site_domoprime.29_as_premeeting_model' => '',
        'site_domoprime.29_as_after_work_model' => '',
        'site_domoprime.29_polluting' => NULL,
        'site_domoprime.30_settings' => NULL,
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'app_domoprime',
        ),
      ),
    ),
    'site_domoprime.00_zone' => 
    array (
      'title' => 'Sectors',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListZone',
        ),
      ),
      'picture' => '/pictures/icons/sectors.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
        ),
      ),
    ),
    'site_domoprime.10_energy' => 
    array (
      'title' => 'Energy',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListEnergy',
        ),
      ),
      'picture' => '/module/app_domoprime/pictures/energy32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_energy',
        ),
      ),
    ),
    'site_domoprime.20_class' => 
    array (
      'title' => 'Classes',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListClass',
        ),
      ),
      'picture' => '/pictures/icons/customer.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_class',
        ),
      ),
    ),
    'site_domoprime.25_quotation_model' => 
    array (
      'title' => 'Quotation models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListQuotationModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_quotation_model',
        ),
      ),
    ),
    'site_domoprime.28_billing_model' => 
    array (
      'title' => 'Billing models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListBillingModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_billing_model',
        ),
      ),
    ),
    'site_domoprime.29_asset_model' => 
    array (
      'title' => 'Asset models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListAssetModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_asset_model',
        ),
      ),
    ),
    'site_domoprime.30_settings' => 
    array (
      'title' => 'Settings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'Settings',
        ),
      ),
      'picture' => '/pictures/icons/settings.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_settings',
        ),
      ),
    ),
    'site_domoprime.29_polluting' => 
    array (
      'title' => 'Pollutings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPollutingCompany',
        ),
      ),
      'picture' => '/pictures/icons/sav.jpg',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_polluters',
        ),
      ),
    ),
    'site_domoprime.15_documents' => 
    array (
      'title' => 'Documents',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListDocument',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_documents',
        ),
      ),
    ),
    'site_domoprime.29_as_premeeting_model' => 
    array (
      'title' => 'Pre meeting models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPreMeetingModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_premeting_model',
        ),
      ),
    ),
    'site_domoprime.29_as_after_work_model' => 
    array (
      'title' => 'After work models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListAfterWorkModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_afterwork_model',
        ),
      ),
    ),
    '25_customers' => 
    array (
      'childs' => 
      array (
        '100_customers_app_domoprime_cumacs' => NULL,
      ),
    ),
    '100_customers_app_domoprime_cumacs' => 
    array (
      'title' => 'Cumacs',
      'enabled' => true,
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPartialCalculation',
        ),
      ),
      'component' => '/app_domoprime/DashboardDocumentMenuItem',
    ),
    '90_configuration' => 
    array (
      'childs' => 
      array (
        '40_app_domoprime_configuration' => NULL,
      ),
    ),
    '40_app_domoprime_configuration' => 
    array (
      'title' => 'ISO',
      'enabled' => true,
      'childs' => 
      array (
        '00_app_domoprime_configuration_zone' => NULL,
        '10_app_domoprime_configuration_energy' => NULL,
        '20_app_domoprime_configuration_class' => NULL,
        '30_app_domoprime_configuration_quotation_model' => NULL,
        '40_app_domoprime_configuration__billing_model' => NULL,
        '50_app_domoprime_configuration_asset_model' => NULL,
        '60_app_domoprime_configuration_polluting' => NULL,
        '80_app_domoprime_configuration_premeeting_model' => NULL,
        '90_app_domoprime_configuration_settings' => NULL,
      ),
    ),
    '00_app_domoprime_configuration_zone' => 
    array (
      'title' => 'Sectors',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListZone',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
        ),
      ),
    ),
    '10_app_domoprime_configuration_energy' => 
    array (
      'title' => 'Energy',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListEnergy',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_energy',
        ),
      ),
    ),
    '20_app_domoprime_configuration_class' => 
    array (
      'title' => 'Classes',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListClass',
        ),
      ),
      'picture' => '/pictures/icons/customer.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_class',
        ),
      ),
    ),
    '30_app_domoprime_configuration_quotation_model' => 
    array (
      'title' => 'Quotation models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListQuotationModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_quotation_model',
        ),
      ),
    ),
    '40_app_domoprime_configuration__billing_model' => 
    array (
      'title' => 'Billing models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListBillingModel',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_billing_model',
        ),
      ),
    ),
    '50_app_domoprime_configuration_asset_model' => 
    array (
      'title' => 'Asset models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListAssetModel',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_asset_model',
        ),
      ),
    ),
    '90_app_domoprime_configuration_settings' => 
    array (
      'title' => 'Settings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'Settings',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_settings',
        ),
      ),
    ),
    '60_app_domoprime_configuration_polluting' => 
    array (
      'title' => 'Pollutings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPollutingCompany',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_polluters',
        ),
      ),
    ),
    '70_app_domoprime_configuration_documents' => 
    array (
      'title' => 'Documents',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListDocument',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_documents',
        ),
      ),
    ),
    '80_app_domoprime_configuration_premeeting_model' => 
    array (
      'title' => 'Pre meeting models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPreMeetingModel',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_premeting_model',
        ),
      ),
    ),
    '77_documents' => 
    array (
      'title' => 'Documents',
      'childs' => 
      array (
        '20_documents_app_domoprime_quotations' => NULL,
        '30_documents_app_domoprime_billings' => NULL,
        '40_documents_app_domoprime_assets' => NULL,
      ),
    ),
    '20_documents_app_domoprime_quotations' => 
    array (
      'title' => 'Quotations',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPartialQuotation',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'app_domoprime_quotation_list',
        ),
      ),
    ),
    '30_documents_app_domoprime_billings' => 
    array (
      'title' => 'Billings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPartialBilling',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'app_domoprime_billing_list',
        ),
      ),
    ),
    '40_documents_app_domoprime_assets' => 
    array (
      'title' => 'Assets',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPartialAsset',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'app_domoprime_asset_list',
        ),
      ),
    ),
    '80_statistics' => 
    array (
      'childs' => 
      array (
        '00_statistics_app_domoprime_report' => NULL,
        '10_statistics_app_domoprime_operation' => NULL,
      ),
    ),
    '00_statistics_app_domoprime_report' => 
    array (
      'title' => 'Cumac Report',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'Report',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'domoprime_report',
        ),
      ),
    ),
    '10_statistics_app_domoprime_operation' => 
    array (
      'title' => 'Operations',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'StatisticOperations',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'domoprime_statistics_operations',
        ),
      ),
    ),
    '0020_customers' => 
    array (
      'childs' => 
      array (
        '0010_customers_app_domoprime_cumacs' => NULL,
      ),
    ),
    '0010_customers_app_domoprime_cumacs' => 
    array (
      'title' => 'Cumacs',
      'enabled' => true,
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPartialCalculation',
        ),
      ),
      'component' => '/app_domoprime/DashboardDocumentMenuItem',
    ),
    '0040_domoprime_iso3_pac_boiler_ite_configuration' => 
    array (
      'title' => 'Configurations',
      'childs' => 
      array (
        '0030_site_domoprime.polluting' => NULL,
      ),
    ),
    '0030_site_domoprime.polluting' => 
    array (
      'title' => 'Pollutings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPollutingCompany',
        ),
      ),
      'picture' => '/pictures/icons/sav.jpg',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_polluters',
        ),
      ),
    ),
    '0120_documents' => 
    array (
      'childs' => 
      array (
        '0000_documents_app_domoprime_quotations' => NULL,
        '0010_documents_app_domoprime_billings' => NULL,
        '0020_documents_app_domoprime_assets' => NULL,
      ),
    ),
    '0000_documents_app_domoprime_quotations' => 
    array (
      'title' => 'Quotations',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPartialQuotation',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'app_domoprime_quotation_list',
        ),
      ),
    ),
    '0010_documents_app_domoprime_billings' => 
    array (
      'title' => 'Billings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPartialBilling',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'app_domoprime_billing_list',
        ),
      ),
    ),
    '0020_documents_app_domoprime_assets' => 
    array (
      'title' => 'Assets',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPartialAsset',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'app_domoprime_asset_list',
        ),
      ),
    ),
    '0140_accounting' => 
    array (
      'childs' => 
      array (
        '0000_statistics_app_domoprime_report' => NULL,
        '0010_statistics_app_domoprime_operation' => NULL,
      ),
    ),
    '0000_statistics_app_domoprime_report' => 
    array (
      'title' => 'Cumac Report',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'Report',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'domoprime_report',
        ),
      ),
    ),
    '0010_statistics_app_domoprime_operation' => 
    array (
      'title' => 'Operations',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'StatisticOperations',
        ),
      ),
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'domoprime_statistics_operations',
        ),
      ),
    ),
    '0070_iso_configuration' => 
    array (
      'childs' => 
      array (
        '0030_app_domoprime_configuration_zone' => NULL,
        '0040_app_domoprime_configuration_energy' => NULL,
        '0070_app_domoprime_configuration_class' => NULL,
        '0080_app_domoprime_configuration_quotation_model' => NULL,
        '0090_app_domoprime_configuration__billing_model' => NULL,
        '0100_app_domoprime_configuration_asset_model' => NULL,
        '0110_app_domoprime_configuration_polluting' => NULL,
        '0120_app_domoprime_configuration_premeeting_model' => NULL,
        '0140_site_domoprime.as_after_work_model' => NULL,
        '0150_app_domoprime_configuration_settings' => NULL,
      ),
    ),
    '0030_app_domoprime_configuration_zone' => 
    array (
      'title' => 'Sectors',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListZone',
        ),
      ),
      'picture' => '/pictures/icons/sectors.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
        ),
      ),
    ),
    '0040_app_domoprime_configuration_energy' => 
    array (
      'title' => 'Energy',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListEnergy',
        ),
      ),
      'picture' => '/module/app_domoprime/pictures/energy32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_energy',
        ),
      ),
    ),
    '0070_app_domoprime_configuration_class' => 
    array (
      'title' => 'Classes',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListClass',
        ),
      ),
      'picture' => '/pictures/icons/customer.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_class',
        ),
      ),
    ),
    '0080_app_domoprime_configuration_quotation_model' => 
    array (
      'title' => 'Quotation models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListQuotationModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_quotation_model',
        ),
      ),
    ),
    '0090_app_domoprime_configuration__billing_model' => 
    array (
      'title' => 'Billing models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListBillingModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_billing_model',
        ),
      ),
    ),
    '0100_app_domoprime_configuration_asset_model' => 
    array (
      'title' => 'Asset models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListAssetModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_asset_model',
        ),
      ),
    ),
    '0110_app_domoprime_configuration_polluting' => 
    array (
      'title' => 'Pollutings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPollutingCompany',
        ),
      ),
      'picture' => '/pictures/icons/sav.jpg',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_polluters',
        ),
      ),
    ),
    '0120_app_domoprime_configuration_premeeting_model' => 
    array (
      'title' => 'Pre meeting models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPreMeetingModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_premeting_model',
        ),
      ),
    ),
    '0140_site_domoprime.as_after_work_model' => 
    array (
      'title' => 'After work models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListAfterWorkModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_afterwork_model',
        ),
      ),
    ),
    '0150_app_domoprime_configuration_settings' => 
    array (
      'title' => 'Settings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'Settings',
        ),
      ),
      'picture' => '/pictures/icons/settings.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_settings',
        ),
      ),
    ),
    '0080_app_domoprime_iso2_configuration' => 
    array (
      'childs' => 
      array (
        '0010_app_domoprime_configuration_zone' => NULL,
        '0020_site_domoprime.energy' => NULL,
      ),
    ),
    '0010_app_domoprime_configuration_zone' => 
    array (
      'title' => 'Sectors',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListZone',
        ),
      ),
      'picture' => '/pictures/icons/sectors.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
        ),
      ),
    ),
    '0020_site_domoprime.energy' => 
    array (
      'title' => 'Energy',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListEnergy',
        ),
      ),
      'picture' => '/module/app_domoprime/pictures/energy32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_energy',
        ),
      ),
    ),
    '0090_participants_configuration' => 
    array (
      'childs' => 
      array (
        '0030_site_domoprime.polluting' => NULL,
        '0040_site_domoprime.quotation_model' => NULL,
        '0050_site_domoprime.billing_model' => NULL,
        '0060_site_domoprime.as_after_work_model' => NULL,
        '0070_site_domoprime.as_premeeting_model' => NULL,
        '0080_app_domoprime_configuration_asset_model' => NULL,
        '0100_site_domoprime.energy' => NULL,
        '0130_site_domoprime.polluting' => NULL,
      ),
    ),
    '0040_site_domoprime.quotation_model' => 
    array (
      'title' => 'Quotation models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListQuotationModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_quotation_model',
        ),
      ),
    ),
    '0050_site_domoprime.billing_model' => 
    array (
      'title' => 'Billing models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListBillingModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_billing_model',
        ),
      ),
    ),
    '0060_site_domoprime.as_after_work_model' => 
    array (
      'title' => 'After work models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListAfterWorkModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_afterwork_model',
        ),
      ),
    ),
    '0070_site_domoprime.as_premeeting_model' => 
    array (
      'title' => 'Pre meeting models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPreMeetingModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_premeting_model',
        ),
      ),
    ),
    '0080_app_domoprime_configuration_asset_model' => 
    array (
      'title' => 'Asset models',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListAssetModel',
        ),
      ),
      'picture' => '/pictures/icons/doc32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_asset_model',
        ),
      ),
    ),
    '0100_site_domoprime.energy' => 
    array (
      'title' => 'Energy',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListEnergy',
        ),
      ),
      'picture' => '/module/app_domoprime/pictures/energy32x32.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_energy',
        ),
      ),
    ),
    '0130_site_domoprime.polluting' => 
    array (
      'title' => 'Classes',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListClass',
        ),
      ),
      'picture' => '/pictures/icons/customer.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_class',
        ),
      ),
    ),
    '0100_chaudiere_pack_configuration' => 
    array (
      'childs' => 
      array (
        '0000_site_domoprime.class' => NULL,
        '0020_site_domoprime.polluting' => NULL,
      ),
    ),
    '0000_site_domoprime.class' => 
    array (
      'title' => 'Classes',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListClass',
        ),
      ),
      'picture' => '/pictures/icons/customer.png',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_class',
        ),
      ),
    ),
    '0020_site_domoprime.polluting' => 
    array (
      'title' => 'Pollutings',
      'route_ajax' => 
      array (
        'app_domoprime_ajax' => 
        array (
          'action' => 'ListPollutingCompany',
        ),
      ),
      'picture' => '/pictures/icons/sav.jpg',
      'help' => 'modify, add and delete status',
      'credentials' => 
      array (
        0 => 
        array (
          0 => 'superadmin',
          1 => 'admin',
          2 => 'settings_app_domoprime_polluters',
        ),
      ),
    ),
  ),
)