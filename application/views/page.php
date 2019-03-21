

<?php get_header(); ?> <!-- MUESTRA HEADER -->
<?php $postid = get_the_ID(); ?> <!-- MUESTRA EL ID DE CADA PAGINA -->

<input type="hidden" id="url" value="<?php echo get_site_url(); ?>">



<!-- CONTENIDO QUIENES SOMOS -->

<?php if ($postid == 7): ?>
    <style type="text/css">
    #menu-item-36 a{color: #ff6f20;font-weight: bold;}
</style>



<!-- PRIMERA SECCION "SLIDER" -->

<?php if ( have_posts() ) : the_post(); ?>
    <section class="slider-page-somos">
        <div class="row none">
            <div class="col-xs-12 col-sm-12 col-lg-12 none">
                <?php $galeria =  get_field('id_galeria'); slider_type_3($galeria); ?>
            </div>
        </div>
    </section>


    <!-- SEGUNDA SECCION "¿QUIENES SOMOS?" -->

    <section class="somos-section-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12 ">

                    <?php $titulo1    =  get_field('titulo_1'); ?>
                    <?php $contenido1 =  get_field('contenido_1'); ?>
                    <h1><?php echo $titulo1 ?></h1>
                    <?php echo $contenido1 ?>

                </div>
            </div>

            <div class="hidden-xs">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12 ">
                        <br><br><br><br><br><br>
                    </div>
                </div>
            </div>

            <!-- TERCERA SECCION "MISION / VISION" -->

            <div class="row mision-vision">

                <!-- MISION -->
                <div class="col-xs-12 col-sm-12 col-lg-6 ">
                    <div class="media">

                        <div class="hidden-xs">
                            <div class="media-left">
                                <img src="<?php bloginfo('template_directory'); ?>/assets/img/comillas.png" class="media-object" style="width:60px">
                            </div>
                        </div>

                        <?php $mision_titulo    =  get_field('mision_titulo'); ?>

                        <?php $mision_contenido =  get_field('mision_contenido'); ?>

                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $mision_titulo  ?></h4>
                            <?php echo $mision_contenido ?>
                        </div>

                    </div>
                </div>

                <!-- VISION -->
                <div class="col-xs-12 col-sm-12 col-lg-6 ">
                    <div class="media">
                        <div class="hidden-xs">
                            <div class="media-left">
                                <img src="<?php bloginfo('template_directory'); ?>/assets/img/comillas.png" class="media-object" style="width:60px">
                            </div>
                        </div>

                        <?php $vision_titulo    =  get_field('vision_titulo'); ?>
                        <?php $vision_contenido =  get_field('vision_contenido'); ?>

                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $vision_titulo ?></h4>
                            <?php echo $vision_contenido ?>
                        </div>
                    </div>
                </div>

            </div> <!-- /row mision-vision -->



            <!-- CUARTA SECCION "NUESTROS VALORES" -->

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12">
                    <?php $titulo_valores    =  get_field('titulo_valores'); ?>
                    <h4><?php echo $titulo_valores ?></h4>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12"><br><br></div>
            </div>

            <div class="row valores">


                <!-- liderazgo -->

                <div class="col-lg-4">
                    <?php $titulo_item_1    =  get_field('titulo_item_1'); ?>

                    <?php $contenido_item_1 =  get_field('contenido_item_1'); ?>

                    <h3><?php echo $titulo_item_1  ?></h3>

                    <?php echo $contenido_item_1 ?>

                </div>



                <!-- Honestidad -->

                <div class="col-lg-4">
                    <?php $titulo_item_2    =  get_field('titulo_item_2'); ?>

                    <?php $contenido_item_2 =  get_field('contenido_item_2'); ?>

                    <h3><?php echo $titulo_item_2  ?></h3>

                    <?php echo $contenido_item_2 ?>

                </div>


                <!-- Perseverancia -->

                <div class="col-lg-4">

                    <?php $titulo_item_3    =  get_field('titulo_item_3'); ?>

                    <?php $contenido_item_3 =  get_field('contenido_item_3'); ?>

                    <h3><?php echo $titulo_item_3  ?></h3>

                    <?php echo $contenido_item_3 ?>

                </div>

            </div> <!-- /row valores -->


            <!-- segunda seccion "Valores" -->

            <div class="row valores">


                <!-- Solidaridad -->

                <div class="col-lg-4">

                    <?php $titulo_item_4    =  get_field('titulo_item_4'); ?>

                    <?php $contenido_item_4 =  get_field('contenido_item_4'); ?>

                    <h3><?php echo $titulo_item_4  ?></h3>

                    <?php echo $contenido_item_4 ?>

                </div>


                <!-- Compromiso -->

                <div class="col-lg-4">
                    <?php $titulo_item_5    =  get_field('titulo_item_5'); ?>

                    <?php $contenido_item_5 =  get_field('contenido_item_5'); ?>

                    <h3><?php echo $titulo_item_5  ?></h3>

                    <?php echo $contenido_item_5 ?>

                </div>


                <!-- Patriotismo -->

                <div class="col-lg-4">

                    <?php $titulo_item_6    =  get_field('titulo_item_6'); ?>

                    <?php $contenido_item_6 =  get_field('contenido_item_6'); ?>

                    <h3><?php echo $titulo_item_6  ?></h3>

                    <?php echo $contenido_item_6 ?>

                </div>

            </div>

        </div> <!-- /container -->
    </section> <!-- /somos-section -->

<?php endif ?>
<?php endif; ?>




<!-- CONTENIDO CONTACTENOS -->

<?php if ($postid == 24): ?> <!-- id pagina -->
<style type="text/css">
#menu-item-31 a{ color: #ff6f20;font-weight: bold;}</style>

<?php if ( have_posts() ) : the_post(); ?>


    <!-- PRIMERA SECCION "CONTACTENOS" -->

    <section class="somos-section-1">
        <div class="container">

            <div class="row">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </section>

<?php endif ?>
<?php wp_reset_query();?>


<!-- SEGUNDA SECCION "DIRECCIONES" -->
<section class="somos-section-2">
    <div class="container">
        <div class="row">

            <?php $post_data =  query_posts('category_name=Contactenos&order=ASC' );?>

            <?php while ( have_posts() ) : the_post();?>

                <div class="col-lg-4">
                    <div class="media">

                        <div class="media-left">
                            <img class="media-object"  src="<?php bloginfo('template_directory'); ?>/assets/img/point.png" alt="" style="width:30px">
                        </div>

                        <div class="media-body">
                            <h4 class="media-heading"><?php the_title(); ?></h4>
                            <?php the_content(); ?>
                            <?php $telefono =  get_field('telefono');?>
                            <?php $url_google_maps =  get_field('url_google_maps');?>
                            <?php if ($telefono != ""): ?>
                                <strong><span>Tel:.</span> <?php echo $telefono ?></strong><br>

                            <?php endif ?>
                            <strong><a href="<?php echo $url_google_maps ?>" target="_blank">Ver Mapa</a></strong>

                        </div>
                    </div>

                </div>
            <?php endwhile;  ?>

        </div>
    </div>
</section>



<!-- TERCERA SECCION "ESCRIBENOS" -->

<?php wp_reset_query();?>

<?php $post = get_post(26);  setup_postdata($post); ?>

