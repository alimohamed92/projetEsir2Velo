<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User extends CI_Controller
{
	private $data = array();
	
    
	public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user', 'user');
    }  
    

    public function index()
	{
		redirect(site_url('auth'));
	}
	
	public function accueil()
	{	//var_dump($this->session->userdata('idUser'));
		$this->check_login_user();
		$res=$this->user->getInfos( $this->session->userdata('idUser') );
		$this->session->set_userdata('infos',$res);
		$data['active']="accueil";
		$this->load->view("etudiant/base_etud", $data);
		$this->load->view("etudiant/view_forum2");
		$this->load->view("etudiant/view_footer");	
	}

	public function ajoutDeplacement()
	{	
	    //$res=$this->user->ajouter_deplacement(1, '$depart', '$arrive', 25.68, 15);
	    $res=$this->user->getCompte($this->input->post('login'),$this->input->post('mp'));
		if($res['error']==0){	
		$depart = $this->input->post('depart');
		$arrive = $this->input->post('arrivee');
		$vitesse = $this->input->post('vitesse');
		$distance = $this->input->post('distance');
		$res=$this->user->ajouter_deplacement($idUser, $depart, $arrive, $vitesse, $distance);
		echo "insertion réeussie !";
		}
		else echo "erreur d'authentification !";
		//redirect(site_url('auth'));
	}


	public function authentification()
	{	
	    $res=$this->user->getCompte($this->input->post('login'),$this->input->post('mp'));
		if($res['error']==0){	
		echo "authentification réeussie !";
		}
		else if($res['error']==1){	
		echo "pas de compte associé à ce login !";
		}
		else echo "erreur d'authentification--->mot de passe  !";
	}

	public function creerUser()
	{	
	    //$res=$this->user->ajouter_deplacement('1', '$depart', '$arrive', 25.68, 15);
		$log =$this->input->post('login');
		$mp = $this->input->post('password');
		$nom = $this->input->post('nom');
		$prenom = $this->input->post('prenom');
		$age = $this->input->post('age');
		$res=$this->user->ajouter_user($log, $mp, $nom, $prenom, $age);
		echo "Opération réeussie !";
	}

	public function vitesse(){
		$this->check_login_user();
		$res = $this->user->getVitesseRecords($this->session->userdata('idUser'));
		$data['active']="records";
		$data['active1']="vitesse";
		$data['records']=$res;
		$this->load->view("etudiant/base_etud", $data);
		$this->load->view("etudiant/view_records", $data);
		$this->load->view("etudiant/view_footer");
	}

	public function distance(){
		$this->check_login_user();
		$res = $this->user->getDistanceRecords($this->session->userdata('idUser'));
		$data['active']="records";
		$data['active1']="Distance";
		$data['records']=$res;
		$this->load->view("etudiant/base_etud", $data);
		$this->load->view("etudiant/view_records", $data);
		$this->load->view("etudiant/view_footer");
	}

		public function historique(){
		$this->check_login_user();
		//$res = $this->user->getDistanceRecords($this->session->userdata('idUser'));
		if( $this->input->post('date1') != null ){
			$res = $this->user->getHistorique($this->session->userdata('idUser'),$this->input->post('date1'),$this->input->post('date2') );
			$data['active']="historique";
			$data['historique'] = $res;
			$data['date1'] = $this->input->post('date1');
			$data['date2'] = $this->input->post('date2');
			$this->load->view("etudiant/base_etud",$data);
			$this->load->view("etudiant/view_historique");
			$this->load->view("etudiant/view_footer");
		}
		else{
			$data['active']="historique";
			$this->load->view("etudiant/base_etud",$data);
			$this->load->view("etudiant/view_historique");
			$this->load->view("etudiant/view_footer");
		}
		
	}


	public function donneesPerso(){
		$this->check_login_user();
		$res = $this->user->getInfos($this->session->userdata('idUser'));
		$data['active']="donnee";
		$data['donnees']=$res;
		$this->load->view("etudiant/base_etud", $data);
		$this->load->view("etudiant/view_donnees", $data);
		$this->load->view("etudiant/view_footer");
	}

	public function modifDonneePerso(){
		$this->check_login_user();
		$nom = $this->input->post('nom');
		$prenom = $this->input->post('prenom');
		$adr = $this->input->post('adresse');
		$age = $this->input->post('age');
		$mail = $this->input->post('mail');
		//var_dump($age); exit();
		$res = $this->user->modifierUser($this->session->userdata('idUser'),$nom,$prenom,$mail,$adr,$age);
		redirect(site_url('user/donneesPerso'));
	}

	public function reinitHistorique(){
		$this->check_login_user();
		//$res = $this->user->getInfos($this->session->userdata('idUser'));
		if($this->input->post('mp') != null){
			$res=$this->user->getCompte($this->input->post('log'),$this->input->post('mp'));
			if($res['error']==0){	
				$this->user->supprimerHistorique($this->session->userdata('idUser'));
			}
			else echo "erreur d'authentification";
		}
		else{
		$data['active']="historique";
		$this->load->view("etudiant/base_etud", $data);
		$this->load->view("etudiant/view_reinitHistorique");
		$this->load->view("etudiant/view_footer");
		}
		
	}

	public function forum(){
		$this->check_login_user();
		$res = $this->user->getSujets();
		$data['active']="forum";
		$data['sujets']=$res;
		$this->load->view("etudiant/base_etud", $data);
		$this->load->view("etudiant/view_forum", $data);
		$this->load->view("etudiant/view_footer");
	}

	public function messages(){
		$this->check_login_user();
		$idSujet = $this->input->get('idSujet');
		//var_dump($this->input->get('idSujet'));
		$res = $this->user->getMessages($idSujet);
		$data['active'] = "forum";
		$data['messages'] = $res;
		$data['sujet'] = $idSujet;
		$data['idUser'] = $this->session->userdata('idUser');
		$this->load->view("etudiant/base_etud", $data);
		$this->load->view("etudiant/view_forum", $data);
		$this->load->view("etudiant/view_footer");
	}

	public function ajouterMessage(){
		$this->check_login_user();
		$idSujet = $this->input->post('idSujet');
		$idUser = $this->input->post('idUser');
		$message = $this->input->post('message');
		$res = $this->user->ajouterMessage($idSujet, $idUser, $message);
		redirect(site_url('user/messages?idSujet='.$idSujet));
	}

	public function supprimerMessage(){
		$this->check_login_user();
		$idMessage = $this->input->get('idMessage');
		$idSujet = $this->input->get('idSujet');
		$res = $this->user->supprimerMessage($idMessage);
		redirect(site_url('user/messages?idSujet='.$idSujet));
	}

	private function check_login_user() {
        if( !$this->session->userdata("log_user") ) {
            redirect(site_url('auth'));
        }
    }

	
}

?>
