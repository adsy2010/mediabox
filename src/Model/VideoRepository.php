<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 20:45
 */

namespace MediaBox\Model;


use InvalidArgumentException;
use RuntimeException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\HydratorInterface;

use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Driver\ResultInterface;

class VideoRepository implements VideoRepositoryInterface
{
    private $db;
    private $hydrator;
    private $videoPrototype;

    public function __construct(
        AdapterInterface $db,
        HydratorInterface $hydrator,
        Video $videoPrototype
    )
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->videoPrototype = $videoPrototype;
    }

    public function findAllVideos()
    {
        // TODO: Implement findAllVideos() method.
        $sql = new Sql($this->db);
        $select = $sql->select('videos');

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator,$this->videoPrototype);
        $resultSet->initialize($result);
        return $resultSet;

    }

    public function findVideo($id)
    {
        // TODO: Implement findVideo() method.
        $sql = new Sql($this->db);
        $select = $sql->select('videos');
        $select->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving video with identifier "%s"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->videoPrototype);
        $resultSet->initialize($result);
        $video = $resultSet->current();

        if (! $video) {
            throw new InvalidArgumentException(sprintf(
                'Video with identifier "%s" not found.',
                $id
            ));
        }

        return $video;
    }
}