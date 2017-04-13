<?php

namespace GraphAware\Neo4jBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GraphAwareNeo4jBundle:Default:index.html.twig');
    }
}
