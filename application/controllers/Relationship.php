<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relationship extends CI_Controller {
    public function check(){
        $a = $this->input->post('A', false);
        $b = $this->input->post('B', false);
        
        if($a && $b){
            if($a == $b){
                echo "是一个人！";
                return;
            }
            $relation = $this->_filter($this->_relation($a), $a, $b);
            
            if($relation == [])
            {
                $relation = $this->_filter($this->_relation($b), $a, $b);
                
            }else{
                $str = $this->_check($relation, $a, $b);
                echo 'A喊B' . $str;
                return;
            }
            if($relation == [])
            {
                
                $AB = $this->_relation($a);
                $BA = $this->_relation($b);
                foreach ($AB as $key => $one){
                    foreach ($BA as $key2 => $one2){
                        if($one[strlen($one) - 1] !== $one2[strlen($one2) - 1]){
                            echo "算不出。。来阿。。。";
                            return;
                        }
                    }
                }
                echo "AB是（兄妹/兄弟）关系！";
                return;
            }else{
                $str = $this->_check($relation, $b, $a);
                echo 'B喊A' . $str;
                return;
            }
            
            
        }else{
            $sql = "select id, name from members";
            $members = $this->db->query($sql);
            $data['members'] = $members;
            $this->load->view('relationship_check.php', $data);
        }
        
    }

    private function _getMemById($id){
        $sql = "select * from members where id = ".$id;
        $member = $this->db->query($sql);
        return $member->result_array();
    }
    private function _relation($a){
        $ret[] = $a;
        do{
            $zero = 0;
            $tmp = [];
            foreach ($ret as $line){
                $lineArr = explode(',', $line);
                $a = $lineArr[count($lineArr) - 1];
                if($a == 0) {
                    $zero ++;       
                }else{
                    $row = $this->_getMemById($a)[0];
                    foreach ($ret as $one)
                    {
                        if($one[strlen($one) - 1] == 0) continue;
                        $tmp[] = $one . ',' . $row['fid'];
                        $tmp[] = $one . ',' . $row['mid'];
                    }
                }
                
            }
            
            if(count($ret) == $zero)
            {
                $ret = array_unique($ret);                
                break;
            }
            $ret = $tmp;
        }while(True);
    return $ret;
    }
    private function _filter($relationship, $a, $b){

        $ret = [];
        if($relationship != []){
            foreach ($relationship as $line)
            {
                $member = explode(',', $line);
                if (in_array($a, $member) && in_array($b, $member))
                {
                    $ret[] = $member;
                }
            }
        
        }
        
        return $ret;
    }
    private function _check($relation, $a, $b){
        $relation = array_pop($relation);
        $pos = array_search($b, $relation);
        $relation = array_chunk($relation, $pos+1);
        
        $member = $this->_getMemById($a)[0];
        $relation = $relation[0];
        $relationshipId = $member['sex'] == 0 ? 1 : 2;
        foreach ($relation as $key => $one)
        {
            if($key > $pos)
            {
                break;
            }
            if($one === $a){
                $sql = 'select * from relationship where id = ' . $relationshipId;
                $tmp = $this->db->query($sql);
                $tmp = $tmp->result_array()[0];
            }else{
                $member = $this->_getMemById($one)[0];
                $field = $member['sex'] == 0 ? 'mother' : 'father';
                $sql = 'select * from relationship where id in (select ' .$field. ' from relationship where id = ' . $tmp['id'] .')';
                $tmp = $this->db->query($sql);
                $tmp = $tmp->result_array()[0];
            }
            
        }   
        return $tmp['relationship'];
    }
}