<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{
	public function beforeFilter(Event $event){
		// Caminho onde eh feito upload do arquivo
		$this->pathUpload = WWW_ROOT.'img'.DS.'uploads'.DS.'products';
		
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
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }
    
    /**
     * Upload da imagem do produto
     *
     * @param integer $idProduct array $inputFile
     */
    private function uploadImage($idProduct, $inputFile){
    	// Remodve as imagens com nome 01
    	$folderProduct = new Folder($this->pathUpload.DS.$idProduct);
    	$files = $folderProduct->find('01.*');
    	foreach($files as $f){
    		$file = new File($this->pathUpload.DS.$idProduct.DS.$f);
    		$file->delete();
    		
    	}
    	
    	// upload
    	$folderProduct = new Folder($this->pathUpload.DS.$idProduct.DS, true);
    	$nameFileProduct = new File($inputFile['name']);
    	$nameFileProduct = "01.".$nameFileProduct->ext();
    	move_uploaded_file($inputFile['tmp_name'], $folderProduct->path.$nameFileProduct);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    	$product = $this->Products->newEntity();
        if ($this->request->is('post')) {        	
        	$product = $this->Products->patchEntity($product, $this->request->getData());
        	
        	if ($this->Products->save($product)) {
            	// Upload da imagem
        		if($imageProduct = $this->request->getData('file_product')){
        			$this->uploadImage($product->id, $imageProduct);
            	}

            	$this->Flash->success(__('The register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Pega a imagem do prduto
     * @param integer $idProduct
     * return String url da imagem do produto
     */
    private function getImage($idProduct){
    	$path = $this->pathUpload.DS.$idProduct.DS;
    	
    	$folderProduct= new Folder($path);
    	$files = $folderProduct->find('01.*');
    	foreach($files as $f){
    		return 'uploads'.DS.'products'.DS.$idProduct.DS.$f;
    	}
    	
    	return null;
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
    	$product = $this->Products->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$product = $this->Products->patchEntity($product, $this->request->getData());

        	if ($this->Products->save($product)) {
            	// Upload da imagem
            	if($this->request->getData('file_product')['size'] > 0){
            		$this->uploadImage($id, $this->request->getData('file_product'));
            	}
            	
                $this->Flash->success(__('The register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register could not be saved. Please, try again.'));
        }

        $this->set('image', $this->getImage($id));
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }
}
