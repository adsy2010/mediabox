<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 21:32
 */

namespace MediaBox\Factory;

use Interop\Container\ContainerInterface;
use MediaBox\Controller\MediaBoxController;
use MediaBox\Model\VideoRepositoryInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class MediaBoxControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        return new MediaBoxController($container->get(VideoRepositoryInterface::class));
    }
}