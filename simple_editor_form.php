<?php

require_once('../../config.php');
require_once($CFG->libdir.'/formslib.php');

/**
 * Custom form class to manage separate "Passed" and "Failed" forms.
 */
class simple_editor_form extends moodleform {
    protected $customdata;
    protected $defaultdata;

    /**
     * Constructor for the simple_editor_form.
     * 
     * @param string|null $customdata Custom data to differentiate forms.
     */
    public function __construct($customdata = null, $defaultdata = null) {
        $this->customdata = $customdata;
        $this->defaultdata = $defaultdata;
        parent::__construct();
    }

    /**
     * Form definition method.
     */
    protected function definition() {
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('header', 'customheader', $this->customdata . ' Email Editor');
        
        // Adding an editor field for the message, the name of the editor field includes the custom data
        $message = $this->customdata . 'message';
        $mform->addElement('editor', $message);
        $mform->setType($message, PARAM_RAW);  // Set to PARAM_RAW to avoid Moodle cleaning the HTML content

        if (!empty($this->defaultdata)) {
            $mform->setDefault($message, array('text' => $this->defaultdata));
        }
        // A hidden element to identify which form is submitted
        $mform->addElement('hidden', 'formtype', $this->customdata);
        $mform->setType('formtype', PARAM_ALPHANUMEXT);  // Alphanumeric and extended characters only

        // Submit button, uniquely named by appending the custom data
        $mform->addElement('submit', $this->customdata . 'submitbutton', get_string('submit'));
    }
}
