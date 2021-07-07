<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laptop_Api extends CI_Controller
{
    public function __construct(){
        parent:: __construct();
        $this->load->model('homepage_m');
    }

// --------------------------------- FETCH DATA ---------------------------------
    function fetch_all_laptop(){
        $data = $this->homepage_m->fetch_all();
        echo json_encode($data->result_array());
    }

    function fetch_cpu(){
        $id_cpu = array_values(explode(',', $this->input->get('id_cpu')));
        if(count($id_cpu) > 0)
        {
            $data = $this->homepage_m->fetch_single('*',$id_cpu,'tb_cpu');
            echo json_encode($data->result_array());               
        }
        else
        {
            echo "empty result";
        }
    }

    function fetch_ram(){
        $id_ram = array_values(explode(',', $this->input->get('id_ram')));
        if(count($id_ram) > 0)
        {
            $data = $this->homepage_m->fetch_single('*',$id_ram,'tb_ram');
            echo json_encode($data->result_array());               
        }
        else
        {
            echo "empty result";
        }
    }

    function fetch_gpu(){
        $id_gpu = array_values(explode(',', $this->input->get('id_gpu')));
        if(count($id_gpu) > 0)
        {
            $data = $this->homepage_m->fetch_single('*',$id_gpu,'tb_gpu');
            echo json_encode($data->result_array());               
        }
        else
        {
            echo "empty result";
        }
    }

    function fetch_storage(){
        $id_storage = array_values(explode(',', $this->input->get('id_storage')));
        if(count($id_storage) > 0)
        {
            $data = $this->homepage_m->fetch_single('*',$id_storage,'tb_storage');
            echo json_encode($data->result_array());               
        }
        else
        {
            echo "empty result";
        }
    }

    function fetch_score(){
        $id_laptop = array_values(explode(',', $this->input->get('id_laptop')));
        if(count($id_laptop) > 0)
        {
            $data = $this->homepage_m->fetch_score($id_laptop);
            echo json_encode($data->result_array());               
        }
        else
        {
            echo "empty result";
        }
    }
}
?>