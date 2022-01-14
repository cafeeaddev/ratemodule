<?php

global $CFG;

require_once("$CFG->libdir/formslib.php");

class rating_form extends moodleform {
    //Add elements to form
    public function definition() {
        GLOBAL $USER;
        $cmid = optional_param('id', null, PARAM_INT);
        if (!$cmid) {
            $cmid = optional_param('cmid', null, PARAM_INT);
        }
        $mform = $this->_form; // Don't forget the underscore!
        $cdata = $this->_customdata;

        $mform->addElement('html', '<div class="estrelas">');

        if (!$cdata) {
            $mform->addElement('html', '<input type="radio" id="rate0" name="rating" value="0" checked>');

            $mform->addElement('html', '<label for="rate1"><i class="fa"></i></label>');
            $mform->addElement('html', '<input type="radio" id="rate1" name="rating" value="1" onchange="this.form.submit()">');

            $mform->addElement('html', '<label for="rate2"><i class="fa"></i></label>');
            $mform->addElement('html', '<input type="radio" id="rate2" name="rating" value="2" onchange="this.form.submit()">');

            $mform->addElement('html', '<label for="rate3"><i class="fa"></i></label>');
            $mform->addElement('html', '<input type="radio" id="rate3" name="rating" value="3" onchange="this.form.submit()">');

            $mform->addElement('html', '<label for="rate4"><i class="fa"></i></label>');
            $mform->addElement('html', '<input type="radio" id="rate4" name="rating" value="4" onchange="this.form.submit()">');

            $mform->addElement('html', '<label for="rate5"><i class="fa"></i></label>');
            $mform->addElement('html', '<input type="radio" id="rate5" name="rating" value="5" onchange="this.form.submit()">');
        } else {
            $mform->addElement('html', '<input type="radio" id="rate0" name="rating" value="0">');

            $mform->addElement('html', '<label><i class="fa"></i></label>');
            if ($cdata->rating == 1){
                $mform->addElement('html', '<input type="radio" id="rate1" name="rating" value="1" checked>');
            } else {
                $mform->addElement('html', '<input type="radio" id="rate1" name="rating" value="1" >');
            }

            $mform->addElement('html', '<label><i class="fa"></i></label>');
            if ($cdata->rating == 2){
                $mform->addElement('html', '<input type="radio" id="rate2" name="rating" value="2" checked>');
            } else {
                $mform->addElement('html', '<input type="radio" id="rate2" name="rating" value="2" >');
            }

            $mform->addElement('html', '<label><i class="fa"></i></label>');
            if ($cdata->rating == 3){
                $mform->addElement('html', '<input type="radio" id="rate3" name="rating" value="3" checked>');
            } else {
                $mform->addElement('html', '<input type="radio" id="rate3" name="rating" value="3" >');
            }

            $mform->addElement('html', '<label><i class="fa"></i></label>');
            if ($cdata->rating == 4){
                $mform->addElement('html', '<input type="radio" id="rate4" name="rating" value="4" checked>');
            } else {
                $mform->addElement('html', '<input type="radio" id="rate4" name="rating" value="4" >');
            }

            $mform->addElement('html', '<label><i class="fa"></i></label>');
            if ($cdata->rating == 5){
                $mform->addElement('html', '<input type="radio" id="rate5" name="rating" value="5" checked>');
            } else {
                $mform->addElement('html', '<input type="radio" id="rate5" name="rating" value="5" >');
            }
        }
        $mform->addElement('hidden', 'user', $USER->id);
        $mform->addElement('hidden', 'cmid', $cmid);
         
        $mform->addElement('html', '</div>');
        $mform->disable_form_change_checker();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
    
}

 