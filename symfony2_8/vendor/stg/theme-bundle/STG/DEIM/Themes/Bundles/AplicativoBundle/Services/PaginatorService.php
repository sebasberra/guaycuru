<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Services;

use Doctrine\ORM\Query;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\Request;

class PaginatorService
{

    protected $knp_paginator;
    protected $request;

    public function __construct(Paginator $knp_paginator, Request $request)
    {
        $this->knp_paginator = $knp_paginator;
        $this->request = $request;
    }

    public function getPagination($query, $pageLimit = 10)
    {
        $paginacion = $this->knp_paginator->paginate($query, $this->request->query->get('page', 1), $pageLimit);
        $paginacion->setCustomParameters(array(
            'style' => 'bottom'
        ));
        
        return $paginacion;
    }
}