<section class="home-section-6">

    <div class="container">
        <div class="row ">
            <div class="col-lg-6">

                <?php $titulo7   =  get_field('titulo_7'); ?>

                <?php $contenido7    =  get_field('contenido_7'); ?>

                <?php $mail    =  get_field('mail_contactanos'); ?>

                <h1><?php echo $titulo7 ?></h1>

                <div class="hidden-xs">
                    <?php echo $contenido7   ?>
                </div>

                <div class="visible-xs" style="width: 100%">
                    <p>Comentarios o preguntas son bienvenidos!</p>
                    <p>Puede comunicarse con FESA a través de nuestro formulario de contacto y uno de nuestros representantes se pondrá en contacto con usted en la menor brevedad posible.</p>
                </div>

                <div class="media">

                    <div class="media-left">
                        <img src="<?php bloginfo('template_directory'); ?>/assets/img/mail.png" class="media-object" style="width:60px">
                    </div>

                    <!-- Redes Sociales -->
                    <div class="media-body menu-redes">

                        <h4 class="media-heading"><?php echo $mail ?></h4>

                        <nav >
                            <?php wp_nav_menu( array( 'theme_location' => 'Redes' ) ); ?>
                        </nav>

                    </div>
                </div>
            </div>


            <!-- CUARTA SECCION "FORMULARIO DE CONTACTO" -->

            <div class="col-lg-6">
                <form id="contactanos_form" method="POST" > 
                    <div class="col-lg-6">

                        <div class="form-group">
                            <input type="text" required="" name="nombre" class="form-control" placeholder="Nombre">
                        </div>

                        <div class="form-group">
                            <input type="email" required="" name="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <input type="text" required="" name="telefono" class="form-control" placeholder="Teléfono">
                        </div>

                        <div class="form-group">
                            <input type="text" required="" name="pais" class="form-control" placeholder="País">
                        </div>
                    </div> <!--col-lg-6 -->

                    <div class="col-lg-6">
                        <div class="form-group">
                            <textarea class="form-control" name="mensaje" rows="8" id="comment" placeholder="Mensaje"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button id="btn-envio" type="submit" class="btn-envio">Enviar</button>

                        <p class="hidden" id="envio" style="font-weight: bold; text-align: center; padding-top:25px;">SE HA ENVIADO SU MENSAJE</p>
                    </div>
                </form>
            </div>

        </div>
    </div> <!-- /container -->
</section>

<?php wp_reset_postdata();  ?>

<?php endif; ?>




<!-- CONTENIDO "MODELO FESA" -->

<?php if ($postid == 9): ?>
    <style type="text/css">
#menu-item-35 a {color: #ff6f20; font-weight: bold;}</style>

<?php if ( have_posts() ) : the_post(); ?>


    <!-- PRIMERA SECCION "SLIDER" -->

    <section class="slider-page-modelo">
        <div class="row none">
            <div class="col-xs-12 col-sm-12 col-lg-12 none">
                <?php $galeria =  get_field('id_galeria'); slider_type_3($galeria); ?>
            </div>
        </div>
    </section>


    <!-- SEGUNDA SECCION "MODELO FESA" -->

    <section class="modelo-section-1">
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12">
                    <h1><?php the_title(); ?></h1>

                    <div class="hidden-xs">
                        <?php the_content(); ?>
                    </div>

                    <div class="visible-xs" style="width: 100%;">
                        <p>El objetivo principal es formar integralmente a los jóvenes para que utilicen la
                            educación y el deporte como vehículo de Formación Integral, y a la vez como
                            herramienta para mejorar su calidad de vida.<br><br>

                            El modelo FESA desarrolla la formación educativa, humana y deportiva en los
                        jóvenes con los componentes siguientes:</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- TERCERA SECCION "PIRAMIDE - MODELO" -->

    <section class="modelo-section-2 ">
        <div class="container">

            <div class="hidden-xs">
                <h1 id="modelo_piramide_img"><?php the_title(); ?></h1>

            </div>

            <div class="visible-xs">
                <center><h1 id="titulo-piramide"><?php the_title(); ?></h1></center>
            </div>





            <div class="hidden-xs">
                <div class="row">
                    <div id="modelo-fesa" class="col-xs-12 col-sm-12 col-lg-12 info-piramide">
                    <nav>

                        <!-- primera escala (04)-->

                        <?php $contenido_1    =  get_field('contenido_1'); ?>
                        <?php $numero_1       =  get_field('numero_1'); ?>

                        <a id="141" href="#uno" data-ancla="uno"  onclick="get_info_piramide(this)"><span class="one" ><?php echo $contenido_1 ?></span></a>


                        <!-- segunda escala (03) -->

                        <?php $contenido_2    =  get_field('contenido_2'); ?>
                        <?php $numero_2       =  get_field('numero_2'); ?>

                        <a id="175" href="#uno" data-ancla="uno" onclick="get_info_piramide(this)"><span class="two"><?php echo $contenido_2 ?></span></a>


                        <!-- tercera escala (02) -->

                        <?php $contenido_3    =  get_field('contenido_3'); ?>
                        <?php $numero_3       =  get_field('numero_3'); ?>

                        <a id="197" href="#uno" data-ancla="uno"  onclick="get_info_piramide(this)"><span class="thre"><?php echo $contenido_3 ?></span></a>



                        <!-- cuarta escala (01) -->

                        <?php $contenido_4    =  get_field('contenido_4'); ?>
                        <?php $numero_4       =  get_field('numero_4'); ?>

                        <a id="211" href="#uno" data-ancla="uno"  onclick="get_info_piramide(this)"><span class="four"><?php echo $contenido_4 ?></span></a>

                        <!-- imagen de piramide --> 
                        <img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/assets/img/triangulonuevo.png" style="    margin: auto;">

                        </nav>

                    </div>
                </div>
            </div>


            <!-- PIRAMIDE "MODELO FESA" PARTE RESPONSIVE -->

            <div class="visible-xs">
                <div id="contenido-cuatro">
                    <div class="row">

                        <div>
                            <center><img src="<?php bloginfo('template_directory'); ?>/assets/img/MF_04.png" alt=""></center>
                        </div>

                        <div>
                            <?php $contenido4_movil    =  get_field('contenido4_movil'); ?>
                            <?php $numero_1       =  get_field('numero_1'); ?>

                            <a id="141" onclick="get_info_piramide(this)" style="text-decoration: none;"><span id="one" ><?php echo $contenido4_movil ?></span></a>
                        </div>

                    </div>
                </div><br>



                <div id="contenido-tres">
                    <div class="row">

                        <div>
                            <center><img src="<?php bloginfo('template_directory'); ?>/assets/img/MF_03.png" alt=""></center>
                        </div>

                        <div>
                            <?php $contenido3_movil    =  get_field('contenido3_movil'); ?>
                            <?php $numero_2       =  get_field('numero_2'); ?>
                            <a id="175" onclick="get_info_piramide(this)" style="text-decoration: none;"><span id="two"><?php echo $contenido3_movil ?></span></a>
                        </div>

                    </div>
                </div><br>


                <div id="contenido-dos">
                    <div class="row">

                        <div>
                            <center><img src="<?php bloginfo('template_directory'); ?>/assets/img/MF_02.png" alt=""></center>
                        </div>

                        <div>
                            <?php $contenido2_movil    =  get_field('contenido2_movil'); ?>
                            <?php $numero_3       =  get_field('numero_3'); ?>
                            <a id="197" onclick="get_info_piramide(this)" style="text-decoration: none;"><span id="thre"><?php echo $contenido2_movil ?></span></a>
                        </div>

                    </div>
                </div><br>


                <div id="contenido-uno">
                    <div class="row">

                        <div>
                            <center><img src="<?php bloginfo('template_directory'); ?>/assets/img/MF_01.png" alt=""></center>
                        </div>

                        <div>
                            <?php $contenido1_movil    =  get_field('contenido1_movil'); ?>
                            <?php $numero_4       =  get_field('numero_4'); ?>
                            <a id="211" onclick="get_info_piramide(this)" style="text-decoration: none;"><span id="four"><?php echo $contenido1_movil ?></span></a>
                        </div>

                    </div>
                </div>

            </div>










        </div> <!-- container -->                  
    </section>

<?php endif ?>


 

