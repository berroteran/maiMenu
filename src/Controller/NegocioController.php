<?php

namespace App\Controller;

use App\Entity\Negocio;
use App\Form\NegocioType;
use App\Repository\NegocioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/negocio")
 */
class NegocioController extends AbstractController
{
    /**
     * @Route("/", name="negocio_index", methods={"GET"})
     */
    public function index(NegocioRepository $negocioRepository): Response
    {
        return $this->render('negocio/index.html.twig', [
            'negocios' => $negocioRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="negocio_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $negocio = new Negocio();
        $form = $this->createForm(NegocioType::class, $negocio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($negocio);
            $entityManager->flush();

            return $this->redirectToRoute('negocio_index');
        }

        return $this->render('negocio/new.html.twig', [
            'negocio' => $negocio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="negocio_show", methods={"GET"})
     */
    public function show(Negocio $negocio): Response
    {
        return $this->render('negocio/show.html.twig', [
            'negocio' => $negocio,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="negocio_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Negocio $negocio): Response
    {
        $form = $this->createForm(NegocioType::class, $negocio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('negocio_index');
        }

        return $this->render('negocio/edit.html.twig', [
            'negocio' => $negocio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="negocio_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Negocio $negocio): Response
    {
        if ($this->isCsrfTokenValid('delete'.$negocio->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($negocio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('negocio_index');
    }
}
