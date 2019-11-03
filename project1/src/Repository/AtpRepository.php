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
        $values = json_decode('
        {"2019-11-01":53,"2019-11-08":59,"2019-11-15":24,"2019-11-22":57,"2019-11-29":58,"2019-12-06":59,"2019-12-13":26,"2019-12-20":64,"2019-12-27":32,"2020-01-03":36,"2020-01-10":65,"2020-01-17":26,"2020-01-24":53,"2020-01-31":55,"2020-02-07":57,"2020-02-14":25,"2020-02-21":55,"2020-02-28":58,"2020-03-06":59,"2020-03-13":26,"2020-03-20":59,"2020-03-27":60,"2020-04-03":61,"2020-04-10":27,"2020-04-17":42,"2020-04-24":57,"2020-05-01":60,"2020-05-08":60,"2020-05-15":29,"2020-05-22":51,"2020-05-29":55,"2020-06-05":56,"2020-06-12":56,"2020-06-19":27,"2020-06-26":36,"2020-07-03":60,"2020-07-10":27,"2020-07-17":28,"2020-07-24":60,"2020-07-31":60,"2020-08-07":59,"2020-08-14":23,"2020-08-21":53,"2020-08-28":55,"2020-09-04":56,"2020-09-11":56,"2020-09-18":26,"2020-09-25":35,"2020-10-02":38,"2020-10-09":62}
        ', true);
        $phases = json_decode('
        [{"Base2":["2019-10-25","2019-11-15"]},{"Base3":["2019-11-22","2019-12-06"]},{"Build2":["2019-12-13","2020-01-03"]},{"Race":["2020-01-10","2020-01-10"]},{"Base1":["2020-01-17","2020-02-07"]},{"Base2":["2020-02-14","2020-03-06"]},{"Base3":["2020-03-13","2020-04-10"]},{"Build1":["2020-04-17","2020-05-15"]},{"Build2":["2020-05-22","2020-06-19"]},{"Peak":["2020-06-26","2020-06-26"]},{"Race":["2020-07-03","2020-07-03"]},{"Preparation":["2020-07-10","2020-07-17"]},{"Base2":["2020-07-24","2020-08-14"]},{"Base3":["2020-08-21","2020-08-28"]},{"Build2":["2020-09-04","2020-09-25"]},{"Peak":["2020-10-02","2020-10-02"]},{"Race":["2020-10-09","2020-10-09"]}]
        ', true);
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
