<?php

namespace App\Repository;

use App\Entity\Atp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Atp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Atp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Atp[]    findAll()
 * @method Atp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Atp::class);
    }

    public function getAtp()
    {
        $values = json_decode('{"2019-11-01":54,"2019-11-08":60,"2019-11-15":29,"2019-11-22":57,"2019-11-29":60,"2019-12-06":28,"2019-12-13":57,"2019-12-20":57,"2019-12-27":57,"2020-01-03":28,"2020-01-10":58,"2020-01-17":27,"2020-01-24":52,"2020-01-31":58,"2020-02-07":28,"2020-02-14":43,"2020-02-21":52,"2020-02-28":58,"2020-03-06":28,"2020-03-13":45,"2020-03-20":58,"2020-03-27":60,"2020-04-03":28,"2020-04-10":45,"2020-04-17":58,"2020-04-24":60,"2020-05-01":28,"2020-05-08":60,"2020-05-15":60,"2020-05-22":28,"2020-05-29":58,"2020-06-05":58,"2020-06-12":58,"2020-06-19":28,"2020-06-26":39,"2020-07-03":27,"2020-07-10":24,"2020-07-17":54,"2020-07-24":60,"2020-07-31":22,"2020-08-07":45,"2020-08-14":58,"2020-08-21":60,"2020-08-28":22,"2020-09-04":57,"2020-09-11":57,"2020-09-18":57,"2020-09-25":22,"2020-10-02":39,"2020-10-09":27}', true);
        $phases = json_decode('[{"Base2":["2019-11-01","2019-11-15"]},{"Base3":["2019-11-22","2019-12-06"]},{"Build2":["2019-12-13","2020-01-03"]},{"Race":["2020-01-10","2020-01-10"]},{"Base1":["2020-01-17","2020-02-07"]},{"Base2":["2020-02-14","2020-03-06"]},{"Base3":["2020-03-13","2020-05-01"]},{"Build1":["2020-05-08","2020-05-22"]},{"Build2":["2020-05-29","2020-06-19"]},{"Peak":["2020-06-26","2020-06-26"]},{"Race":["2020-07-03","2020-07-03"]},{"Preparation":["2020-07-10","2020-07-10"]},{"Base2":["2020-07-17","2020-07-31"]},{"Base3":["2020-08-07","2020-08-28"]},{"Build2":["2020-09-04","2020-09-25"]},{"Peak":["2020-10-02","2020-10-02"]},{"Race":["2020-10-09","2020-10-09"]}]', true);
        return [$values, $phases];
    }
    // /**
    //  * @return Atp[] Returns an array of Atp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Atp
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
