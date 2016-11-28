<?php

namespace Controller;


use Model\SalonsModel;
use Model\MessagesModel;


class SalonController extends BaseController
{

	/**
	 * Cette action permet de voir la listes des messages d'un salon
	 * @param int $id l'id du salon dont je cherche à voir les messages
	 */
	public function seeSalon($id){

		/*
		* On instancie le modele des salons de façon à récuperer les informations
		* du salon dont l'id est $id (passé dans l'url)
		*/
			$salonsModel = new SalonsModel();
			$salon = $salonsModel->find($id);


			// on instancie le modeles des messages pour récuperer les messages du
			// salon dont l'id est $id
			$messagesModel = new MessagesModel();

			/*
			* j'utilise une méthode propre au modèle MessagesModel qui permet de
			* récuperer les messages avec les infos utilisateur assocéees
			*
			*/
			$messages = $messagesModel->searchAllWithUserInfos($id);

			$this->show('Salons/see', array('salon' => $salon, 'messages' => $messages));
	}

}
