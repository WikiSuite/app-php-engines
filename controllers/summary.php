<?php

/**
 * PHP engines summary controller.
 *
 * @category   apps
 * @package    php-engines
 * @subpackage controllers
 * @author     Marc Laporte
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://github.com/eglooca/app-php-engines
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * PHP engines summary controller.
 *
 * @category   apps
 * @package    php_engines
 * @subpackage controllers
 * @author     Marc Laporte
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://github.com/eglooca/app-php-engines
 */

class Summary extends ClearOS_Controller
{
    /**
     * PHP summary default controller.
     *
     * @return view
     */

    function index()
    {
        clearos_profile(__METHOD__, __LINE__);

        // Load dependencies
        //------------------

        $this->lang->load('php_engines');
        $this->load->library('php_engines/PHP_Engines');

        // Load view data
        //---------------

        try {
            $data['services'] = $this->php_engines->get_services_info();
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        $this->page->view_form('php_engines/summary', $data, lang('services_services'));
    }

    /**
     * Daemon start/stop toggle.
     *
     * @return JSON
     */

    function start_toggle()
    {
        clearos_profile(__METHOD__, __LINE__);

        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');

        $daemon = $this->input->post('service');

        $this->load->library('base/Daemon', $daemon);

        try {
            $state = $this->daemon->get_running_state();
            $this->daemon->set_running_state(!$state);
            echo json_encode(Array('code' => 0, 'running_state' => $this->daemon->get_running_state()));
        } catch (Exception $e) {
            echo json_encode(Array('code' => clearos_exception_code($e), 'errmsg' => clearos_exception_message($e)));
            return;
        }
    }

    /**
     * Daemon on boot toggle.
     *
     * @return JSON
     */

    function boot_toggle()
    {
        clearos_profile(__METHOD__, __LINE__);

        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');

        $daemon = $this->input->post('service');

        $this->load->library('base/Daemon', $daemon);

        try {
            $state = $this->daemon->get_boot_state();
            $this->daemon->set_boot_state(!$state);
            echo json_encode(Array('code' => 0, 'boot_state' => $this->daemon->get_boot_state()));
        } catch (Exception $e) {
            echo json_encode(Array('code' => clearos_exception_code($e), 'errmsg' => clearos_exception_message($e)));
            return;
        }
    }

    /**
     * Daemon start.
     *
     * @return view
     */

    function start($daemon)
    {
        clearos_profile(__METHOD__, __LINE__);

        $this->load->library('base/Daemon', $daemon);

        try {
            $this->daemon->set_running_state(TRUE);
            redirect('/services/');
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }
    }

    /**
     * Daemon stop.
     *
     * @return view
     */

    function stop($daemon)
    {
        clearos_profile(__METHOD__, __LINE__);

        $this->load->library('base/Daemon', $daemon);

        try {
            $this->daemon->set_running_state(FALSE);
            redirect('/services/');
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }
    }

    /**
     * Daemon start on boot
     *
     * @return view
     */

    function boot_start($daemon)
    {
        clearos_profile(__METHOD__, __LINE__);
        $this->load->library('base/Daemon', $daemon);

        try {
            $this->daemon->set_boot_state(TRUE);
            redirect('/services/');
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }
    }

    /**
     * Daemon stop on boot
     *
     * @return view
     */

    function boot_stop($daemon)
    {
        clearos_profile(__METHOD__, __LINE__);
        $this->load->library('base/Daemon', $daemon);

        try {
            $this->daemon->set_boot_state(FALSE);
            redirect('/services/');
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }
    }

    /**
     * Ajax daemon status response.
     *
     * @return JSON
     */

    function status()
    {
        clearos_profile(__METHOD__, __LINE__);

        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');

        // Load dependencies
        //------------------

        $this->load->library('services/Services');

        // Load view data
        //---------------

        try {
            $services = $this->services->get_services_info();
            echo json_encode(   
                array(
                    'code' => 0,
                    'services' => $services
                )
            );
        } catch (Exception $e) {
            echo json_encode(Array('code' => clearos_exception_code($e), 'errmsg' => clearos_exception_message($e)));
        }
    }
}
