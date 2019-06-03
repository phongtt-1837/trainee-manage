<?php
return [
    'constants' => [
        'default_password' => 'abc123',
        'default_value' => '0',
    ],
    'roles' => [
        'admin' => '1',
        'trainer' => '2',
        'trainee' => '3',
    ],
    'test_or_not' => [
        'yes' => '1',
        'no' => '0',
    ],
    'gender' => [
        '0' => 'Male',
        '1' => 'Female',
    ],
    'test_status' => [
        '0' => 'New',
        '1' => 'Resolved',
        '2' => 'Not achieved',
        '3' => 'ReSend',
        '4' => 'Done',
    ],
    'test_status_color' => [
        '0' => 'secondary',
        '1' => 'info',
        '2' => 'warning',
        '3' => 'primary',
        '4' => 'success',
    ],
    'new' => 0,
    'resolved' => 1,
    'not_achieved' => 2,
    'resend' => 3,
    'done' => 4,
    'notification' => [
        'test' => 'Test',
        'test_result' => 'Test Result',
        'course_expired' => 'Course Expired',
    ],
];
