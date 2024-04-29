<?php
defined('MOODLE_INTERNAL') || die(); // Prevent direct access.

/**
 * Save or update a template record in the database.
 *
 * @param stdClass $record The record to be saved or updated.
 * @global stdClass $DB Global database object.
 */
function save_template($record) {
    global $DB;
    $existing = $DB->get_record('local_maileditor_templates', ['type' => $record->type]);
    if ($existing) {
        $record->id = $existing->id;
        $DB->update_record('local_maileditor_templates', $record);
    } else {
        $DB->insert_record('local_maileditor_templates', $record);
    }
}
