<?php


namespace Core;


use Annotation\Parser\RequestMappingParser;
use Doctrine\Common\Annotations\AnnotationRegistry;
use \Doctrine\Common\Annotations;

/**
 * 相当于一个处理器，做一些初始化工作
 * Class Application
 *
 * @package Core
 */
class Application
{
    public static $beans = [];

    public static function init($loader)
    {
//        $loader = require dirname(__DIR__) . "/vendor/autoload.php";
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);
        self::loadAnnotationRoute();
        self::loadAnnotationBean();
    }

    public static function run()
    {

    }

    public static function loadAnnotationBean()
    {
        //自动加载注解类(规则)到组件当中
        $reader = new Annotations\AnnotationReader();
        //手动实例化类 glob() 遍历文件
        $obj = new Route();
        $re  = new \ReflectionClass($obj);
        //获取类所有注解
        $class_annos = $reader->getClassAnnotations($re);

        foreach ($class_annos as $class_anno) {
            $beanName = $class_anno->getName();
            //parse方法作为作业
            self::$beans[$beanName] = $re->newInstance();
        }
    }

    public static function getBean($name)
    {
        return self::$beans[$name] ?? '';
    }

    public static function loadAnnotationRoute()
    {
        //自动加载注解类(规则)到组件当中
        $reader = new Annotations\AnnotationReader();

        //这里采用手动实例化类、可以利用 glob() 遍历文件
        $obj = new \App\Http\Controller\HomeController();
        $re  = new \ReflectionClass($obj);

        //获取类注解
        $class_annos = $reader->getClassAnnotations($re);
        foreach ($class_annos as $class_anno) {
            $routePrefix = $class_anno->getPrefix();
            //通过反射得到所有的方法
            $refMethods = $re->getMethods();
            foreach ($refMethods as $method) {
                $methodAnnos = $reader->getMethodAnnotations($method);
                foreach ($methodAnnos as $methodAnno) {
                    $routePath = $methodAnno->getRoute();
                    var_dump($routePath);
                    //把某个逻辑放到在某个解析类当中处理逻辑
                    //$re->newInstance();反射实例化
                    (new RequestMappingParser())->parse($routePrefix,
                        $routePath, $re->newInstance(), $method->name);
                }
            }
        }


    }
}