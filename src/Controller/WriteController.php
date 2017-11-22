<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 21/11/2017
 * Time: 23:32
 */

namespace MediaBox\Controller;


use InvalidArgumentException;
use MediaBox\Model\VideoRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use MediaBox\Form\VideoForm;
use MediaBox\Model\Video;

class WriteController extends AbstractActionController
{
    private $videoRepository;

    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function editAction()
    {
        //same as view at the moment
        $id = $this->params()->fromRoute('id');

        try{
            $video = $this->videoRepository->findVideo($id);
            $tags = $this->videoRepository->findAllTags();
        } catch (InvalidArgumentException $exception){
            return $this->redirect()->toRoute('mediabox');
        }

        return new ViewModel([
            'video' => $video,
            'tags' => $tags
        ]);
    }

}