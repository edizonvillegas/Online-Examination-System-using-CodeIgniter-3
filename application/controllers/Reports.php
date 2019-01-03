<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	function __construct() {
		parent::__construct();
		if ( ! $this->session->userdata('userSessId') ) {
      		$this->session->set_flashdata('msg', 'Please login to continue!');
			redirect(base_url().'users/login');
		} else {
			$this->load->model('Reports_model');
		}
	}

	function index() {
		$this->all();
  }
    
  function all() {

    $this->load->library('pagination');
    $config['full_tag_open']    =   "<ul class='pagination pull-right'>";
    $config['full_tag_close']   =   "</ul>";
    $config['num_tag_open']     =   '<li>';
    $config['num_tag_close']    =   '</li>';
    $config['cur_tag_open']     =   "<li class='disabled'><li class='active'><a href='#'>";
    $config['cur_tag_close']    =   "<span class='sr-only'></span></a></li>";
    $config['next_tag_open']    =   "<li>";
    $config['next_tagl_close']  =   "</li>";
    $config['prev_tag_open']    =   "<li>";
    $config['prev_tagl_close']  =   "</li>";
    $config['first_tag_open']   =   "<li>";
    $config['first_tagl_close'] =   "</li>";
    $config['last_tag_open']    =   "<li>";
    $config['last_tagl_close']  =   "</li>";
    $config["base_url"] = base_url() . "reports/all/";
    $config["total_rows"] = $this->Reports_model->countReports();
    $config["per_page"] = 1;
    $config['uri_segment'] = 3;
    $limit = $config['per_page'];
    $data["total_rows"] =  $config["total_rows"];
    $this->pagination->initialize($config);

    $page = ($this->uri->segment(3) ) ? $this->uri->segment(3) : 0;

    $data["links"] = $this->pagination->create_links();


    $data['reports'] = $this->Reports_model->reports($page, $limit);

    $this->template->set('title', 'Reports');
    $this->template->load('template', 'reports', $data);
  }

  function history($id) {
  	$this->load->library('pagination');
    $config['full_tag_open']    =   "<ul class='pagination pull-right'>";
    $config['full_tag_close']   =   "</ul>";
    $config['num_tag_open']     =   '<li>';
    $config['num_tag_close']    =   '</li>';
    $config['cur_tag_open']     =   "<li class='disabled'><li class='active'><a href='#'>";
    $config['cur_tag_close']    =   "<span class='sr-only'></span></a></li>";
    $config['next_tag_open']    =   "<li>";
    $config['next_tagl_close']  =   "</li>";
    $config['prev_tag_open']    =   "<li>";
    $config['prev_tagl_close']  =   "</li>";
    $config['first_tag_open']   =   "<li>";
    $config['first_tagl_close'] =   "</li>";
    $config['last_tag_open']    =   "<li>";
    $config['last_tagl_close']  =   "</li>";
    $config["base_url"] = base_url() . "Questions/results/history/";
    $config["total_rows"] = $this->Reports_model->countSearchHistory($id);
    $config["per_page"] = 15;
    $config['uri_segment'] = 3;
    $limit = $config['per_page'];
    $data["total_rows"] = $config["total_rows"];
    $this->pagination->initialize($config);

    $page = ($this->uri->segment(4) ) ? $this->uri->segment(4) : 0;

    $data["links"] = $this->pagination->create_links();


    $data['reports'] = $this->Reports_model->searchHistory($id, $page, $limit);

    $this->template->set('title', 'Reports');
    $this->template->load('template', 'reports', $data);
  }

}