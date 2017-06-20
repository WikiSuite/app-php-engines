<?php

/**
 * PHP engines summary view.
 *
 * @category   apps
 * @package    php-engines
 * @subpackage views
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
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('base');
$this->lang->load('php_engines');

///////////////////////////////////////////////////////////////////////////////
// Headers
///////////////////////////////////////////////////////////////////////////////

$headers = array(
    lang('base_description'),
    lang('php_engines_in_use')
);

///////////////////////////////////////////////////////////////////////////////
// Anchors
///////////////////////////////////////////////////////////////////////////////

$anchors = array();

///////////////////////////////////////////////////////////////////////////////
// Items
///////////////////////////////////////////////////////////////////////////////

foreach ($services as $service => $details) {

    if ($details['boot_state'])
        $boot_status = "<span class='clearos-boot-status'><i class='fa fa-check-circle'></i></span>";
    else
        $boot_status = "<span class='clearos-boot-status'>-</span>";

    $buttons = button_set(array(
        anchor_view('/app/php_engines/view/' . $service)
    ));

    $item['title'] = $service;
    $item['current_state'] = (bool)$details['running_state'];
    $item['action'] = $action;
    $item['anchors'] = $buttons;
    $item['details'] = array(
        $details['description'],
        $boot_status
    );

    $items[] = $item;
}

///////////////////////////////////////////////////////////////////////////////
// Summary table
///////////////////////////////////////////////////////////////////////////////

$options = array (
    'sort-default-col' => 1,
    'row-enable-disable' => TRUE,
);

echo summary_table(
    lang('services_services'),
    $anchors,
    $headers,
    $items,
    $options
);
