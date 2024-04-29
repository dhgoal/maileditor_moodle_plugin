<?php
require('../../config.php');
require_login();
require_once('./lib.php');
require('./simple_editor_form.php');
require('./db/datalib.php');

global $DB, $USER;

$context = context_system::instance();
require_capability('local/maileditor:edit', $context);

local_maileditor_init();

$passed_template = $DB->get_record('local_maileditor_templates', ['type' => 'passed']);
$failed_template = $DB->get_record('local_maileditor_templates', ['type' => 'failed']);

$passed_form = new simple_editor_form("Passed", $passed_template ? $passed_template->content : null);
$failed_form = new simple_editor_form("Failed", $failed_template ? $failed_template->content : null);

echo $OUTPUT->header();

// Check which submit button was pressed
$from_passed = optional_param('Passedsubmitbutton', false, PARAM_BOOL);
$from_failed = optional_param('Failedsubmitbutton', false, PARAM_BOOL);

if ($from_passed && $passed_data = $passed_form->get_data()) {
    $record = new stdClass();
    $record->type = 'passed';
    $record->content = $passed_data->Passedmessage['text'];
    save_template($record);
    echo 'The passed email changed successfully!';
}

$passed_form->display();

if ($from_failed && $failed_data = $failed_form->get_data()) {
    $record = new stdClass();
    $record->type = 'failed';
    $record->content = $failed_data->Failedmessage['text'];
    save_template($record);
    echo 'The failed email changed successfully!';
}

$failed_form->display();

echo $OUTPUT->footer();