<a name="uno" id="uno"><div class="load-info-piramide"></a>




    <?php $post = get_post(211);  setup_postdata($post); ?>



    <!-- CUARTA SECCION "Oportunidades para becarios en selecciones nacionales, equipos profesionales o becas universitarias." (SLIDER) -->


    <section class="modelo-section-5">
    
        <?php $post = get_post(141);  setup_postdata($post); ?>
        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1">

                    <?php $titulo       =  get_field('titulo_1'); ?>

                    <h1><?php echo $titulo ?></h1>

                    <?php $id_galeria_interna         =  get_field('id_galeria_interna'); ?>

                    <?php $contenido                  =  get_field('contenido_item_4'); ?>


                    <!-- imagenes de porcentajes -->

                    <?php $porcentaje1                =  get_field('porcentaje_1'); ?>      

                    <?php $contenidoporcentaje1       =  get_field('contenido_porcentaje_1'); ?>      

                    <?php $porcentaje2                =  get_field('porcentaje_2'); ?>      

                    <?php $contenidoporcentaje2       =  get_field('contenido_porcentaje_2'); ?>  

                    <?php $porcentaje3                =  get_field('porcentaje_3'); ?>      

                    <?php $contenidoporcentaje3       =  get_field('contenido_porcentaje_3'); ?>  

                    <?php $table                      = get_field( 'tabla_becarios' ); ?>

                    <?php $titulo_tabla               = get_field( 'titulo_tabla' ); ?>

                    <?php slider_modelo_interna($id_galeria_interna);  ?>


                    <div class="contenido_parrafo">
                        <?php echo $contenido; ?>
                    </div>

                </div>
            </div>
        </div> <!-- /container -->


        <!-- QUINTA SECCION "ESTADISTICAS" -->

        <div class="porcentage">
            <div class="container">

                <div class="row">

                    <div class="col-lg-12">
                        <h1>Estadísticas</h1>
                    </div>

                    <!-- 80% -->
                    <div class=" col-xs-12 col-sm-12 col-lg-4 ">
                        <img src="<?php echo $porcentaje1  ?>">
                        <?php echo $contenidoporcentaje1; ?>
                    </div>

                    <!-- 72% -->
                    <div class=" col-xs-12 col-sm-12 col-lg-4 ">
                        <img src="<?php echo $porcentaje2  ?>">
                        <?php echo $contenidoporcentaje2; ?>
                    </div>

                    <!-- 90% -->
                    <div class="col-xs-12 col-sm-12 col-lg-4 ">
                        <img src="<?php echo $porcentaje3  ?>">
                        <?php echo $contenidoporcentaje3; ?>
                    </div>

                </div>

            </div> <!-- /container -->
        </div>

        <?php wp_reset_postdata();  ?>
    </section>


    <!-- SEXTA SECCION TABLA "Becarios en el Extranjero" -->

    <section class="modelo-section-4" >
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12 table-responsive">

                    <?php 
                    if ( $table ) {
                        echo '<table border="0" class="custom-table">';
                        if ( $table['header'] ) {
                            echo '<thead>';
                            echo '<tr>';
                            echo '<td colspan="4" class="table-title">';
                            echo $titulo_tabla;
                            echo '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            foreach ( $table['header'] as $th ) {
                                echo '<th>';
                                echo $th['c'];
                                echo '</th>';
                            }
                            echo '</tr>';
                            echo '</thead>';
                        }

                        echo '<tbody>';
                        foreach ( $table['body'] as $tr ) {
                            echo '<tr>';
                            foreach ( $tr as $td ) {
                                echo '<td>';
                                echo $td['c'];
                                echo '</td>';
                            }
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } ?>

                </div>
            </div>

        </div> <!-- /container -->
    </section>

</div>


<?php endif; ?>




<!-- CONTENIDO PAGINA "DISCIPLINAS DEPORTIVAS" -->

<?php if ($postid  == 11): ?>
    <style type="text/css">
    #menu-item-32 a {color: #ff6f20; font-weight: bold;} 
</style>


<!-- PRIMERA SECCION --> 

<!-- TITULO + SUBTITULO -->

<section class="diciplina-section-1_2">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-lg-12">

                <div class="col-xs-12 col-sm-12 col-lg-12 section-1">

                    <?php $titulo_principal       =  get_field('titulo_principal'); ?>

                    <div class="disciplinas">
                        <div class="hidden-xs">
                            <h2><?php echo $titulo_principal; ?></h2>
                        </div>

                        <div class="visible-xs">
                            <h2><strong>DISCIPLINAS<br><br> DEPORTIVAS</strong></h2>


                              <h2><span>FÚTBOL</span></h2>  
                        </div>


                    </div>

                </div>

            </div>

        </div>
    </div>
</section>


<!-- SEGUNDA SECCION PARRAFO + SLIDER "FUTBOL" -->

<section class="diciplina-section-2">
    <div class="container">

        <?php $parrafo  = get_field( 'parrafo' ); ?>
        <?php $galeria_futbol  = get_field( 'galeria_futbol' ); ?> 
        <?php $tabla_futbol                      = get_field( 'disiplina_futbol' ); ?>

        <div id="parrafo">
            <div class="contenido">
                <?php echo $parrafo; ?>
            </div>
        </div> 

        <div class="row none">
            <?php slider_type_id_btn($galeria_futbol);  ?>
            <br>
            <div class="visible-xs">


                <center><button data-toggle="collapse" data-target="#futbol" id="ver-nomina-jugadores">VER NóMINA DE JUGADORES</button></center>

            </div>

        </div>
    </div>
</section>


<!-- TERCERA SECCION TABLA FUTBOL-->

<section id="futbol" class="modelo-section-4_2 collapse">
    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12 table-responsive">

                <div class="futbol" style="float: left;">

                    <?php 
                    if ( $tabla_futbol ) {
                        echo '<table border="0" class="custom-table">';
                        if ( $tabla_futbol['header'] ) {
                            echo '<thead>';
                            echo '<tr>';
                            echo '<td colspan="4" class="table-title2">';
                            echo $titulo_tabla;
                            echo '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            foreach ( $tabla_futbol['header'] as $th ) {
                                echo '<th>';
                                echo $th['c'];
                                echo '</th>';
                            }
                            echo '</tr>';
                            echo '</thead>';
                        }

                        echo '<tbody>';
                        foreach ( $tabla_futbol['body'] as $tr ) {
                            echo '<tr>';
                            foreach ( $tr as $td ) {
                                echo '<td>';
                                echo $td['c'];
                                echo '</td>';
                            }
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } ?>

                </div>
            </div>
        </div>

    </div> <!-- /container -->
</section>




<!-- CUARTA SECCION TITULO BEISBOL -->

<section class="diciplina-section-1">
    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">

                <div class="col-xs-12 col-sm-12 col-lg-12 section-1">

                    <?php $beisbol       =  get_field('beisbol'); ?>



                    <div class="disciplinas2">
                        <h2><?php echo $beisbol; ?></h2>
                    </div>



                </div>

            </div>
        </div>

    </div> <!-- /container -->
</section>


<!-- QUINTA SECCION SLIDER "BEISBOL" -->
<section class="diciplina-section-2">
    <div class="container">
        <div class="row none">
            <?php $texto_beisbol  = get_field( 'texto_beisbol' ); ?>
            <?php $galeria_beisbol  = get_field( 'galeria_beisbol' ); ?>


            <div id="parrafo">
                <div class="contenido">
                    <?php echo $texto_beisbol; ?>
                </div>
            </div> 

            <?php slider_type_id($galeria_beisbol);  ?>
        </div>

    </div>
</section>


<!-- QUINTA SECCION TITULO + PARRAFO "APOYO A OTRAS DISCIPLINAS DEPORTIVAS" -->
<section class="diciplina-section-1">
    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">

                <div class="col-xs-12 col-sm-12 col-lg-12 section-1">

                    <?php $titulo_principal       =  get_field('titulo_principal'); ?>
                    <?php $parrafo  = get_field( 'parrafo' ); ?>  
                    <?php $titulo       =  get_field('titulo'); ?>  
                    <?php $id_galeria_interna  = get_field( 'id_galeria' ); ?>
                    <?php $galeria_futbol  = get_field( 'galeria_futbol' ); ?>
                    <?php $contenido  = get_field( 'contenido' ); ?>
                    <?php $logo_galeria  = get_field( 'logo_galeria' ); ?>

                    <h1><?php echo $titulo; ?></h1>

                    <?php echo $contenido; ?>

                </div>


                <!-- SEXTA SECCION "DISCIPLINAS DEPORTIVAS" -->

                <div class="col-xs-12 col-sm-12 col-lg-12 disciplina" style="padding-bottom: 50px;">
                    <?php galeria_logos_diciplinas($logo_galeria); ?>
                </div>


                <!-- SECCION BOTON GRANDE "VER FOTOGALERIA" -->
                <div class="hidden-xs">
                    <div class="col-xs-12 col-sm-12 col-lg-12" style="text-align: center;">
                        <button  type="button" data-toggle="collapse" data-target="#fotogaleria" class="btn ver btn-default">Ver fotogalería</button> 
                    </div>
                </div>

                <div class="visible-xs">
                    <div class="col-xs-12 col-sm-12 col-lg-12" style="text-align: center;">
                        <button id="boton-foto-galeria" type="button" data-toggle="collapse" data-target="#fotogaleria" class="btn ver btn-default">Ver fotogalería</button> 
                    </div>
                </div>





            </div>
        </div>

    </div> <!-- /container -->
