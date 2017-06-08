<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Styles Controller
 *
 * @property \App\Model\Table\StylesTable $Styles
 */
class StylesController extends AppController
{
	
	public function beforeFilter(Event $event){
		// Caminho onde eh feito upload do arquivo
		$this->pathUpload = WWW_ROOT.'img'.DS.'uploads'.DS.'styles';
		
		// Thema do adminLTE
		$this->viewBuilder()->setTheme('AdminLTE');
		$this->viewBuilder()->setLayout('defaultlte');
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $styles = $this->paginate($this->Styles);

        $this->set(compact('styles'));
        $this->set('_serialize', ['styles']);
    }

    /**
     * View method
     *
     * @param string|null $id Style id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $style = $this->Styles->get($id, [
            'contain' => []
        ]);

        $this->set('style', $style);
        $this->set('_serialize', ['style']);
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
    private function getImage($idStyle){
    	$path = $this->pathUpload.DS.$idStyle.DS;
    	 
    	$folderStyle = new Folder($path);
    	$files = $folderStyle->find('01.*');
    	foreach($files as $f){
    		return 'uploads'.DS.'styles'.DS.$idStyle.DS.$f;
    	}
    	 
    	return null;
    }
    
    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $style = $this->Styles->newEntity();
        if ($this->request->is('post')) {
            $style = $this->Styles->patchEntity($style, $this->request->getData());
            if ($this->Styles->save($style)) {
            	// Upload da imagem
            	$this->uploadImage($style->id, $this->request->getData('file_style'));
            	
                $this->Flash->success(__('The style has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The style could not be saved. Please, try again.'));
        }
        $this->set(compact('style'));
        $this->set('_serialize', ['style']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Style id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $style = $this->Styles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $style = $this->Styles->patchEntity($style, $this->request->getData());
            if ($this->Styles->save($style)) {
            	// Upload da imagem
            	if($this->request->getData('file_style')['size'] > 0){
            		$this->uploadImage($style->id, $this->request->getData('file_style'));
            	}
            	
                $this->Flash->success(__('The style has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The style could not be saved. Please, try again.'));
        }
        
        $this->set('image', $this->getImage($id));
        $this->set(compact('style'));
        $this->set('_serialize', ['style']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Style id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $style = $this->Styles->get($id);
        if ($this->Styles->delete($style)) {
            $this->Flash->success(__('The style has been deleted.'));
        } else {
            $this->Flash->error(__('The style could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
