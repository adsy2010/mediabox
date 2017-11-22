<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 21/11/2017
 * Time: 23:35
 */

namespace MediaBox\Model;

use InvalidArgumentException;
use PHPUnit\Runner\Exception;
use RuntimeException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\HydratorInterface;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Delete;
use Zend\Db\Adapter\Driver\ResultInterface;

class VideoCommand implements VideoCommandInterface
{

    private $db;
    private $hydrator;
    private $videoPrototype;
    private $tagPrototype;

    public function __construct(
        AdapterInterface $db,
        HydratorInterface $hydrator,
        Video $videoPrototype,
        Tag $tagPrototype
    )
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->videoPrototype = $videoPrototype;
        $this->tagPrototype = $tagPrototype;
    }

    public function insertVideo(Video $video)
    {
        // TODO: Implement insertVideo() method.
    }

    public function updateVideo(Video $video)
    {
        // TODO: Implement updateVideo() method.
    }

    public function deleteVideo(Video $video)
    {
        // TODO: Implement deleteVideo() method.
    }
}