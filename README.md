# mediabox
This is a media display system with customisable data. Its soul purpose is to display videos for staff access for training purposes.

Built in Zend as a module with a basic CRUD system


To setup, the module currently uses the skeleton framework application from Zend using dev mode.

composer create-project -s dev zendframework/skeleton-application /path/to/dir/of/project

say no to minimal and yes to everything else

set config to 1 (module.config.php) for everything

Update file /config/modules.config.php to include the module:

...
    'Zend\Validator',
    'ZendDeveloperTools',
    'Application', //still needed as its used as a base
	'MediaBox'
...

Update /composer.json

    "autoload": {
        "psr-4": {
            "Application\\": "module/Application/src/",
            "MediaBox\\": "module/MediaBox/src/"
        }
    },
	
Run composer dump-autoload

The app should now work at /tools/mediabox

You probably will need a database. 

This is some base code you can add to global.php in /config/autoload

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => sprintf('sqlite:%s/data/zftutorial.db', realpath(getcwd())),
    ],
];

then add the sql to the db file located in the project under the data folder