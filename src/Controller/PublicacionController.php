<?php

namespace App\Controller;

use App\Repository\PublicacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicacionController extends AbstractController
{
    /**
     * @Route("/ultimas", name="ultimas-publicaciones")
     */
    public function index(PublicacionRepository $pr)
    {
        // Preguntar a los modelos
        $publicaciones = $pr->findAll();

        return $this->render('publicacion/index.html.twig', [
            'listado_publicaciones' => $publicaciones,
        ]);
    }
}