</section>


<!-- SEPTIMA SECCION "SLIDER" -->

<section id="fotogaleria" class="diciplina-section-2 collapse">
    <div class="container">
        <div class="row none">

            <?php slider_diciplinas($id_galeria_interna);  ?>

        </div>
    </div>
</section>

<?php endif ?>





<!-- CONTENIDO "INSTALACIONES" -->

<?php if ($postid  == 13): ?>
    <style type="text/css">
    #menu-item-34 a {color: #ff6f20; font-weight: bold;}
</style>

<?php if ( have_posts() ) : the_post(); ?>


    <!-- PRIMERA SECCION TITULO "INSTALACIONES" --> 

    <section class="instalaciones-section-0">
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12">
                    <h1> <?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>

        </div>
    </section>



    <!-- INSTALACIONES -->

    <section class="instalaciones-section-1">
        <div class="container">

            <?php $post_data =  query_posts('category_name=Instalaciones&order=ASC' );?>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12">

                    <div class="slides">

                        <?php $c=0; while ( have_posts() ) : the_post();?>

                        <div class="sliders <?php if($c==0)echo"active"?>">
                            <ul class="info">
                                <li><img src="<?php bloginfo('template_directory'); ?>/assets/img/punto.png" alt=""></li>

                                <li>
                                    <?php  $postid = get_the_ID();?>
                                    <?php if($c==0): $first=$postid; endif?>
                                    <a class="get-instalacion" onclick="get_instalaciones(this)" id="<?php echo $postid ?>" href="#"><?php the_title(); ?></a>
                                </li>

                                <?php $direccion =  get_field('direccion'); ?>

                                <label for=""><?php echo $direccion; ?></label>
                                <?php $mapa = get_field('mapa');  ?>&ensp;| <a href="<?php echo $mapa ?>" target="_blank">Ver mapa</a>

                            </ul>

                            <div class="content">
                                <?php the_content(); ?>
                            </div>

                        </div>
                        <?php $c++; endwhile;  ?>

                    </div>
                </div>

            </div>
        </section>


        <script>
            $(document).ready(function(){
                url = $('#url').val();
                urlimg = url+"/wp-content/themes/Fesa/assets/img/loading.gif";
                var parametros = {'id':<?=$first;?> };
                jQuery.ajax({
                    data:  parametros,
                    url:   url+'/wp-instalaciones.php',
                    type:  'post',
                    beforeSend: function () {
                        jQuery(".instalaciones-section-2").html("<img id='loader' style='margin: auto;' class='img-responsive' src='"+urlimg+"' />"); 

                    },
                    success:  function (response) {
                        jQuery(".instalaciones-section-2").html(response); 

                    }
                });
            });
        </script>
        <!-- SEGUNDA SECCION "SLIDER" -->
        <section class="instalaciones-section-2">

        </section>
    <?php endif; ?>

<?php endif ?>



<!-- CONTENIDO "APOYEMOS A NUESTROS JOVENES" -->

<?php if ($postid  == 18): ?>

    <style type="text/css">
    #menu-item-29 a { color: #ff6f20; font-weight: bold; }
</style>


<!-- SLIDER'S -->

