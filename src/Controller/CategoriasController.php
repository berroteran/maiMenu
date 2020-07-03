<?php

namespace App\Controller;

use App\Entity\Categorias;
use App\Entity\Negocio;
use App\Form\CategoriasType;
use App\Repository\CategoriasRepository;
use App\Repository\NegocioRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorias")
 */
class CategoriasController extends AbstractController
{
    /**
     * Listar todas las categorias
     * @Route("/", name="categorias_index", methods={"GET", "POST"})
     */
    public function index(CategoriasRepository $categoriasRepository): Response
    {
        //to recuperar todas los neGoCios
        $negociosCtl = new NegocioRepository( $this->getDoctrine()  );

        return $this->render('categorias/index.html.twig', [
            'categorias' => $categoriasRepository->findAll(),
            'negocios' => $negociosCtl->findAll(),
        ]);
    }

    /**
     * listar categorias por negocio
     * @Route("/{id}/negocio", name="categorias_negocio", methods={ "GET", "POST"})
     */
    public function catByNegocio(CategoriasRepository $categoriasRepository, $id): Response
    {
        //to recuperar todas los neGoCios
        $negociosCtl = new NegocioRepository( $this->getDoctrine()  );

        return $this->render('categorias/index.html.twig', [
            //'categorias' => $categoriasRepository->findAll(),
            'categorias' => $categoriasRepository->findBy(  array("negocio" => $id )),
            'negocios' => $negociosCtl->findAll(),
            'empresa' => $id,
        ]);
    }

    /**
     * @Route("/new", name="categorias_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $categoria = new Categorias();
        $categoria->setFechaAlta();
        $categoria->setActivo(true);
        //$categoria->setFechaModificacion(date_create(date('Y-m-d H:i:s')));

        $form = $this->createForm(CategoriasType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $categoria->setImage($imageFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoria);
            $entityManager->flush();

            return $this->redirectToRoute('categorias_index');
        }

        return $this->render('categorias/new.html.twig', [
            'categoria' => $categoria,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/new/{id}/negocio", name="categorias_newXn", methods={"GET", "POST"})
     */
    public function newXn(Request $request, $id, FileUploader $fileUploader): Response
    {
        //to recuperar todas los neGoCios
        $negociosCtl = new NegocioRepository( $this->getDoctrine()  );

        $categoria = new Categorias();
        $categoria->setNegocio( $negociosCtl->find(1) );

        //$categoria->setFechaAlta(date_create(date('Y-m-d H:i:s')));
        //$categoria->setFechaModificacion(date_create(date('Y-m-d H:i:s')));
        $form = $this->createForm(CategoriasType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->uploadByNegocio( $imageFile, $categoria->getNegocio()->getId(), $categoria->getTipoImage());
                $categoria->setImage($imageFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoria);
            $entityManager->flush();

            return $this->redirectToRoute('categorias_index');
        }

        return $this->render('categorias/new.html.twig', [
            'categoria' => $categoria,
            'form' => $form->createView(),
            'empresa' => $id,
        ]);
    }


    /**
     * @Route("/{id}", name="categorias_show", methods={"GET"})
     */
    public function show(Categorias $categoria): Response
    {
        return $this->render('categorias/show.html.twig', [
            'categoria' => $categoria,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categorias_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categorias $categoria, FileUploader $fileUploader ): Response
    {
        $form = $this->createForm(CategoriasType::class, $categoria);
        $form->handleRequest($request);
        //update auditooria
        //$categoria->set$this->security->getUser();
        $categoria->setFechaModificacion();

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                //$imageFileName = $fileUploader->upload($imageFile);
                $imageFileName = $fileUploader->uploadByNegocio( $imageFile, $categoria->getNegocio()->getId(), $categoria->getTipoImage());
                $categoria->setImage($imageFileName);
                $this->getDoctrine()->getManager()->persist($categoria);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorias_index');
        }

        return $this->render('categorias/edit.html.twig', [
            'categoria' => $categoria,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorias_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Categorias $categoria): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categoria->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoria);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorias_index');
    }
}
