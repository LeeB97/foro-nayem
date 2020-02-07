<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Comentario;
use App\Entity\Publicacion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UnaPublicacionConComentarios extends Fixture
{
    private $manager;

    private function crearPublicacion(
        $titulo,
        $contenido,
        $fecha,
        $nombreCategoria,
        $comentarios
    ){
        $repoCat = $this->manager->getRepository(Categoria::class);
        $p = new Publicacion();
        $cat = $repoCat->findOneBy(
            ['nombre' => $nombreCategoria]
        );

        $p->setCategoria($cat);
        $p->setTitulo($titulo);
        $p->setContenido($contenido);
        $p->setFechaPublicacion($fecha);

        foreach ($comentarios as $comentario){
            $c = new Comentario();
            $c->setContenido($comentario);
            $c->setFechaPublicacion(new \DateTime('now'));

            $c->setPublicacion($p);

            $this->manager->persist($c);
        }

        $this->manager->persist($p);

        $this->manager->flush();
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $comentarios = ['Lo apoyo','Que va','Correcto','Ni loco','TT_TT',':D'];

        $this->crearPublicacion(
            "Mi publicación con comentarios",
            "Comentarios!!!!!!!",
            new \DateTime("now"),
            "Programación",
            $comentarios
        );
    }
}
