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
        0 => 'Route1',
        1 => 'Route2',
        //2 => 'Route3'
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
            [
                'lat' => '50.26339',
                'lng' => '18.615685',
                'route_id' => 1
            ],
            [
                'lat' => '50.260757',
                'lng' => '18.64109',
                'route_id' => 1
            ],
            [
                'lat' => '50.259001',
                'lng' => '18.671646',
                'route_id' => 1
            ],
            [
                'lat' => '50.258781',
                'lng' => '18.704262',
                'route_id' => 1
            ],
            [
                'lat' => '50.260537',
                'lng' => '18.721428',
                'route_id' => 1
            ],
            [
                'lat' => '50.238803',
                'lng' => '18.708725',
                'route_id' => 1
            ],
            [
                'lat' => '50.227164',
                'lng' => '18.697395',
                'route_id' => 1
            ],
            [
                'lat' => '50.214862',
                'lng' => '18.691902',
                'route_id' => 1
            ],
            [
                'lat' => '50.205634',
                'lng' => '18.697052',
                'route_id' => 1
            ],
            [
                'lat' => '50.198822',
                'lng' => '18.699799',
                'route_id' => 1
            ],
            [
                'lat' => '50.184974',
                'lng' => '18.706665',
                'route_id' => 1
            ],
            [
                'lat' => '50.173981',
                'lng' => '18.716621',
                'route_id' => 1
            ]
        ],
        1 => [
            [
                'lat' => '50.084717',
                'lng' => '18.66384',
                'route_id' => 2
            ],
            [
                'lat' => '50.084717',
                'lng' => '18.66384',
                'route_id' => 2
            ],
            [
                'lat' => '50.075794',
                'lng' => '18.664184',
                'route_id' => 2
            ],
            [
                'lat' => '50.070616',
                'lng' => '18.663497',
                'route_id' => 2
            ],
            [
                'lat' => '50.068302',
                'lng' => '18.66178',
                'route_id' => 2
            ],
            [
                'lat' => '50.070065',
                'lng' => '18.664527',
                'route_id' => 2
            ],
            [
                'lat' => '50.067971',
                'lng' => '18.664355',
                'route_id' => 2
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
