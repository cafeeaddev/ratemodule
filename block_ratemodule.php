<?php
/**
 * Ratemodule block caps.
 *
 * @package    block_ratemodule
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
            //For some Moodle pages where id is represented as cmid
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

        //$CFG->cachejs = false;
        //$PAGE->requires->js('path/to/plugin/javascript/jquery-1.4.2.min.js');
        //$PAGE->requires->jquery();

        $this->content = '';
        if (empty($currentcontext)) {
            return $this->content;
        }

        if (!$cmid) {
            return null;
        }
        
        $table = 'block_ratemodule';
        //Checks if the user already rated the activity
        $exRating = $DB->get_record($table, array("userid"=>$USER->id, "coursemoduleid"=>$cmid));

        require_once('rating_form.php');
        //Creates the form used to rate the activity
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

                //Inserts the rating in the database
                $DB->insert_record($table, $record);

                $exRating = $DB->get_record($table, array("userid"=>$USER->id, "coursemoduleid"=>$cmid));
                $mform = new rating_form($PAGE->url->out(false), $exRating);
            }
        }

        $this->content->text = $mform->render();
        return $this->content;
    }

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
        return true;
    }

    function _self_test() {
        return true;
    }
}
