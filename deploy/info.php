<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'php_engines';
$app['version'] = '1.1.3';
$app['release'] = '1';
$app['vendor'] = 'WikiSuite';
$app['packager'] = 'eGloo';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('php_engines_app_description');
$app['powered_by'] = array(
    'vendor' => array(
        'name' => 'PHP',
        'url' => 'http://php.net',
    ),
);

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

$app['requires'] = array(
    'app-web-server'
);

$app['core_requires'] = array(
    'app-base-core >= 1:2.4.19',
    'app-date-core',
    'app-events-core',
    'app-php-engines-core',
    'app-php-core >= 1:2.3.2',
    'app-web-server-core >= 1:2.4.0',
    'app-flexshare-core >= 1:2.4.10',
    'clearos-base >= 7.0.2',
    'rh-php56-php-bcmath',
    'rh-php56-php-cli',
    'rh-php56-php-common',
    'rh-php56-php-fpm',
    'rh-php56-php-gd',
    'rh-php56-php-intl',
    'rh-php56-php-ldap',
    'rh-php56-php-mbstring',
    'rh-php56-php-pecl-memcache',
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
    'rh-php71-php-bcmath',
    'rh-php71-php-cli',
    'rh-php71-php-common',
    'rh-php71-php-fpm',
    'rh-php71-php-gd',
    'rh-php71-php-gmp',
    'rh-php71-php-intl',
    'rh-php71-php-json',
    'rh-php71-php-ldap',
    'rh-php71-php-mbstring',
    'rh-php71-php-mysqlnd',
    'rh-php71-php-opcache',
    'rh-php71-php-pdo',
    'rh-php71-php-pear',
    'rh-php71-php-process',
    'rh-php71-php-soap',
    'rh-php71-php-xml',
    'rh-php71-php-zip',
);

$app['core_directory_manifest'] = array(
    '/var/clearos/php_engines' => array(),
    '/var/clearos/php_engines/backup' => array(),
    '/var/clearos/php_engines/state' => array()
);

$app['core_file_manifest'] = array(
    'rh-php56-php-fpm.php' => array('target' => '/var/clearos/base/daemon/rh-php56-php-fpm.php'),
    'rh-php70-php-fpm.php' => array('target' => '/var/clearos/base/daemon/rh-php70-php-fpm.php'),
    'rh-php71-php-fpm.php' => array('target' => '/var/clearos/base/daemon/rh-php71-php-fpm.php'),
    'apache-php_engines_path.conf' => array(
        'target' => '/etc/httpd/conf.d/php_engines_path.conf',
        'config' => TRUE,
        'config_params' => 'noreplace'
    ),
    'date-event'=> array(
        'target' => '/var/clearos/events/date/php_engines',
        'mode' => '0755'
    ),
    'php_engines.conf' => array (
        'target' => '/etc/clearos/php_engines.conf',
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
    'php_wrapper'=> array(
        'target' => '/usr/clearos/bin/php',
        'mode' => '0755'
    ),
    'www_path.conf' => array(
        'target' => [
            '/etc/opt/rh/rh-php56/php-fpm.d/www_path.conf',
            '/etc/opt/rh/rh-php70/php-fpm.d/www_path.conf',
            '/etc/opt/rh/rh-php71/php-fpm.d/www_path.conf'
        ],
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
);

$app['delete_dependency'] = array(
    'app-php-engines-core',
);
