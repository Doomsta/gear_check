<?php

namespace App;

use App\Model\Repository\CharRepository;
use Igorw\Silex\ConfigServiceProvider;
use Silex\Application\TwigTrait;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Twig_Extension_Debug;

define('ROOT_PATH', realpath(__DIR__.'/../..'));

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
        $this->register(new ConfigServiceProvider(
            ROOT_PATH . '/config/base.yml',
            array(
                'ROOT_PATH' => ROOT_PATH,
                'APP_PATH' => __DIR__,
                'DATA_PATH' => ROOT_PATH . '/data',
                'LOG_PATH' => ROOT_PATH . '/log',
            )
        ));
        $this->register(new ConfigServiceProvider(
            ROOT_PATH . '/config/dev.yml',
            array(
                'ROOT_PATH' => ROOT_PATH,
                'APP_PATH' => __DIR__,
                'DATA_PATH' => ROOT_PATH . '/data',
                'LOG_PATH' => ROOT_PATH . '/log',
            )
        ));
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
        $this->register(new DoctrineServiceProvider(), array(

            )

        );
    }

    protected function initController()
    {
        $this['tool'] = new TooltipBuilder();
        $this->get('/char/{name}', function ($name) {
            $charRepo = new CharRepository($this['db']);
            $char = $charRepo->getChar($name);
            return $this->render('char.twig', array('char' => $char));
        });

        $this->get('/debug/{name}', function ($name) {
            $charRepo = new CharRepository($this['db']);
            $tB = new TooltipBuilder();
            $char = $charRepo->getChar($name);
            echo '<pre>';
            echo $tB->getItemTooltip($char->getEquipmentCollection()->getItemBySlot(1), $char);
            echo '</pre>';
            return '';
        });
    }

    protected function initGearCheck()
    {
    }
}
