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
			$cpu_scores = [];
			$ram_scores = [];
			$gpu_scores = [];
			$storage_scores = [];
			$price_scores = [];
			$percent_weights = [0.25,0.20,0.25,0.15,0.15];
			$sum_vector_s = 0;
			$vector_s_arr = [];
			
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

			if($data_action == "fetch_score")
			{
				if($this->input->post('id_laptop'))
				{
					$id_laptop = join(',',$this->input->post('id_laptop'));
				}
				else
				{
					$id_laptop = "";
				}
							
				$api_url = base_url()."rest/Laptop_Api/fetch_score?id_laptop=$id_laptop";	

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
						$price = $row->price;
						switch ($price) {
							case $price <= 4000000:
								$price_score = 1;
								break;
							case $price <= 6000000:
								$price_score = 2;
								break;
							case $price <= 8000000:
								$price_score = 3;
								break;
							case $price <= 15000000:
								$price_score = 4;
								  break;
							case $price > 15000000:
								$price_score = 5;
								break;
							default:
								$price_score = 0;
						  };

						  array_push($cpu_scores,$row->cpu_score);
						  array_push($ram_scores,$row->ram_score);
						  array_push($gpu_scores,$row->gpu_score);
						  array_push($storage_scores,$row->storage_score);
						  array_push($price_scores,$price_score);
				
						$output .='
						<tr align="center">
							<td hidden>'.$row->id.'</td>
							<td>'.$row->laptop.'</td>
							<td>'.$row->cpu_score.'</td>
							<td>'.$row->ram_score.'</td>
							<td>'.$row->gpu_score.'</td>
							<td>'.$row->storage_score.'</td>
							<td>'.$price_score.'</td>
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

			if($data_action == "fetch_vector")
			{
				if($this->input->post('id_laptop'))
				{
					$id_laptop = join(',',$this->input->post('id_laptop'));
				}
				else
				{
					$id_laptop = "";
				}
							
				$api_url = base_url()."rest/Laptop_Api/fetch_score?id_laptop=$id_laptop";	

				$client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);
                $result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
					
					$i = 0;

                    foreach ($result as $row) 
					{
						
						$price = $row->price;
						switch ($price) {
							case $price <= 4000000:
								$price_score = 1;
								break;
							case $price <= 6000000:
								$price_score = 2;
								break;
							case $price <= 8000000:
								$price_score = 3;
								break;
							case $price <= 15000000:
								$price_score = 4;
								  break;
							case $price > 15000000:
								$price_score = 5;
								break;
							default:
								$price_score = 0;
						  };
						  						
						$vector_s = pow($row->cpu_score,0.25)*pow($row->ram_score,0.20)*pow($row->gpu_score,0.25)*pow($row->storage_score,0.15)*pow($price_score,0.20);

						array_push($vector_s_arr,$vector_s);
						$sum_vector_s += $vector_s;

						$output .='
						<tr align="center">
							<td>'.$row->laptop.'</td>
							<td>'.$vector_s_arr[$i].'</td>	
							<td>'.$vector_s_arr[$i]/14.5.'</td>				
						</tr>
						';

						$i += 1;
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
				print_r($percent_weights);
				
			}
		}
	}		
}


//<td>'.$vector_s_arr[$i]/$sum_vector_s.'</td>