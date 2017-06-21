<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'php_engines';
$app['version'] = '1.0.0';
$app['release'] = '1';
$app['vendor'] = 'WikiSuite';
$app['packager'] = 'eGloo';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('php_engines_app_description');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('php_engines_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = lang('base_subcategory_web');

/////////////////////////////////////////////////////////////////////////////
// Controllers
/////////////////////////////////////////////////////////////////////////////

$app['controllers']['php_engines']['title'] = $app['name'];
$app['controllers']['settings']['title'] = lang('base_settings');
$app['controllers']['policy']['title'] = lang('base_app_policy');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_requires'] = array(
    'app-php-engines-core',
    'app-php-core',
    'rh-php56-php-bcmath',
    'rh-php56-php-cli',
    'rh-php56-php-common',
    'rh-php56-php-fpm',
    'rh-php56-php-gd',
    'rh-php56-php-intl',
    'rh-php56-php-ldap',
    'rh-php56-php-mbstring',
    'rh-php56-php-mysqlnd',
    'rh-php56-php-opcache',
    'rh-php56-php-pdo',
    'rh-php56-php-pear',
    'rh-php56-php-soap',
    'rh-php56-php-xml',
    'rh-php56-php-xmlrpc',
    'rh-php70-php-bcmath',
    'rh-php70-php-cli',
    'rh-php70-php-common',
    'rh-php70-php-fpm',
    'rh-php70-php-gd',
    'rh-php70-php-intl',
    'rh-php70-php-ldap',
    'rh-php70-php-mbstring',
    'rh-php70-php-mysqlnd',
    'rh-php70-php-opcache',
    'rh-php70-php-pdo',
    'rh-php70-php-pear',
    'rh-php70-php-soap',
    'rh-php70-php-xml',
);

$app['core_directory_manifest'] = array(
    '/var/clearos/php_engines' => array(),
    '/var/clearos/php_engines/backup' => array(),
    '/var/clearos/php_engines/state' => array()
);

$app['core_file_manifest'] = array(
    'rh-php56-php-fpm.php' => array('target' => '/var/clearos/base/daemon/rh-php56-php-fpm.php'),
    'rh-php70-php-fpm.php' => array('target' => '/var/clearos/base/daemon/rh-php70-php-fpm.php')
);

$app['delete_dependency'] = array(
    'app-php-engines-core',
);
