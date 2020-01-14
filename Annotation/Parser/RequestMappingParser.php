<?php

namespace Annotation\Parser;

use Core\Route;

/**
 * Class RequestMappingParser
 *
 * @since 2.0
 */
class RequestMappingParser
{
    /**
     * @param int $type
     * @param RequestMapping $annotation
     *
     * @return array
     * @throws AnnotationException
     */
    public function parse($routePrefix, $routePath, $handler, $action): array
    {
        Route::addRoute($routePrefix, $routePath, $handler, $action);
        return [];
    }
}
