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
<button id="show_specs" type="button" class="btn btn-primary btn-lg btn-block ">Tampilkan Detail Spesifikasi</button>


<div id="tb_specs">
    <br>
    <h3 class="text-center my-3">Spesifikasi CPU</h3>
    <table id="tb_cpu" class="table table-striped text-nowrap display" style="width:100%">
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
    <table id="tb_ram" class="table table-striped text-nowrap display" style="width:100%">
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
    <table id="tb_gpu" class="table table-striped text-nowrap display" style="width:100%">
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
    <table id="tb_storage" class="table table-striped text-nowrap display" style="width:100%">
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
</div>

<br>
<button id="start_wp" type="button" class="btn btn-primary btn-lg btn-block ">Mulai Weight Product</button>

<div id="tb_wp">
    <br>
    <h3 class="text-center my-3">Nilai Setiap Alternatif</h3>
    <table id="tb_score" class="table table-striped text-nowrap display" style="width:100%">
        <thead>
            <tr class="text-center">
                <th hidden></th>
                <th>Alternatif</th>
                <th>CPU</th>
                <th>RAM</th>
                <th>GPU</th>
                <th>Storage</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody id="tbody_score">
            
        </tbody>
    </table>
    <br>
    <h3 class="text-center my-3">Nilai Bobot Kriteria</h3>
    <table id="tb_weight" class="table table-striped text-nowrap display" style="width:100%">
        <thead>
            <tr class="text-center">
                <th></th>
                <th>W1 CPU</th>
                <th>W2 RAM</th>
                <th>W3 GPU</th>
                <th>W4 Storage</th>
                <th>W5 Harga</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tbody_weight">
            <tr class="text-center">
                <td class="font-weight-bold">ΣW</td>
                <td>5</td>
                <td>4</td>
                <td>5</td>
                <td>3</td>
                <td>3</td>
                <td class="font-weight-bold">20</td>
            </tr>
            <tr class="text-center">
                <td class="font-weight-bold">%W</td>
                <td>0.25</td>
                <td>0.20</td>
                <td>0.25</td>
                <td>0.15</td>
                <td>0.15</td>
                <td class="font-weight-bold">1</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table id="tb_vektor" class="table table-striped text-nowrap" style="width:100%">
        <thead>
            <tr class="text-center">
                <th>Alternatif</th>
                <th>Vektor S</th>
                <th>Vektor V</th>
            </tr>
        </thead>
        <tbody id="tbody_vector">
            <tr class="text-center">

            </tr>
        </tbody>
    </table>

</div>



<?php $this->load->view('templates/footer'); ?>


<script type="text/javascript" language="javascript">

$(document).ready(function(){

	var row = true;
    const id_cpu = [];
    const id_ram = [];
    const id_gpu = [];
    const id_storage = [];
    const id_laptop = [];
    fetch_data();

    $(document).on('click', '#show_specs', function(){
        if($('#tb_specs').is(":hidden")){
            $('#show_specs').text("Sembunyikan Detail Spesifikasi");
            $('#tb_specs').show("slow","linear");
        }else{
            $('#show_specs').text("Tampilkan Detail Spesifikasi");
            $('#tb_specs').hide("slow","linear");
        }     
    })

    $(document).on('click', '#start_wp', function(){
        if($('#tb_wp').is(":hidden")){
            $('#start_wp').text("Sembunyikan Weight Product");
            $('#tb_wp').show("slow","linear");
        }else{
            $('#start_wp').text("Tampilkan Weight Product");
            $('#tb_wp').hide("slow","linear");
        } 
    })

	function fetch_data(){
        $.ajax({
            url:"<?php echo base_url(); ?>homepage/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('#tbody_laptop').html(data);

				table = $('#tb_laptop').DataTable({
                    scrollX: true,
                    
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

                $('table.display').dataTable( {
                    ordering: false,
                    searching: false, 
                    paging: false,
                    info: false,
                });

                $('#tb_specs').hide();
                $('#tb_wp').hide();

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

    function fetch_data_score(){
        $.ajax({
            url:"<?php echo base_url();?>homepage/action",
            method:"POST",
            data:{data_action:'fetch_score', id_laptop:id_laptop},
            success:function(data)
            {
                //console.log(data);
                $('#tbody_score').html(data);
            }
        })
    }

    function fetch_data_vector(){
        $.ajax({
            url:"<?php echo base_url();?>homepage/action",
            method:"POST",
            data:{data_action:'fetch_vector', id_laptop:id_laptop},
            success:function(data)
            {
                //console.log(data);
                $('#tbody_vector').html(data);
            }
        })
    }

	function select_row(){
        
        table.on( 'select', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {              
                var idcpu = table.cell(indexes,2).render();
                var idram = table.cell(indexes,3).render();
                var idgpu = table.cell(indexes,4).render();
                var idstorage = table.cell(indexes,5).render();
                var idlaptop = table.cell(indexes,1).render();
                id_cpu.push(idcpu);   
                id_ram.push(idram);
                id_gpu.push(idgpu);
                id_storage.push(idstorage);
                id_laptop.push(idlaptop);
                fetch_data_cpu(); 
                fetch_data_ram();   
                fetch_data_gpu();  
                fetch_data_storage();
                fetch_data_score();   
                fetch_data_vector();
                            
            }
        });
        table.on( 'deselect', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {            
                var idcpu = table.cell(indexes,2).render();
                var idram = table.cell(indexes,3).render();
                var idgpu = table.cell(indexes,4).render();
                var idstorage = table.cell(indexes,5).render();
                var idlaptop = table.cell(indexes,1).render();
                removeItem(id_cpu, idcpu); 
                removeItem(id_ram, idram); 
                removeItem(id_gpu, idgpu); 
                removeItem(id_storage, idstorage); 
                removeItem(id_laptop, idlaptop); 
                fetch_data_cpu(); 
                fetch_data_ram(); 
                fetch_data_gpu();
                fetch_data_storage();
                fetch_data_score(); 
                fetch_data_vector();
                   
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
