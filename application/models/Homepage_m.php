<?php
    class Homepage_m extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }

        function fetch_all()
        {
            $this->db->select('
                tb_laptop.*,
                concat(tb_brand.nama," ",tb_laptop.tipe) as laptop,
                concat(tb_cpu.series," ",tb_cpu.number) as cpu_series,
                concat(tb_ram.size," GB") as ram_size,
                tb_gpu.series as gpu_series,
                tb_storage.capacity as storage_capacity,
                tb_laptop.price,
            ');
            $this->db->from('tb_laptop');
            $this->db->join('tb_brand', 'tb_brand.id = tb_laptop.id_brand','inner');
            $this->db->join('tb_cpu', 'tb_cpu.id = tb_laptop.id_cpu','inner');
            $this->db->join('tb_ram', 'tb_ram.id = tb_laptop.id_ram','inner');
            $this->db->join('tb_gpu', 'tb_gpu.id = tb_laptop.id_gpu','inner');
            $this->db->join('tb_storage', 'tb_storage.id = tb_laptop.id_storage','inner');
            ;           
            $query = $this->db->get();
            return $query;
        }

        function fetch_single($select,$id, $tb)
        {
            $this->db->select($select);
            $this->db->from($tb);
            $this->db->where_in('id', $id);
            $query = $this->db->get();
            return $query;
        }

        
    }
?>