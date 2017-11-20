<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 23:28
 */

namespace MediaBox\Model;


class Tag
{
    private $tagId;
    private $categoryId;
    private $tagCategory;
    private $tagName;

    public function __construct($categoryId, $tagCategory, $tagName, $tagId = null)
    {
        $this->categoryId = $categoryId;
        $this->tagCategory = $tagCategory;
        $this->tagName = $tagName;
        $this->tagId = $tagId;
    }

    /**
     * @return mixed
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return mixed
     */
    public function getTagCategory()
    {
        return $this->tagCategory;
    }

    /**
     * @return mixed
     */
    public function getTagName()
    {
        return $this->tagName;
    }
}