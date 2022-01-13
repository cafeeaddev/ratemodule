<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Ratemodule block caps.
 *
 * @package    block_ratemodule
 * @copyright  Daniel Neis <danielneis@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_ratemodule extends block_base {

    function init() {
        $this->title = get_string('blocktitle', 'block_ratemodule');
    }

    function get_content() {
        global $CFG, $OUTPUT, $USER, $PAGE, $DB;
        $cmid = optional_param('id', null, PARAM_INT);
        if (!$cmid) {
            $cmid = optional_param('cmid', null, PARAM_INT);
        }

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        // user/index.php expect course context, so get one if page has module context.
        $currentcontext = $this->page->context->get_course_context(false);

        $this->content = '';
        if (empty($currentcontext)) {
            return $this->content;
        }

        if (!$cmid) {
            return null;
        }
        $table = 'block_ratemodule';
        $exRating = $DB->get_record($table, array("userid"=>$USER->id, "coursemoduleid"=>$cmid));

        require_once('rating_form.php');
        $mform = new rating_form($PAGE->url->out(false), $exRating);

        //Form processing and displaying is done here
        if ($mform->is_cancelled()) {
            //Handle form cancel operation, if cancel button is present on form
        } else if ($fromform = $mform->get_data()) {
            //In this case you process validated data. $mform->get_data() returns data posted in form.
            if ($data = $mform->get_data()) {
                $rating = $_POST['rating'];
                $user = $data->user;
                $cmid = $data->cmid;

                $record = new stdClass();
                $record->rating = $rating;
                $record->timecreated = time();
                $record->userid = intval($user);
                $record->coursemoduleid = intval($cmid);


                //var_dump($record);

                $DB->insert_record($table, $record);

                $exRating = $DB->get_record($table, array("userid"=>$USER->id, "coursemoduleid"=>$cmid));
                $mform = new rating_form($PAGE->url->out(false), $exRating);
            }
        }

        $this->content->text = $mform->render();
        return $this->content;
    }

    // my moodle can only have SITEID and it's redundant here, so take it away
    public function applicable_formats() {
        return array('all' => false,
                     'site' => true,
                     'site-index' => true,
                     'course-view' => true, 
                     'course-view-social' => false,
                     'mod' => true, 
                     'mod-quiz' => false);
    }

    public function instance_allow_multiple() {
        return true;
    }

    function has_config() {return true;}

    public function cron() {
        mtrace( "Hey, my cron script is running" );
        return true;
    }

    function _self_test() {
        return true;
    }
}
