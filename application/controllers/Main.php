<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // load form validation library
        $this->load->helper('form');          
    }

	public function index()
	{
		$this->load->view('members');
	}

	public function search()
	{
		$this->load->view('search');
	}

	public function login()
	{
        $this->load->view('login');   // login view folder
	}

	public function signup()
	{
        $this->load->view('signup'); // signup view folder
	}

	public function forgotpass()
	{
		$this->load->view('forgotpass');
	}

	public function reset_pass_user()
	{
		if(!$this->session->userdata('is_authenticated'))
		{
		   redirect('main/forgotpass');
		}
		else
		{
           $this->load->view('reset_pass_user');
		}
	}

	public function userlogout()
	{
	     $this->load->view('login'); 
	}

	public function profile()
	{
	    if(!$this->session->userdata('is_login'))
	    {
           redirect('main');  	
	    }
	    else
	    {
	       $this->load->view('profile');	
	    }	    
	}

    public function comments()
    {
        $this->load->view('comments');
    }



	public function login_validation() // controller of login view
	{

		$this->form_validation->set_rules('user_mail', 'User_mail', 'required|trim|callback_validate_credentials'); // true means xss_clean enabled

		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		// run method means if form_validation->set rules is verified then run
		if($this->form_validation->run())
		{

			$user_info = $this->model_users->get_user();

			$data = array(
                 
                'username' => $user_info['username'],
                'email' => $user_info['email'],
                'created_at' => $user_info['created_at'],
                'id' => $user_info['id'],
                
                'is_login' => 1  // means if logged in
			);
            
			$this->session->set_flashdata('category_success', 'success message');
			$this->session->set_userdata($data);
			redirect('main/profile');
		}
		else
		{
			$this->load->view('login');
		}
	}


	public function validate_credentials()
	{
		if ($this->model_users->can_log_in()) // can_log_in evaluates if can log in
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('validate_credentials', 'Login details is invalid'); //sends error message
			return false;
		}
	}


	public function signup_validation()
	{

		$this->form_validation->set_rules('username', 'Username', 'required|trim');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[users.email]');

		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

		$this->form_validation->set_message('is_unique', 'That email address already exists'); //overide set_rules is_unique email

		if($this->form_validation->run())
		{
			//generate a random key
			$key = md5(uniqid());

           //send email
            
			$this->load->library('email');
			$this->email->from('diximojesse@gmail.com', 'Authentication in CI3');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Confirm Email');
            $this->email->set_mailtype("html");

			$message = "<div style='background:teal; padding:50px 50px; border-radius:20px;
			<div style='font-size:30px;font-weight:bold;color:white;'>
             <p style='font-size:20px;color:#fff;font-weight:bold'>Thank you for your registration please click the link below to complete your registration</p>
            
            <br /><br />
            <a style='-webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: solid 1px #1A4575;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            background: #3A68A1;
            color: #fee1cc;
            text-decoration: none;
            padding: 8px 12px;
            text-decoration: none;
            font-size: larger;
            }'
			href='".base_url()."main/register_user/$key'>Click Here</a>
			</div>
			
			</div>";

			$this->email->message($message);
            
			if($this->email->send())
			{
			   
			}
			else
			{
			   $this->session->set_flashdata('signup_failed', 'error message');
			   redirect('main/signup');
			}



			$this->model_users->add_temp_user($key); //add input fields $key to temp_users db
            $this->session->set_flashdata('signup_success', 'success message');
		    redirect('main/signup');
		}

		else
		{ 
		   $this->load->view('signup'); 
		}
	}


	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('logout_success', 'success message');
		redirect('main/login');
	}


	public function register_user($key) // Generated key value sent to email 
	{

		if($this->model_users->is_key_valid($key)) // evaluates if $key value is valid
		{
		    if($newemail = $this->model_users->add_user($key))
		    {

			    $data = array(
                 
                'username' => $newemail['username'],
                'email' => $newemail['email'],
                'created_at' => $newemail['created_at'],
                'id' => $newemail['id'],
                
                'is_login' => 1  // means if logged in

			    );

		    	$this->session->set_flashdata('category_success', 'success message');
		    	$this->session->set_userdata($data);
		    	redirect('main/profile');
		    }
		    else
		    {
		    	$this->session->set_flashdata('signup_failed', 'error message');
		    	redirect('main/signup');
		    }
		}
		else
		{
		    $this->session->set_flashdata('signup_failed', 'error message');
		    redirect('main/signup');
		}
	}


    public function forgotpass_validation()
    {

    	$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_validate_forgotpass');

    	if($this->form_validation->run())
    	{
    	     $resetkey = md5(uniqid());

    	    //send email

			$this->load->library('email');
			$this->email->from('diximojesse@gmail.com', 'Reset Password');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Reset Password');
            $this->email->set_mailtype("html");
            
            $message = "<div style='background:teal; padding:50px 50px; border-radius:20px;
			<div style='font-size:30px;font-weight:bold;color:white;'>
             <p style='font-size:20px;color:#fff;font-weight:bold'>Click the link below to reset your password</p>
            
            <br /><br />
            <a style='-webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: solid 1px #1A4575;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            background: #3A68A1;
            color: #fee1cc;
            text-decoration: none;
            padding: 8px 12px;
            text-decoration: none;
            font-size: larger;
            }'
			href='".base_url()."main/user_reset_pass/$resetkey'>Reset Password</a>
			</div>
			</div>";
			
			$this->email->message($message);
            
			if($this->email->send())
			{
               $this->model_users->add_to_users($resetkey);
               $this->session->set_flashdata('password_reset', 'success message');
			   redirect('main/forgotpass');
			}
			else
			{
			   $this->session->set_flashdata('forgot_pass_error', 'error message');
		       redirect('main/forgotpass');
			}	
    	}
    	else
    	{
    		$this->load->view('forgotpass');
    	}

    }


    public function validate_forgotpass()
    {

    	if($this->model_users->email_valid())
    	{
    		return true;
    	}
    	else
    	{    
    		$this->form_validation->set_message('validate_forgotpass', '<p class="text-danger error">Please enter a valid email</p>.'); //sends error message to callback
			return false;
    	}
    }


    public function user_reset_pass($resetkey)
    {

    	$dbresetkey = $this->model_users->is_authenticated($resetkey);

    	if($dbresetkey)
    	{
    		$this->load->view('reset_pass_user');
    	}
    	else
    	{
    		$this->session->set_flashdata('forgot_pass_error', 'error message');
    		redirect('main/forgotpass');
    	}
    }


    public function reset_validation()
    {

    	$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_validate_email_reset');

		$this->form_validation->set_rules('npassword', 'New Password', 'required|trim');

		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[npassword]');


		if($this->form_validation->run())
		{
			$this->session->set_flashdata('reset_success', 'success message');
			redirect('main/login');
		}
		else
		{
			$this->session->set_flashdata('reset_error', 'error message.');
			$this->load->view('reset_pass_user');
		}

    }


    public function validate_email_reset()
    {
    	
        if($this->model_users->check_email_reset())
        {
            if($this->model_users->update_password())
            {
            	return true;
            }
            else
            {
            	return false;
            }
        }
        else
        {
        	$this->form_validation->set_message('validate_email_reset', '<p class="text-danger error">Please enter a valid email</p>.'); //sends error message
        }
    }

}