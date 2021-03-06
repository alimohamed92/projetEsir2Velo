<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model
{
	    private $table='Users';



    public function getcompte($log,$mp) {
        
        $res = $this->db->select('*')
                        ->from('Users')
                        ->where('login', $log)
                        ->get()
                        ->result_array();

        if(count($res)!=1){
        	return array("error" => 1, "user" => false);
        } 
        else{
            if ( password_verify( $mp, $res['0']['password'] ) ){
                return array("error" => 0, "user" => true, "id"=>$res[0]['Id_User']);
            }
        	else return array("error" => 2, "user" => false);
        }               
       
    }

    public function getInfos($id){
             $res = $this->db->select('*')
                            ->from('Users')
                            ->where('id_User', $id)
                            ->get()
                            ->result_array();
            return $res;
    }


    public function getVitesseRecords($id){
             $res = $this->db->select('*')
                            ->from('deplacement')
                            ->limit(10)
                            ->order_by('vitesseMoy', 'desc')
                            ->where('idUser', $id)
                            ->get()
                            ->result_array();
            return $res;
        }


    public function getDistanceRecords($id){
             $res = $this->db->select('*')
                            ->from('deplacement')
                            ->limit(10)
                            ->order_by('distancePar', 'desc')
                            ->where('idUser', $id)
                            ->get()
                            ->result_array();
            return $res;
        }


    public function getSujets(){
         $res = $this->db->select('*')
                            ->from('sujet')
                            ->order_by('dateAjout', 'desc')
                            ->get()
                            ->result_array();
        return $res;
    }    

    
    public function getMessages($idSujet){
            $res = $this->db->select('*')
                            ->from('message')
                            ->order_by('dateAjout', 'desc')
                            ->where('sujetId', $idSujet)
                            ->get()
                            ->result_array();
            return $res;
        } 


    public function supprimerMessage($id){
         $tableName = "message";
         $res = $this->db->where('idMessage',$id)
                         ->delete($tableName);
         return $res;
        }    


    public function ajouterMessage($idSujet, $idUser, $message)
        {
            return $this->db->set('sujetId', $idSujet)
                    ->set('idUser',  $idUser)
                    ->set('message',    $message)
                    ->set('dateAjout', 'NOW()', false)
                    ->insert("message");
        }

    public function getHistorique($id,$date1,$date2){
        $where = 'date >= \''.$date1.'\' AND date <= \''.$date2.'\'';
            $res = $this->db->select('*')
                            ->from('deplacement')
                            ->order_by('date', 'desc')
                            ->where('idUser', $id)
                            ->where($where)
                            ->get()
                            ->result_array();
            return $res;
        }

    /*public function getHistoriqueMoiDernier($id){
        $where = 'date >= \''.$date2.'\' AND date <= \''.$date2.'\'';
            $res = $this->db->select('*')
                            ->from('deplacement')
                            ->order_by('vitesseMoy', 'desc')
                            ->where('idUser', $id)
                            ->where($where)
                            ->get()
                            ->result_array();
            return $res;
        }  */  


    public function ajouter_deplacement($idUser, $depart, $arrive, $vitesse, $distance)
        {
            return $this->db->set('idUser', $idUser)
                    ->set('pointDepart',  $depart)
                    ->set('pointArrivee',    $arrive)
                    ->set('date', 'NOW()', false)
                    ->set('vitesseMoy', $vitesse)
                    ->set('distancePar', $distance)
                    ->insert("deplacement");
        }

    public function ajouter_user($log, $mp, $nom, $prenom, $age)
        {
            return $this->db->set('Login', $log)
                    ->set('password',  $mp)
                    ->set('Nom',    $nom)
                    ->set('dateInscription', 'NOW()', false)
                    ->set('Prenom', $prenom)
                    ->set('Age', $age)
                    ->insert("deplacement");
        }

    public function modifierUser($id, $nom, $prenom, $mail, $adresse, $age) {
        $user = array(
            'Nom' => $nom,
            'Prenom' => $prenom,
            'mail'=> $mail,
            'adresse'=> $adresse,
            'Age'=>$age
            );
        $res = $this->db->where('Id_User', $id)
                        ->update($this->table, $user);
        return $res;
    }


    public function supprimerHistorique($id){
        $tableName = "deplacement";
         $res = $this->db->where('idUser',$id)
                         ->delete($tableName);
         return $res;
        }   

}