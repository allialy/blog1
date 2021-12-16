<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
    /**
     * @Route("/contacter/{city}", name="contactCity")
     */
    public function contactCity(Request $request, string $city): Response
    {
        $name = $request->query->get('name');

        dump($name);

        return $this->render('contact/index.html.twig', [
            'name' => $name,
            'city' => $city,
        ]);
    }
}
