<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Publicacion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PrimeraPublicacion extends Fixture
{
    private $manager;

    private function crearPublicacion(
        $titulo,
        $contenido,
        $fecha,
        $nombreCategoria
    ){
        $repoCat = $this->manager->getRepository(Categoria::class);
        $p = new Publicacion();
        $c = $repoCat->findOneBy(
            ['nombre' => $nombreCategoria]
        );

        $p->setCategoria($c);
        $p->setTitulo($titulo);
        $p->setContenido($contenido);
        $p->setFechaPublicacion($fecha);

        $this->manager->persist($p);

        $this->manager->flush();
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->crearPublicacion(
            "Mi primera publicación",
            "Hola mundo de Symfony",
            new \DateTime("now"),
            "Programación"
        );
    }
}
