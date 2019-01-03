<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

  public $usersTable = "oes_users";
  public $examinersTable = "oes_examiners";

  function __construct() {
    parent:: __construct();
    date_default_timezone_set('Asia/Manila');
  }

  function loginValidation($data) {
    $loginValidation = $this->db
      ->select('user_id AS id, user_uname AS uname, user_last_login AS lastIn, user_pw AS upass, user_position AS position, user_email AS email')
      ->from($this->usersTable)
      ->where('user_uname', $data['userId'])
      ->where('user_status', 1)
      ->get()
      ->row();
    return $loginValidation;
  }

  function updateLastLogin($userEmail) {
    $data = ['user_last_login'   =>  date("Y-m-d H:i:s")];
    $this->db->where('user_email', $userEmail);
    $updateLastLogin = $this->db->update($this->usersTable, $data);
    return $updateLastLogin;
  }

  function loginWithGoogle($data) {
    $ifExists = $this->db
      ->where('user_email', $data['user_email'])
      ->where('user_status', 1)
      ->get($this->usersTable)
      ->num_rows();
    if ($ifExists == 0) {
      $this->session->set_userdata('userPositionSessId', 1);
      $data = [
        'user_name'         =>   $data['user_name'],
        'user_email'        =>   $data['user_email'],
        'user_uname'        =>   $data['user_uname'],
        'user_google_login' =>   1,
        'user_status'       =>   1,
        'user_position'     =>   1,
        'user_last_login'   =>  date("Y-m-d H:i:s")
      ];
      $loginWithGoogle = $this->db->insert($this->usersTable, $data);
      return $loginWithGoogle;
    } else {
      $ifAdmin = $this->db
        ->where('user_email', $data['user_email'])
        ->where('user_status', 1)
        ->get($this->usersTable)
        ->row();
      if($ifAdmin->user_position == 0) {
        $this->session->set_userdata('userIDSess', $ifAdmin->user_id);
        $this->session->set_userdata('userPositionSessId', 0);
      } else {
        $this->session->set_userdata('userIDSess', $ifAdmin->user_id);
        $this->session->set_userdata('userPositionSessId', 1);
      }
    }
  }

  function signUp($data) {
    $ifExists = $this->db
      ->where('user_email', $data['email'])
      ->where('user_status', 1)
      ->get($this->usersTable)
      ->num_rows();
    if ($ifExists == 0) {
      $newEmail         =   explode('@',  $data['email']);
      $newName          =   $newEmail[0].substr(mt_rand(), 5);
      $newPass          =   $data['newPass'];

      $this->load->library('email');
      $this->email->from('edizon.villegas@transcosmos.com.ph', 'Store');
      $this->email->to($data['email']);
      $this->email->subject('Email Activation');
      $this->email->message('Hi'. $data['fname'] . ' ' . $data['lname'] . '! <br><br>Here is your Username : '.$newName.' <br>Click the link to activate your account. <a href="https://buyandsellstore.000webhostapp.com/users/activate/'.urlencode(substr($newPass, -5) ).'">https://buyandsellstore.000webhostapp.com/users/activate/'.urlencode(substr($newPass, -5) ).'</a>');
      $this->email->set_mailtype('html');
      $this->email->send();

      $data = [
        'user_name'     =>  $data['fname'] . ' ' . $data['lname'],
        'user_email'    =>  $data['email'],
        'user_uname'    =>  $data['fname'].$data['lname'],
        'user_uname'    =>  $newName,
        'user_pw'       =>  $newPass,
        'user_status'   =>  0
      ];
      $signUp = $this->db->insert($this->usersTable, $data);
      return $signUp;
    }
  }

  function activate() {
    $data = ['user_status' => 1];
    $this->db->like('user_pw', urldecode($this->uri->segment('3') ) );
    $activate = $this->db->update($this->usersTable, $data);
  }

  function getAllExaminers($term, $topicId) {
    $getAllExaminers = $this->db
      ->query("SELECT DISTINCT
        u.user_id AS id,
        u.user_name AS name
        FROM oes_users AS u
        LEFT JOIN oes_examiners AS e
        ON u.user_id = e.examiner_id
        WHERE u.user_name LIKE '%".$term."%' && u.user_position != 0")
      ->result();
    return $getAllExaminers;
  }

  function getAllExaminers2($term, $topicId) {
    $getAllExaminers = $this->db
      ->query("SELECT DISTINCT
        u.user_id AS id,
        u.user_name AS name
        FROM oes_users AS u
        WHERE u.user_name LIKE '%".$term."%' && u.user_position = 1 && u.user_id
        NOT IN (SELECT e.examiner_id FROM oes_examiners AS e WHERE e.examiner_id IS NOT NULL && e.examiner_topics = $topicId)")
      ->result();
    return $getAllExaminers;
  }

  function getAllExaminersById($id) {
    $getAllExaminersById = $this->db
      ->select('u.user_id AS id, u.user_name AS name, e.examiner_topic_date_taken AS dateTaken')
      ->from($this->usersTable . ' AS u')
      ->join($this->examinersTable . ' AS e', 'u.user_id = e.examiner_id')
      ->where('u.user_position !=', 0)
      ->where('e.examiner_topics', $id)
      ->get()
      ->result();
    return $getAllExaminersById;
  }

  function verifyPassword($data = []) {
    $verifyPassword = $this->db
      ->where('user_uname', $this->session->userdata('userSessId') )
      ->get($this->usersTable)
      ->row();
    return $verifyPassword;
  }

  function changePassword($newPassword, $userId) {
    $set    =   ['user_pw' =>  $newPassword];
    $where  =   ['user_id' =>  $userId];
    $changepassword = $this->db
      ->where($where)
      ->update($this->usersTable, $set);
    return $changepassword;
  }
  
}