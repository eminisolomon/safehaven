<?php

namespace Eminisolomon\SafeHaven\Service;

use Eminisolomon\SafeHaven\ApiRequestor;
use Eminisolomon\SafeHaven\Exceptions\SafeHavenException;

abstract class AbstractService
{
    public $requestor;

    public function __construct(?ApiRequestor $requestor = null)
    {
        $this->requestor = $requestor ?? new ApiRequestor;
    }

    /**
     * @throws SafeHavenException
     */
    protected function buildPath($basePath, ...$ids)
    {
        foreach ($ids as $id) {
            if ($id === null || \trim($id) === '') {
                throw SafeHavenException::invalidArgument();
            }
        }

        return \sprintf($basePath, ...\array_map('\urlencode', $ids));
    }
}
