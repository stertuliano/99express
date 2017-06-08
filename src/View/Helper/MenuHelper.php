<?php
namespace App\View\Helper;

use Cake\View\Helper;

class MenuHelper extends Helper
{
	// Se for o menu ativo no memento retorna active
	public function getIsActive($menu, $subMenu=null){
		$controler = $this->_View->name;
		$action = $this->_View->request->getParam('action');
		if($action == '') $action = 'index';
		
		if($subMenu == null){
			if($menu == $controler){
				return 'active a';
			}
		}
		else{
			if(($menu == $controler) && ($subMenu == $action)){
				return 'active';
			}
		}
		
		return '';
	}
}
