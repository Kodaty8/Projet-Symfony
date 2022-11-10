<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\OfferRepository;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class Matching
{
    public function getMatchingOffers(User $user, OfferRepository $offerRepository)
    {
        $skills = $user->getSkills();
        $offers = $offerRepository->findAll();
        $matchingoffers = [];
        foreach ($offers as $offer){
            $matchPercentage =0;
            $requirements = $offer->getRequirements();
            foreach ($requirements as $requirement){
                foreach ($skills as $skill){
                    if ($skill->getName() == $requirement->getName()){
                        $matchPercentage +=1;
                    }
                }
            }
            if ($matchPercentage >= count($requirements)*0.7){
                array_push($matchingoffers, $offer);
            }
        }

        return $matchingoffers;
    }
}