<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Tweet;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TweetRepository extends EntityRepository
{

    public function findTweets($criteria, $page, $count) {
        if (!is_numeric($page)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $page est incorrecte (valeur : ' . $page . ').'
            );
        }

        if ($page < 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        if (!is_numeric($count)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $count est incorrecte (valeur : ' . $count . ').'
            );
        }

        $firstResult = ($page - 1) * $count;

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('t')
            ->from(Tweet::class, 't')
            ->orderBy('t.createdAt','DESC')
            ->setFirstResult($firstResult)
            ->setMaxResults($count);

        if(isset($criteria['username'])) {
            $queryBuilder
                ->andWhere('t.username = :username')
                ->setParameter('username', $criteria['username']);
        }

        if(isset($criteria['hashtag'])) {
            $queryBuilder
                ->andWhere('t.hashtags LIKE :hashtag')
                ->setParameter('hashtag', '%'.$criteria['hashtag'].'%');
        }

        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }
}