<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 20:20
 */

namespace MediaBox\Model;


class Video
{
    private $id;
    private $description;
    private $uploadedOn;
    private $format;
    private $duration;
    private $url;
    private $thumbnail;
    private $name;

    public function __construct($description, $uploadedOn, $format, $duration, $url, $thumbnail, $name, $id = null)
    {
        $this->description = $description;
        $this->uploadedOn = $uploadedOn;
        $this->format = $format;
        $this->duration = $duration;
        $this->url = $url;
        $this->thumbnail = $thumbnail;
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUploadedOn()
    {
        return $this->uploadedOn;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return mixed
     */
    public function getUploaded()
    {
        return $this->uploaded;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }
}