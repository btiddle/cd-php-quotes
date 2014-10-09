<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller extends CI_Controller {

    public function index()
    {
        $this->load->view('login_view');
    }

    public function date_valid($date)
    {
        // http://stackoverflow.com/questions/14359158/codeigniter-date-format-form-validation
        $parts = explode("/", $date);

        if (count($parts) == 3) {
            if (checkdate($parts[1], $parts[0], $parts[2]) AND strlen($parts[2]) == 4)
            {
                return TRUE;
            }
        }
        $this->form_validation->set_message('date_valid', 'The date of birth field must be mm/dd/yyyy');
        return FALSE;
    }

    public function login_valid($password)
    {
        $data = array(
            'password' => $password,
            'email' => $this->session->userdata('email')
        );

        $this->load->model('users');
        $result = $this->users->login_user($data);

        if (empty($result) === TRUE) {
            $this->form_validation->set_message('login_valid', 'Login failed because of incorrect name or password.');
            return FALSE;
        }
        return TRUE;
    }

    public function register()
    {
        // $this->load->view('main');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','name', 'required');
        $this->form_validation->set_rules('alias','alias', 'required');
        $this->form_validation->set_rules('email','email address', 'required|valid_email');
        $this->form_validation->set_rules('birthdate','date of birth', 'required|callback_date_valid');
        $this->form_validation->set_rules('password','password', 'required|min_length[8]|matches[confirm_password]');

        if($this->form_validation->run() == FALSE )
        {
            $this->session->set_flashdata("errors", validation_errors());
            redirect('/');
        }
        else
        {
            $data = array(
                'name' => $this->input->post("name"),
                'alias' => $this->input->post("alias"),
                'email' => $this->input->post("email"),
                'birthdate' => $this->input->post("birthdate"),
                'password' => $this->input->post("password")
            );
            $this->load->model('users');
            $this->users->add_user($data);

            $this->session->set_userdata('email', $this->input->post('email'));
            redirect('/controller/display_quotes');
        }
    }

    public function login()
    {
        $this->session->set_userdata('email', $this->input->post('email'));

        // echo "in login";
        // die();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','email', 'required');
        $this->form_validation->set_rules('password','password', 'required|callback_login_valid');

        if($this->form_validation->run() == FALSE )
        {
            $this->session->set_flashdata("errors", validation_errors());
            redirect('/');
        }
        redirect('/controller/display_quotes');
    }

    public function logout()
    {
        redirect('/');
    }

    public function new_quote()
    {
        $data = array(
            'author' => $this->input->post("author"),
            'quote' => $this->input->post("quote"),
            'posted_by' => $this->input->post("posted_by")
        );
        $this->load->model('quotes');
        $this->quotes->add_quote($data);

        redirect('/controller/display_quotes');
    }

    public function add_to_favorites()
    {
        $data = array(
            'user_id' => $this->input->get('user_id'),
            'quote_id' => $this->input->get('quote_id')
        );

        $this->load->model('quotes');
        $this->quotes->insert_favorites($data);

        redirect('/controller/display_quotes');
    }

    public function remove_from_favorites()
    {
        $data = array(
            'user_id' => $this->input->get('user_id'),
            'quote_id' => $this->input->get('quote_id')
        );

        $this->load->model('quotes');
        $this->quotes->delete_favorites($data);

        redirect('/controller/display_quotes');

    }

    public function display_quotes()
    {
        $this->load->model('users');
        $email = $this->session->userdata('email');
        $user = $this->users->get_user(array("email" => $email));
        $alias = $user['alias'];
        $user_id = $user['user_id'];

        $this->load->model('quotes');
        
        $favorities = $this->quotes->get_favorities(array('user_id' => $user_id));

        $quotables = $this->quotes->get_quotables(array('user_id' => $user_id));

        $view_data = array(
            'alias' => $alias,
            'user_id' => $user_id,
            'favorities' => $favorities,
            'quotables' => $quotables
        );

        $this->load->view('quotes_view', $view_data);
    }

}

/* End of file controller.php */
/* Location: ./application/controllers/controller.php */
