<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return new Response('<h1>Welcome home friend!</h1>');
    }

    /**
     * @Route("/custom/{name}", name="custom")
     * @param Request $request
     * @return Response
     */
    public function custom(Request $request): Response
    {
        var_dump($request);
        dump($request);
        return new Response('<h1>Welcome custom!</h1>');
    }
}
