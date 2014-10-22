<?php

namespace App;

use App\Model\Repository\CharRepository;
use Silex\Application\TwigTrait;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Twig_Extension_Debug;

class Application extends \Silex\Application
{
    use TwigTrait;

    public function __construct(array $values = array())
    {
        parent::__construct($values);

        // TODO !!
        define("PROJEKTNAME", "Envy Gear-Check");
        $mysql_host = "localhost";
        $mysql_user = "root";
        $mysql_pass = "";
        define('MYSQL_DATABASE_TDB', 'world');
        define('MYSQL_DATABASE', 'gear_check');
        define('PROVIDER', 'wow_castle_de');
        mysql_connect($mysql_host, $mysql_user, $mysql_pass);
        unset($mysql_pass);


        $this->initConfig();
        $this->initProvider();
        $this->initGearCheck();
        $this->initController();
    }

    protected function initConfig()
    {
    }

    protected function initProvider()
    {
        $this->register(new SessionServiceProvider());
        $this->register(new UrlGeneratorServiceProvider());
        $this->register(new ServiceControllerServiceProvider());
        $this->register(new TwigServiceProvider(),
            array(
                'twig.path' => __DIR__ . '/View',
                'debug' => true,
            )
        );
        $this['twig']->addExtension(new Twig_Extension_Debug());
    }

    protected function initController()
    {
        $this->get('/char/{name}', function ($name) {
            $charRepo = new CharRepository();
            $char = $charRepo->getChar($name);
            return $this->render('char.twig', array('char' => $char));
        });
    }

    protected function initGearCheck()
    {
    }
}
