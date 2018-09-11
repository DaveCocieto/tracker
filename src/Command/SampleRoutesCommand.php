<?php

namespace App\Command;

use App\Entity\Coordinates;
use App\Entity\Routes;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SampleRoutesCommand extends Command {

    private $routes = [
        'Route1',
        //'Route2',
        //'Route3'
    ];

    private $coordinates = [
        0 => [
            [
                'lat' => '50.33335',
                'lng' => '18.54393',
                'route_id' => 1
            ],
            [
                'lat' => '50.318446',
                'lng' => '18.547363',
                'route_id' => 1
            ],
            [
                'lat' => '50.276776',
                'lng' => '18.574486',
                'route_id' => 1
            ],
            [
                'lat' => '50.267341',
                'lng' => '18.588219',
                'route_id' => 1
            ],
        ]
    ];

    public function __construct($name = null, ContainerInterface $container)
    {
        parent::__construct($name);
        $this->container = $container;
    }

    protected function configure()
    {
        $this->setName('app:addSampleRoutes')
            ->setDescription('Adds sample routes to DB');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Sample Routes',
            '=============',
            '',
        ]);

        $entityManager = $this->container->get('doctrine')->getEntityManager();

        foreach ($this->routes as $key => $route) {
            $r = new Routes();
            $r->setName($route);
            $r->setCreated(new \DateTime(date('Y-m-d H:i:s')));

            $entityManager->persist($r);

            if (!empty($this->coordinates[$key])) {
                foreach ($this->coordinates[$key] as $coordinate) {
                    $c = new Coordinates();
                    $c->setLat($coordinate['lat']);
                    $c->setLng($coordinate['lng']);
                    $c->setCreated(new \DateTime(date('Y-m-d H:i:s')));
                    $c->setRouteId($coordinate['route_id']);

                    $entityManager->persist($c);
                }
            }
        }

        //$entityManager->persist();
        $entityManager->flush();

        $output->writeln([
            'DONE'
        ]);
    }
}
