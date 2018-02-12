<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model
{

	public function can_log_in()
	{   

        $user_mail = $this->input->post('user_mail');

        $password = sha1($this->input->post('password'));

		$this->db->select('username, email, password'); 

        $this->db->where("(email = '$user_mail' OR username = '$user_mail') AND password = '$password'");


		$query = $this->db->get('users'); // get data from database table

		if($query->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


    public function get_user()
    {

        $user_mail = $this->input->post('user_mail');

        $password = sha1($this->input->post('password'));

        $this->db->select('username, email, password, id, created_at'); 

        $this->db->where("(email = '$user_mail' OR username = '$user_mail') AND password = '$password'");


        $query = $this->db->get('users');

        $row = $query->row(); // get each row columns from users table


            $data = array(

               'username' => $row->username,

               'email' => $row->email,

               'created_at' => $row->created_at,      

               'id' => $row->id 

            );


        if($query->num_rows() == 1)
        {
            return $data;
        }
        else
        {
            return false;
        }

    }


	public function add_temp_user($key)
	{

        $data = array(

            'username' => ucfirst($this->input->post('username')),

            'email' => ucfirst($this->input->post('email')),

            'password' => sha1($this->input->post('password')),

            'key' => $key
        );


        $query = $this->db->insert('temp_users', $data);

        if($query)
        {
        	return true;
        }
        else
        {
        	return false;
        }
	}


	public function is_key_valid($key)
	{

         $this->db->where('key', $key);

         $query = $this->db->get('temp_users');

         if($query->num_rows() == 1)
         {
         	return true;
         }
         else
         {
         	return false;
         }
	}


	public function add_user($key)
	{

         $this->db->where('key', $key);

         $temp_user = $this->db->get('temp_users'); // grab temp_users row

         if($temp_user)   // if successfull execute the code below
         {

         	$row = $temp_user->row(); // grab row data from temp_users table

         	$data = array(

               'username' => $row->username,
               'email' => $row->email,   // insert email to users table row email from temp_users table
               'created_at' => $row->created_at,
               'password' => $row->password, // insert password to users table row password from temp_users table
               'id' => $row->id 
         	);

            // insert $data var array to users table
         	$did_add_user = $this->db->insert('users', $data);
         }

         if($did_add_user) // delete data from temp_users after adding to users table
         {
            
         	$this->db->where('key', $key);

         	$this->db->delete('temp_users');
         	return $data;
         }
         else
         {
         	return false;
         }
	} 


    public function add_to_users($resetkey)
    {

        $reset_email = $this->input->post('email');

        $new_user = $this->db->get('users');


         if($new_user)
         {

         
            $data = array(

            'resetkey' => $resetkey

            );

         
         $this->db->where("email = '$reset_email'");
         $query = $this->db->update('users', $data);
         
         }

         if($query)
         {
            return true;
         }
         else
         {
            return false;
         }
    }


    public function is_authenticated($resetkey)
    {

         $this->db->select('resetkey'); 

         $this->db->where('resetkey', $resetkey);

         $query = $this->db->get('users');

         if($query)
         {
            return true;
         }
         else
         {
            return false;
         }
    }


    public function email_valid()
    {

        $this->db->where('email', $this->input->post('email'));


        $query = $this->db->get('users');

        if($query->num_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function check_email_reset()
    {

        $this->db->where('email', $this->input->post('email'));

        $query = $this->db->get('users');

        if($query->num_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    
    public function update_password()
    {

        $reset_pass_email = $this->input->post('email');

        $resetkey = $this->db->where('resetkey');

        $query = $this->db->get('users');


    if($resetkey)
    {

        if($query)
        {

           $data = array(

            'password' => sha1($this->input->post('npassword'))

           );

            $this->db->where("email = '$reset_pass_email'");
            $newpassword = $this->db->update('users', $data);

            if($newpassword)
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
           return false;
        }
    }

    }

}