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
        2 => 'Route3',
        3 => 'Route4',
        4 => 'Route5',
        5 => 'Route6',
        6 => 'Route7',
        7 => 'Route8',
        8 => 'Route9',
        9 => 'Route10',
        10 => 'Route11',
        11 => 'Route12',
        12 => 'Route13',
        13 => 'Route14',
        14 => 'Route15',
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
        ],
        2 => [
            [
                'lat' => '50.016616',
                'lng' => '19.95943',
                'route_id' => 3
            ],
            [
                'lat' => '50.018187',
                'lng' => '19.959602',
                'route_id' => 3
            ],
            [
                'lat' => '50.020062',
                'lng' => '19.960289',
                'route_id' => 3
            ],
            [
                'lat' => '50.021607',
                'lng' => '19.960374',
                'route_id' => 3
            ],
            [
                'lat' => '50.023674',
                'lng' => '19.960546',
                'route_id' => 3
            ],
            [
                'lat' => '50.02621',
                'lng' => '19.959972',
                'route_id' => 3
            ],
            [
                'lat' => '50.028581',
                'lng' => '19.958813',
                'route_id' => 3
            ],
            [
                'lat' => '50.029546',
                'lng' => '19.953449',
                'route_id' => 3
            ],
            [
                'lat' => '50.030345',
                'lng' => '19.950659',
                'route_id' => 3
            ],
            [
                'lat' => '50.031448',
                'lng' => '19.9489',
                'route_id' => 3
            ],
            [
                'lat' => '50.032606',
                'lng' => '19.947269',
                'route_id' => 3
            ],
            [
                'lat' => '50.033126',
                'lng' => '19.946904',
                'route_id' => 3
            ],
            [
                'lat' => '50.033546',
                'lng' => '19.947011',
                'route_id' => 3
            ],
            [
                'lat' => '50.034814',
                'lng' => '19.947644',
                'route_id' => 3
            ],
            [
                'lat' => '50.035407',
                'lng' => '19.948202',
                'route_id' => 3
            ],
            [
                'lat' => '50.035923',
                'lng' => '19.948846',
                'route_id' => 3
            ],
            [
                'lat' => '50.038588',
                'lng' => '19.952415',
                'route_id' => 3
            ],
            [
                'lat' => '50.040034',
                'lng' => '19.954639',
                'route_id' => 3
            ],
            [
                'lat' => '50.040703',
                'lng' => '19.956323',
                'route_id' => 3
            ],
            [
                'lat' => '50.041054',
                'lng' => '19.957943',
                'route_id' => 3
            ],
            [
                'lat' => '50.04133',
                'lng' => '19.959285',
                'route_id' => 3
            ],
            [
                'lat' => '50.04151',
                'lng' => '19.960648',
                'route_id' => 3
            ],
            [
                'lat' => '50.041785',
                'lng' => '19.962966',
                'route_id' => 3
            ],
            [
                'lat' => '50.041799',
                'lng' => '19.963513',
                'route_id' => 3
            ],
            [
                'lat' => '50.041916',
                'lng' => '19.964403',
                'route_id' => 3
            ],
            [
                'lat' => '50.04215',
                'lng' => '19.965079',
                'route_id' => 3
            ],
            [
                'lat' => '50.042433',
                'lng' => '19.965584',
                'route_id' => 3
            ],
            [
                'lat' => '50.042867',
                'lng' => '19.966517',
                'route_id' => 3
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

            $i = $key;
            $copied = false;
            if ($key > 2) {
                $i = rand(0, 2);
                $copied = true;
            }

            if (!empty($this->coordinates[$i])) {
                foreach ($this->coordinates[$i] as $coordinate) {
                    $c = new Coordinates();
                    $c->setLat($coordinate['lat']);
                    $c->setLng($coordinate['lng']);
                    $c->setCreated(new \DateTime(date('Y-m-d H:i:s')));
                    $route_id = $coordinate['route_id'];
                    if ($copied) {
                        $route_id = $key + 1;
                    }
                    $c->setRouteId($route_id);

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
