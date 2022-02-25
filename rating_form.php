<?php

global $CFG;

require_once("$CFG->libdir/formslib.php");

class rating_form extends moodleform {
    //Add elements to form
    public function definition() {
        GLOBAL $USER, $CFG;
        
        require_once("custom_radio.php");
        //Registering custom radio element
        MoodleQuickForm::registerElementType('custom_radio',
                                         "$CFG->dataroot/blocks/ratemodule/custom_radio.php",
                                         'Custom_QuickForm_radio');
        $cmid = optional_param('id', null, PARAM_INT);
        if (!$cmid) {
            //For some Moodle pages where id is represented as cmid
            $cmid = optional_param('cmid', null, PARAM_INT);
        }

        $mform = $this->_form;
        $cdata = $this->_customdata;

        $mform->addElement('html', '<div class="estrelas">');
        $radioarray=array();

        //Checks if the user already rated this activity
        if (!$cdata) {
            $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '0', ['id'=>'rate0', 'checked'=>'true']);
            $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '1', ['id'=>'rate1', 'onchange'=>'this.form.submit()']);
            $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '2', ['id'=>'rate2', 'onchange'=>'this.form.submit()']);
            $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '3', ['id'=>'rate3', 'onchange'=>'this.form.submit()']);
            $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '4', ['id'=>'rate4', 'onchange'=>'this.form.submit()']);
            $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '5', ['id'=>'rate5', 'onchange'=>'this.form.submit()']);
        } else {
            
            if ($cdata->rating == 1) {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '1', ['id'=>'rate1', 'noedit'=>'true', 'selected'=>'true', 'checked'=>'true']);
            } else {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '1', ['id'=>'rate1', 'noedit'=>'true']);
            }
            if ($cdata->rating == 2) {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '2', ['id'=>'rate2', 'noedit'=>'true', 'selected'=>'true', 'checked'=>'true']);
            } else {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '2', ['id'=>'rate2', 'noedit'=>'true']);
            }
            if ($cdata->rating == 3) {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '3', ['id'=>'rate3', 'noedit'=>'true', 'selected'=>'true', 'checked'=>'true']);
            } else {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '3', ['id'=>'rate3', 'noedit'=>'true']);
            }
            if ($cdata->rating == 4) {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '4', ['id'=>'rate4', 'noedit'=>'true', 'selected'=>'true', 'checked'=>'true']);
            } else {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '4', ['id'=>'rate4', 'noedit'=>'true']);
            }
            if ($cdata->rating == 5) {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '5', ['id'=>'rate5', 'noedit'=>'true', 'selected'=>'true', 'checked'=>'true']);
            } else {
                $radioarray[] = $mform->createElement('custom_radio', 'rating', '', '', '5', ['id'=>'rate5', 'noedit'=>'true']);
            }
            
        }
        $mform->addGroup($radioarray, 'radioarr', '', array(' '), false);
        $mform->addElement('hidden', 'user', $USER->id);
        $mform->addElement('hidden', 'cmid', $cmid);

        $mform->addElement('html', '</div>');
        $systemcontext = context_system::instance();
        if(has_capability('moodle/site:config', $systemcontext)) {
            $mform->addElement('html', '<div style="background: #dbdbdb; text-align: center;"><a href="'.$CFG->wwwroot.'/blocks/ratemodule/report">Report</a></div>');
        }
        //If activity has already been rated, disables editing on the form
        $mform->disable_form_change_checker();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }

}
