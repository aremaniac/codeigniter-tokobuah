<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

  public function __construct()
   {
       parent::__construct();
       $this->load->model("user_model");
       $this->load->library('form_validation');
       $this->clear_cache();
   }

    public function index() {
        $this->load->view("halaman_login");
    }

    public function proses_login() {
        $user = $this->input->post("username");
        $pass = $this->input->post("password");

        $login = $this->user_model->cek_user($user, $pass);

        if (!empty($login)) {
            // login berhasil
            $login['login_status'] = 'logged_in';
            $this->session->set_userdata($login);
            // print_r($this->session->userdata()); die;
            redirect(site_url('admin'));
        } else {
            // login gagal
            $this->session->set_flashdata("gagal", "Username atau Password Salah!");
            redirect(site_url('login'));
        }
    }

    public function logout() {
      $this->session->unset_userdata("login_status");
      $this->session->sess_destroy();

      redirect(site_url('login'));
    }

    function clear_cache()
    {
      $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
    }
}
