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

class DeleteController extends AbstractActionController
{
    private $videoRepository;

    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
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
                return $this->redirect()->toRoute('mediabox/video', ['id' => $id]);
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
}