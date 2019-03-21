 <?php 
 $ci =&get_instance();
 $ci->load->model("ContactModel");
 $ci->load->model("MatterModel");
 $ci->lang->load($this->session->userdata("lng") , 'labels');
 ?>

 <script src="<?=base_url()?>js/contactAjax.js"></script>
 <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
 <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
 <script src="<?=base_url()?>js/util.js"></script>
 <script src="<?=base_url()?>js/my.js"></script>

 <script>
    $( function() {
        $( "#DateOpened" ).datepicker();
    } );
</script>
<!-- CONTENIDO Contacts -->



<div id="hiddencontact" class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
    <h3><?php echo $this->lang->line('contacts_1'); ?></h3><hr>
</div>

<div id="hiddencontact"  class="row">

    <div  class="matterContent">
        <!-- Contacts -->

        <div class="col-md-3 panel_cat">
            <div class="x_panel">

                <div id="matters" class="x_title">
                    <h2><i class="fa fa-balance-scale"></i> &ensp;<?php echo $this->lang->line('contacts_2'); ?></h2>
                    <div class="clearfix"></div>
                </div>

                <!-- matter cat  -->
                <div id="content-matters" class="matCat">



                    <a href="<?=base_app()?>Contacts/setGroup/ALL">
                        <?=$this->lang->line('contacts_45');?>
                    </a>

                    <?php 
                    foreach ($Groups as $row)
                        { ?>

                            <a href="<?=base_app()?>Contacts/setGroup/<?=$row->Id?>">
                                <?=$row->Name?>
                            </a>

                        <?php } ?>

                        <script type="text/javascript">
                            function showCreateNew(){

                                if($("#newGroupForm").is( ":visible" )){
                                    $("#newGroupForm").slideUp("fast");
                                }else{

                                    $("#newGroupForm").slideDown( "fast" );
                                }
                            }

                        </script> 
                        <a>
                            <span class="underLineText" onclick="showCreateNew()" >
                                <img src="<?=base_app()?>/img/add_adress.jpg" > <?php echo $this->lang->line('contacts_11'); ?>
                            </span>
                            <div class="clearh1"></div>

                        </a>

                        <div class="clearh1"></div>

                        <div id="newGroupForm">
                            <?php
                            echo $this->session->set_userdata('message', $message);
                            echo $this->session->set_userdata('Wmessage', $message);
                            ?>
                            <form action="<?=base_app()?>Contacts/saveGroup" method="POST" id="WrapCreateGrp">
                                <input type="text" name="GroupName" style="border: 1px solid #8F8F8F;width: 200px">
                                <div class="clearh10"></div>

                                <input type="button" value="X" onclick="showCreateNew()" id="close" />
                                <input  type="submit" value="" id="save" />
                            </form>

                        </div>




                    </div>
                </div>
            </div>


            <div class="col-xs-9 ListWrap">     

                <form   action="<?=base_app()?>Contacts/eraseListConfirm" method="POST" id="contactList" >

                    <div class="col-xs-12  buttWrap">

                        <!-- boton " + add Contact"-->
                        <div class="col-md-3 pl0">
                            <a id="add_matters" onclick="createContact('ContactID_A','Contact_A')" class="btn btn-primary btn-lg btn-block" >
                                <i class="fa fa-plus"></i> &nbsp; <?php echo $this->lang->line('contacts_3'); ?>
                            </a>
                        </div>


                        <!-- boton " Delete Contacts" -->
                        <div class="col-md-3">
                            <input type="submit" id="delete_matters"   class="btn fa-trash btn-block" value="&#xf1f8; <?php echo $this->lang->line('contacts_4'); ?>" style="font-family:Arvo, FontAwesome" />
                        </div>

                        <div class="col-md-3">


                            <div class="btn-group ml-2 listButtWrap">

                                <button id="abc"type="button" class="btn btn-lg btn-secondary">ABC</button>
                                <button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >

                                    <span class="caret"></span>

                                </button>
                                <ul class="dropdown-menu btn-block listABC" role="menu">
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/A">A</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/B">B</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/C">C</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/D">D</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/E">E</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/F">F</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/G">G</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/H">H</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/I">I</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/J">J</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/K">K</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/L">L</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/M">M</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/N">N</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/N">Ñ</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/O">O</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/P">P</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/Q">Q</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/R">R</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/S">S</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/T">T</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/U">U</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/V">V</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/W">W</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/X">X</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/Y">Y</a></li>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/Z">Z</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a class="dropdown-item" href="<?=base_app()?>Contacts/ListAlpha/ALL"><?php echo $this->lang->line('modal_time_3'); ?></a>
                                    </ul>
                                </div><!-- fin wrap ml 2 -->

                            </div><!-- fin md 3 -->

                            <div class="col-md-3">


                                <div class="btn-group ml-2 listButtWrap">

                                    <button id="abc"type="button" class="btn btn-lg btn-secondary"><?php echo $this->lang->line('contacts_5'); ?></button>
                                    <button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >

                                        <span class="caret"></span>

                                    </button>
                                    <ul class="dropdown-menu btn-block groupTopList" role="menu">

                                        <?php 
                                        foreach ($Groups as $row)
                                            { ?>

                                                <li class="">
                                                    <input type="checkbox" name="goupID[]" class="goupID" value="<?=$row->Id?>" onclick="addHiddenGroups(this.value)">
                                                    <?=$row->Name?> 
                                                </li>

                                                <?php  
                                            } 
                                            ?>  

                                            <div class="dropdown-divider"></div>

                                            <li class="">
                                                <button type="button" class="btn btn-default btn-xs" onclick="ContactsTo(1)">
                                                    <?php echo $this->lang->line('contacts_42'); ?>
                                                </button>   
                                            </li>
                                            <li>
                                                <button type="button" class="btn btn-default btn-xs" onclick="ContactsTo(2)">   
                                                    <?php echo $this->lang->line('contacts_43'); ?>
                                                </button>
                                            </li>       

                                        </ul>

                                    </div><!-- fin wrap ml 2 -->







                                </div><!-- fin md 3 -->


                            </div><!-- fin xs 9 -->

                            <div class="col-xs-12 wrapMess">
                                <?php 
                                if(isset($message)){ echo $message; }   
                                echo $this->session->userdata("Wmessage");
                                echo $this->session->set_userdata("message","");
                                ?>
                            </div>





                            <!-- all Contacts -->


                            <script type="text/javascript">
                                function printTMatters() {
                                    var divToPrint = document.getElementById('resultTable');
                                    var htmlToPrint = '' +
                                    '<style type="text/css">' +
                                    'table th, table td {' +
                                    'border:1px solid #000;' +
                                    'padding;0.5em;' +
                                    '}' +
                                    '</style>';
                                    htmlToPrint += divToPrint.outerHTML;
                                    newWin = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
                                    newWin.document.write(htmlToPrint);
                                    newWin.print();
                                    newWin.close(); 
                                }
                            </script>

                            <div class="col-xs-12">
                                <div class="print">
                                    <p><?php echo $this->lang->line('contacts_2'); ?></p> <span onclick="printTMatters()"  class="fa fa-print  fa-2x"  ></span>
                                </div>
                            </div>


                            <!-- tabla -->

                            <div class="col-xs-12" >

                                <div class="paginationWrap" > 
                                    <div class="pagesList col-md-4" ><?php echo $links ?></div> 
                                    <div class="resxP     col-md-4">

                                        <span class="l"><?php echo $this->lang->line('contacts_6'); ?> &nbsp;</span>

                                        <button   type="button" class="btn btn-default btn-xs br0 l" data-toggle="dropdown">

                                            Change
                                            <span class="caret"></span>

                                        </button>

                                        <ul class="dropdown-menu btn-block" role="menu">
                                            <li><a href="<?=base_app()?>Contacts/MAxResultXPage/5">5</a></li>
                                            <li><a href="<?=base_app()?>Contacts/MAxResultXPage/10">10</a></li>
                                            <li><a href="<?=base_app()?>Contacts/MAxResultXPage/15">15</a></li>
                                            <li><a href="<?=base_app()?>Contacts/MAxResultXPage/20">20</a></li>
                                        </ul>



                                    </div>
                                    <div class="resultInfo col-md-4">
                                        <?=$startItem?>-<?=$endItem?> of <?=$totalContact?> items
                                    </div>
                                    <div class="clearh1"></div>
                                </div>



                                <div id="resultTable"> 

                                    <table class="table table-bordered table-inverse">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th><?php echo $this->lang->line('contacts_7'); ?></th>
                                                <th><?php echo $this->lang->line('contacts_8'); ?></th>
                                                <th><?php echo $this->lang->line('contacts_9'); ?></th>
                                                <th><?php echo $this->lang->line('contacts_10'); ?></th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 

                                            foreach ($Contacts as $row){ 
                                                $ci->load->model("ContactModel");

                                                $Phone = $ci->ContactModel->onePhone($row->Id);
                                                $Email = $ci->ContactModel->oneEmail($row->Id);
                                                $Groups = $ci->ContactModel->GroupsOFContacts($row->Id);


                                                if($row->Class=="Business-Org"){

                                                    $name = $row->Company;

                                                }else{
                                                    $name = $row->FirstName." ".$row->LastName;
                                                }



                                                ?>
                                                <tr>
                                                    <td><input type="checkbox" name="ItemID[]" value="<?=$row->Id?>" class="itemContact"> </td>
                                                    <td><a onclick="atachTo('AjaxContact/details/<?=$row->Id?>')"><?=$name?></a></td>
                                                    <td><?=$Phone->Phone?></td>
                                                    <td><?=$Email->Email?></td>
                                                    <td><?php
                                                    if(count($Groups)>0){
                                                        foreach($Groups as $row  ){
                                                            echo $row->NameGroup.",";
                                                        }
                                                    }

                                                    ?></td>
                                                </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div><!-- fin result table -->   
                            </div><!-- fin col-md-9 -->
                        </form> 
                    </div>  
                </div><!-- fin clase maters content -->

            </div>

            <script>
                $('#WrapCreateGrp').submit(function() {
                    if ($('[name="GroupName"]').val()=='') {
                        alert('El nombre del grupo no puede estar vacío');
                        return false;
                    }
                });
            </script>

            <!-- inicio de la version movil-->
 <!-- <div id="listpreset" >
 <div class="col border">
        <h4 class="d-flex justify-content-center tittle">Contacts</h4>
    </div>
    <div class="row none">
        <div class="col-5">
            <div class="dropdown dropmira"><button class="btn btn-primary dropdown-toggle dropsecond" data-toggle="dropdown" aria-expanded="false" type="button"><img src="http://demo.web-informatica.info/MiraTask/img/bal.png" class="balimg">All Contacts</button>
                <div class="dropdown-menu change" role="menu"><a class="dropdown-item item change" role="presentation" href="#">All Contacts</a><a class="dropdown-item item change" role="presentation" href="#">Prospective Clients</a><a class="dropdown-item item change" role="presentation" href="#">Referral Sources</a>
                    <a
                        class="dropdown-item item change off" role="presentation" href="#"><img src="http://demo.web-informatica.info/MiraTask/img/add.png" class="imgspace">First Item</a><a class="dropdown-item item change off" role="presentation" href="#"><input type="text" id="inputespecial" placeholder="New Group Name"></a><a class="dropdown-item item change off" role="presentation"
                            href="#"><img src="http://demo.web-informatica.info/MiraTask/img/cancel.png" class="imgspace right"><img src="http://demo.web-informatica.info/MiraTask/img/save.png" class="imgspace right"></a></div>
            </div>
        </div>
        <div class="col-5 offset-2">
            <div id="changedrop" class="dropdown"><button class="btn btn-primary dropdown-toggle btnpage" data-toggle="dropdown" aria-expanded="false" type="button">Pages </button>
                <div class="dropdown-menu changesecond" role="menu"><a class="dropdown-item menusecond" role="presentation" href="#">1</a><a class="dropdown-item menusecond" role="presentation" href="#">2</a><a class="dropdown-item menusecond" role="presentation" href="#">3</a></div>
            </div>
        </div>
    </div>
    <div class="col margibottom">
        <div class="divmenuprint"><label class="labelsmall">All Contacts</label><img src="http://demo.web-informatica.info/MiraTask/img/print.png" class="printlogo"></div>
        
        
        <?php 
                        
                        foreach ($Contacts as $row){ 
                            $ci->load->model("ContactModel");
                            
                            $Phone = $ci->ContactModel->onePhone($row->Id);
                            $Email = $ci->ContactModel->oneEmail($row->Id);
                            $Groups = $ci->ContactModel->GroupsOFContacts($row->Id);
                            

                             if($row->Class=="Business-Org"){

                                $name = $row->Company;

                             }else{
                                $name = $row->FirstName." ".$row->LastName;
                             }
                         
                         
                             
                        ?>
        
        <div class="divboxcontac">
            <div class="container">
                <div class="row">
                    <div class="col-1"><input type="checkbox" class="checkbox mira"></div>
                    <div class="col-8"><label class="col-form-label labelname"><a onclick="atachTo('AjaxContact/details/<?=$row->Id?>')"><?=$name?></a></label>
                        <div>
                            <div class="col-10 offset-2 off"><label class="col-form-label labelphone">phone:&nbsp;</label><label class="col-form-label labelphone ligth"><?=$Phone->Phone?></label></div>
                            <div class="col-10 offset-2 off"><label class="col-form-label labelphone">Email: &nbsp;</label><label class="col-form-label labelphone ligth correo"><?=$Email->Email?></label></div>
                        </div>
                    </div>
                    <div class="col-2 offset-0 off padding"><label class="col-form-label labelphone">Group List:&nbsp;</label><label class="col-form-label labelphone ligth">Group 1</label></div>
                </div>
            </div>
        </div>
        <?php  } ?>
        
        
    </div>
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center"><a href="#"><i class="fa fa-chevron-left"></i>&nbsp; &nbsp; Previous</a></div>
            <div class="col d-flex justify-content-center align-items-center"><a href="#">&nbsp; &nbsp; Next&nbsp;<i class="fa fa-chevron-right"></i></a></div>
        </div>
    </div>
    <div class="divmenudown">
        <div class="boxmenu">
            <div class="col"><img class="d-flex mx-auto" src="http://demo.web-informatica.info/MiraTask/img/lupa.png"></div>
            <div class="col off"><label class="col-form-label d-flex justify-content-center align-items-center menulabel">Search</label></div>
        </div>
        <div class="boxmenu" id="addcontact">
            <div class="col"><img class="d-flex mx-auto" src="http://demo.web-informatica.info/MiraTask/img/plus.png"></div>
            <div class="col off"><label class="col-form-label d-flex justify-content-center align-items-center menulabel">Add Contact</label></div>
        </div>
        <div class="boxmenu">
            <div class="col"><img class="d-flex mx-auto" src="http://demo.web-informatica.info/MiraTask/img/deleted.png"></div>
            <div class="col off"><label class="col-form-label d-flex justify-content-center align-items-center menulabel">Delete Contact</label></div>
        </div>
        <div class="boxmenu">
            <div class="col"><img class="d-flex mx-auto row" src="http://demo.web-informatica.info/MiraTask/img/row.png"></div>
            <div class="col off"><label class="col-form-label d-flex justify-content-center align-items-center menulabel">ABC</label></div>
        </div>
        <div class="boxmenu">
            <div class="col"><img class="d-flex mx-auto row" src="http://demo.web-informatica.info/MiraTask/img/row.png"></div>
            <div class="col off"><label class="col-form-label d-flex justify-content-center align-items-center menulabel">Groups</label></div>
        </div>
    </div>
    <div class="modalforme">
        <div class="secondmodal">
            <div class="headermodal"><img src="http://demo.web-informatica.info/MiraTask/img/people.png" class="imgpeople"><label class="labelfirts">Add Contact</label></div>
            <div class="row off">
                <div class="col-6 d-flex justify-content-center">
                    <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-1"><label class="form-check-label" for="formCheck-1">Individuals</label></div>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-1"><label class="form-check-label" for="formCheck-1">Business / <br>Organizations</label></div>
                </div>
            </div>
            <div class="row off">
                <div class="col-6 d-flex justify-content-center">
                    <div class="dropdown"><button class="btn btn-primary dropdown-toggle btnpage more" data-toggle="dropdown" aria-expanded="false" type="button">Groups</button>
                        <div class="dropdown-menu changesecond" role="menu"><a class="dropdown-item menusecond" role="presentation" href="#">1</a><a class="dropdown-item menusecond" role="presentation" href="#">2</a><a class="dropdown-item menusecond" role="presentation" href="#">3</a></div>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <div class="dropdown"><button class="btn btn-primary dropdown-toggle btnpage more" data-toggle="dropdown" aria-expanded="false" type="button">Select Own</button>
                        <div class="dropdown-menu changesecond" role="menu"><a class="dropdown-item menusecond" role="presentation" href="#">1</a><a class="dropdown-item menusecond" role="presentation" href="#">2</a><a class="dropdown-item menusecond" role="presentation" href="#">3</a></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="optionone">
                <div class="row off">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Title</label></div>
                    <div class="col-8"><input type="text" class="inputmodal"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Name*</label></div>
                    <div class="col-8"><input type="text" placeholder="  First" class="inputmodal"><input type="text" placeholder="  Middle" class="inputmodal more"><input type="text" placeholder="  Last" class="inputmodal more"><input type="text" placeholder="  Suffix"
                            class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Profession</label></div>
                    <div class="col-8"><input type="text" class="inputmodal"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Company</label></div>
                    <div class="col-8"><input type="text" class="inputmodal"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">ClientID</label></div>
                    <div class="col-8"><input type="text" class="inputmodal"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Address *</label></div>
                    <div class="col-8"><select class="selectmodal"><optgroup label="This is a group"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select><input type="text"
                            placeholder="  Street" class="inputmodal more"><input type="text" placeholder="  Street 2" class="inputmodal more"><input type="text" placeholder="  City" class="inputmodal more"><select class="selectmodal margin"><optgroup label="This is a group"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select>
                        <input
                            type="text" placeholder="  Zip Code" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal"></label></div>
                    <div class="col-8"><img src="http://demo.web-informatica.info/MiraTask/img/add.png"><a href="#" class="addtext">Add adress&nbsp;<br></a></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Phone</label></div>
                    <div class="col-8"><input type="text" placeholder="  555-555-5555" class="inputmodal more"><input type="text" placeholder="  Ext." class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal"></label></div>
                    <div class="col-8"><img src="http://demo.web-informatica.info/MiraTask/img/add.png"><a href="#" class="addtext">Add phone&nbsp;<br></a></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Email</label></div>
                    <div class="col-8"><input type="text" placeholder="  sample@hotmail.com" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal"></label></div>
                    <div class="col-8"><img src="http://demo.web-informatica.info/MiraTask/img/add.png"><a href="#" class="addtext">Add email&nbsp;<br></a></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Date Of <br>Birth</label></div>
                    <div class="col-8"><input type="text" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Other <br>identifier<br></label></div>
                    <div class="col-8"><input type="text" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Website<br></label></div>
                    <div class="col-8"><input type="text" placeholder="http://yourwebsite.com" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal"></label></div>
                    <div class="col-8"><img src="http://demo.web-informatica.info/MiraTask/img/add.png"><a href="#" class="addtext">Add website&nbsp;<br></a></div>
                </div>
                <div class="row off more">
                    <div class="col-6 d-flex justify-content-center"><button class="btn btn-primary btngreen" type="button">Save</button></div>
                    <div class="col-6 d-flex justify-content-center"><button id="cancel" class="btn btn-primary btngreen change" type="button">Cancel</button></div>
                </div>
            </div>
            <div class="optiontwo">
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Company</label></div>
                    <div class="col-8"><input type="text" class="inputmodal"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">ClientID</label></div>
                    <div class="col-8"><input type="text" class="inputmodal"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Address *</label></div>
                    <div class="col-8"><select class="selectmodal"><optgroup label="This is a group"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select><input type="text"
                            placeholder="  Street" class="inputmodal more"><input type="text" placeholder="  Street 2" class="inputmodal more"><input type="text" placeholder="  City" class="inputmodal more"><select class="selectmodal margin"><optgroup label="This is a group"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select>
                        <input
                            type="text" placeholder="  Zip Code" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal"></label></div>
                    <div class="col-8"><img src="http://demo.web-informatica.info/MiraTask/img/add.png"><a href="#" class="addtext">Add adress&nbsp;<br></a></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Phone</label></div>
                    <div class="col-8"><input type="text" placeholder="  555-555-5555" class="inputmodal more"><input type="text" placeholder="  Ext." class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal"></label></div>
                    <div class="col-8"><img src="http://demo.web-informatica.info/MiraTask/img/add.png"><a href="#" class="addtext">Add phone&nbsp;<br></a></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Email</label></div>
                    <div class="col-8"><input type="text" placeholder="  sample@hotmail.com" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal"></label></div>
                    <div class="col-8"><img src="http://demo.web-informatica.info/MiraTask/img/add.png"><a href="#" class="addtext">Add email&nbsp;<br></a></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Date Of <br>Birth</label></div>
                    <div class="col-8"><input type="text" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Other <br>identifier<br></label></div>
                    <div class="col-8"><input type="text" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal">Website<br></label></div>
                    <div class="col-8"><input type="text" placeholder="http://yourwebsite.com" class="inputmodal more"></div>
                </div>
                <div class="row off more">
                    <div class="col-4 d-flex justify-content-end off"><label class="col-form-label labelmodal"></label></div>
                    <div class="col-8"><img src="http://demo.web-informatica.info/MiraTask/img/add.png"><a href="#" class="addtext">Add website&nbsp;<br></a></div>
                </div>
                <div class="row off more">
                    <div class="col-6 d-flex justify-content-center"><button class="btn btn-primary btngreen" type="button">Save</button></div>
                    <div class="col-6 d-flex justify-content-center"><button class="btn btn-primary btngreen change" type="button">Cancel</button></div>
                </div>
            </div>
        </div>
    </div>
 
 </div>-->