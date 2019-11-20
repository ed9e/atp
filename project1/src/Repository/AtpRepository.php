<?php

namespace App\Repository;

use App\Config\Service;
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
    public $configService;

    public function __construct(ManagerRegistry $registry, Service $configService)
    {
        parent::__construct($registry, Atp::class);
        $this->configService = $configService;
    }

    public function getAtp()
    {
        $values = json_decode($this->configService->load($this->configService::RESOURCE_SESSION_CONFIG, $this->configService::ATP_FETCH_TEST), true);
        $phases = json_decode($this->configService->load($this->configService::RESOURCE_SESSION_CONFIG, $this->configService::ATP_FETCH_MESO_TEST), true);

//        $values = json_decode('
//        {"2019-11-01":40,"2019-11-08":45,"2019-11-15":41,"2019-11-22":44,"2019-11-29":45,"2019-12-06":46,"2019-12-13":29,"2019-12-20":47,"2019-12-27":49,"2020-01-03":29,"2020-01-10":54,"2020-01-17":29,"2020-01-24":48,"2020-01-31":50,"2020-02-07":30,"2020-02-14":47,"2020-02-21":48,"2020-02-28":50,"2020-03-06":30,"2020-03-13":48,"2020-03-20":50,"2020-03-27":51,"2020-04-03":31,"2020-04-10":48,"2020-04-17":50,"2020-04-24":52,"2020-05-01":31,"2020-05-08":53,"2020-05-15":53,"2020-05-22":32,"2020-05-29":52,"2020-06-05":52,"2020-06-12":52,"2020-06-19":32,"2020-06-26":41,"2020-07-03":55,"2020-07-10":30,"2020-07-17":54,"2020-07-24":55,"2020-07-31":32,"2020-08-07":53,"2020-08-14":54,"2020-08-21":55,"2020-08-28":32,"2020-09-04":56,"2020-09-11":56,"2020-09-18":56,"2020-09-25":33,"2020-10-02":43,"2020-10-09":62}
//        ', true);
//        $phases = json_decode('
//        [{"Base2":["2019-11-01","2019-11-15"]},{"Base3":["2019-11-22","2019-12-13"]},{"Build2":["2019-12-20","2020-01-03"]},{"Race":["2020-01-10","2020-01-17"]},{"Base1":["2020-01-24","2020-02-07"]},{"Base2":["2020-02-14","2020-03-06"]},{"Base3":["2020-03-13","2020-05-01"]},{"Build1":["2020-05-08","2020-05-22"]},{"Build2":["2020-05-29","2020-06-19"]},{"Peak":["2020-06-26","2020-06-26"]},{"Race":["2020-07-03","2020-07-03"]},{"Preparation":["2020-07-10","2020-07-10"]},{"Base2":["2020-07-17","2020-07-31"]},{"Base3":["2020-08-07","2020-08-28"]},{"Build2":["2020-09-04","2020-09-25"]},{"Peak":["2020-10-02","2020-10-02"]},{"Race":["2020-10-09","2020-10-09"]}]
//        ', true);
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
