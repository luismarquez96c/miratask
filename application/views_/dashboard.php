 <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
 <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
 <script src="<?=base_url()?>js/util.js"></script>

 <?php 
    $ci =&get_instance();
    $ci->load->model("MatterModel");
    $ci->load->model("UserModel");
 ?>
 
 <!-- CONTENIDO DASHBOARD-->

<div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
    <h3>Dashboard</h3><hr>
</div>




<div class="row">

	<div   class="dashboardWrap matterContent" >


        <!-- MATTERS -->



        <div class="col-md-4 dashBox">
         
           
            <div id="matters" class="x_title">
                <h2><img src="<?=base_url()?>img/matters_blue.png"> &ensp;Matters</h2>
                <div class="clearfix"></div>
            </div>
         
    		<!-- contenido -->
    		<div class="matCat">

     
    			<?php 
    					 
    			foreach ($lastFive as $row)
    			{			
    			?>
    			
    			<a href="<?=base_app()."Matters/Details/".$row->Id?>">
    				<?=substr($row->Name,0,30)?>... <span><?=decodedate($row->DateOpen)?></span>
    			</a>
    			
    			<?php 
    			}
    			?> 
    		</div>
        </div>
            





        <!-- TASK ---------------------->



        <div class="col-md-4 dashBox">
       
         
    		<div id="task" class="x_title">
    			<h2><img src="<?=base_url()?>img/task.png"> &ensp;Task</h2>
    			<!-- buscador -->

                <div class="col-md-5">
                        
                    <button type="button" class="btn btn-default btn-xs br0 timesList" data-toggle="dropdown" aria-expanded="false">
                        

                        <?php 
                        if($this->session->userdata("labelTimeAct")==""){

                            echo "Today";

                        }else{

                            echo $this->session->userdata("labelTimeAct");

                        }
                        ?>


                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu btn-block" role="menu">
                         <li><a href="<?=base_app()?>/Dashboard/setFiltroTask/Today">Today</a></li>
                         <li><a href="<?=base_app()?>/Dashboard/setFiltroTask/Tomorrow">Tomorrow</a></li>
                         <li><a href="<?=base_app()?>/Dashboard/setFiltroTask/Week">This Week</a></li>
                         <li><a href="<?=base_app()?>/Dashboard/setFiltroTask/Overdue">Overdue</a></li>
                         <li><a href="<?=base_app()?>/Dashboard/setFiltroTask/All">All Task (by priority)</a></li>
                    </ul>
                </div>

    			<div class="clearfix"></div>
    		</div>

          
            <div class="matCat">

        		<?php 			 
        		foreach ($lastTask as $row)
        		{			
        		?>
        		
        		<a onclick="detailTask('<?=$row->Id?>')" >
					 
        			<?=substr($row->Subject,0,40)?>...<span><?=decodedate($row->StartDate)?></span>
        		</a>
        		
        		<?php 
        		}
        		?> 

            </div>
         
        </div><!-- fin task -->






        <!-- YOU BILLED ---------------------------->

        <div class="col-md-4 dashBox">
            <div class="x_panel">

                <div id="you_billed" class="x_title">
                    
                    <h2><img src="<?=base_url()?>img/Billing_blue.png"> &ensp; You Billed</h2>

                    <!-- buscador -->
            		<div class="col-md-5">
                
                        <button type="button" class="btn btn-default btn-xs br0 timesList" data-toggle="dropdown" aria-expanded="false">
                        <?php 
                            if($this->session->userdata("labelYou")!=""){
                                echo $this->session->userdata("labelYou");
                            }else{
                                echo 'Today';
                            }
                            ?>
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu btn-block" role="menu">
                             <li><a href="<?=base_app()?>/Dashboard/setYouBilled/Today">Today</a></li>
                             <li><a href="<?=base_app()?>/Dashboard/setYouBilled/Week">Week</a></li>
                             <li><a href="<?=base_app()?>/Dashboard/setYouBilled/Month">Month</a></li>
                             <li><a href="<?=base_app()?>/Dashboard/setYouBilled/Year">Year</a></li>
                        </ul>
                    </div>

                    <div class="clearfix"></div>
                </div>

                 <!-- contenido -->   
                <div id="content-you-billed" class="x_content">
                    <article class="media event">
                        <div class="media-body">
                            <p>$<?=number_format($youBilled->Total,2)?> <small>Billables Fies</small></p>
                        </div>
                    </article>
                </div>

            </div>
        </div><!-- you billed -->





        <div class="clearh20"></div>




           
        <!-- MEETINGS AND APPOINTMENTS -->


        <div class="col-xs-6 dashBox dashBoxLarge">

            <div id="meetings_appointments" class="dashMeet">

                <h2> &nbsp; <img src="<?=base_app()?>img/contact_group.png"> &nbsp; Meetings and Appointments</h2>

             
                <div role="tabpanel" class="cero" data-example-id="togglable-tabs">

                    <?php 
                        //class="active"
                        $lbXAct=$this->session->userdata("labelExp");
                        //echo "lavel actual ".$lbAct;
                        if($lbXAct=="Today"){    $active=""; $active[1]="active"; }
                        if($lbXAct=="Tomorrow"){ $active=""; $active[2]="active"; }
                        if($lbXAct=="Week"){     $active=""; $active[3]="active"; }
                         
                    ?>
                
                    <ul id="dashOpc" class="nav nav-tabs bar_tabs" role="tablist">



                       <li  class="<?=$active[1]?>" ><a href="<?=base_app()?>Dashboard/setLastMetting/Today"  >Today</a></li>
                       <li  class="<?=$active[2]?>" ><a href="<?=base_app()?>Dashboard/setLastMetting/Tomorrow"  >Tomorrow</a></li>
                       <li  class="<?=$active[3]?>" ><a href="<?=base_app()?>Dashboard/setLastMetting/Week" >Week</a></li>
                        
                        
                    </ul>

                   

                </div>

                <div class="uno" id="uno"></div>

                <div class="dos" id="dos"></div>
                <div class="tres"  ></div>
         
                <div class="clearfix"></div>
            </div>

            <!-- contenido -->
            <div id="content_meetings_appointments" class="tab-content">

        		<div class="dasMeeting">

        			 <?php
                        $this->load->helper('calendar');
                        if(count($Meeting)>0 )
                        {    
                            

                            foreach ($Meeting as $row)
                            {  
                               
                               if($row->all_day==1){
                                    $allDay="All Day";
                               }else{
                                    $allDay=minutes_to_hours($row->start_time)."-".minutes_to_hours($row->end_time);
                               }
                        ?>
        			
            			<a>

            				<div class="cero" onclick="loadEvent('<?=$row->id?>')"> <?=substr($row->subject,0,40)?>    </div> 
                            <div class="uno">  <?=decodedate($row->start_date)?> <?=$allDay?>  </div> 
                            <div class="dos">  
                                <?=substr($row->location,0,10)?>  
                                
                            </div> 

                            <div class="tres"> 
                                <span onclick="deleteEvent('<?=$row->id?>')" >
                                    <img src="<?=base_url()?>img/status_2.jpg">
                                </span>
                            </div>


                            <div class="clearh1"></div>
            			</a> 

                         <?php 
                            }
                        
                         }   
                         ?>

                    

        			 <div class="clearh1"></div>
        		</div>

            </div><!-- fin contenido  -->
         
        </div><!-- fin mettign apointment -->
          





        <!-- TASK for me ------------------------------------------------------------>


        <div class="col-xs-6 dashBox dashBoxLarge">
         
            <div id="meetings_appointments"  class="dashMeet">
                <h2><img src="<?=base_url()?>img/task.png"> &ensp;  Task</h2>

                <div class="mytaskscroll" role="tabpanel" data-example-id="togglable-tabs">
                        
                    <?php 
                    //class="active"
                    $lbAct=$this->session->userdata("labelMTimeAct");
                    //echo "lavel actual ".$lbAct;
                    if($lbAct=="Today"){    $active=""; $active[1]="active"; }
                    if($lbAct=="Tomorrow"){ $active=""; $active[2]="active"; }
                    if($lbAct=="Priority"){ $active=""; $active[3]="active"; }
                    if($lbAct=="Overdue"){  $active=""; $active[4]="active"; }
                    ?>


                    <ul id="dashOpc" class="nav nav-tabs bar_tabs  "  >
                           <li class="<?=$active[1]?>" ><a href="<?=base_app()?>Dashboard/setMYLastTask/Today">Today</a></li>
                           <li class="<?=$active[2]?>" ><a href="<?=base_app()?>Dashboard/setMYLastTask/Tomorrow">Tomorrow</a></li>
                           <li class="<?=$active[3]?>" ><a href="<?=base_app()?>Dashboard/setMYLastTask/Priority">Priority</a></li>
                           <li class="<?=$active[4]?>" ><a href="<?=base_app()?>Dashboard/setMYLastTask/Overdue">Overdue</a></li>
                    </ul>
                </div>
                

         
                <div class="clearfix"></div>


            </div><!-- fin barra de titulo -->

            <!-- contenido task -->
            <div id="content_meetings_appointments" class="tab-content">


                <!-- contenido 1 -->

                 
                    <div id="task1" class=" ">
                        
                        
                        <?php
                        if(count($myLastTask)>0 )
                        {    
                        echo '<table class="dashTask">';         
                            foreach ($myLastTask as $row)
                            {  

                                  
                            $AssignTo=$ci->UserModel->GetAttorney($row->AssignTo);     
                            $Priority  = $ci->TaskModel->Priority($row->Priority);
                                 
                            ?>
                            
                             
                            <tr>
                             
                                <td> <a onclick="detailTask('<?=$row->Id?>')" ><?=$row->Subject?></a></td>
                                <td> <a onclick="detailTask('<?=$row->Id?>')" ><?=$AssignTo->Name?> <?=$AssignTo->LastName?></a></td> 
                                <td> <?=decodedate($row->StartDate)?></td> 
                                <td> <?=$Priority->Name?> 
                                     
                                    <span onclick="deleteTask('<?=$row->Id?>')" >
                                        <img src="<?=base_url()?>img/status_2.jpg">
                                        
                                    </span>  
                                     <span onclick="completeTask('<?=$row->Id?>')" >
                                     
                                        <img src="<?=base_url()?>img/status_1.jpg">
                                        
                                    </span>
                                </td> 

                           <tr>
                        
                            <?php 
                            }
                        echo '</table>';    
                         
                        }else{ ?>
                            <table class="dashTask">
                                <tr>
                                    <td>Task 1 assigned to you will  appear here</td>
                                </tr>
                            </table>
                        <?php    
                        }
                        ?> 

                    <div class="addMasWrap">        
                        <span class="" onclick="createTask()" for="">
                             <img src="<?=base_url()?>img/otrotask.png"> &nbsp; Add Task
                        </span>
                    </div>    
                     
                </div> <!-- /contenido 1 -->
            </div>

        </div><!-- fin task -->


        <!-- RECENT ACTIVITY -->
        <div class="col-md-12  dashBoxLarge">
            <div class="x_panel">

                <div id="recent-activity" class="x_title">
                    <h2> &nbsp; <img src="<?=base_app()?>img/contact_group.png"> &nbsp; Recent Activity</h2>
                    <div class="clearfix"></div>
                </div>

                <!-- contenido -->

                <div id="content_recent_activity" class="x_content ">

                     

                    <?php           
                    foreach ($recentActi as $row){ 

                         

                        if($row->Object=="note"){

                            $label="to the matter";
                            $img="recentactv.png";
							$enlace=' href="'.base_app().'Matters/Details/'.$row->Id.'?tab=notes" ';

                             

                        }elseif($row->Object=="matter"){

                            $label="";
                            $img="matters_blue.png";
							$enlace=' href="'.base_app().'Matters/Details/'.$row->Id.'" ';
						
						}elseif($row->Object=="contact"){
							
							$label="to the matter";
							$img="contact_group.png";
                            $enlace='  ';

                        }elseif($row->Object=="document"){
                            
                            $label="to the Matter ";
                            $img="Document_blue.png";
                            $enlace=' href="'.base_app().'docsxup/'.$row->titulo.'" ';

                            

                        }elseif($row->Object=="task"){
                            
                            $label="";
                            $img="task.png";
                            $enlace=' onclick="detailTask(\''.$row->Id.'\')" ';   

                        }elseif($row->Object=="event"){
                            
                            $label="";
                            $img="recentActivity.png";
                            $enlace=' onclick="loadEvent(\''.$row->Id.'\')" '; 

                        }elseif($row->Object=="Time and expense"){

                            $label2='';
                            $label="";
                            $img="Billing_blue.png";
                            $enlace=' onclick="add_entry_g(\'0\',\''.$row->Id.'\')" ';      

                        }else{


                            $label="";
                            $img="";
                        }

                        $this->load->helper("caltime");





                              
                    ?>

                        <article class="media event">

                            <a <?=$enlace?> class="pull-left date">
                                <p class="day"><img src="<?=base_url()?>img/<?=$img?>"></p>
                            </a>

                            <div class="media-body">
                                <p>
                                    <?=$row->Creator. "   ".$row->Actions ?> a 
                                     <?=$row->Object?>   <a <?=$enlace?> ><?=substr($row->titulo,0,100)?></a> <?=$label?>
                                    
                                    <?php
                                        if($row->Too!="vacio"){ echo '<a href="'.base_url().'/Matters/Details/'.$row->idToo.'" >'.$row->Too.'</a>'; }
                                    ?>
                                    
                                </p>
                                <small><?=caltime($row->fecha)?> ago</small>
                            </div>

                        </article>

                    <?php 
                    }
                    ?>


                     <div class="clearh1"></div>

                </div><!-- x-content -->
            </div>    
        </div><!-- fin recent activity -->
        



             
        
             
    </div><!-- Fin MatterContent -->

    <!-- RESOURCES -->


    <div class="col-md-12" id="resources">

        <div class="row">

             <div class="center" style="width:800px; margin-left:250px;">
            <div   class="mbr-cards-col col-xs-12 col-lg-4">
                 

                     
                        <a href="mailto:soporte@web-informatica.com"><img src="<?=base_app()?>img/Email.png"></a>
                   

                 
            </div>


            <!-- segundo icono -->
            <div   class="mbr-cards-col col-xs-12 col-lg-4">
                 

                   
                        <a href="mailto:soporte@web-informatica.com"><img src="<?=base_app()?>img/TecnicalSuport.png"></a>
                    

                
            </div>
            </div>


             
            
            
        </div>
    </div>




</div><!-- row -->

<script type="text/javascript">


        
     


    //const container = document.querySelector('#matCat');
    //const ps = new PerfectScrollbar(container);

    

    

    //const ps = new PerfectScrollbar('.matCat', {
    //  wheelSpeed: 2,
    //  wheelPropagation: true,
    //  minScrollbarLength: 20
    //});

       

    </script>






         




