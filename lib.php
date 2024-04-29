<?php

defined('MOODLE_INTERNAL') || die();

function local_maileditor_extend_navigation(global_navigation $navigation) {
    $node = navigation_node::create(get_string('pluginname', 'local_maileditor'),
                                    new moodle_url('/local/maileditor/index.php'),
                                    navigation_node::TYPE_CUSTOM, null, null,
                                    new pix_icon('icon', '', 'local_maileditor'));
    $navigation->add_node($node);
}

function local_maileditor_init() {
    global $PAGE;
    $PAGE->set_context(context_system::instance());
    $PAGE->set_url(new moodle_url('/local/maileditor/index.php'));
    $PAGE->set_title(get_string('pluginname', 'local_maileditor'));
    $PAGE->set_heading(get_string('pluginname', 'local_maileditor'));
}
