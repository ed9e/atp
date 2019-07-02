<?php


namespace App\Command\Garmin\Traits;


use App\Mapper\Type\Response\EntityFieldMap;
use Symfony\Bundle\MakerBundle\Util\ClassSourceManipulator;

trait EntityManipulate
{

    protected function entityManipulate(string $entityName)
    {
        $path = $this->params->get('kernel.root_dir') . '/Entity/'.$entityName.'.php';
        $src = file_get_contents($path);
        $manipulator = new ClassSourceManipulator($src, true);
        foreach ($this->garminManager->getMap() as $fieldMap) {
            /**@var EntityFieldMap $fieldMap */
            $ret[$fieldMap->getEfi()->getName()] = $fieldMap->getEfi()->getType();
            $manipulator->addEntityField($fieldMap->getEfi()->getName(), ['type' => $fieldMap->getEfi()->getType(), 'nullable' => $fieldMap->getEfi()->getNullable()], $fieldMap->getEfi()->getDescription());
        }

        file_put_contents($path, $manipulator->getSourceCode());
        $this->info('Fields added');
    }
}