<?php if ( have_posts() ) : the_post(); ?>

    <?php $patrocinadores = get_field('patrocinadores'); ?>

    <?php $contenido_patrocinadores = get_field('contenido_patrocinadores'); ?>

    <?php $imagen_beneficio_1      = get_field('imagen_beneficio_1'); ?>

    <?php $imagen_beneficio_2      = get_field('imagen_beneficio_2'); ?>

    <?php $imagen_beneficio_3      = get_field('imagen_beneficio_3'); ?>

    <?php $imagen_beneficio_4      = get_field('imagen_beneficio_4'); ?>

    <?php $imagen_beneficio_5      = get_field('imagen_beneficio_5'); ?>

    <?php $titulo_beneficio_1      = get_field('titulo_beneficio_1'); ?>

    <?php $titulo_beneficio_2      = get_field('titulo_beneficio_2'); ?>

    <?php $titulo_beneficio_3      = get_field('titulo_beneficio_3'); ?>

    <?php $titulo_beneficio_4      = get_field('titulo_beneficio_4'); ?>

    <?php $titulo_beneficio_5      = get_field('titulo_beneficio_5'); ?>

    <?php $informacion                = get_field('informacion'); ?>

    <?php $patrocinadores_titulo      = get_field('patrocinadores_titulo'); ?>

    <?php $galeria_logos              = get_field('galeria_logos'); ?>


    <!-- PRIMERA SECCION "SLIDER" -->

    <section class="section-apoyemos-slider">

        <div class="col-xs-12 col-sm-12 col-lg-12 none">

            <?php $slider = get_field('id_galeria'); ?>

            <?php slider_type_3($slider);   ?>
        </div>

    </section>



    <!-- SEGUNDA SECCION TITULO "APOYA TALENTOS" + PARRAFO -->

    <section class="section-apoyemos-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12">

                    <?php $titulo = get_field('titulo'); ?>

                    <h1 class="titulo-anaranjado"> <?php echo $titulo; ?></h1>

                    <div class="parrafo"><?php the_content(); ?></div>

                </div>
            </div>
        </div>
    </section>


    <!-- TERCERA SECCION "ICONOS" -->

    <section class="section-apoyemos-2">
        <div class="container">
            <div class="row">

                <!-- primer icono "socios fesa" --> 
                <div class="col-xs-12 col-sm-6 col-lg-3">
                    <img src="<?php bloginfo('template_directory') ?>/assets/img/1.png" alt="">

                    <div class="contetitulodetalle">
                        <span>SOCIOS FESA</span>
                    </div>

                    <div class="verdetallecontent">
                        <a onclick="get_apoyo(this);" id="330"  class="btn btn-default ver-detalle">Ver Detalles</a>
                    </div>

                    <div class="hidden-xs">
                        <img id="triangulo1" class="" style="position: absolute; top: 28.6rem; left: 12rem" src="<?php bloginfo('template_directory') ?>/assets/img/marcador.png"">
                    </div>
                </div>

                <!-- segundo icono "vallas publicitarias" -->
                <div class="col-xs-12 col-sm-6 col-lg-3">
                    <img src="<?php bloginfo('template_directory') ?>/assets/img/2.png" alt="">

                    <div class="contetitulodetalle">
                        <span>vallas publicitarias </span>
                    </div>

                    <div class="verdetallecontent">
                        <a onclick="get_apoyo(this);" id="361"   class="btn btn-default ver-detalle">Ver Detalles</a>
                    </div>

                    <div class="hidden-xs">
                        <img id="triangulo2" class="hidden" style="position: absolute; top: 28.6rem; left: 12rem" src="<?php bloginfo('template_directory') ?>/assets/img/marcador.png">
                    </div>
                </div>


                <!-- tercer icono "academias de futbol" -->
                <div class="col-xs-12 col-sm-6 col-lg-3">
                    <img src="<?php bloginfo('template_directory') ?>/assets/img/3.png" alt="">

                    <div class="contetitulodetalle">
                        <span>academias de fútbol</span>
                    </div>

                    <div class="verdetallecontent">
                        <a onclick="get_apoyo(this);" id="390"  class="btn btn-default ver-detalle">Ver Detalles</a>
                    </div>

                    <div class="hidden-xs">
                        <img id="triangulo3" class="hidden" style="position: absolute; top: 28.6rem; left: 12rem" src="<?php bloginfo('template_directory') ?>/assets/img/marcador.png">
                    </div>
                </div>


                <!-- cuarto icono "alquiler de complejos deportivos fesa" -->
                <div class="col-xs-12 col-sm-6 col-lg-3">
                    <img src="<?php bloginfo('template_directory') ?>/assets/img/4.png" alt="">

                    <div class="contetitulodetalle">
                        <span>alquiler complejos <br> deportivos fesa </span>
                    </div>

                    <div class="verdetallecontent">
                        <a onclick="get_apoyo(this);"  id="403" class="btn btn-default ver-detalle">Ver Detalles</a>
                    </div>

                    <div class="hidden-xs">
                        <img id="triangulo4" class="hidden" style="position: absolute; top: 28.6rem; left: 12rem" src="<?php bloginfo('template_directory') ?>/assets/img/marcador.png">
                    </div>
                </div>

            </div>
        </div>
    </section>



    <!-- CUARTA SECCION "Conviértase en un Socio FESA y verá la diferencia que podemos hacer juntos." -->

    <section id="socio-fesa" class="section-apoyemos-3">
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-12">
                    <?php $post = get_post(330);  setup_postdata($post); ?>

                    <h1><?php the_title(); ?></h1>
                    <div class="contenido">

                        <?php the_content(); ?>
                    </div>

                </div>


                <!-- QUINTA SECCION "¿Cómo puedo convertirme en un Socio FESA?" -->

                <div class="hidden-xs">
                    <div class="col-xs-12 col-sm-12 col-lg-12 enlaces-donar">  
                        <ul>

                            <li>
                                <a href="<?php   echo get_site_url() ?>/metodos-para-apoyar/">
                                    <img src="http://www.fesaelsalvador.org/wp-content/uploads/2017/05/B-ES.png" alt="">
                                </a>
                            </li>

                            <li> 
                                <a href="<?php   echo get_site_url() ?>/metodos-para-apoyar/">
                                    <img src="http://www.fesaelsalvador.org/wp-content/uploads/2017/05/B-usa.png"  alt="">
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>




                <div class="visible-xs">
                    <div class="col-xs-12 col-sm-12 col-lg-12 enlaces-donar">   
                        <ul>

                            <li>
                                <a href="<?php  echo get_site_url() ?>/metodos-para-apoyar/">
                                    <img src="http://www.fesaelsalvador.org/wp-content/uploads/2017/05/B-ES.png" WIDTH=125 HEIGHT=100 BORDER=0  alt="">
                                </a>
                            </li>

                            <li>    
                                <a href="<?php  echo get_site_url() ?>/metodos-para-apoyar/">
                                    <img src="http://www.fesaelsalvador.org/wp-content/uploads/2017/05/B-usa.png" WIDTH=125 HEIGHT=100 BORDER=0  alt="">
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

            </div> <!-- /row -->

            <?php wp_reset_postdata();  ?>
        </div>
    </section>


    <!-- SEXTA SECCION "PATROCINADORES" -->


    <!-- titulo + texto -->
    <section id="patrocinadores" class="section-apoyemos-4">
        <h1 class="titulo-anaranjado"><?php echo $patrocinadores; ?></h1>

        <div class="parrafo">
            <?php echo $contenido_patrocinadores ?>
        </div>
    </section>


    <!-- SEPTIMA SECCION ICONOS "Algunos de los principales beneficios..." -->
    <section class="section-apoyemos-5">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-lg-12">
                    <h1>Algunos de los principales beneficios del patrocinio para <br> empresas son</h1>
                </div>

                <!-- primer icono "Exclusividad de segmento" -->
                <div class="col-xs-12 col-sm-4 col-lg-4">
                    <?php $imagen1 = $imagen_beneficio_1['url']; ?>
                    <img src="<?php echo $imagen1 ?>" alt="">
                    <span><?php echo $titulo_beneficio_1 ; ?></span>
                </div>


                <!-- segundo icono "Espacios publicitarios en proyectos..." -->
                <div class="col-xs-12 col-sm-4 col-lg-4">
                    <?php $imagen2 = $imagen_beneficio_2['url']; ?>
                    <img src="<?php echo $imagen2 ?>" alt="">
                    <span><?php echo $titulo_beneficio_2 ; ?></span>
                </div>

                <!-- tercer icono "Exposición de marca en conferencias..." --> 
                <div class="col-xs-12 col-sm-4 col-lg-4">
                    <?php $imagen3 = $imagen_beneficio_3['url']; ?>
                    <img src="<?php echo $imagen3 ?>" alt="">
                    <span><?php echo $titulo_beneficio_3 ; ?></span>
                </div>  

            </div> <!-- /row -->


            <!-- ************************************ -->

            <div class="row">

                <!-- cuarto icono "Exposición de marca en uniformes..." -->
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <?php $imagen4 = $imagen_beneficio_4['url']; ?>
                    <img src="<?php echo $imagen4 ?>" alt="">
                    <span><?php echo $titulo_beneficio_4 ; ?></span>
                </div>  


                <!-- quinto icono "Actividades de responsabilidad sociales..." --> 
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <?php $imagen5 = $imagen_beneficio_5['url']; ?>
                    <img src="<?php echo $imagen5 ?>" alt="">
                    <span><?php echo $titulo_beneficio_5 ; ?></span>
                </div>

            </div> <!-- /row -->

        </div>
    </section>


    <!-- OCTABA SECCION "Para obtener más información, póngase en contacto..." -->

    <!-- titulo + texto -->

    <section class="section-apoyemos-6">
        <?php echo $informacion;?>
    </section>



    <!-- NOVENA SECCION "Patrocinadores Institucionales" -->

    <section class="section-apoyemos-7">    

        <div class="contenedor-logos">
            <div class="row none">
                <div class="col-xs-12 col-sm-12 col-lg-12">
                    <h1>    <?php echo $patrocinadores_titulo ?></h1>
                    <?php       galeria_logos($galeria_logos ); ?>
                </div>
            </div>
        </div>
    </section>


<?php endif; ?> 
<?php endif; ?>



