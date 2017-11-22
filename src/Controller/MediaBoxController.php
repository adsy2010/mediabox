<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 17:06
 */

namespace MediaBox\Controller;

use InvalidArgumentException;
use MediaBox\Form\VideoForm;
use MediaBox\Model\Video;
use MediaBox\Model\VideoRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MediaBoxController extends AbstractActionController
{
    private $videoRepository;

    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function indexAction()
    {
        try{
            $videos = $this->videoRepository->findAllVideos();
        } catch (InvalidArgumentException $exception){
            return $exception->getMessage();
            //return $this->redirect()->toRoute('mediabox');
        }

        return new ViewModel([
            'videos' => $videos
        ]);
    }

    public function deleteAction()
    {

    }

    public function addAction()
    {

    }

    public function videoAction()
    {
        $id = $this->params()->fromRoute('id');

        try{
            $video = $this->videoRepository->findVideo($id);
            $tags = $this->videoRepository->findVideoTags($id);
        } catch (InvalidArgumentException $exception){
            die($exception->getMessage());
            //return $this->redirect()->toRoute('mediabox');
        }

        return new ViewModel([
            'video' => $video,
            'tags' => $tags
        ]);

        //return ['video' => $video];
    }

}