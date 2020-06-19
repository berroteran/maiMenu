<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function index(Request $request)
    {
        $companies = [
            'La Marquesa' => 'http://parquenacionallamarquesa.com.mx/menu/elarco/loscedros/cabanaCedros.html',
            'La fonda del Chavo' => '$298.68 billion USD',
            'Rolex' => '$1.10 trillion USD',
            'Alphabet' => 'www.google.com',

        ];

        return $this->render('list/index.html.twig', [
            'companies' => $companies,
        ]);
    }
}