<?php if ($postid  == 412): ?>

    <?php if ( have_posts() ) : the_post(); ?>



        <section class="section-metodos-1 ">

            <div class="container">



                <div class="row">



                    <!-- titulo + texto -->

                    <div class="col-xs-12 col-sm-12 col-lg-12">

                        <?php the_content() ?>

                        <h1 class="titulo-anaranjado"><?php the_title(); ?></h1>

                    </div>





                    <!-- METODOS PARA APOYAR -->

                    <div class="row text-center none"><br>



                        <!-- Paypal -->

                        <!-- Stripe -->
                        <div class="col-xs-12  col-md-12 col-sm-6 col-lg-6">

                            <div class="panel panel-default">



                                <div class="panel-heading">

                                    <img src="<?php bloginfo('template_directory')?>/assets/img/pc.png" alt="" class="img-circle img-thumbnail">

                                    <br>

                                    <label for="">Stripe Checkout</label>

                                </div>

                                <script src="https://checkout.stripe.com/checkout.js"></script>

                                <div class="panel-body contenido-1"> 

                                    <?php $internet = get_field('internet'); echo $internet; ?>
                                    <span style="font-family: 'Montserrat';font-weight: bold;color: #ff6f20;font-size: 14px;">Donación recurrente:</span>
                                    <style>
                                    #subscripcion input{
                                        text-align: center;
                                    }
                                </style>
                                <select name="" id="subscripcion" class="form-control" required="required">
                                    <option value="">-- Seleccione una Cantidad --</option>
                                    <option value="15">$15</option>
                                    <option value="25">$25</option>
                                    <option value="50">$50</option>
                                    <option value="100">$100</option>
                                    <option value="250">250</option>
                                </select>
                                <br>
                                <button type="button" id="subscripcion_btn" class="btn btn-danger center-block">Donar</button>


                                <div id="stripemodal" class="modal fade" tabindex="-1" role="dialog">
                                    <div id="one" class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div id="three" class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Gracias por tu donación y <br> apoyo a nuestros jóvenes.</h4>
                                            </div>
                                            <div id="two" class="modal-body" id="stripetext">
                                                <?php es_subbox($namefield = "YES", $desc = "", $group = "Public"); ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <script>
                                    var base_url = "http://www.fesaelsalvador.org/"
                                    var handler = StripeCheckout.configure({
                                        key: 'pk_live_tuAQU0G96GwOU5fTZKsuIJ0t',
                                        image: base_url+'wp-content/themes/Fesa/assets/img/fesa_stripe.png',
                                        locale: 'auto',
                                        token: function(token) {
                                            console.log(token);
                                            var token_response = token.id;
                                            var email_user = token.email;
                                            var cantidad = $('#subscripcion option:selected').val();

                                            console.log(cantidad);
                                            $.ajax({
                                                url: base_url+'wp-content/themes/Fesa/stripe/stripe_sub.php',
                                                type: 'POST',
                                                dataType: 'HTML',
                                                data: 'stripeToken='+token_response+'&email='+email_user+'&cantidad='+cantidad,
                                                success:function(response){
                                                    $("#stripemodal").modal();
                                                    if(response == 0){
                                                        $("#stripetext").html("error en la compra");
                                                    }
                                                }
                                            });
                                        }
                                    });

                                    document.getElementById('subscripcion_btn').addEventListener('click', function(e) {

                                        var cantidad = $('#subscripcion').val();

                                        cantidad = (cantidad*100);

                                        handler.open({
                                            name: 'SUBSCRIPCION FESA',
                                            description: 'Subscripción de: $'+(cantidad/100),
                                            amount: cantidad,
                                            panelLabel: 'Donar'

                                        });
                                        e.preventDefault();
                                    });


                                    window.addEventListener('popstate', function() {
                                        handler.close();
                                    });
                                </script>

                                <span style="font-family: 'Montserrat';font-weight: bold;color: #ff6f20;font-size: 14px;">Donación Única:</span>

                            <?php $unico = get_field('unico'); echo $unico; ?>


                                <div class="contenido-donar" style="margin-top: 20px;">

                                    <!--<a href="" class="btn btn-default btn-donar">Donar</a>-->
                                    <div class="col-xs-10 col-xs-offset-1" style="padding: 0;">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="number" class="form-control" id="cantidad" placeholder="Cantidad a Donar">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <button class="btn btn-danger" id="donacion">Donar</button>


                                    <script>
                                        var base_url = "http://www.fesaelsalvador.org/"
                                        var handler2 = StripeCheckout.configure({
                                            key: 'pk_live_tuAQU0G96GwOU5fTZKsuIJ0t',
                                            image: base_url+'wp-content/themes/Fesa/assets/img/fesa_stripe.png',
                                            locale: 'auto',
                                            token: function(token) {
                                                console.log(token);
                                                var token_response = token.id;

                                                var cantidad = $('#cantidad').val();

                                                cantidad = (cantidad*100); 

                                                var email_user = token.email;
                                                $.ajax({
                                                    url: base_url+'wp-content/themes/Fesa/stripe/stripe.php',
                                                    type: 'POST',
                                                    dataType: 'HTML',
                                                    data: 'stripeToken='+token_response+'&email='+email_user+'&cantidad='+cantidad,
                                                    success:function(response){
                                                        alert(response);
                                                    }
                                                });
                                            }
                                        });

                                        document.getElementById('donacion').addEventListener('click', function(e) {

                                            var cantidad = $('#cantidad').val();

                                            cantidad = (cantidad*100);

                                            handler2.open({
                                                name: 'DONACIÓN FESA',
                                                description: 'Cantidad a donar: $'+(cantidad/100),
                                                amount: cantidad,
                                                panelLabel: 'Donar'
                                            });
                                            e.preventDefault();
                                        });


                                        window.addEventListener('popstate', function() {
                                            handler2.close();
                                        });
                                    </script>
                                </form>
                            </div>
                            <br>

                            <img src="<?php bloginfo('template_directory')?>/assets/img/tarjetas.png" alt="" class=" img-thumbnail">

                        </div>
                    </div></div>

                    <div class="col-xs-12  col-md-12 col-sm-6 col-lg-6">

                        <div class="panel panel-default">



                            <div class="panel-heading">

                                <img src="<?php bloginfo('template_directory')?>/assets/img/pc.png" alt="" class="img-circle img-thumbnail">

                                <br>

                                <label for="">Paypal</label>

                            </div>



                            <div class="panel-body contenido-1"> 

                                <?php $internet = get_field('internet'); echo $internet; ?>

                                 <span style="font-family: 'Montserrat';font-weight: bold;color: #ff6f20;font-size: 14px;">Donación recurrente:</span>
                                <form class="ayudanow" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <p><input name="cmd" type="hidden" value="_s-xclick" /> <input name="hosted_button_id" type="hidden" value="L8ZWGZ9VY8WSY" /></p>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><input name="on0" type="hidden" value="Donativos" />Donativos</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="os0">
                                                        <option value="Opcion 1">Opcion 1 : $15.00 USD - monthly</option>
                                                        <option value="Opcion 2">Opcion 2 : $25.00 USD - monthly</option>
                                                        <option value="Opcion 3">Opcion 3 : $50.00 USD - monthly</option>
                                                        <option value="Opcion 4">Opcion 4 : $100.00 USD - monthly</option>
                                                        <option value="Opcion 5">Opcion 5 : $250.00 USD - monthly</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p><input name="currency_code" type="hidden" value="USD" /> <input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" type="image" /> <img src="https://www.paypalobjects.com/cs_CZ/i/scr/pixel.gif" alt="" width="1" height="1" border="0" /></p>
                                </form>


                                <span style="font-family: 'Montserrat';font-weight: bold;color: #ff6f20;font-size: 14px;">Donación Única:</span>

                                <?php $unico = get_field('unico'); echo $unico; ?>
                                <div class="contenido-donar" style="margin-top: 20px;">



                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">

                                        <input type="hidden" name="cmd" value="_s-xclick">

                                        <input type="hidden" name="hosted_button_id" value="F8AC48FBJH43N">

                                        <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

                                        <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">

                                    </form>

                                    <br>

                                    <img src="<?php bloginfo('template_directory')?>/assets/img/tarjetas.png" alt="" class=" img-thumbnail">

                                </div>



                            </div>



                        </div>

                    </div>


                </div>


                





                <!-- Institución Bancaria -->

                <div class="col-xs-12 col-md-12 col-sm-6 col-lg-6 ">

                    <div class="panel panel-default">



                        <div class="panel-heading">

                            <img src="<?php bloginfo('template_directory')?>/assets/img/casa.png" class="img-circle img-thumbnail"><br>

                            <label for="">Institución Bancaria</label>

                        </div>



                        <div class="panel-body contenido-1"> 

                            <?php $institucion_bancaria = get_field('institucion_bancaria'); echo $institucion_bancaria; ?>

                        </div>



                    </div>

                </div>





                <!-- Teléfono -->

                <div class="col-xs-12  col-md-12 col-sm-6 col-lg-6 ">

                    <div class="panel panel-default">



                        <div class="panel-heading">

                            <img src="<?php bloginfo('template_directory')?>/assets/img/telefonoycorreo.png" class="img-circle img-thumbnail"><br>

                            <label for="">Teléfono o Correo Electrónico</label>

                        </div>



                        <div class="panel-body contenido-2"> 

                            <?php $telefono = get_field('telefono'); echo $telefono; ?>
                            <br>
                            <p>2. O escribir a: </p><?php $correo = get_field('correo'); echo $correo; ?>

                        </div>



                    </div>

                </div>



                <!-- correo -->

                <!--<div class="col-xs-12  col-md-12 col-sm-6 col-lg-6">

                    <div class="panel panel-default">



                        <div class="panel-heading">

                            <img src="<?php bloginfo('template_directory')?>/assets/img/maile.png" class="img-circle img-thumbnail"><br>

                        </div>



                        <div class="panel-body contenido-2"> 

                            <?php $correo = get_field('correo'); echo $correo; ?>

                        </div>



                    </div>                                  

                </div>

            -->

            <div class="col-xs-12  col-md-12 col-sm-6 col-lg-1"></div>





            <!-- TERCERA SECCION "INFORMACION" -->

            <div class="col-xs-12  col-md-12 col-sm-12 col-lg-10 contenido">

                <!-- <?php $informacion = get_field('informacion'); echo $informacion; ?>        -->                

            </div>

            <div class="col-xs-12  col-md-12 col-sm-6 col-lg-1"></div>



        </div> <!-- /row text-center none -->

    </div> <!-- /row -->



    <!-- boton "regresar" -->

    <div class="row none">

        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 volver">

            <a href="http://fesaelsalvador.org/apoyemos-a-nuestros-jovenes/#330" class="btn btn-default btn-volver"> &#60;  &#160;&#160;&#160;      Regresar</a>

        </div>

    </div>



