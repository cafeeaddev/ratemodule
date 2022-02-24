<?php

global $CFG;

require_once("$CFG->dirroot/lib/pear/HTML/QuickForm/radio.php");

class Custom_QuickForm_radio extends HTML_QuickForm_radio {
    function toHtml()
    {
        $newLabel = '';
        $result = '';
        if (($this->getAttribute('id') != "rate0") and (!$this->getAttribute('noedit'))) {
            $newLabel = '<label for="' . $this->getAttribute('id') . '"><i class="fa"></i></label>';
        } else {
            if ($this->getAttribute('noedit')) {
                $result .= '<label><i class="fa"></i></label>';
                if ($this->getAttribute('selected')) {
                    $checked = 'checked="true"';
                } else {
                    $checked = '';
                }
                
            } else {
                $checked = 'checked="true"';
            }
            $result .= '<input type="radio" id="' . $this->getAttribute('id') . '" name="' . $this->getAttribute('name') . '" value="' . $this->getAttribute('value') . '" '.$checked.'>';
            return $result;
        }
        $newLabel = $newLabel. $this->_text ;
        return $newLabel . HTML_QuickForm_input::toHtml();
        
    }
}