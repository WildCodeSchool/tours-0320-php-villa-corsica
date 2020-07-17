<?php

namespace App\DataFixtures;

use App\Entity\Villa;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VillaFixtures extends Fixture
{
    const VILLAS = [

      'Laura' => [
          'location' => 'Sainte-Lucie-de-Porto-Vecchio Corse-du-Sud France',
          'description' => 'D\'une superficie de 60 m2, elle dispose d\'une chambre avec un lit double en 160 
          et d\'une chambre avec 2 lits simples (90). La cuisine moderne américaine, rénovée en 2018, est ouverte 
          sur le salon. Côté extérieur, la terrasse offre une vue panoramique sur les aiguilles de Bavella. 
          La piscine privée dispose d\'une terrasse en ipé. Equipée de transats et parasol, elle est protégée 
          par une barrière en fer forgé.',
          'nb_room' => '2',
          'nb_bed' => '3',
          'nb_bathroom' => '1',
          'capacity' => '4',
          'sqm' => '60',
          'poster' => 'Laura.jpeg',
      ],


        'Lea' => [
            'location' => 'Sainte-Lucie-de-Porto-Vecchio Corse-du-Sud France',
            'description' => 'Cette maison contemporaine allie le charme du bois, de la pierre et du fer forgé. 
            D’une superficie totale de 90 m2, elle dispose de 2 niveaux indépendants. Le Rez de villa comprend 
            une kitchenette, une chambre double (lit en 160) et une salle de bain. Le niveau supérieur, partiellement 
            climatisé, dispose d’une cuisine américaine moderne avec un coin salon, une chambre double (lit en 160) et 
            une chambre avec 2 lits simples. Côté extérieur, la terrasse couverte offre une vue sur la montagne sans 
            vis-à-vis. La piscine privée, bordée d’une terrasse en ipé est protégée par une barrière en fer forgé. 
            Elle est équipée de transats et de parasol.',
            'nb_room' => '3',
            'nb_bed' => '4',
            'nb_bathroom' => '1',
            'capacity' => '6',
            'sqm' => '90',
            'poster' => 'Lea.jpeg',
        ],


        'Chjara' => [
            'location' => 'Sainte-Lucie-de-Porto-Vecchio Corse-du-Sud France',
            'description' => 'D’une superficie totale de 90 m2, elle dispose d’un grand salon avec une cuisine ouverte. 
            Elle comprend deux chambres doubles (lits en 160) et une petite chambre avec lits superposés. 
            Sa grande terrasse offre une vue panoramique sur les montagnes, et notamment sur les aiguilles 
            de Bavella. La piscine privée est protégée par une barrière en fer forgé 
            et est équipée de transats, salon de jardin et parasols.',
            'nb_room' => '3',
            'nb_bed' => '4',
            'nb_bathroom' => '1',
            'capacity' => '6',
            'sqm' => '90',
            'poster' => 'Chjara.jpeg',
        ],


        'Fiori 1' => [
            'location' => 'Sainte-Lucie-de-Porto-Vecchio Corse-du-Sud France',
            'description' => 'Cette villa allie le charme et le confort. Récente, elle se fond dans la 
            végétation avec sa façade en pierre. D’une superficie de 60 m2, elle dispose d’une chambre 
            parentale climatisée avec un lit double en 160 et d’une chambre avec 2 lits simples, séparées 
            par une salle d’eau. La cuisine moderne américaine est ouverte sur le salon (climatisé). La terrasse 
            couverte permet de profiter des longues soirées d’été. La piscine privée, protégée par une barrière 
            en fer forgé, offre une vue panoramique sur les montagnes. Elle est bordée par une terrasse en 
            ipé et équipée de transats et parasols.',
            'nb_room' => '2',
            'nb_bed' => '3',
            'nb_bathroom' => '1',
            'capacity' => '4',
            'sqm' => '60',
            'poster' => 'Fiori 1.jpeg',
        ],


        'Fiori 2' => [
            'location' => 'Sainte-Lucie-de-Porto-Vecchio Corse-du-Sud France',
            'description' => 'Cette villa est récente (2018). D’une superficie de 60 m2, elle dispose d’une chambre 
            parentale climatisée avec un lit double en 160 et d’une chambre avec 2 lits simples, séparées par une 
            salle d’eau. La cuisine moderne américaine est ouverte sur le salon (climatisé). La terrasse couverte 
            permet de profiter des longues soirées d’été. La piscine privée, protégée par une barrière en fer forgé, 
            offre une vue panoramique sur les montagnes. Elle est bordée par une terrasse 
            en ipé et équipée de transats et parasols.',
            'nb_room' => '2',
            'nb_bed' => '3',
            'nb_bathroom' => '1',
            'capacity' => '4',
            'sqm' => '60',
            'poster' => 'Fiori 2.jpeg',
        ],

    ];

    public function load(ObjectManager $manager)
    {
        $loop = 0;
        foreach (self::VILLAS as $name => $data) {
            $villa = new Villa();
            $villa->setName($name);
            $villa->setLocation($data['location']);
            $villa->setDescription($data['description']);
            $villa->setNbRoom($data['nb_room']);
            $villa->setNbBed($data['nb_bed']);
            $villa->setNbBathroom($data['nb_bathroom']);
            $villa->setCapacity($data['capacity']);
            $villa->setSqm($data['sqm']);
            $villa->setPoster($data['poster']);
            $manager->persist(($villa));
            $loop++;
        }
        $manager->flush();
    }
}
