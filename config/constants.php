<?php

return [
    'UPLOADS' => [
        'SCREENSHOTS' => 'screenshots/',
        "PANCARDS"    => 'pan_cards/',
        "RENEW_ACCOUNT_IMAGES"=>'renewal_account_images'
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
    'Parents' => 8,
    'Permissions'=>[
        "user",
        "role",
        "client",
        "client-demat",
        "client-demat-status",
        "freelancer-data",
        "freelancer",
        "channel-partner-data",
        "channel-partner",
        "analyst",
        "monitor-data",
        "report",
        "monitor",
        "trade-hold",
        "setup",
        "trader-data",
        "trader",
        "renewal-status",
        "accounting",
        "finance-management-bank",
        "financial-status",
        "finance-management-report",
        "blog-admin",
        "blog-user",
        "business-management",
        "keyword",
        "settings-user-account-type",
        "settings-client-profession",
        "settings-client-broker",
        "settings-bank-details",
        "settings-service-type",
    ],
    "LABEL_TYPES"=>[
        "income",
        "expense",
        "transfer",
        "loan"
    ],
    "USERS_TYPE"=>[
        1=>"Partner",
        2=>"Employee",
        3=>"Channel Partner",
        4=>"Freelancer AMS",
        5=>"Freelancer Prime" 
    ]
];

?>