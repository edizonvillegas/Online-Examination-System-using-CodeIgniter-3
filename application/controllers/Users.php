<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct() {
		parent::__construct();
		if ($this->uri->segment(2) != "logout" && $this->session->userdata('userSessId') != "" && $this->uri->segment(2) != "changepassword" && $this->uri->segment(2) != "newpassword") {
			redirect(base_url() );
		}
		$this->load->model('Users_model');
	}

	function index() {
		$this->login();
	}

	function login() {
		$this->template->set('title', 'Login');
		$this->template->load('template', 'login');
	}

	function login_validation() {
		if ($formData = $this->input->post() ) {
			if ($getUser = $this->Users_model->loginValidation($formData) ) {
				$userUname = $getUser->uname;
				if ($userUname) {
					$userPass = $getUser->upass;
					$password = $formData['userPass'];
					if (password_verify($password, $userPass) ) {
						$this->session->set_userdata('userSessId', $userUname);
						if($getUser->position == 0 && $getUser->id == 1) {
							$this->session->set_userdata('userPositionSessId', $getUser->position);
						} else {
							$this->session->set_userdata('userPositionSessId', 1);
						}
						$this->session->set_userdata('userLastLoggedInSessId', date("Y-m-d H:i:s") );
						$this->Users_model->updateLastLogin($getUser->email);
						$this->session->set_userdata('lastIn', date("Y-m-d H:i:s") );
						$this->session->set_userdata('userIDSess', $getUser->id);
						redirect(base_url().'questions' );
					}
					else {
						$this->loginMsg('Invalid User');
					}
				} else {
					$this->loginMsg('Invalid User!');
				}
			} else {
				$this->loginMsg('Invalid User!');
			}
		} else {
			$this->loginMsg('Page not found!');
		}
	}

	function loginMsg($msg) {
		$this->session->set_flashdata('msg', $msg);
		redirect(base_url().'users/login' );
	}

	function insertGoogleInfo() {
		$data = $this->input->post();
		$this->Users_model->loginWithGoogle($data);
		$this->session->set_userdata('userLastLoggedInSessId', date("Y-m-d H:i:s") );
		$this->Users_model->updateLastLogin($data['user_email']);
		$this->session->set_userdata('lastIn', date("Y-m-d H:i:s") );
		$this->session->set_userdata('gmailSessId', 1);
		$this->session->set_userdata('userSessId', $data['user_uname']);
	}

	function logout() {
		$this->session->sess_destroy();
		$this->session->unset_userdata('userSessId');
		$this->session->unset_userdata('letters');
		redirect(base_url().'users/login' );
	}

	function signup() {
		$this->template->set('title', 'Sign Up');
		$this->template->load('template', 'signup');
	}

	function signUpMsg($stat, $msg) {
		$this->session->set_flashdata($stat, $msg);
		redirect(base_url().'users/signup' );
	}

	function signup_validation() {
		$data = $this->input->post();
		$data['newPass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
		if ($this->Users_model->signUp($data) ) {
			$this->signUpMsg('success', 'Verify your email to continue!');
		} else {
			$this->signUpMsg('failed', 'Email already exist!');
		}
	}

	function activate() {
		if ($this->uri->segment('3') != "") {
			$this->Users_model->activate();
			$this->signUpMsg('success', 'Account activated, you can now login!');
		} else {
			$this->signUpMsg('failed', 'Activation code not found!');
		}
	}

	function changepassword() {
		$this->template->set('title', 'Change Password');
		$this->template->load('template', 'change_password');
	}

	function newpassword($data = []) {
		$formData = $this->input->post();
		$userId = $this->session->userdata('userIDSess');

		$password = $formData['oldPassword'];
		$newPassword = $formData['newPassword'];
	    $newhash = password_hash($newPassword, PASSWORD_DEFAULT);
	    $result = $this->Users_model->verifyPassword($formData);
	    if (password_verify($password, $result->user_pw) ) {

	      	if($formData['newPassword'] != $formData['confirmNewPassword']) {
				$this->session->set_flashdata('passwordChanged', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password didnt match!</div>');
			} else {
				echo 'ok';
				$this->session->set_flashdata('passwordChanged', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password Changed!</div>');
				$this->Users_model->changePassword($newhash, $userId);
			}
	    }
	    else
	    {
	      if($formData['newPassword'] != $formData['confirmNewPassword']) {
				$this->session->set_flashdata('passwordChanged', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password didnt match!</div>');
			} else {
				$this->session->set_flashdata('passwordChanged', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>User didnt exist!</div>');
			}
	    }


		redirect(base_url().'users/changepassword');
	}
}
