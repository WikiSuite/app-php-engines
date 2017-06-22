<?php

/**
 * PHP engine base class.
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
use \clearos\apps\php_engines\PHP_Engines as PHP_Engines;

clearos_load_library('base/Daemon');
clearos_load_library('php_engines/PHP_Engines');

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * PHP engine base class.
 *
 * @category   apps
 * @package    php-engines
 * @subpackage libraries
 * @author     Marc Laporte
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://github.com/eglooca/app-php-engines
 */

class PHP_Engine extends Daemon
{
    ///////////////////////////////////////////////////////////////////////////////
    // V A R I A B L E S
    ///////////////////////////////////////////////////////////////////////////////

    protected $config = NULL;
    protected $engine = '';

    ///////////////////////////////////////////////////////////////////////////////
    // M E T H O D S
    ///////////////////////////////////////////////////////////////////////////////

    /**
     * PHP Engine constructor.
     */

    function __construct($engine)
    {
        clearos_profile(__METHOD__, __LINE__);

        $this->engine = $engine;

        parent::__construct($engine);
    }

    /**
     * Returns engine use from state file.
     *
     * @return array state
     * @throws Engine_Exception
     */

    public function get_deployed_state()
    {
        clearos_profile(__METHOD__, __LINE__);

        $php = new PHP_Engines();

        return $php->get_deployed_state($this->engine);
    }

    /**
     * Returns engine description.
     *
     * @return string version
     * @throws Engine_Exception
     */

    public function get_php_description()
    {
        clearos_profile(__METHOD__, __LINE__);

        $php = new PHP_Engines();

        $engines = $php->get_engines();

        return $engines[$this->engine];
    }
}
