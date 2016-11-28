<?php

namespace Controller;

use \W\Controller\Controller;
use Model\UtilisateursModel;
class UserController extends BaseController
{
	/*
	Cette fonction sert a afficher la liste des utilisateurs
	*/
	public function listUsers(){
		// $usersList = array(
		// 		'Googleman', 'Pausewoman', 'Pauseman', 'Roland'

		/*
		* ici j'instancie depuis l'action du controleur un modele d'UtilisateursModel
		* pour pouvoir accéder à la liste des utilisateurs
		*/
		$usersModel = new UtilisateursModel();

		$usersList = $usersModel->findAll();

		// je transmets cette liste a ma vue : $file = chemin; $data = données à transmettre
		// la ligne suivante affiche la vue présente dans app/veiw/users/list.php et y injecte le tableau '$usersList' sous un nouveau nom '$listUsers'
		$this->show('users/list', array('listusers' => $usersList));
	}

}
