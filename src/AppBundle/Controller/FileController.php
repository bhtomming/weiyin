<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\6\5 0005
 * Time: 15:30
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AddressController
 * @package AppBundle\Controller
 * @Route("/file")
 */
class FileController extends Controller
{
    /**
     * @Route("/view", name="file_view")
     */
    public function viewAction(){
        $finder = $this->getFinder();
        $imgPath = $this->getParameter('app.path.article_images');
        $images = [];
        foreach ($finder as $file){
            $image['name'] = substr($file->getFilename(),0,strpos($file->getFilename(),'.'.$file->getExtension()));
            $image['path'] = $imgPath.'/'.$file->getFilename();
            $images[] = $image;
        }
        return $this->render('default/file_browser.html.twig',array(
            'images' => $images
        ));
    }

    /**
     * @Route("/upload", name="file_upload")
     */
    public function uploadAction(Request $request){
        $file = $request->files->get('upload');
        $token = $request->request->get('token');
        $fileName = $this->get('app.file.uploader')->upload($file);

        $data  = [
            'uploaded' => 1,
            'fileName' => $fileName,
            'url' => $this->getParameter('app.path.article_images').'/'.$fileName,
        ];
        return new JsonResponse($data);
    }

    /**
     * @Route("/del", name="file_del");
     */
    public function imagesDelAction(Request $request){
        $data = [
            'status' => 202,
        ];
        $fileName = $this->getParameter('kernel.project_dir').'/web'.$request->request->get('fileName');
        if(file_exists($fileName)){
            unlink($fileName);
            $data['status'] = 200;
        }
        return new JsonResponse($data);
    }

    /**
     * @Route("/modify", name="file_mod");
     */
    public function imagesModAction(Request $request){
        $data = [
            'status' => 202,
        ];

        $oldFile = $this->getParameter('kernel.project_dir').'/web'.$request->request->get('filePath');
        $newName = $this->getParameter('kernel.project_dir').'/web'.$this->getParameter('app.path.article_images').'/'.$request->request->get('fileName');

        if(file_exists($oldFile)){
            $extend = substr($oldFile,strrpos($oldFile,'.'));
            rename($oldFile,$newName.$extend);
            $data['status'] = 200;
        }
        return new JsonResponse($data);
    }

    public function getFinder(){
        $finder = new Finder();
        $path = $this->getParameter('kernel.project_dir').'/web'.$this->getParameter('app.path.article_images');
        $finder->files()->in($path);
        return $finder;
    }

}