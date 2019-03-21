<?php 
$ci =&get_instance();
$ci->load->model("AdminModel");

if($this->input->get('date1')!="" && $this->input->get('date2')!=""){
	$fecha1 = $this->input->get('date1');
	$fecha2 = $this->input->get('date2');
}else{
	$fecha1 = "";
	$fecha2 = date('Y-m-d');
}

$info_user = $ci->AdminModel->get_info_user($user,$fecha1,$fecha2);
$role = $ci->AdminModel->get_role($info_user[0]->Id);
for ($i = 0; $i <count($info_user) ; $i++) {

	$fechaInicio = $info_user[$i]->hora_start;
	$fechaInicio = new DateTime($fechaInicio);

	$fecha_pausa = $info_user[$i]->hora_pausa;
	$fecha_pausa = new DateTime($fecha_pausa);

	$fecha_pausa_fin = $info_user[$i]->hora_pausa_fin;
	$fecha_pausa_fin = new DateTime($fecha_pausa_fin);

	$fecha_fin = $info_user[$i]->hora_fin;
	$fecha_fin = new DateTime($fecha_fin);

	$intervalo1[$i] = $fechaInicio->diff($fecha_pausa);
	$intervalo2[$i] = $fecha_pausa->diff($fecha_pausa_fin);
	$intervalo3[$i] = $fecha_pausa_fin->diff($fecha_fin);
	$total[$i] = calcular_total(hora_parcial($intervalo1[$i]->format('%h'),$intervalo1[$i]->format('%i')),hora_parcial($intervalo3[$i]->format('%h'),$intervalo3[$i]->format('%i')));

	$register[$i] = $info_user[$i]->fecha_register; 

	$horas_basica[$i] = ($total[$i]>8?8:$total[$i]);

	$horas_extras[$i] = ($total[$i]>8?$total[$i]-8:0);

	$total_horas += $horas_basica[$i]; 

	$total_horas_extras += $horas_extras[$i];

	$total_weeks_hours += ($horas_basica[$i]+$horas_extras[$i]);
}


function hora_parcial($hora,$minutos)
{
	$restante = round($minutos/6, 1);

	$restante = str_replace(".", "", $restante);

	return $hora.".".$restante;

}

function calcular_total($a_break,$d_break){
	return $a_break+$d_break;
}

($this->input->get('date1')!=""?$date1=$this->input->get('date1'):$date1='');
($this->input->get('date2')!=""?$date2=$this->input->get('date2'):$date2='');

?>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
<script src="<?=base_url()?>js/util.js"></script>

<div class="col-md-12 col-sm-12 col-xs-12" id="titulo" style="font-family: 'Arvo', sans-serif;">
	<h3>Employee Time Sheet</h3><hr>
</div>

<div class="container">
	<div class="container-tabla" style="overflow-y: scroll;height: 620px;" id="scroll_container">
		<div class="col-xs-12">
			<div class="pull-right" style="margin-bottom: 20px;">

				<form class="form-inline" action="<?=base_url('Admin/Working_detail/'.$user)?>">
					<div class="form-group">
						<label for="date1">Form:</label>
						<input type="date" class="form-control" name="date1" id="date1" value="<?=$date1?>" max="<?=$date2?>">
					</div>
					<div class="form-group">
						<label for="date2">To:</label>
						<input type="date" class="form-control" name="date2" id="date2" value="<?=$date2?>" max="<?=$date2?>">
					</div>
					<div class="form-group" style='margin-left:10px;'>
						<button type="submit" class="btn btn-info">Filter</button>
					</div>
				</form>

			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-4 col-xs-offset-1">
				<h4 style="color: #2c2c2d;">Employee details: <span style="color: #909090;"><?=$info_user[0]->Name." ".$info_user[0]->LastName;?></span></h4>
			</div>
			<div class="col-xs-4">
				<h4 style="color: #2c2c2d;">Role: <span style="color: #909090;"><?php echo $role->Role ?></span></h4>
			</div>
		</div>

		<div class="col-xs-12" style="border: 1px solid #e6e6e6;color: #2c2c2d;width: 993px;margin-left: 46px;">
			<div class="col-xs-3 text-center">
				<h4>Outstanding</h4>
				<h4>Week Hours</h4>
				<h4>40.00</h4>
			</div>
			<div class="col-xs-3 text-center">
				<h4>Total Work</h4>
				<h4>Week Hours</h4>
				<h4><?=$total_weeks_hours?></h4>
			</div>
			<div class="col-xs-3 text-center">
				<h4>Regular Hours</h4><br>
				<h4><?=$total_horas?></h4>
			</div>
			<div class="col-xs-3 text-center">
				<h4>Overtime Hours</h4><br>
				<h4><?=$total_horas_extras?></h4>
			</div>
		</div>

		<div class="container" style="width: 91%;margin-top: 220px;">
			<div class="container_dia">
				<table class="table table-responsive table-striped" align="center">
					<thead class="header-table-sessions2">
						<tr>
							<th>Date(s)</th>
							<th>Time In</th>
							<th>Break Start</th>
							<th>Break End</th>
							<th>Time Out</th>
							<th>Hours Worked</th>
							<th></th>
						</tr>
					</thead>
					<?php for ($i = 0; $i <count($info_user) ; $i++) {
						$date[$i] = date('m/d/Y',strtotime($info_user[$i]->hora_start));
						$validate[$i] = $info_user[$i]->fecha_register;
						$h_start[$i] = date('H:i',strtotime($info_user[$i]->hora_start));
						$h_pausa[$i] = date('H:i',strtotime($info_user[$i]->hora_pausa));
						$h_pausaf[$i] = date('H:i',strtotime($info_user[$i]->hora_pausa_fin));
						$h_out[$i] = date('H:i',strtotime($info_user[$i]->hora_fin));
						?>
						<tbody class="body-table-sessions2">
							<input type="hidden" value="<?=$info_user[0]->Id?>" id="user<?=$i?>">
							<input type="hidden" value="<?=$info_user[$i]->iduser_sessions?>" id="id<?=$i?>">
							<tr>
								<td>
									<input type="date" readonly="" id="validate<?=$i?>" value="<?=$validate[$i]?>">
								</td>
								<td>
									<input type="time" readonly="" class="<?=$i?>" id="start<?=$i?>" value="<?=$h_start[$i]?>" >
								</td>
								<td>
									<input type="time" readonly="" class="<?=$i?>" id="pausa<?=$i?>" value="<?=$h_pausa[$i];?>" data-min="<?=$h_start[$i]?>">

								</td>
								<td>
									<input type="time" readonly="" class="<?=$i?>" id="pausaf<?=$i?>" value="<?=$h_pausaf[$i]?>" data-min="<?=$h_pausa[$i];?>">
								</td>
								<td>
									<input type="time" readonly="" class="<?=$i?>" id="out<?=$i?>" value="<?=$h_out[$i];?>" data-min="<?=$h_pausaf[$i]?>">
								</td>
								<td>
									<input type="text" readonly="" value="<?=$horas_basica[$i]?>">
								</td>
								<td>
									<a href="#"><i data-row="<?=$i?>" class="fa fa-save save-<?=$i?> hidden" data-row="<?=$i?>"></i></a>	<a href="#"><i data-row="<?=$i?>" class="fa fa-edit edit<?=$i?>"></i></a> | <a href="#"><i class="fa fa-trash fa-delete" data-row="<?=$i?>"></i></a>
								</td>
							</tr>

						</tbody>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>