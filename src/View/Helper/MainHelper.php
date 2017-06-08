<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Filesystem\Folder;
use Cake\I18n\Number;

class MainHelper extends Helper
{
	// Se for o menu ativo no memento retorna active
	public function getStatusName($status){
		if($subMenu == null){
			if($menu == $this->name){
				return 'active a';
			}
		}
		else{
			if(($menu == $this->name) && ($subMenu == $this->request->getParam('action'))){
				return 'active b';
			}
		}
		
		return '';
	}
	
	// Converte para o valor de dinheiro brasileiro
	public function moneyBr($value, $symbol=false){
		if($symbol){
			return Number::currency($value, 'BRL');
		}
		else{
			return str_replace('R$', '', Number::currency($value, 'BRL'));
		}
	}
	
	// peaga a imagem de cada "modulo"
	public function getImage($module, $id){
		$path = WWW_ROOT.'img'.DS.'uploads'.DS.$module.DS.$id.DS;
		$folder = new Folder($path);
		$files = $folder->find('01.*');
		foreach($files as $f){
			return 'uploads'.DS.$module.DS.$id.DS.$f;
		}
		
		return null;
	}
}
