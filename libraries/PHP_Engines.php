<?php

/**
 * PHP engines class.
 *
 * @category   apps
 * @package    php-engines
 * @subpackage libraries
 * @author     Marc Laporte
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://github.com/eglooca/app-php-engines
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// N A M E S P A C E
///////////////////////////////////////////////////////////////////////////////

namespace clearos\apps\php_engines;

///////////////////////////////////////////////////////////////////////////////
// B O O T S T R A P
///////////////////////////////////////////////////////////////////////////////

$bootstrap = getenv('CLEAROS_BOOTSTRAP') ? getenv('CLEAROS_BOOTSTRAP') : '/usr/clearos/framework/shared';
require_once $bootstrap . '/bootstrap.php';

///////////////////////////////////////////////////////////////////////////////
// T R A N S L A T I O N S
///////////////////////////////////////////////////////////////////////////////

clearos_load_language('php_engines');

///////////////////////////////////////////////////////////////////////////////
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

use \clearos\apps\base\Daemon as Daemon;
use \clearos\apps\base\Engine as Engine;
use \clearos\apps\base\File as File;

clearos_load_library('base/Daemon');
clearos_load_library('base/Engine');
clearos_load_library('base/File');

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * PHP engines class.
 *
 * @category   apps
 * @package    php-engines
 * @subpackage libraries
 * @author     Marc Laporte
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://github.com/eglooca/app-php-engines
 */

class PHP_Engines extends Engine
{
    ///////////////////////////////////////////////////////////////////////////////
    // V A R I A B L E S
    ///////////////////////////////////////////////////////////////////////////////

    protected $services = array();
    protected $supported = array(
        'rh-php56-php-fpm',
        'rh-php70-php-fpm'
    );

    const PATH_DAEMONS = '/var/clearos/base/daemon';

    ///////////////////////////////////////////////////////////////////////////////
    // M E T H O D S
    ///////////////////////////////////////////////////////////////////////////////

    /**
     * Services constructor.
     */

    function __construct()
    {
        clearos_profile(__METHOD__, __LINE__);
    }

    /**
     * Returns list of daemon services.
     *
     * @return array list of daemon services.
     * @throws Engine_Exception
     */

    public function get_services()
    {
        clearos_profile(__METHOD__, __LINE__);
        
        foreach ($this->supported as $service) {
            $filename = self::PATH_DAEMONS . '/' . $service . '.php';
            $file = new File($filename);

            if ($file->exists())
                $services[] = $service;
        }

        return $services;
    }

    /**
     * Returns information on daemon services.
     *
     * @return array information on daemon services.
     * @throws Engine_Exception
     */

    public function get_services_info()
    {
        clearos_profile(__METHOD__, __LINE__);

        $services_info = array();

        foreach ($this->get_services() as $daemon_name) {
            $daemon = new Daemon($daemon_name);

            if (! $daemon->is_installed())
                continue;

            $services_info[$daemon_name]['description'] = $daemon->get_title(); //details['title'];
            $services_info[$daemon_name]['running_state'] = $daemon->get_running_state();
            $services_info[$daemon_name]['boot_state'] = $daemon->get_boot_state();
            $services_info[$daemon_name]['multiservice'] = $daemon->is_multiservice();
            $services_info[$daemon_name]['url'] = $daemon->get_app_url();
        }

        return $services_info;
    }
}
