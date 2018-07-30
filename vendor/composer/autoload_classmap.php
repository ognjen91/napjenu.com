<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'App\\Calendars\\Calendar' => $baseDir . '/app/classes/Calendars/Calendar.php',
    'App\\Calendars\\Prices' => $baseDir . '/app/classes/Calendars/Prices.php',
    'App\\Db_ops\\Connection' => $baseDir . '/app/classes/Db_ops/Connection.php',
    'App\\Db_ops\\Db_object' => $baseDir . '/app/classes/Db_ops/Db_object.php',
    'App\\Db_ops\\Sql' => $baseDir . '/app/classes/Db_ops/Sql.php',
    'App\\Facilities\\Facility' => $baseDir . '/app/classes/Facilities/Facility.php',
    'App\\Helpers\\Check' => $baseDir . '/app/classes/Helpers/Check.php',
    'App\\Helpers\\Process' => $baseDir . '/app/classes/Helpers/Process.php',
    'App\\Images\\Facility_image' => $baseDir . '/app/classes/Images/Facility_image.php',
    'App\\Images\\Image' => $baseDir . '/app/classes/Images/Image.php',
    'App\\Images\\Room_image' => $baseDir . '/app/classes/Images/Room_image.php',
    'App\\Languages\\English' => $baseDir . '/app/classes/Languages/English.php',
    'App\\Languages\\Language' => $baseDir . '/app/classes/Languages/Language.php',
    'App\\Languages\\Serbian' => $baseDir . '/app/classes/Languages/Serbian.php',
    'App\\Persons\\Owner' => $baseDir . '/app/classes/Persons/Owner.php',
    'App\\Sessions\\Owners_session' => $baseDir . '/app/classes/Sessions/Owners_session.php',
    'App\\Sessions\\Session' => $baseDir . '/app/classes/Sessions/Session.php',
    'App\\Spaces\\Room' => $baseDir . '/app/classes/Spaces/Room.php',
    'App\\Tokens\\Owner_session_token' => $baseDir . '/app/classes/Tokens/Owner_session_token.php',
    'App\\Tokens\\Registration_token' => $baseDir . '/app/classes/Tokens/Registration_token.php',
    'App\\Tokens\\Token' => $baseDir . '/app/classes/Tokens/Token.php',
    'Dotenv\\Dotenv' => $vendorDir . '/vlucas/phpdotenv/src/Dotenv.php',
    'Dotenv\\Exception\\ExceptionInterface' => $vendorDir . '/vlucas/phpdotenv/src/Exception/ExceptionInterface.php',
    'Dotenv\\Exception\\InvalidCallbackException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/InvalidCallbackException.php',
    'Dotenv\\Exception\\InvalidFileException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/InvalidFileException.php',
    'Dotenv\\Exception\\InvalidPathException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/InvalidPathException.php',
    'Dotenv\\Exception\\ValidationException' => $vendorDir . '/vlucas/phpdotenv/src/Exception/ValidationException.php',
    'Dotenv\\Loader' => $vendorDir . '/vlucas/phpdotenv/src/Loader.php',
    'Dotenv\\Validator' => $vendorDir . '/vlucas/phpdotenv/src/Validator.php',
    'PHPMailer\\PHPMailer\\Exception' => $vendorDir . '/phpmailer/phpmailer/src/Exception.php',
    'PHPMailer\\PHPMailer\\OAuth' => $vendorDir . '/phpmailer/phpmailer/src/OAuth.php',
    'PHPMailer\\PHPMailer\\PHPMailer' => $vendorDir . '/phpmailer/phpmailer/src/PHPMailer.php',
    'PHPMailer\\PHPMailer\\POP3' => $vendorDir . '/phpmailer/phpmailer/src/POP3.php',
    'PHPMailer\\PHPMailer\\SMTP' => $vendorDir . '/phpmailer/phpmailer/src/SMTP.php',
    'Traits\\Calendar\\calendar_functions' => $baseDir . '/app/traits/Calendar/calendar_functions.php',
    'Traits\\Image\\image_functions' => $baseDir . '/app/traits/Image/image_functions.php',
);