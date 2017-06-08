<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Banners Controller
 *
 */
class BannersController extends AppController
{
	
	public function beforeFilter(Event $event){
		// Caminho onde eh feito upload do arquivo
		$this->pathUpload = WWW_ROOT.'img'.DS.'uploads'.DS.'banners';
		
		// Thema do adminLTE
		$this->viewBuilder()->setTheme('AdminLTE');
		$this->viewBuilder()->setLayout('defaultlte');
	}
    
    /**
     * Upload da imagem do style
     *
     * @param integer $idStyle array $inputFile
     */
    private function uploadImage($idStyle, $inputFile){
    	// Remodve as imagens com nome 01
    	$folderStyle = new Folder($this->pathUpload.DS.$idStyle);
    	$files = $folderStyle->find('01.*');
    	foreach($files as $f){
    		$file = new File($this->pathUpload.DS.$idStyle.DS.$f);
    		$file->delete();
    	}

    	// Upload
    	$folderStyle = new Folder($this->pathUpload.DS.$idStyle.DS, true);
    	$nameFileStyle = new File($inputFile['name']);
    	$nameFileStyle = "01.".$nameFileStyle->ext();
    	move_uploaded_file($inputFile['tmp_name'], $folderStyle->path.$nameFileStyle);
    }

    /**
     * Pega a imagem do style
     * @param integer $idStyle
     * return String url da imagem do style
     */
    private function getImage($placeHolder){
    	$path = $this->pathUpload.DS.$placeHolder.DS;
    	 
    	$folderBanner = new Folder($path);
    	$files = $folderBanner->find('01.*');
    	foreach($files as $f){
    		return 'uploads'.DS.'banners'.DS.$placeHolder.DS.$f;
    	}
    	 
    	return null;
    }

    /**
     * Edit method
     *
     * @param string|null $id Style id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($placeHolder=null)
    {
        if ($this->request->is(['patch', 'post', 'put'])) {

            // Upload da imagem
			if($this->request->getData('file_banner')['size'] > 0){
				$this->uploadImage($placeHolder, $this->request->getData('file_banner'));
			}
            	
			$this->Flash->success(__('The register has been saved.'));

			return $this->redirect(['action' => 'edit', $placeHolder]);
        }
        
        $this->set('image', $this->getImage($placeHolder));
        $this->set('placeHolder', $placeHolder);
        $this->set(compact('banner'));
        $this->set('_serialize', ['banner']);
    }
}
