 <?php 
 $ci =&get_instance();
 $ci->load->model("AdminModel");

 ($this->input->get('date1')!=""?$date1=$this->input->get('date1'):$date1='');
 ($this->input->get('date2')!=""?$date2=$this->input->get('date2'):$date2='');

 ($this->input->get('date1')!=""?$date1_mask=date('m-d-Y',strtotime($this->input->get('date1'))):$date1_mask='');
 ($this->input->get('date2')!=""?$date2_mask=date('m-d-Y',strtotime($this->input->get('date2'))):$date2_mask='');

 ?>
 <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
 <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
 <script src="<?=base_url()?>js/util.js"></script>

 <div class="col-md-12 col-sm-12 col-xs-12" id="titulo">
 	<h3 style="font-family: 'Arvo', sans-serif;">Timesheet</h3><hr>
 </div>
 <div class="container">
 	<ul class="topMbar" id="topMbarWrap">
 		<li style="float:left">
 			<!--<form>  
 				<input type="text" onkeyup=""  class="form-control" placeholder="&#xF002; Search" style="font-family:Lato, FontAwesome" />
 			</form>-->
 		</li>
 		<div class="pull-right" style="margin-bottom: 20px;padding-right: 10px;">
 			<form class="form-inline" action="<?=base_url('Admin/Adjust_time')?>">
 				<div class="form-group">
 					<label for="date1">Form:</label>
 					<script>
 						$(function(){
 							$("#date1-mask").datepicker({
 								dateFormat: 'mm-dd-yy'
 							});
 							$("#date2-mask").datepicker({
 								dateFormat: 'mm-dd-yy'
 							});

 							$('#date1-mask').change(function() {
 								var fecha = $(this).val();

 								fecha = fecha.split('-');

 								var nueva_fecha = fecha[2]+"-"+fecha[0]+"-"+fecha[1];

 								$('#date-1').val(nueva_fecha);
 							});

 							$('#date2-mask').change(function() {
 								var fecha = $(this).val();

 								fecha = fecha.split('-');

 								var nueva_fecha = fecha[2]+"-"+fecha[0]+"-"+fecha[1];

 								$('#date-2').val(nueva_fecha);
 							});
 						});
 					</script>
 					<input type="text" class="form-control" name="" id="date1-mask" value="<?=$date1_mask?>" max="<?=$date2?>">
 					<input type="hidden" name="date1" id="date-1" value="<?=$date1?>" max="<?=$date2?>">
 				</div>
 				<div class="form-group">
 					<label for="date2">To:</label>
 					<input type="text" class="form-control" name="" id="date2-mask" value="<?=$date2_mask?>" max="<?=$date2?>">
 					<input type="hidden" name="date2" id="date-2" value="<?=$date2?>" max="<?=$date2?>">
 				</div>
 				<div class="form-group" style='margin-left:10px;'>
 					<button type="submit" class="btn btn-info">Filter</button>
 				</div>
 			</form>
 		</div>
 		<a href="#" onclick="exportarXLS();" id="activador_xls" class="pull-left"><i class="fa fa-arrow-circle-down fa-2x" style="padding-right: 166px;padding-left:166px;padding-bottom:20px;margin-top: 20px;font-size: 18px;"> Download</i></a>
 	</ul>
 	<div class="container-tabla">
 		<table class="table table-responsive table-striped" style="margin-top: 120px;" id="tabla">
 			<thead class="header-table-sessions">
 				<tr>
 					<th>Employee</th>
 					<th>Hours Worked</th>
 					<th>Overtime Hours</th>
 					<th>Break Time Hours</th>
 					<th class="none">Action</th>
 				</tr>
 			</thead>
 			<tbody class="body-table-sessions">
 				<?php
 				for ($i = 0; $i < count($users); $i++) {

 					$info_user = $ci->AdminModel->get_horas_user($users[$i]->id_user);

 					for ($j = 0; $j <count($info_user) ; $j++) {
 						
 						$fechaInicio = $info_user[$j]->hora_start;
 						$fechaInicio = new DateTime($fechaInicio);
 						
 						$fecha_pausa = $info_user[$j]->hora_pausa;
 						$fecha_pausa = new DateTime($fecha_pausa);
 						
 						$fecha_pausa_fin = $info_user[$j]->hora_pausa_fin;
 						$fecha_pausa_fin = new DateTime($fecha_pausa_fin);
 						
 						$fecha_fin = $info_user[$j]->hora_fin;
 						$fecha_fin = new DateTime($fecha_fin);
 						
 						$intervalo1[$j] = $fechaInicio->diff($fecha_pausa);
 						$intervalo2[$j] = $fecha_pausa->diff($fecha_pausa_fin);
 						$intervalo3[$j] = $fecha_pausa_fin->diff($fecha_fin);
 						$total[$j] = calcular_total(hora_parcial($intervalo1[$j]->format('%h'),$intervalo1[$j]->format('%i')),hora_parcial($intervalo3[$j]->format('%h'),$intervalo3[$j]->format('%i')));
 						
 						$horas_break[$j] = hora_parcial($intervalo3[$j]->format('%h'),$intervalo3[$j]->format('%i'));

 						$total_horas_break[$i] = +$horas_break[$j];
 						
 						$register[$j] = $info_user[$j]->fecha_register; 
 						
 						$horas_basica[$j] = ($total[$j]>8?8:$total[$j]);
 						
 						$horas_extras[$j] = ($total[$j]>8?$total[$j]-8:0);
 						
 						$total_horas[$j] += $horas_basica[$j]; 
 						
 						$total_horas_extras[$i] += $horas_extras[$j];
 						
 						$total_weeks_hours[$i] += ($horas_basica[$j]+$horas_extras[$j]);

 					}
 					

 					$horas_basica[$i] = ($work_time[$i]>8?8:$work_time[$i]);

 					$horas_extras[$i] = ($work_time[$i]>8?$work_time[$i]-8:0);
 					$url = base_url()."Admin/Working_detail/".$users[$i]->Id;
 					?>
 					<tr>
 						<td><a class="session_user_link" href="<?=$url;?>"><?=$users[$i]->Name." ".$users[$i]->LastName?></a></td>
 						<td><?=$total_weeks_hours[$i]?> Hours</td>
 						<td><?=$total_horas_extras[$i]?> Hours</td>
 						<td><?=$total_horas_break[$i]?> Hours</td>
 						<td class="none"><a href="<?=$url;?>">Edit</a></td>
 					</tr>
 				<?php } ?>
 			</tbody>
 		</table>
 	</div>
 </div>