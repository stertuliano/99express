<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services
 */
class ServicesController extends AppController
{
	public function beforeFilter(Event $event){
		// Caminho onde eh feito upload do arquivo
		$this->pathUpload = WWW_ROOT.'img'.DS.'uploads'.DS.'services';
		
		// Carrega models necessarias
		$this->loadModel('ServicesAggregates');
		
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
        $services = $this->paginate($this->Services);

        $this->set(compact('services'));
        $this->set('_serialize', ['services']);
    }

    /**
     * View method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => ['ServicesAggregates']
        ]);

        $this->set('service', $service);
        $this->set('_serialize', ['service']);
    }
    
    /**
     * Upload da imagem do servico
     *
     * @param integer $idService array $inputFile
     */
    private function uploadImage($idService, $inputFile){
    	// Remodve as imagens com nome 01
    	$folderService = new Folder($this->pathUpload.DS.$idService);
    	$files = $folderService->find('01.*');
    	foreach($files as $f){
    		$file = new File($this->pathUpload.DS.$idService.DS.$f);
    		$file->delete();
    		
    	}
    	
    	// upload
    	$folderService = new Folder($this->pathUpload.DS.$idService.DS, true);
    	$nameFileService = new File($inputFile['name']);
    	$nameFileService = "01.".$nameFileService->ext();
    	move_uploaded_file($inputFile['tmp_name'], $folderService->path.$nameFileService);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $service = $this->Services->newEntity();
        if ($this->request->is('post')) {        	
        	$service = $this->Services->patchEntity($service, $this->request->getData());
        	
            if ($this->Services->save($service)) {
            	// Upload da imagem
            	if($imageService = $this->request->getData('file_service')){
            		$this->uploadImage($service->id, $this->request->getData('file_service'));
            	}
            	
            	// Adiciona os servicos agregados
            	$this->addAggregates($this->request->getData("aggregates"), $service->id);

            	$this->Flash->success(__('The register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register could not be saved. Please, try again.'));
        }
        $this->set(compact('service'));
        $this->set('_serialize', ['service']);
    }
    
    /**
     * Funcao para inserir servicos agregados
     * @param array $aggregates integer $idService
     */
    private function addAggregates($aggregates, $idService){
    	$this->ServicesAggregates->deleteAll(['service_id' => $idService]);
    	
    	for($i = 1; $i <= count($aggregates['name'])-1; $i++){
    		$aggregate = $this->ServicesAggregates->newEntity();
    		$aggregate = $this->ServicesAggregates->patchEntity($aggregate, [
    				'name' => $aggregates['name'][$i],
    				'description' => $aggregates['description'][$i],
    				'price' => $aggregates['price'][$i],
    				'service_id' => $idService
    		]);
    		$this->ServicesAggregates->save($aggregate);
    	}
    }

    /**
     * Pega a imagem do servico
     * @param integer $idService
     * return String url da imagem do servico
     */
    private function getImage($idService){
    	$path = $this->pathUpload.DS.$idService.DS;
    	
    	$folderService = new Folder($path);
    	$files = $folderService->find('01.*');
    	foreach($files as $f){
    		return 'uploads'.DS.'services'.DS.$idService.DS.$f;
    	}
    	
    	return null;
    }

    /**
     * Edit method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->getData());

            if ($this->Services->save($service)) {
            	// Upload da imagem
            	if($this->request->getData('file_service')['size'] > 0){
            		$this->uploadImage($id, $this->request->getData('file_service'));
            	}
            	
            	// Adiciona os servicos agregados
            	$this->addAggregates($this->request->getData("aggregates"), $id);
            	
                $this->Flash->success(__('The register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register could not be saved. Please, try again.'));
        }

        $this->set('image', $this->getImage($id));
        $aggregates = $this->Services->ServicesAggregates->find()->where(['service_id' => $id]);
        $this->set(compact('service'));
        $this->set(compact('aggregates'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->Flash->success(__('The service has been deleted.'));
        } else {
            $this->Flash->error(__('The service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
