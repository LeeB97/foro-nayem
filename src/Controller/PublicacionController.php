<?php

namespace App\Controller;

use App\Entity\Publicacion;
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

    /**
     * @Route("/publicacion/{id}", name="publicacion-detalle")
     */
    public function detalle(Publicacion $publicacion) {

        //public function detalle($id, PublicacionRepository $pr) { si se pone la publicacion directamente, esto lo hace automaticamente
        //    $publicacion = $pr->find($id){
        //    if($publicacion == null) {
        //        throw $this->createNotFoundException('No existe esta publicaicon :)');
        //   }
        return $this->render('publicacion/detalle.html.twig', [
            'publicacion' => $publicacion,
        ]);
    }

}
