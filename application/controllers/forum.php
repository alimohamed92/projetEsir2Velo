<?php

class Forum extends CI_Controller
{
	public function accueil()
	{
		/*$this->load->library('email');
		$this->email->from('alimohamedaffizou@gmail.com', 'Ali');
		$this->email->to('alimohamedaffizou@yahoo.fr');
		$this->email->subject("Titre de l'email");
		$this->email->message('ton message');                        
		$this->email->send();*/
		$this->load->view("view_test");
		if( isset($_POST['test']) ){
			  $tabCheckbox = $_POST['test'];
              foreach ($tabCheckbox as $checkbox){
				  echo "test ".$checkbox;
				 }
			}
	}

	
	public function testTuto()
	{
		
		$this->load->view("etudiant/base_etud");
		$this->load->view("etudiant/view_forum2");
		$this->load->view("etudiant/view_footer");
		
	}
	
}

?>
