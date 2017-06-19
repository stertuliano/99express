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
	/**
	 * Upload da imagem do produto
	 *
	 * @param integer $idProduct array $inputFile
	 */
	private function _uploadImage($idProduct, $inputFile, $principal=false){
		// Remodve as imagens com nome 01
		$folderProduct = new Folder($this->pathUpload.DS.$idProduct);
		
		// upload
		$folderProduct = new Folder($this->pathUpload.DS.$idProduct.DS, true);
		$nameFileProduct = new File($inputFile['name']);
		if($principal){
			$nameFileProduct = '0001'.md5(rand(1000, 9999)).".".$nameFileProduct->ext();
		}
		else{
			$nameFileProduct = md5(rand(1000, 9999)).".".$nameFileProduct->ext();
		}
		move_uploaded_file($inputFile['tmp_name'], $folderProduct->path.$nameFileProduct);
	}
	
	/**
	 * Pega a imagem do prduto
	 * @param integer $idProduct
	 * return String url da imagem do produto
	 */
	private function _getImages($idProduct){
		$retorno = null;
		$path = $this->pathUpload.DS.$idProduct.DS;
		
		$folderProduct = new Folder($path);
		$files = $folderProduct->find('.*');
		foreach($files as $f){
			$retorno[] = 'uploads'.DS.'products'.DS.$idProduct.DS.$f;
		}
		
		return $retorno;
	}
	
	/**
	 * Pega a imagem principal do produto do prduto (O produto principal eh o arquivo na pasta que comeca com "0001")
	 * @param integer $idProduct
	 * return String url da imagem do produto
	 */
	private function _getPrincipalImage($idProduct){
		$retorno = null;
		$path = $this->pathUpload.DS.$idProduct.DS;
		
		$folderProduct = new Folder($path);
		$files = $folderProduct->find('0001.*');
		
		if(count($files)){
			return $files[0];
		}
		else{
			return false;
		}
	}
	
	/**
	 * Antes de carregar a controller
	 * {@inheritDoc}
	 * @see \Cake\Controller\Controller::beforeFilter()
	 */
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
        		if($imagesProduct = $this->request->getData('files_product')){
        			foreach($imagesProduct as $ip){
        				$this->_uploadImage($product->id, $ip);
        			}
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
     * Funcao para remover imagem do produto via ajax
     */
    public function removeImage(){
    	if ($this->request->is('ajax')){
    		$this->autoRender=false;
    		$key = $this->request->getData('key');
    		$key = explode('-', $key);
    		
    		if(count($key) == 2){
    			$idProduct = $key[0];
    			$imageName = $key[1];
    			
    			$file = new File($this->pathUpload.DS.$idProduct.DS.$imageName);
    			$file->delete();
    		}
    		echo 1;
    		exit;
    	}
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
            	if($imagesProduct = $this->request->getData('files_product')){
            		for($i = 0; $i <= count($imagesProduct)-1; $i++){
            			if( ($i == 0) && !$this->_getPrincipalImage($product->id) ){
            				$this->_uploadImage($product->id, $imagesProduct[$i], true);
            			}
            			else{
            				$this->_uploadImage($product->id, $imagesProduct[$i]);
            			}
            			
            			
            		}
            	}
            	
                $this->Flash->success(__('The register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register could not be saved. Please, try again.'));
        }

        $this->set('images', $this->_getImages($id));
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }
}
