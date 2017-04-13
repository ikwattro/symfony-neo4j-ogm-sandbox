<?php

namespace AppBundle\Controller;

use AppBundle\Form\FamilyFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/new", name="new_family")
     */
    public function newAction()
    {
        $form = $this->createForm(FamilyFormType::class);

        return $this->render('AppBundle:Default:form.html.twig', ['form' => $form->createView()]);
    }
}
