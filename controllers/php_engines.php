<?php

/**
 * PHP controller.
 *
 * @category   Apps
 * @package    PHP
 * @subpackage Views
 * @author     Your name <your@e-mail>
 * @copyright  2013 Your name / Company
 * @license    Your license
 */

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * PHP controller.
 *
 * @category   Apps
 * @package    PHP
 * @subpackage Controllers
 * @author     Your name <your@e-mail>
 * @copyright  2013 Your name / Company
 * @license    Your license
 */

class Php_engines extends ClearOS_Controller
{
    /**
     * PHP default controller.
     *
     * @return view
     */

    function index()
    {
        // Load dependencies
        //------------------

        $this->lang->load('php_engines');

        // Load views
        //-----------

        $this->page->view_form('php_engines', NULL, lang('php_engines_app_name'));
    }
}
