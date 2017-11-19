<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 21:44
 */

namespace MediaBox\Factory;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use MediaBox\Model\VideoRepository;
use MediaBox\Model\Video;
use Zend\Db\Adapter\AdapterInterface;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

use Zend\Hydrator\Reflection as ReflectionHydrator;

class VideoRepositoryFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        return new VideoRepository(
            $container->get(AdapterInterface::class),
                new ReflectionHydrator(),
                new Video('','','','','','','','')
        );
    }
}