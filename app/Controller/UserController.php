<?php

namespace Controller;
use Model\UtilisateursModel;
use W\Security\AuthentificationModel;
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


		public function login() {
			// on va utiliser le model d'Authentification et plus particulierement
			// la méthode isValidLoginInfo à laquelle on passera en params
			// le pseudo/mail et le passeword envoyés en post par l'utilisateur
			//une fois cette vérification faite, on récupere l'utilisateur en bdd
			// on le connect et on le redirige vers la page d'accueil

				if( ! empty($_POST)){
			// je vérifier la non-acuite du pseudo en POST
				if (isset($_POST) && isset($_POST['pseudo'])) {
					// si le pseudo est vide en ajoute un message d'erreur
			    }
				// je verifier la non-vacuité du mot de passe en POST
				if (isset($_POST) && isset($_POST['mot_de_passe'])) {
		    	}
				}
			$auth = new AuthentificationModel();
			if( !empty($_POST['pseudo']) && !empty($_POST['mot_de_pasee'])){
				//vérification de l'existence de l'utilisateur
				$idUser = $auth->isValidLoginInfo($_POST['pseudo'], $_POST['mot_de_passe']);

				if($idUser !== 0){
					$utilisateurModel = new UtilisateursModel();

					// je récupere les infos de l'utilisateur et je m'en sert pour le connecter au site à l'aide de
					// $auth->logUserIn
					$userInfos = $utilisateurModel->find($idUser);
					$auth->logUserIn($userInfos);

					// une fois l'utilisateur connecter, je le redirige vers l'accueil
					$this->redirectToRoute('default_home');
				} else {
					// les infos de connexion sont incorrectes, on avertit
					// l'utilisateur
				}
			}
			$this->show('users/login', array('datas' => isset($_POST) ? $_POST : array()));
		}

		public function logout(){
			$auth = new authentificationModel();
			$auth->logUserOut();
			$this->redirectToRoute('login');
		}
}