</div>

</section>



<?php endif; ?> 

<?php endif; ?>




<!-- CONTENIDO DE "LOGROS" -->

<?php if ($postid  == 429): ?>

    <style type="text/css">
    #menu-item-432 a { color: #ff6f20; font-weight: bold;}
</style>

<?php if ( have_posts() ) : the_post(); ?>



    <!-- PRIMERA SECCION "SLIDER" -->

    <section class="slider-page-modelo">

        <div class="col-xs-12 col-sm-12 col-lg-12 none">
            <?php $galeria =  get_field('id_galeria_slider'); slider_type_3($galeria); ?>
        </div>
    </section>


    <!-- SEGUNDA SECCION LOGROS TITULO + PARRAFO -->

    <section class="section-logros-1 parrafo">
        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1" style="text-align: justify;">
                    <h1 class="titulo-anaranjado"><?php the_title(); ?></h1>
                    <?php the_content() ?>

                    <?php $id_galeria_interna = get_field('id_photo_galeria'); ?><br>

                    
                </div>

            </div>

        </div>



        <div class="contenedortestimoniales" style="padding-top: 10px;">

            <?php $testimonios = get_testimonios(); 
                
            ?>
        <h1 style="    margin-top: 31px;
    margin-bottom: -22px;" class="titulo-anaranjado">TESTIMONIOS</h1>
            
            
        
            
  <div class="row">
    
  </div>
  <div class='row'>
    <div class="col-md-10 col-md-offset-1">
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <ol class="carousel-indicators">
        <?php foreach ($testimonios as $i => $item) { ?>
          <li data-target="#quote-carousel" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0)?"active":"" ?>"></li>
       <?php  }  ?>
        </ol>
        
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">



        <?php asort($testimonios);
       foreach($testimonios as $i => $item): ?>
          <!-- Quote 1 -->
          <div class="item <?php echo ($i == 0)?"active":"" ?>">
            <blockquote>
              <div class="row">
                <div class="col-sm-4 text-center" style="padding-top: 45px;">
                  <img class="img-circle" src="<?=$item->imagen["url"]?>"  >
                  <!--<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">-->
                </div>
                <div id="paragraftesti" class="col-sm-8" style="padding-top: 35px;">
                    <h3 class="tituloanaranjado"><?=$item->nombre?></h3>
                    <h6 class="prfesiontitulo"><?=$item->profesion?></h6>
                  <p class="paragraftesti"><?=$item->detalle?></p>
                  
                </div>
              </div>
            </blockquote>
          </div>


<?php endforeach;?> 
          
        

         

        </div>
        
        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><img class="indicadorizquierda" src="http://www.fesaelsalvador.org/wp-content/uploads/2018/05/left.png"></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>                          
    </div>
  </div>


<script type="text/javascript">
    // When the DOM is ready, run this function
$(document).ready(function() {
  //Set the carousel options
  $('#quote-carousel').carousel({
    pause: true,
    interval: 4000,
  });
});
</script>
            
        </div>



<h1 class="titulo-anaranjado">FOTO GALERÍA</h1><br>
    </section>



    <!-- TERCERA SECCION "FOTOGALERIA" -->

    <section class="modelo-section-5 change-azul">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-10 col-lg-offset-1">
                    <?php slider_modelo_interna($id_galeria_interna);  ?>
                </div>

            </div>
        </div>
    </section>

<?php endif; ?> 
<?php endif; ?>



<!-- CONTENIDO DE "SALA DE PRENSA" -->
<?php if ($postid  == 16): ?>
    <style type="text/css">
    #menu-item-37 a {color: #ff6f20; font-weight: bold;}
</style>


<!-- PRIMERA SECCION "SLIDER + BUSCADOR" -->

<section class="slider-page-sala">
    <div class="col-xs-12 col-sm-12 col-lg-12 none">
        <?php $galeria =  get_field('id_galeria_slider'); slider_type_id_search($galeria); ?>
    </div>
</section>


<!-- SEGUNDA SECCION "MAS RECIENTES" -->

<?php   $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?>
<section class="category-noticias" id="mas_recientes">
    <div class="container">


        <div class="visible-xs">
            <h3 class='titulo-anaranjado' style="padding-top: 0px; margin-bottom: 0px;">NOTICIAS</h3>
        </div>





        <div class="row">

            <div class="col-xs-12 col-sm-12 col-lg-8 Noticias none">
                <h1 class="titulo-n"><b> MÁS RECIENTES </b></h1>


                <!-- img grande noticia -->
                <div class="col-lg-12 Noticias-fet">
                    <?php  query_posts( array( 'post_type' => array( 'noticias') ) );   ?>
                    <?php $i=0; ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <?php if ($i == 0): ?>
                            <?php  $has_image=get_the_post_thumbnail( $page->ID, 'full' );?>
                            <?php if($has_image!=""): ?>
                                <?php echo get_the_post_thumbnail( $page->ID, 'full' );  ?>
                            <?php else:
                                $img=get_that_image(get_the_content());
                                echo '<img src="'.$img.'" />';
                            endif ?> 
                        <?php endif ?>
                        <?php $i++; ?>                      
                    <?php endwhile;?>
                </div>



                <div class="col-lg-12">


                    <!-- informacion noticia --> 
                    <div class="col-lg-6 detalle-noticia">
                        <?php  query_posts( array( 'post_type' => array( 'noticias') ) );   ?>
                        <?php $i=0; ?>
                        <?php while (have_posts()) : the_post(); ?>

                            <?php if ($i == 0): ?>
                                <h1><?php the_title();  ?></h1>
                                <?php echo substr(get_the_excerpt(),0,110)." ..."; ?>
                                <?php echo '<a class="leer_mas" href="'.get_the_permalink().'">Leer más</a>'; ?>
                            <?php endif ?>
                            <?php $i++; ?>                      
                        <?php endwhile;?>
                    </div>


                    <!-- mas noticias -->   
                    <div class="col-lg-6 img-peque">
                        <?php  query_posts( array( 'post_type' => array( 'noticias')  ,'posts_per_page' => 7 ));    ?>
                        <?php $i=0; ?>
                        <?php while (have_posts()) : the_post(); ?>

                            <?php if ($i >= 1): ?>
                                <?php  $has_image=get_the_post_thumbnail( $page->ID, 'thumbnail' );?>
                                <?php if($has_image!=""): ?>
                                    <?php echo get_the_post_thumbnail( $page->ID, 'thumbnail' );  ?>
                                <?php else:
                                    $img=get_that_image(get_the_content());
                                    echo '<img onclick="refresh('.$i.')" src="'.$img.'" />';
                                endif ?> 


                            <?php endif ?>
                            <?php $i++; ?>                      
                        <?php endwhile;?>
                    </div>



                </div>

                <?php wp_reset_postdata();  ?>
            </div>


            <!-- TERCERA SECCION COMUNICADOS -->

            <div class="col-xs-12 col-sm-12 col-lg-4 Comunicados none">

                <h1 class="titulo-c"> COMUNICADOS </h1> 
                <?php  query_posts( array( 'post_type' => array('Comunicados'),'posts_per_page' => 3  ) );  ?>
                <?php while (have_posts()) : the_post(); ?>

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
                            <strong> <span> <?php $author = get_the_author(); echo $author ?> </span> | <?php the_date('F j, Y');  ?></strong>
                        </div>

                        <div class="panel-body">
                            <p><?php the_excerpt(); ?></p>
                        </div>
                    </div>

                <?php endwhile;?>

            </div>
        </div>
    </div>
