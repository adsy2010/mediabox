<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 20:47
 */

namespace MediaBox\Model;



interface VideoCommandInterface
{
    public function insertVideo(Video $video);
    public function updateVideo(Video $video);
    public function deleteVideo(Video $video);
}