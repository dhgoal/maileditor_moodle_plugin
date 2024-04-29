<?php
$capabilities = array(

    'local/maileditor:edit' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'admin' => CAP_ALLOW
        ),
        'clonepermissionsfrom' => 'moodle/site:config',
    ),

);
