<?php

namespace Pimcore\Bundle\PimcoreBundle\DataCollector;

use Pimcore\Bundle\PimcoreBundle\Service\Request\PimcoreContextResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class PimcoreDataCollector extends DataCollector
{
    /**
     * @var PimcoreContextResolver
     */
    protected $contextResolver;

    /**
     * @param PimcoreContextResolver $contextResolver
     */
    public function __construct(PimcoreContextResolver $contextResolver)
    {
        $this->contextResolver = $contextResolver;
    }

    /**
     * @inheritDoc
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = [
            'context' => $this->contextResolver->getPimcoreContext($request)
        ];
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'pimcore.data_collector';
    }

    /**
     * @return string|null
     */
    public function getContext()
    {
        return $this->data['context'];
    }
}