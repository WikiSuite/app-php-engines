
Name: app-php-engines
Epoch: 1
Version: 1.0.4
Release: 1%{dist}
Summary: PHP Engines
License: GPLv3
Group: ClearOS/Apps
Packager: eGloo
Vendor: WikiSuite
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base
Requires: app-web-server

%description
With PHP Engines, an administrator can select the PHP version to run inside each web server virtual host.

%package core
Summary: PHP Engines - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: app-base-core >= 1:2.3.40
Requires: app-date-core
Requires: app-events-core
Requires: app-php-engines-core
Requires: app-php-core >= 1:2.3.2
Requires: app-web-server-core >= 1:2.4.0
Requires: app-flexshare-core >= 1:2.4.10
Requires: clearos-base >= 7.0.2
Requires: rh-php56-php-bcmath
Requires: rh-php56-php-cli
Requires: rh-php56-php-common
Requires: rh-php56-php-fpm
Requires: rh-php56-php-gd
Requires: rh-php56-php-intl
Requires: rh-php56-php-ldap
Requires: rh-php56-php-mbstring
Requires: rh-php56-php-pecl-memcache
Requires: rh-php56-php-mysqlnd
Requires: rh-php56-php-opcache
Requires: rh-php56-php-pdo
Requires: rh-php56-php-pear
Requires: rh-php56-php-soap
Requires: rh-php56-php-xml
Requires: rh-php56-php-xmlrpc
Requires: rh-php70-php-bcmath
Requires: rh-php70-php-cli
Requires: rh-php70-php-common
Requires: rh-php70-php-fpm
Requires: rh-php70-php-gd
Requires: rh-php70-php-intl
Requires: rh-php70-php-ldap
Requires: rh-php70-php-mbstring
Requires: rh-php70-php-mysqlnd
Requires: rh-php70-php-opcache
Requires: rh-php70-php-pdo
Requires: rh-php70-php-pear
Requires: rh-php70-php-soap
Requires: rh-php70-php-xml

%description core
With PHP Engines, an administrator can select the PHP version to run inside each web server virtual host.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/php_engines
cp -r * %{buildroot}/usr/clearos/apps/php_engines/

install -d -m 0755 %{buildroot}/var/clearos/php_engines
install -d -m 0755 %{buildroot}/var/clearos/php_engines/backup
install -d -m 0755 %{buildroot}/var/clearos/php_engines/state
install -D -m 0755 packaging/date-event %{buildroot}/var/clearos/events/date/php_engines
install -D -m 0644 packaging/php_engines.conf %{buildroot}/etc/clearos/php_engines.conf
install -D -m 0755 packaging/php_wrapper %{buildroot}/usr/clearos/bin/php
install -D -m 0644 packaging/rh-php56-php-fpm.php %{buildroot}/var/clearos/base/daemon/rh-php56-php-fpm.php
install -D -m 0644 packaging/rh-php70-php-fpm.php %{buildroot}/var/clearos/base/daemon/rh-php70-php-fpm.php

%post
logger -p local6.notice -t installer 'app-php-engines - installing'

%post core
logger -p local6.notice -t installer 'app-php-engines-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/php_engines/deploy/install ] && /usr/clearos/apps/php_engines/deploy/install
fi

[ -x /usr/clearos/apps/php_engines/deploy/upgrade ] && /usr/clearos/apps/php_engines/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-php-engines - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-php-engines-core - uninstalling'
    [ -x /usr/clearos/apps/php_engines/deploy/uninstall ] && /usr/clearos/apps/php_engines/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/php_engines/controllers
/usr/clearos/apps/php_engines/htdocs
/usr/clearos/apps/php_engines/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/php_engines/packaging
%exclude /usr/clearos/apps/php_engines/unify.json
%dir /usr/clearos/apps/php_engines
%dir /var/clearos/php_engines
%dir /var/clearos/php_engines/backup
%dir /var/clearos/php_engines/state
/usr/clearos/apps/php_engines/deploy
/usr/clearos/apps/php_engines/language
/usr/clearos/apps/php_engines/libraries
/var/clearos/events/date/php_engines
%config(noreplace) /etc/clearos/php_engines.conf
/usr/clearos/bin/php
/var/clearos/base/daemon/rh-php56-php-fpm.php
/var/clearos/base/daemon/rh-php70-php-fpm.php
