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
		$depart = $this->$this->input->post('depart');
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

	private function check_login_user() {
        if( !$this->session->userdata("log_user") ) {
            redirect(site_url('auth'));
        }
    }

	
}

?>
