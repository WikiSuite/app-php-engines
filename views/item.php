<?php

/**
 * PHP engines item view.
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
// Infoboxes
///////////////////////////////////////////////////////////////////////////////

if (!empty($deployed))
    echo infobox_highlight(lang('php_engines_deployed'), lang('php_engines_deployed_help'));


///////////////////////////////////////////////////////////////////////////////
// Form
///////////////////////////////////////////////////////////////////////////////

$buttons = array();

if (empty($deployed) && $running_state && !$builtin_engine)
    $buttons[] = anchor_disable('/app/php_engines/settings/confirm_disable/' . $engine, 'low');

if (!$running_state)
    $buttons[] = anchor_enable('/app/php_engines/settings/enable/' . $engine, 'low');

$buttons[] = anchor_custom('/app/php_engines/settings', lang('base_return_to_summary'));

echo form_open('php_engines/settings/view');
echo form_header($title);

echo field_toggle_enable_disable('running_state', $running_state, lang('base_status'), TRUE);
echo field_button_set($buttons);

echo form_footer();
echo form_close();

///////////////////////////////////////////////////////////////////////////////
// Deployed state
///////////////////////////////////////////////////////////////////////////////

$items = array();
$anchors = array();

$headers = array(
    lang('php_engines_app'),
    lang('base_details'),
);

foreach ($deployed as $engine) {
    $item['title'] = $engine['app_description'];
    $item['details'] = array(
        $engine['app_description'],
        $engine['app_key'],
    );

    $items[] = $item;
}

$options['no_action'] = TRUE;
$options['empty_table_message'] = lang('php_engines_not_in_use');

echo summary_table(
    lang('php_engines_deployed'),
    $anchors,
    $headers,
    $items,
    $options
);
