<?php $this->load->view('templates/header'); ?>

<h3 class="text-center my-3">Daftar Laptop</h3>
<table id="tb_laptop" class="table table-striped text-nowrap" style="width:100%">
	<thead>
		<tr class="text-center">
			<th></th>
			<th hidden></th>
            <th hidden></th>
            <th hidden></th>
            <th hidden></th>
            <th hidden></th>
			<th>Laptop</th>
			<th>CPU</th>
			<th>RAM</th>
			<th>GPU</th>
			<th>Storage</th>
			<th>Price</th>
		</tr>
	</thead>
	<tbody id="tbody_laptop">
		
	</tbody>
</table>

<br>
<h3 class="text-center my-3">Spesifikasi CPU</h3>
<table id="tb_cpu" class="table table-striped text-nowrap" style="width:100%">
	<thead>
		<tr class="text-center">
			<th hidden></th>
			<th>Series</th>
			<th>Codename</th>
			<th>Core</th>
			<th>Thread</th>
            <th>Score</th>
		</tr>
	</thead>
	<tbody id="tbody_cpu">
		
	</tbody>
</table>

<br>
<h3 class="text-center my-3">Spesifikasi RAM</h3>
<table id="tb_ram" class="table table-striped text-nowrap" style="width:100%">
	<thead>
		<tr class="text-center">
			<th hidden></th>
			<th>Kapasitas</th>
			<th>Tipe</th>
			<th>Jenis</th>
            <th>Score</th>
		</tr>
	</thead>
	<tbody id="tbody_ram">
		
	</tbody>
</table>

<br>
<h3 class="text-center my-3">Spesifikasi GPU</h3>
<table id="tb_gpu" class="table table-striped text-nowrap" style="width:100%">
	<thead>
		<tr class="text-center">
			<th hidden></th>
			<th>Series</th>
			<th>Brand</th>
			<th>Memory Size</th>
            <th>Score</th>
		</tr>
	</thead>
	<tbody id="tbody_gpu">
		
	</tbody>
</table>

<br>
<h3 class="text-center my-3">Media Penyimpanan</h3>
<table id="tb_storage" class="table table-striped text-nowrap" style="width:100%">
	<thead>
		<tr class="text-center">
			<th hidden></th>
			<th>tipe</th>
			<th>kapasitas</th>
            <th>RPM</th>
            <th>R/W</th>
            <th>Score</th>
		</tr>
	</thead>
	<tbody id="tbody_storage">
		
	</tbody>
</table>


<?php $this->load->view('templates/footer'); ?>


<script type="text/javascript" language="javascript">

$(document).ready(function(){

	var row = true;
    const id_cpu = [];
    const id_ram = [];
    const id_gpu = [];
    const id_storage = [];
    fetch_data();


	function fetch_data(){
        $.ajax({
            url:"<?php echo base_url(); ?>homepage/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('#tbody_laptop').html(data);

				table = $('#tb_laptop').DataTable({
                    "scrollX": true,
                    columnDefs: [{
                        width: 10,
                        targets: 0,
                        data: "select",
                        searchable: false,
                        orderable: false,
                        className: 'select-checkbox',       
                    }],

                    select: {
                        style: 'multiple',           
                    },
                    order: [[ 1, 'asc' ]],
                }); 

                if(row == true){
                    select_row();
                    row = false;
                }    
            }
        });
    }

    function fetch_data_cpu(){
        $.ajax({
            url:"<?php echo base_url();?>homepage/action",
            method:"POST",
            data:{data_action:'fetch_cpu', id_cpu:id_cpu},
            success:function(data)
            {
                //console.log(data);
                $('#tbody_cpu').html(data);
            }
        })
    }

    function fetch_data_ram(){
        $.ajax({
            url:"<?php echo base_url();?>homepage/action",
            method:"POST",
            data:{data_action:'fetch_ram', id_ram:id_ram},
            success:function(data)
            {
                //console.log(data);
                $('#tbody_ram').html(data);
            }
        })
    }

    function fetch_data_gpu(){
        $.ajax({
            url:"<?php echo base_url();?>homepage/action",
            method:"POST",
            data:{data_action:'fetch_gpu', id_gpu:id_gpu},
            success:function(data)
            {
                //console.log(data);
                $('#tbody_gpu').html(data);
            }
        })
    }

    function fetch_data_storage(){
        $.ajax({
            url:"<?php echo base_url();?>homepage/action",
            method:"POST",
            data:{data_action:'fetch_storage', id_storage:id_storage},
            success:function(data)
            {
                //console.log(data);
                $('#tbody_storage').html(data);
            }
        })
    }

	function select_row(){
        
        table.on( 'select', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {              
                var id1 = table.cell(indexes,2).render();
                var id2 = table.cell(indexes,3).render();
                var id3 = table.cell(indexes,4).render();
                var id4 = table.cell(indexes,5).render();
                id_cpu.push(id1);   
                id_ram.push(id2);
                id_gpu.push(id3);
                id_storage.push(id4);
                fetch_data_cpu(); 
                fetch_data_ram();   
                fetch_data_gpu();  
                fetch_data_storage();                 
            }
        });
        table.on( 'deselect', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {            
                var id1 = table.cell(indexes,2).render();
                var id2 = table.cell(indexes,3).render();
                var id3 = table.cell(indexes,4).render();
                var id4 = table.cell(indexes,5).render();
                removeItem(id_cpu, id1); 
                removeItem(id_ram, id2); 
                removeItem(id_gpu, id3); 
                removeItem(id_storage, id4); 
                fetch_data_cpu(); 
                fetch_data_ram(); 
                fetch_data_gpu();
                fetch_data_storage();
            }
        });     
    }

    function removeItem(array, item){
        for(var i in array){
            if(array[i]==item){
                array.splice(i,1);
                break;
            }
        }
    }
    
})

</script>
