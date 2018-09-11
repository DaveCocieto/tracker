<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MapCoordinate;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function index()
    {
        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
        ]);
    }

    public function mapSettings() {
        return $this->render('map/map_settings.html.twig', [
            'controller_name' => 'MapController',
            'pass_encoded' => urlencode('ZAQ!@WSX')
        ]);
    }

    public function saveCoordinate() {
        $entityManager = $this->getDoctrine()->getManager();

        $map_coordinate = new MapCoordinate();
        $map_coordinate->setLat('54');
        $map_coordinate->setLng('12');
        $map_coordinate->setCreated(new \DateTime(date('Y-m-d H:i:s')));

        $entityManager->persist($map_coordinate);

        $entityManager->flush();

        return $this->redirectToRoute('settings_map', array(), 301);
    }

    public function getCoordinates() {
        $repository = $this->getDoctrine()->getRepository(MapCoordinate::class);

        // look for a single Coordinte by its primary key (usually "id")
        //$fetched = $repository->find(1);

        // find one by lat and lng
        /*$fetched = $repository->findOneBy([
            'lat' => 54,
            'lng' => 12,
        ]);*/

        // find all by lat and lng
        /*$fetched = $repository->findBy([
            'lat' => 54,
            'lng' => 12,
        ]);*/

        // find all
        $fetched = $repository->findAll();

        return $this->render('map/get_coordinates.html.twig', [
            'fetched' => $fetched
        ]);
    }
}
