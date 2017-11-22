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
        $id = $this->params()->fromRoute('id', 0);

        if(!$id){
            return $this->redirect()->toRoute('mediabox');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                //$this->table->deleteAlbum($id);

            }
            else{
                return $this->redirect()->toRoute('mediabox', ['action'=>'video', 'id' => $id]);
            }

            return $this->redirect()->toRoute('mediabox');
            // Redirect to list of albums

        }

        try{
            $video = $this->videoRepository->findVideo($id);
        } catch (InvalidArgumentException $exception){
            return $this->redirect()->toRoute('mediabox');
        }

        return new ViewModel([
            'video' => $video
        ]);
    }

    public function addAction()
    {
        try{
            $tags = $this->videoRepository->findAllTags();
        } catch (InvalidArgumentException $exception){
            return $this->redirect()->toRoute('mediabox');
        }

        $form = new VideoForm();
        $form->get('submit')->setAttribute('value', 'add');

        //testing
        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['tags' => $tags, 'form' => $form];
        }
            //die(json_encode($request->getContent()));
            //$del = $request->getPost();//'del', 'No');

        return new ViewModel([
            'tags' => $tags,
            'form' => $form
        ]);
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