<?php

namespace App\Controller;

use App\Service\Greeting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    private $greeting;

    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;
    }

    /**
     *
     * @Route("/blog/{name}", name="blog_index")
     */
    public function index(string $name): Response
    {
        return $this->render('base.html.twig', ['message' => $this->greeting->greet(
            $name
        )]);
    }

}