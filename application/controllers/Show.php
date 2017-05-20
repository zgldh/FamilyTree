<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    $sql = "select a.id, a.name, a.sex, a.birthday ,b.name as mname, c.name as fname from members a left join members b on a.mid = b.id left join members c on a.fid = c.id ";
	    $members = $this->db->query($sql);
	    $data['members'] = $members;
	    $this->load->view('show_members', $data);
	}
	
	public function add(){
	    //assume valid of data already checked in front and here.
	    $data = array(
            'name' => $_REQUEST['name'],
            'sex'  => $_REQUEST['sex'],
	        'fid'  => $_REQUEST['fid'],
	        'mid'  => $_REQUEST['mid'],
	        'birthday' => strtotime($_REQUEST['birth']),
        );

        $ret = $this->db->insert('members', $data);
	    if($ret){
	        echo 'ok';
	    }else{
	        echo $this->db->_error_message();
	         
	    }
	}
	
	public function delete(){
	    $id = $this->input->get('id', false);
	    if(!$id)
	    {
	        echo 'invalid id!';
	    }
	    $ret = $this->db->delete('members', array('id' => $id));
	    
	    if($ret){
	        echo 'ok';
	    }else{
	        echo $this->db->_error_message();
	    
	    }
	}
	
	public function update(){
	    $data = $this->input->post('data', false);
	    if(!$data)
	    {
	        echo 'invalid data!';
	    }

	    $data = explode(',', $data);
	    $update = array(
	        'name' => $data[1],
            'sex'  => ["男" => 1, "女" => 0][$data[2]],
	        'fid'  => $data[5],
	        'mid'  => $data[4],
	        'birthday' => strtotime($data[3]),
	    );
	    $this->db->where('id', $data[0]);
	    $ret = $this->db->update('members', $update);
	    
	    if($ret){
	        echo 'ok';
	    }else{
	        echo $this->db->_error_message();
	         
	    }
	}
}
