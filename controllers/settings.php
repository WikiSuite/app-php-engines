<?php

/**
 * PHP engines settings controller.
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
 * PHP engines settings controller.
 *
 * @category   apps
 * @package    php_engines
 * @subpackage controllers
 * @author     Marc Laporte
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://github.com/eglooca/app-php-engines
 */

class Settings extends ClearOS_Controller
{
    /**
     * PHP settings default controller.
     *
     * @return view
     */

    function index()
    {
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

        $this->page->view_form('php_engines/summary', $data, lang('php_engines_php_engines'));
    }

    /**
     * Confirm disable view.
     *
     * @param string $engine engine name
     *
     * @return view
     */

    function confirm_disable($engine = NULL)
    {
        // Load dependencies
        //------------------

        $this->load->library('php_engines/PHP_Engine', $engine);

        // Load view data
        //---------------

        try {
            $title = $this->php_engine->get_title();
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        $confirm_uri = '/app/php_engines/settings/disable/' . $engine;
        $cancel_uri = '/app/php_engines/settings/view/' . $engine;
        $message = lang('php_engines_confirm_disable') . ' ' . $title;

        $this->page->view_confirm($message, $confirm_uri, $cancel_uri);
    }

    /**
     * Disable view.
     *
     * @param string $engine engine name
     *
     * @return view
     */

    function disable($engine = NULL)
    {
        // Load dependencies
        //------------------

        $this->load->library('php_engines/PHP_Engine', $engine);

        // Load view data
        //---------------

        try {
            $title = $this->php_engine->set_boot_state(FALSE);
            $title = $this->php_engine->set_running_state(FALSE);
            redirect('/php_engines/settings');
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }
    }

    /**
     * Enable view.
     *
     * @param string $engine engine name
     *
     * @return view
     */

    function enable($engine = NULL)
    {
        // Load dependencies
        //------------------

        $this->load->library('php_engines/PHP_Engine', $engine);

        // Load view data
        //---------------

        try {
            $title = $this->php_engine->set_boot_state(TRUE);
            $title = $this->php_engine->set_running_state(TRUE);
            redirect('/php_engines/settings');
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }
    }

    /**
     * PHP item view.
     *
     * @return view
     */

    function view($engine)
    {
        // Load dependencies
        //------------------

        $this->lang->load('php_engines');
        $this->load->library('php_engines/PHP_Engine', $engine);

        // Load view data
        //---------------

        try {
            $data['title'] = $this->php_engine->get_title();
            $data['boot_state'] = $this->php_engine->get_boot_state();
            $data['running_state'] = $this->php_engine->get_running_state();
            $data['engine'] = $engine;
            $data['deployed'] = [ ];
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        $this->page->view_form('php_engines/item', $data, lang('php_engines_php_engine'));
    }
}
