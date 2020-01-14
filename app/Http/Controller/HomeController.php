<?php declare(strict_types=1);

namespace App\Http\Controller;

use Annotation\Mapping\Controller;
use Annotation\Mapping\RequestMapping;

/**
 * Class HomeController
 * @Controller(prefix="/index")
 */
class HomeController
{
    /**
     * @RequestMapping("/test")
     * @throws \Throwable
     */
    public function index()
    {
        return [
            1   => 1,
            2   => 2,
            333 => 3,
            444 => 4,
            11  => 2,
        ];
    }

    /**
     * @RequestMapping("/er")
     * @throws \Throwable
     */
    public function er()
    {
        echo "er";
    }
}
