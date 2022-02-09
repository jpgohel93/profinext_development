<?php

return [
    'UPLOADS' => [
        'SCREENSHOTS' => 'screenshots/'
    ],
    'ALLOWED_EXTENSIONS' => ['png','jpeg','jpg','pdf','docx','doc','xlsx','xls'],
    'ALLOWED_MIMETYPES' => ['image/png','image/jpeg','application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/msword','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-excel','text/plain'],
    'Super Admin' => 1, 
    'Admin' => 2,
    'Sub Admin' => 3,
    'HR Manager' => 4,
    'Counsellor' => 5,
    'Teachers' => 6,
    'Students' => 7,
    'Parents' => 8
];

?>