</section>


<!-- CUARTA SECCION "NOTICIAS" -->

<section class="">
    <div class="container section-filtro-fecha">

        <div class="row">
            <div class="col-lg-1">
            </div>

            <div class="col-lg-3">
                <div class="dropdown">

                    <button class="btn btn-noticias btn-primary dropdown-toggle" type="button" data-toggle="dropdown">NOTICIAS
                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu">
                        <?php $data =  wp_get_archives( array( 'type' => 'yearly', 'format' => 'customlist', 'show_post_count' => false) ); ?>
                    </ul>

                </div>
            </div>

            <div class="col-lg-8">
            </div>

        </div> 
    </div>          
</section>
<section class="section-noticias-all">
    <div class="container">
        <div class="row">
            <?php if (empty($_GET['q'])): ?>
                <?php  query_posts( array( 'post_type' => array( 'noticias','comunicados'), 'paged' =>  $paged,'posts_per_page' => 8 ) );   ?>

                <?php if ( have_posts() ) : ?>

                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <span class="in-right"></span>

                        <nav aria-label="...">
                            <ul class="pager">
                                <li class="previous"><?php previous_posts_link(' &larr; Anterior'); ?></li>
                                <li class="next">  <?php next_posts_link('Siguiente &rarr; '); ?> </li>
                            </ul>
                        </nav>

                    </div> 
                    <?php while (have_posts()) : the_post(); ?>

                        <div class="col-xs-12 col-sm-6 col-md-3 ">  
                            <a href="<?php the_permalink(); ?>" style="text-decoration: none;" >                
                                <div class="thumbnail">
                                    <?php 
                                    $has_image=get_the_post_thumbnail( $page->ID, 'thumbnail' );
                                    if($has_image!=""){
                                        echo $has_image;
                                    }else{
                                        $img=get_that_image(get_the_content());
                                        echo '<img src="'.$img.'" />';
                                    }
                                    ?>


                                    <div class="caption info-detalle">
                                        <h3 class="titulo">  <?php the_title();  ?></h3>
                                        <strong> <span> <?php $author = get_the_author(); echo $author ?> </span> | <?php the_time('F j, Y',$page->ID);  ?></strong>
                                    </div>

                                </div>
                            </a>        
                        </div>  

                    <?php endwhile;?>
                    <div class="col-xs-12 col-sm-12  col-lg-12">
                        <br>
                    </div>

    <!-- <div class="col-lg-12 page"> 
               <div class="pagination-bottom"><?php custom_pagination(); ?></div>
           </div>-->
        <?php endif; ?>
    </div>
<?php else: // Si es busqueda?>

    <?php 
    $args= array( 'post_type' => array("noticias","comunicados"), 'paged' =>  $paged,'posts_per_page' => 8,'s'=> addslashes($_GET['q']));
    $query=new WP_Query($args);
   /* echo "<pre style='display:block'>";
    print_r($query);
    echo "</pre>";*/
     //query_posts( ); 

    ?>
    
    <?php if (  $query->have_posts() ) : ?>

        <div class="col-xs-12 col-sm-12 col-lg-12">
            <span class="in-right"></span>

            <nav aria-label="...">
                <ul class="pager">
                    <li class="previous"><?php previous_posts_link(' &larr; Anterior'); ?></li>
                    <li class="next">  <?php next_posts_link('Siguiente &rarr; '); ?> </li>
                </ul>
            </nav>

        </div> 
        <?php while ( $query->have_posts()) :  $query->the_post(); ?>

            <div class="col-xs-12 col-sm-6 col-md-3 ">  
                <a href="<?php the_permalink(); ?>" style="text-decoration: none;" >         
                    <div class="thumbnail">
                        <?php 
                        $has_image=get_the_post_thumbnail( $post->ID, 'thumbnail' );
                        if($has_image!=""){
                            echo $has_image;
                        }else{
                            $img=get_that_image(get_the_content());
                            echo '<img src="'.$img.'" />';
                        }
                        ?>


                        <div class="caption info-detalle">
                            <h3 class="titulo">  <?php the_title();  ?></h3>
                            <strong> <span> <?php $author = get_the_author(); echo $author ?> </span> | <?php the_time('F j, Y',$post->ID);  ?></strong>
                        </div>

                    </div>
                </a>   
            </div>  

        <?php endwhile;?>
        <div class="col-xs-12 col-sm-12  col-lg-12">
            <br>
        </div>

    <!-- <div class="col-lg-12 page"> 
           <div class="pagination-bottom"><?php custom_pagination(); ?></div>
       </div>-->
   <?php endif; ?>
<?php endif ?>

</div>
</section>
<?php endif; ?>



<!-- CONTENIDO DE "COLEGIO" -->
<?php if ($postid == 20): ?>

 <style type="text/css">
  #menu-item-30 a {color: #ff6f20; font-weight: bold;}
</style>


<!-- PRIMERA SECCION "SLIDER" -->

<section class="slider-page-modelo">
  <div class="col-xs-12 col-sm-12 col-lg-12 none">
    <?php $galeria =  get_field('id_galeria_slider'); slider_type_3($galeria); ?>
  </div>
</section>

<section class="colegio-section-1">

</section>



<!-- SEGUNDA SECCION SLIDER + PARRAFO -->

<section class="modelo-section-5_3">
  <?php $post = get_post(20);  setup_postdata($post); ?>

  <div class="container">
   <div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1">

     <?php $titulo          =  get_field('titulo_1'); ?>
     <?php $contenido       =  get_field('contenido_5'); ?>
     <?php $id_galeria_interna       =  get_field('id_galeria_interna'); ?>
     <?php $url_imagen_1       =  get_field('url_imagen_1'); ?>
     <?php $titulo_bloque       =  get_field('titulo_bloque'); ?>
     <?php $contenido_bloque       =  get_field('contenido_bloque'); ?>
     <?php $url_imagen_2       =  get_field('url_imagen_2'); ?>
     <?php $titulo_bloque2       =  get_field('titulo_bloque_2'); ?>
     <?php $contenido_bloque_2       =  get_field('contenido_bloque_2'); ?>


     <div class="hidden-xs">
      <h1><?php echo $titulo ?></h1>
     </div>

     <div class="visible-xs">
     <h1 style="text-align: center;"><?php echo $titulo ?></h1>
     </div>




     <?php slider_modelo_interna($id_galeria_interna);  ?>

     <div class="contenido_parrafo">
      <?php echo $contenido; ?>
    </div>

  </div>
</div>
</div>
</section>


<!-- " EJE ACADEMICO" -->
<section class="modelo-section-6 eje-academico">
  <div class="container">

   <div class="row ">
    <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1 ">

     <img src="<?php echo $url_imagen_1['url'] ; ?>" alt="">

     <h1><?php echo $titulo_bloque  ?></h1>

     <div class="contenido-section">
      <?php echo $contenido_bloque  ?>
    </div>

  </div>
</div>
</div>
</section>


<!-- "Eje Humano y Salud" -->
<section class="modelo-section-6 eje-humano">
  <div class="container">

   <div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1 ">

     <img src="<?php echo $url_imagen_2['url'] ; ?>" alt="">

     <h1><?php echo $titulo_bloque2  ?></h1>

     <div class="contenido-section">
      <?php echo $contenido_bloque_2  ?>
    </div>

  </div>
</div>

</div>
</section>
<?php endif ?>

<?php get_footer(); ?>