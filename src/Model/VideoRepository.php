<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 20:45
 */

namespace MediaBox\Model;


use InvalidArgumentException;
use PHPUnit\Runner\Exception;
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

    public function findAllVideos()
    {
        $sql = new Sql($this->db);
        $select = $sql->select()->from(array('v' => 'videos'))
                ->limit(10);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator,$this->videoPrototype);
        $resultSet->initialize($result);
        return $resultSet;

    }

    public function findAllTags()
    {
        $sql = new Sql($this->db);
        $select = $sql
                ->select(array('t'=>'tags'))
                ->join(array('tc' => 'tagcategory'), 't.category = tc.id', array('tagCategory'=>'name', 'categoryId' => 'id'))
                ->columns(array('tagName' => 'name', 'tagId' => 'id'))
                ->order(array('tagName ASC')
        );

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator,$this->tagPrototype);
        $resultSet->initialize($result);
        return $resultSet;
    }

    public function findVideoTags($id)
    {
        $sql = new Sql($this->db);

        $select = $sql->select()
            ->from(array('v' => 'videotags'))
            ->join(array('t' => 'tags'), 'v.tagId = t.id', array('tagId' => 'id', 'tagName' => 'name'))
            ->join(array('tc' => 'tagcategory'), 't.category = tc.id', array('tagCategory' => 'name', 'categoryId'=>'id'))
            ->columns(array())
            ->where(['videoId = ?' => $id]);


        //SELECT tags.id as tagId, tagcategory.id as categoryId, tagcategory.name as tagCategory, tags.name as tagName FROM videotags
        //INNER JOIN tags ON videotags.tagId = tags.id
        //INNER JOIN tagcategory ON tags.category = tagcategory.id;

        /*$state = json_encode($select->getRawState());
        throw new RuntimeException(sprintf(
            '"%s"',
            $state
        ));*/


        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator,$this->tagPrototype);
        $resultSet->initialize($result);
        return $resultSet;
        /*
        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving video tags with video identifier "%s"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->tagPrototype);
        $resultSet->initialize($result);
        $tags = $resultSet->current();

        if (!$tags) {
            throw new InvalidArgumentException(sprintf(
                'Video with identifier "%s" not found.',
                $id
            ));
        }

        return $tags;*/
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