<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2fda4d6441e92b6991f8a87db460a95
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Traits\\' => 7,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Traits\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/traits',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/classes',
        ),
    );

    public static $classMap = array (
        'App\\Calendars\\Calendar' => __DIR__ . '/../..' . '/app/classes/Calendars/Calendar.php',
        'App\\Calendars\\Prices' => __DIR__ . '/../..' . '/app/classes/Calendars/Prices.php',
        'App\\Db_ops\\Connection' => __DIR__ . '/../..' . '/app/classes/Db_ops/Connection.php',
        'App\\Db_ops\\Db_object' => __DIR__ . '/../..' . '/app/classes/Db_ops/Db_object.php',
        'App\\Db_ops\\Sql' => __DIR__ . '/../..' . '/app/classes/Db_ops/Sql.php',
        'App\\Facilities\\Facility' => __DIR__ . '/../..' . '/app/classes/Facilities/Facility.php',
        'App\\Helpers\\Check' => __DIR__ . '/../..' . '/app/classes/Helpers/Check.php',
        'App\\Helpers\\Process' => __DIR__ . '/../..' . '/app/classes/Helpers/Process.php',
        'App\\Images\\Facility_image' => __DIR__ . '/../..' . '/app/classes/Images/Facility_image.php',
        'App\\Images\\Image' => __DIR__ . '/../..' . '/app/classes/Images/Image.php',
        'App\\Images\\Room_image' => __DIR__ . '/../..' . '/app/classes/Images/Room_image.php',
        'App\\Languages\\English' => __DIR__ . '/../..' . '/app/classes/Languages/English.php',
        'App\\Languages\\Language' => __DIR__ . '/../..' . '/app/classes/Languages/Language.php',
        'App\\Languages\\Serbian' => __DIR__ . '/../..' . '/app/classes/Languages/Serbian.php',
        'App\\Persons\\Owner' => __DIR__ . '/../..' . '/app/classes/Persons/Owner.php',
        'App\\Sessions\\Owners_session' => __DIR__ . '/../..' . '/app/classes/Sessions/Owners_session.php',
        'App\\Sessions\\Session' => __DIR__ . '/../..' . '/app/classes/Sessions/Session.php',
        'App\\Spaces\\Room' => __DIR__ . '/../..' . '/app/classes/Spaces/Room.php',
        'App\\Tokens\\Owner_session_token' => __DIR__ . '/../..' . '/app/classes/Tokens/Owner_session_token.php',
        'App\\Tokens\\Registration_token' => __DIR__ . '/../..' . '/app/classes/Tokens/Registration_token.php',
        'App\\Tokens\\Token' => __DIR__ . '/../..' . '/app/classes/Tokens/Token.php',
        'Dotenv\\Dotenv' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Dotenv.php',
        'Dotenv\\Exception\\ExceptionInterface' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/ExceptionInterface.php',
        'Dotenv\\Exception\\InvalidCallbackException' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/InvalidCallbackException.php',
        'Dotenv\\Exception\\InvalidFileException' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/InvalidFileException.php',
        'Dotenv\\Exception\\InvalidPathException' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/InvalidPathException.php',
        'Dotenv\\Exception\\ValidationException' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/ValidationException.php',
        'Dotenv\\Loader' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Loader.php',
        'Dotenv\\Validator' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Validator.php',
        'PHPMailer\\PHPMailer\\Exception' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/Exception.php',
        'PHPMailer\\PHPMailer\\OAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/OAuth.php',
        'PHPMailer\\PHPMailer\\PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/PHPMailer.php',
        'PHPMailer\\PHPMailer\\POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/POP3.php',
        'PHPMailer\\PHPMailer\\SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/SMTP.php',
        'Traits\\Calendar\\calendar_functions' => __DIR__ . '/../..' . '/app/traits/Calendar/calendar_functions.php',
        'Traits\\Image\\image_functions' => __DIR__ . '/../..' . '/app/traits/Image/image_functions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2fda4d6441e92b6991f8a87db460a95::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2fda4d6441e92b6991f8a87db460a95::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc2fda4d6441e92b6991f8a87db460a95::$classMap;

        }, null, ClassLoader::class);
    }
}
