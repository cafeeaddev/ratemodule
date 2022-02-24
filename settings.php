<?php
/**
 * Ratemodule block caps.
 *
 * @package    block_ratemodule
 */

defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_heading('sampleheader',
                                         get_string('headerconfig', 'block_ratemodule'),
                                         get_string('descconfig', 'block_ratemodule')));

$settings->add(new admin_setting_configcheckbox('ratemodule/foo',
                                                get_string('labelfoo', 'block_ratemodule'),
                                                get_string('descfoo', 'block_ratemodule'),
                                                '0'));
