<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 20:46
 */

namespace MediaBox\Model;


interface VideoRepositoryInterface
{
    public function findAllVideos();
    public function findVideo($id);

}