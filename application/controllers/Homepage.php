<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Homepage_m');
	}

	function index()
	{
		$this->load->view('homepage_v');
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == 'fetch_all')
			{
				$api_url = base_url()."rest/Laptop_Api/fetch_all_laptop";

				$client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);
                $result = json_decode($response);

				$output = '';
				
				if(count($result) > 0)
				{
					foreach($result as $row)
					{
						$output .='
						<tr align="center">
							<td></td>
							<td hidden>'.$row->id.'</td>
							<td hidden>'.$row->id_cpu.'</td>
							<td hidden>'.$row->id_ram.'</td>
							<td hidden>'.$row->id_gpu.'</td>
							<td hidden>'.$row->id_storage.'</td>
							<td>'.$row->laptop.'</td>
							<td>'.$row->cpu_series.'</td>
							<td>'.$row->ram_size.'</td>
							<td>'.$row->gpu_brand.' '.$row->gpu_series.'</td>
							<td>'.$row->storage_capacity.'</td>
							<td>'.$row->price.'</td>
						</tr>
						';
					}
				}
				else
				{
					$output .='
					<tr>
						<td colspan="8" align="center">Data Tidak Ditemukan</td>
					</tr>
					';
				}
				echo $output;
			}

			if($data_action == "fetch_cpu")
			{
				if($this->input->post('id_cpu'))
				{
					$id_cpu = join(',',$this->input->post('id_cpu'));
				}
				else
				{
					$id_cpu = "";
				}
				
				
				$api_url = base_url()."rest/Laptop_Api/fetch_cpu?id_cpu=$id_cpu";	

				$client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);
                $result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
                    foreach ($result as $row) 
					{
						$output .='
						<tr align="center">
							<td hidden>'.$row->id.'</td>
							<td>'.$row->series.' '.$row->number.'</td>
							<td>'.$row->codename.'</td>
							<td>'.$row->core.'</td>
							<td>'.$row->thread.'</td>
							<td>'.$row->score.'</td>
						</tr>
						';
                    }					
				}
				else
				{
					$output .='
					<tr>
						<td colspan="5" align="center">Data Tidak Ditemukan</td>
					</tr>
					';
				}
				echo $output;
			}

			if($data_action == "fetch_ram")
			{
				if($this->input->post('id_ram'))
				{
					$id_ram = join(',',$this->input->post('id_ram'));
				}
				else
				{
					$id_ram = "";
				}
				
				
				$api_url = base_url()."rest/Laptop_Api/fetch_ram?id_ram=$id_ram";	

				$client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);
                $result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
                    foreach ($result as $row) 
					{
						$output .='
						<tr align="center">
							<td hidden>'.$row->id.'</td>
							<td>'.$row->size.' GB'.'</td>
							<td>'.$row->tipe.'</td>
							<td>'.$row->jenis.'</td>
							<td>'.$row->score.'</td>
						</tr>
						';
                    }					
				}
				else
				{
					$output .='
					<tr>
						<td colspan="5" align="center">Data Tidak Ditemukan</td>
					</tr>
					';
				}
				echo $output;
			}

			if($data_action == "fetch_gpu")
			{
				if($this->input->post('id_gpu'))
				{
					$id_gpu = join(',',$this->input->post('id_gpu'));
				}
				else
				{
					$id_gpu = "";
				}
				
				
				$api_url = base_url()."rest/Laptop_Api/fetch_gpu?id_gpu=$id_gpu";	

				$client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);
                $result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
                    foreach ($result as $row) 
					{
						$output .='
						<tr align="center">
							<td hidden>'.$row->id.'</td>
							<td>'.$row->series.'</td>
							<td>'.$row->id_brand.'</td>
							<td>'.$row->m_size.'</td>
							<td>'.$row->score.'</td>
						</tr>
						';
                    }					
				}
				else
				{
					$output .='
					<tr>
						<td colspan="5" align="center">Data Tidak Ditemukan</td>
					</tr>
					';
				}
				echo $output;
			}

			if($data_action == "fetch_storage")
			{
				if($this->input->post('id_storage'))
				{
					$id_storage = join(',',$this->input->post('id_storage'));
				}
				else
				{
					$id_storage = "";
				}
				
				
				$api_url = base_url()."rest/Laptop_Api/fetch_storage?id_storage=$id_storage";	

				$client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);
                $result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
                    foreach ($result as $row) 
					{
						$output .='
						<tr align="center">
							<td hidden>'.$row->id.'</td>
							<td>'.$row->tipe.'</td>
							<td>'.$row->capacity.'</td>
							<td>'.$row->rpm.'</td>
							<td>'.$row->rwspeed." MB/s".'</td>
							<td>'.$row->score.'</td>
						</tr>
						';
                    }					
				}
				else
				{
					$output .='
					<tr>
						<td colspan="5" align="center">Data Tidak Ditemukan</td>
					</tr>
					';
				}
				echo $output;
			}
		}
	}
}