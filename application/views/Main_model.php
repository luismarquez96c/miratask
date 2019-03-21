<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
	function registrar_usuarios($usuario){
		$usuario["fecha_creacion"]=date("Y-m-d H:i:s");
		$this->db->insert("ig_usuarios",$usuario);
		return $this->db->insert_id();
	}

	function registrar_empresa($empresa){
		$this->db->insert("empresa",$empresa);
		return $this->db->insert_id();
	}

	function validar_usuario($email,$pass){
		$sql="select * from ig_usuarios WHERE email=? AND password=? AND status=1";
		$r=$this->db->query($sql,array($email,$pass))->row();
		if(count($r)==0){ // Si no encuentra registros
			return false; // Retornar false
		}else{
			return $r; // Si existe registro, retornar el resultado
		}

	}
	function validar_usuario_solo_correo($email){
		$sql="select * from ig_usuarios WHERE email=?  AND status=1";
		$r=$this->db->query($sql,array($email))->row();
		if(count($r)==0){ // Si no encuentra registros
			return false; // Retornar false
		}else{
			return $r; // Si existe registro, retornar el resultado
		}
	}
	function validar_correo_disponible($email,$id_user){
		$sql="select * from ig_usuarios where email=? AND id_usuario!=?";
		$r=$this->db->query($sql,array($email,$id_user))->row();
		//echo $this->db->last_query();
		if(count($r)==0){ //No esta registrado =  Disponible
			return true;
		}else{
			return false;
		}

	}
	function  usuario_get($id=0){
		$sql="select * from ig_usuarios  a where a.id_usuario=".$id;
		$r=$this->db->query($sql)->row();
		if(isset($r->id_usuario)){
			$r->ubicacion=$this->db->query("select * from ig_usuarios_ubicacion where id_usuario=?",array($r->id_usuario))->row();
		}
		return $r;
	}
	
	
	function nombre_empresa($id_usuario){
		$r=$this->db->query("SELECT NAME, id FROM empresa WHERE id_usuario=".$id_usuario)->result();
		return $r;
	}
	function perfil_persona($id_usuario){
		$query = $this->db->query('SELECT * FROM perfil WHERE id_perfil='.$id_usuario)->result();
		return $query;

	}

	function actulizarperfil($filename,$banner,$nombre,$correo,$fecha,$lugar,$ubicacion,$pais,$ciudad,$id){
		if($filename){
			$this->db->set('foto',$filename );
		}
		$this->db->set('banner',$banner );
		$this->db->set('nombre_perfil',$nombre );
		$this->db->set('correo_perfil',$correo );
		$this->db->set('fecha_nacimiento',$fecha);
		$this->db->set('lugar_trabajo',$lugar );
		$this->db->set('ubicacion',$ubicacion );
		$this->db->set('pais',$pais );
		$this->db->set('ciudad',$ciudad );
		$this->db->where('id_perfil',$id);
		$this->db->update('perfil');
	}
	function usuario_update($usuario){
		$this->db->update("ig_usuarios",$usuario,array("id_usuario"=>$usuario["id_usuario"]));
		return $usuario["id_usuario"];
	}
	function usuario_ubicacion_save($ubi){
		$existe=$this->db->query("select * from ig_usuarios_ubicacion WHERE id_usuario=?",array($ubi["id_usuario"]))->row();
		if(isset($existe->id_usuario)){
			$this->db->update("ig_usuarios_ubicacion",$ubi,array("id_usuario"=>$ubi["id_usuario"]));
		}else{
			$this->db->insert("ig_usuarios_ubicacion",$ubi);
		}
	}
	function registrar_producto($producto){
		$this->db->insert("producto",$producto);
		return $this->db->insert_id();
	}
	function registrar_oferta($oferta){
		$this->db->insert("oferta",$oferta);
		return $this->db->insert_id();
	}
	function registrar_evento($evento){
		$this->db->insert("evento",$evento);
		return $this->db->insert_id();
	}

	function actulizardetalle($id,$descripcion,$telefono,$telefono1,$domicilio,$link1,$link2,$link3,$link4,$direccion,$pais,$ciudad){

		$this->db->set('descripcion',$descripcion );
		$this->db->set('telefono',$telefono );
		$this->db->set('telefono1',$telefono1 );
		$this->db->set('domicilio',$domicilio );
		$this->db->set('link1',$link1 );
		$this->db->set('link2',$link2 );
		$this->db->set('link3',$link3 );
		$this->db->set('link4',$link4 );
		$this->db->set('direccion',$direccion );
		$this->db->set('pais',$pais );
		$this->db->set('ciudad ',$ciudad );
		$this->db->where('id',$id);
		$this->db->update('empresa');
	}

	function registrar_imagenes($imagen){
		$this->db->insert("imagenes",$imagen);
		return $this->db->insert_id();
	}
	function registrar_horas($datahora){
		$this->db->insert("horarios",$datahora);
		return $this->db->insert_id();
	}
	function eliminar_horas($id_empresa){
		$this->db->delete("horarios",array("id_empresa"=>$id_empresa));

	}
	function productos_radom(){
		$query = $this->db->query('SELECT nombre_producto, imagen_1,precio_producto FROM producto ORDER BY RAND() LIMIT 6')->result();
		return $query;

	}
	function empresas_radom(){
		$query = $this->db->query('SELECT A.id, A.name, A.category, B.imagenes, B.posicion FROM empresa A INNER JOIN imagenes B ON A.id=B.id_empresa WHERE B.posicion = 12 ORDER BY RAND() LIMIT 6')->result();
		return $query;

	}
	function empresas_radom2(){
		$query = $this->db->query('SELECT A.id, A.name, A.category, B.imagenes, B.posicion FROM empresa A INNER JOIN imagenes B ON A.id=B.id_empresa WHERE B.posicion = 12 ORDER BY RAND() LIMIT 3')->result();
		return $query;

	}
	function modificar_email($id,$email){
		$this->db->set('email',$email );
		$this->db->where('id',$id);
		$this->db->update('empresa');
	}
	function todos_prouctos(){
		$query = $this->db->query('SELECT * FROM producto A INNER JOIN empresa B ON A.id_empresa=B.id')->result();
		return $query;
	}
	function todas_ofertas(){
		$query = $this->db->query('SELECT * FROM oferta A INNER JOIN empresa B ON A.id_empresa=B.id')->result();
		return $query;
	}
	function todos_eventos(){
		$query = $this->db->query('SELECT * FROM evento A INNER JOIN empresa B ON A.id_empresa=B.id')->result();
		return $query;
	}

	function todas_empresas(){
		$query = $this->db->query('SELECT id,NAME,ciudad,imagenes,posicion,direccion  FROM empresa A INNER JOIN imagenes B ON A.id=B.id_empresa WHERE posicion=13 GROUP BY A.id')->result();
		return $query;

	}
	function registrar_punto($punto){
		$this->db->insert("puntos",$punto);
		return $this->db->insert_id();
	}
	function todos_puntos(){
		$query = $this->db->query('SELECT * FROM puntos ')->result();
		return $query;
	}
	function empresa_imagenes_get($id_empresa){
		$sql="SELECT imagenes,posicion FROM imagenes WHERE id_empresa=".$id_empresa;
		$r=$this->db->query($sql)->result_array();
		return array_column($r,"imagenes","posicion");
	}
	function empresa_front_get($id){
		$sql="select * from empresa a where a.status=1 AND a.id=".$id;
		$r=$this->db->query($sql)->row();
		return $r;
	}
	function empresa_ofertas_get($id){
		$sql="SELECT * FROM oferta WHERE id_empresa=".$id;
		$r=$this->db->query($sql)->result();
		return $r;
	}
	function empresas_otras($id_actual){
		$sql="SELECT *,(SELECT imagenes FROM imagenes WHERE id_empresa=a.id AND posicion=13 LIMIT 1) imagen FROM empresa a WHERE a.id!=".$id_actual." ORDER BY RAND()
		LIMIT 3";
		$r=$this->db->query($sql)->result();
		return $r;
	}

	function categorias_get($order=false){
		$sql="select * from ig_categorias";
		if($order){
			$sql.=" order by nombre_categoria ASC";
		}
		$r=$this->db->query($sql)->result();
		return $r;
	}
	function empresa_save($item){
		$id=0;
		if(isset($item["id_empresa"]) && $item["id_empresa"]>0){
			$this->db->update("ig_empresas",$item,array("id_empresa"=>$item["id_empresa"]));
			$id= $item["id_empresa"];
		}else{
			$this->db->insert("ig_empresas",$item);
			$id= $this->db->insert_id();
		}
		$this->slug_save($id,"EMPRESA",$item["nombre"]);
		return $id;
	}
	function empresas_usuario_get($id_usuario){
		$sql="select * from ig_empresas where id_usuario=".$id_usuario;
		$r=$this->db->query($sql)->result();
		return $r;
	}
	function empresa_get($id,$fulldata=false){
		$sql="select * from ig_empresas where id_empresa=?";
		$r=$this->db->query($sql,array($id))->row();
		if($fulldata && count($r)>0){
			$r->sucursales=$this->db->query("select * from ig_sucursales where id_empresa=".$id." AND tipo_sucursal='SUCURSAL' AND status>-1")->result();
			$r->puntos_venta=$this->db->query("SELECT a.*,
												IF(a.tipo_item='SUCURSAL',
												(SELECT CONCAT(c.nombre,' - ', b.nombre_sucursal) FROM ig_sucursales b INNER JOIN ig_empresas c ON b.id_empresa=c.id_empresa WHERE b.id_sucursal=a.id_item),
												(SELECT b.nombre_negocio FROM ig_ubicaciones b WHERE b.id_ubicacion=a.id_item)) nombre_item
												FROM ig_empresas_puntoventa a WHERE a.id_empresa=".$id."")->result();
			$r->administradores=$this->db->query("SELECT a.id_usuario,b.nombre_completo FROM ig_administradores_empresas a INNER JOIN ig_usuarios b ON a.id_usuario=b.id_usuario WHERE a.id_empresa=".$id)->result();
			$r->tags=$this->db->query("select b.tag from ig_tags_items a inner join ig_tags b on a.id_tag=b.id_tag and a.tipo_item='EMPRESA' and a.id_item=".$id)->result();
		}
		return $r;
	}
	function sucursal_empresa_save($sucursal){
		if($sucursal["id_sucursal"]==0){
			$this->db->insert("ig_sucursales",$sucursal);
			return $this->db->insert_id();
		}else{
			$this->db->update("ig_sucursales",$sucursal,array("id_sucursal"=>$sucursal["id_sucursal"]));
			return $sucursal["id_sucursal"];
		}
	}

	function producto_save($producto){
		$id=0;
		if(isset($producto["id_producto"]) && $producto["id_producto"]>0){
			$this->db->update("ig_productos",$producto,array("id_producto"=>$producto["id_producto"]));
			$id= $producto["id_producto"];
		}else{
			$this->db->insert("ig_productos",$producto);
			$id=$this->db->insert_id();
		}

		$this->slug_save($id,"PRODUCTO",$producto["nombre_producto"]);
		return $id;
	}
	function lugares_venta_save($lugares){
		
		if(count($lugares)>0){
			$tipo=$lugares[0]["tipo_item"];
			$id=$lugares[0]["id_item"];
			$this->db->delete("ig_actividad_lugares_venta",array("id_item"=>$id,"tipo_item"=>$tipo));
			$this->db->insert_batch("ig_actividad_lugares_venta",$lugares);
		}
		
	}
	function lugares_venta_get($id,$tipo){
		$sql="
		SELECT a.*, IF(a.lugar_tipo='SUCURSAL',CONCAT(e.nombre,' - ',b.nombre_sucursal) ,c.nombre_negocio) nombre_lugar   FROM ig_actividad_lugares_venta a 
		LEFT JOIN ig_sucursales b ON a.lugar_id=b.id_sucursal AND a.lugar_tipo='SUCURSAL'
		LEFT JOIN ig_empresas e ON b.id_empresa=e.id_empresa
		LEFT JOIN ig_ubicaciones c ON a.lugar_id=c.id_ubicacion AND a.lugar_tipo='UBICACION'
		WHERE a.id_item=".$id." AND a.tipo_item='".$tipo."'
		";
		$r=$this->db->query($sql)->result();
		return $r;
	}
	function tags_get($id_item,$tipo_item){
		return $this->db->query("select b.tag from ig_tags_items a inner join ig_tags b on a.id_tag=b.id_tag and a.tipo_item='".$tipo_item."' and a.id_item=".$id_item)->result();

	}
	function imagen_save($imagen){
		if(isset($imagen["id_imagen"]) && $imagen["id_imagen"]>0){
			$this->db->update("ig_imagenes",$imagen,array("id_imagen"=>$imagen["id_imagen"]));
			return $imagen["id_imagen"];
		}else{
			$this->db->insert("ig_imagenes",$imagen);
			return $this->db->insert_id();
		}
	}
	function producto_detalle_empresa_get($id_producto,$id_empresa){
		$sql="select * from ig_productos a where a.id_producto=? AND a.id_empresa=?";
		$r=$this->db->query($sql,array($id_producto,$id_empresa))->row();
		if(count($r)>0){
			$r->imagenes=$this->db->query("select id_imagen,url,orden from ig_imagenes a WHERE a.id_item=? AND a.tipo_item='PRODUCTO' AND a.status=1",array($id_producto))->result();
			$r->datos=$this->actividad_datos_get($r->id_producto,"PRODUCTO","DATOS");
			$r->condiciones=$this->actividad_datos_get($r->id_producto,"PRODUCTO","CONDICIONES");
			$r->lugares_venta=$this->lugares_venta_get($r->id_producto,"PRODUCTO");
			$r->tags=$this->tags_get($r->id_producto,"PRODUCTO");
		}
		return $r;
	}
	function sucursales_empresa_get($id_empresa,$fulldata=false,$unic=false){
		$sql="select * from ig_sucursales WHERE tipo_sucursal='SUCURSAL' AND id_empresa=? AND status=1";
		$r=$this->db->query($sql,array($id_empresa))->result();
		if($fulldata){
			foreach($r as $i => $suc):
				$r[$i]->telefonos=$this->sucursales_telefonos_get($suc->id_sucursal);
				$r[$i]->horario=$this->sucursale_horario_get($suc->id_sucursal);
				$r[$i]->links=$this->sucursales_link_get($suc->id_sucursal);
				$r[$i]->galeria=$this->sucursal_galeria_get($suc->id_sucursal);
				$r[$i]->menu=$this->sucursale_menu_get($suc->id_sucursal);
			endforeach;
		}
		return $r;
	}
	function sucursales_imagenes_get($id_empresa){
		$sql="select id_sucursal,imagen,banner from ig_sucursales WHERE tipo_sucursal='SUCURSAL' AND id_empresa=? AND status=1";
		$r=$this->db->query($sql,array($id_empresa))->row();
		return $r;
	}
	function  productos_empresa_get($id_empresa){

		$sql="SELECT a.* , c.nombre nombre_empresa,
		(SELECT b.url FROM ig_imagenes b WHERE b.id_item=a.id_producto AND b.tipo_item='PRODUCTO' AND b.orden=1 AND b.status=1 LIMIT 1) imagen
		FROM
		ig_productos a
		INNER JOIN ig_empresas c ON a.id_empresa=c.id_empresa
		WHERE a.status=1 AND c.id_empresa=?

		";
		$r=$this->db->query($sql,array($id_empresa))->result();
		return $r;

	}
	function  ofertas_empresa_get($id_empresa){

		$sql="SELECT a.* , c.nombre nombre_empresa,
		(SELECT b.url FROM ig_imagenes b WHERE b.id_item=a.id_oferta AND b.tipo_item='OFERTA' AND b.orden=1 AND b.status=1 LIMIT 1) imagen
		FROM
		ig_ofertas a
		INNER JOIN ig_empresas c ON a.id_empresa=c.id_empresa
		WHERE a.status=1 AND c.id_empresa=?

		";
		$r=$this->db->query($sql,array($id_empresa))->result();
		return $r;
	}
	function  eventos_empresa_get($id_empresa){

		$sql="SELECT a.* , c.nombre nombre_empresa,
		(SELECT b.url FROM ig_imagenes b WHERE b.id_item=a.id_evento AND b.tipo_item='EVENTO' AND b.orden=1 AND b.status=1 LIMIT 1) imagen
		FROM
		ig_eventos a
		INNER JOIN ig_empresas c ON a.id_empresa=c.id_empresa
		WHERE a.status=1 AND c.id_empresa=?

		";
		$r=$this->db->query($sql,array($id_empresa))->result();
		return $r;
	}
	
	function sucursal_telefono_save($tel){
		if($tel["id_telefono"]>0){
			$this->db->update("ig_telefonos",$tel,array("id_telefono"=>$tel["id_telefono"]));
			return $tel["id_telefono"];
		}else{
			$this->db->insert("ig_telefonos",$tel);
			return $this->db->insert_id();
		}
	}
	function sucursales_telefonos_get($id_sucursal){
		$sql="select * from ig_telefonos a where a.id_sucursal=? AND a.status=1";
		$r=$this->db->query($sql,array($id_sucursal))->result();
		return $r;
	}
	function sucursal_horario_save($dia){
		$existe=$this->db->query("select * from ig_horarios a WHERE a.dia=? AND a.id_sucursal=?",array($dia["dia"],$dia["id_sucursal"]))->result();
		if(count($existe)>0){
			$this->db->update("ig_horarios",$dia,array("dia"=>$dia["dia"],"id_sucursal"=>$dia["id_sucursal"]));
		}else{
			$this->db->insert("ig_horarios",$dia);
		}
	}
	function sucursale_horario_get($id_sucursal){
		$sql="select * from ig_horarios a WHERE a.id_sucursal=?";
		$r=$this->db->query($sql,array($id_sucursal))->result();
		$h=array();
		foreach($r as $i => $item):
			$h[$item->dia]=$item;
		endforeach;
		return $h;
	}
	function sucursal_link_save($item_link){
		$existe=$this->db->query("select * from ig_enlaces a WHERE a.dominio=? AND a.id_sucursal=?",array($item_link["dominio"],$item_link["id_sucursal"]))->result();
		if(count($existe)>0){
			$this->db->update("ig_enlaces",$item_link,array("dominio"=>$item_link["dominio"],"id_sucursal"=>$item_link["id_sucursal"]));
		}else{
			$this->db->insert("ig_enlaces",$item_link);
		}
	}
	function sucursales_link_get($id_sucursal){
		$sql="select * from ig_enlaces a WHERE a.id_sucursal=?";
		$r=$this->db->query($sql,array($id_sucursal))->result();
		$h=array();
		foreach($r as $i => $item):
			$h[$item->dominio]=$item;
		endforeach;
		return $h;
	}
	function sucursal_galeria_get($id_sucursal){
		$sql="select id_imagen,url, orden from ig_imagenes a where a.id_item=? AND a.tipo_item='GALERIA_SUC' order by orden ASC";
		$r=$this->db->query($sql,array($id_sucursal))->result();
		return $r;
	}

	function actividad_datos_save($id_item,$tipo,$atributo,$items){
		$this->db->delete("ig_attributos_actividad",array("id_item"=>$id_item,"tipo_actividad"=>$tipo,"tipo_atributo"=>$atributo));
		foreach($items as $i => $item):
			if(trim($item)!=""){
				$tmp["contenido"]=trim($item);
				$tmp["id_item"]=$id_item;
				$tmp["tipo_atributo"]=$atributo;
				$tmp["tipo_actividad"]=$tipo;
				$this->db->insert("ig_attributos_actividad",$tmp);
			}
			
		endforeach;
	}
	function actividad_datos_get($id_item,$tipo,$atributo){
		$sql="select * from ig_attributos_actividad WHERE id_item=? AND tipo_actividad=? AND tipo_atributo=?";
		$r=$this->db->query($sql,array($id_item,$tipo,$atributo))->result();
		return $r;
	}
	function oferta_save($oferta){
		$id=0;
		if(isset($oferta["dias"])){
			$dias=$oferta["dias"];
			unset($oferta["dias"]);
		}
		
		if(isset($oferta["id_oferta"]) && $oferta["id_oferta"]>0){
			$this->db->update("ig_ofertas",$oferta,array("id_oferta"=>$oferta["id_oferta"]));
			$id= $oferta["id_oferta"];
		}else{
			$this->db->insert("ig_ofertas",$oferta);
			$id= $this->db->insert_id();
		}
		$this->slug_save($id,"OFERTA",$oferta["nombre_oferta"]);
		if(isset($dias)){
			$this->db->delete("ig_ofertas_dias",array("id_oferta"=>$id));
			foreach ($dias as $key => $value) {
				$this->db->insert("ig_ofertas_dias",array("id_oferta"=>$id,"dia"=>$value));
			}
		}
		
		return $id;
	}
	function oferta_detalle_empresa_get($id_oferta,$id_empresa){
		$sql="select * from ig_ofertas a where a.id_oferta=? AND a.id_empresa=?";
		$r=$this->db->query($sql,array($id_oferta,$id_empresa))->row();
		if(count($r)>0){
			$r->imagenes=$this->db->query("select id_imagen,url,orden from ig_imagenes a WHERE a.id_item=? AND a.tipo_item='OFERTA' AND a.status=1",array($id_oferta))->result();
			$r->datos=$this->actividad_datos_get($r->id_oferta,"OFERTA","DATOS");
			$r->condiciones=$this->actividad_datos_get($r->id_oferta,"OFERTA","CONDICIONES");
			$r->lugares_venta=$this->lugares_venta_get($r->id_oferta,"OFERTA");
			$r->tags=$this->tags_get($r->id_oferta,"OFERTA");
			$dias=$this->db->query("select dia from ig_ofertas_dias where id_oferta=?",$r->id_oferta)->result_array();
			$r->dias=(is_array($dias)? array_column($dias,"dia") : array());
		
		}
		return $r;
	}
	function evento_save($evento){
		$id=0;
		if(isset($evento["id_evento"]) && $evento["id_evento"]>0){
			$this->db->update("ig_eventos",$evento,array("id_evento"=>$evento["id_evento"]));
			$id= $evento["id_evento"];
		}else{
			$this->db->insert("ig_eventos",$evento);
			$id= $this->db->insert_id();
		}
		$this->slug_save($id,"EVENTO",$evento["nombre_evento"]);
		return $id;
	}
	function evento_detalle_empresa_get($id_evento,$id_empresa){
		$sql="select * from ig_eventos a where a.id_evento=? AND a.id_empresa=?";
		$r=$this->db->query($sql,array($id_evento,$id_empresa))->row();
		if(count($r)>0){
			$r->imagenes=$this->db->query("select id_imagen,url,orden from ig_imagenes a WHERE a.id_item=? AND a.tipo_item='EVENTO' AND a.status=1",array($id_evento))->result();
			$r->datos=$this->actividad_datos_get($r->id_evento,"EVENTO","DATOS");
			$r->condiciones=$this->actividad_datos_get($r->id_evento,"EVENTO","CONDICIONES");
			$r->lugares_venta=$this->lugares_venta_get($r->id_evento,"EVENTO");
			$r->tags=$this->tags_get($r->id_evento,"EVENTO");
			$r->precios=$this->db->query("select * from ig_eventos_precios WHERE id_evento=?",array($r->id_evento))->result();
		}
		return $r;
	}
	function evento_precios_save($id_evento,$precios){
		
		$this->db->delete("ig_eventos_precios",array("id_evento"=>$id_evento));
		if(count($precios)>0)
			$this->db->insert_batch("ig_eventos_precios",$precios);
	}
	function slug_get($title,$id=0){
		$title=cleanString($title);
		$title2=substr($title,0,30);
		

		$in_use=true;
		$i=1;
		while($in_use){
			$sql="select count(*) exist from ig_slugs where slug ='".$title2."' and id_item!=".$id;
			$r=$this->db->query($sql)->row();
			if($r->exist==0){
				$in_use=false;
			}else{
				$title2=$title."-".$i;
				$i++;
			}
		}
		
		return $title2;
	}
	function slug_save($id_item,$tipo_item,$slug){
		$slug=$this->slug_get($slug,$id_item);
		$exist=$this->db->query("select * from ig_slugs WHERE id_item=? AND tipo_item=?",array($id_item,$tipo_item))->row();
		if(count($exist)>0){
			$this->db->update("ig_slugs",array("slug"=>$slug),array("id_item"=>$id_item,"tipo_item"=>$tipo_item));
		}else{
			$this->db->insert("ig_slugs",array("id_item"=>$id_item,"tipo_item"=>$tipo_item,"slug"=>$slug));
		}
	}

	function menu_seccion_save($seccion){
		if($seccion["id_menu_seccion"]>0){
			$this->db->update("ig_menu_secciones",$seccion,array("id_menu_seccion"=>$seccion["id_menu_seccion"]));
			return $seccion["id_menu_seccion"];
		}else{
			$this->db->insert("ig_menu_secciones",$seccion);
			return $this->db->insert_id();
		}
	}
	function menu_items_save($items){
		$this->db->delete("ig_menu_items",array("id_menu_seccion"=>$items[0]["id_menu_seccion"]));
		$this->db->insert_batch("ig_menu_items",$items);
	}
	function sucursale_menu_get($id_sucursal){
		$secciones=$this->db->query("select * from ig_menu_secciones a WHERE a.id_sucursal=?",array($id_sucursal))->result();
		if(count($secciones)>0){
			foreach($secciones as $i => $item):
				$secciones[$i]->imagenes=$this->db->query("select id_imagen,url,orden from ig_imagenes a WHERE a.id_item=? AND a.tipo_item='MENU' AND a.status=1",array($item->id_menu_seccion))->result();
				$secciones[$i]->items=$this->db->query("select * from ig_menu_items where status=1 AND id_menu_seccion=".$item->id_menu_seccion)->result();
			endforeach;
		}
		return $secciones;
	}
	function buscar($filtro){
		$filtro=addslashes($filtro["frase"]);
		$resultado=array();
		$sql="
		SELECT *,
		CASE
		 WHEN tipo_item='EMPRESA' THEN (SELECT CONCAT(c.nombre_sucursal,'|', c.banner) FROM ig_sucursales c WHERE tmp.id_item=c.id_empresa AND c.tipo_sucursal='SUCURSAL' LIMIT 1)
		 WHEN tipo_item='PRODUCTO' THEN (SELECT CONCAT(c.precio,'|',c.descripcion_producto,'|',d.nombre,'|',IFNULL((SELECT f.url FROM ig_imagenes f WHERE tmp.id_item=f.id_item AND f.tipo_item='PRODUCTO' LIMIT 1),'')) FROM ig_productos c INNER JOIN ig_empresas d ON c.id_empresa=d.id_empresa WHERE tmp.id_item=c.id_producto)
		 WHEN tipo_item='OFERTA' THEN (SELECT CONCAT(c.precio_original,'|',c.valor_porcentaje,'|',c.tipo_oferta,'|',d.nombre,'|',(SELECT f.url FROM ig_imagenes f WHERE tmp.id_item=f.id_item AND f.tipo_item='OFERTA' LIMIT 1)) FROM ig_ofertas c INNER JOIN ig_empresas d ON c.id_empresa=d.id_empresa WHERE tmp.id_item=c.id_oferta )
		 WHEN tipo_item='EVENTO' THEN (SELECT CONCAT(c.fecha_evento,'|',c.precio_evento,'|',d.nombre,'|',(SELECT f.url FROM ig_imagenes f WHERE tmp.id_item=f.id_item AND f.tipo_item='EVENTO' LIMIT 1)) FROM ig_eventos c INNER JOIN ig_empresas d ON c.id_empresa=d.id_empresa WHERE tmp.id_item=c.id_evento) 
		END detalle

		FROM (
		SELECT * FROM (
		SELECT 'EMPRESA' tipo_item, a.id_empresa id_item, nombre nombre_item, b.slug, a.calificacion FROM ig_empresas a INNER JOIN ig_slugs b  ON a.id_empresa=b.id_item AND b.tipo_item='EMPRESA' WHERE a.status=1 AND a.nombre LIKE '%".$filtro."%'
		UNION ALL
		SELECT 'PRODUCTO' tipo_item, a.id_producto id_item, nombre_producto nombre_item, b.slug, a.calificacion FROM ig_productos a INNER JOIN ig_slugs b  ON a.id_producto=b.id_item AND b.tipo_item='PRODUCTO' WHERE  a.status=1 AND a.nombre_producto LIKE '%".$filtro."%'
		UNION ALL 
		SELECT 'OFERTA' tipo_item, a.id_oferta id_item, nombre_oferta nombre, b.slug, a.calificacion FROM ig_ofertas a INNER JOIN ig_slugs b  ON a.id_oferta=b.id_item AND b.tipo_item='OFERTA' WHERE a.status=1 AND a.nombre_oferta LIKE '%".$filtro."%'
		UNION ALL
		SELECT 'EVENTO' tipo_item, a.id_evento id_item,  nombre_evento nombre, b.slug, a.calificacion FROM ig_eventos a INNER JOIN ig_slugs b  ON a.id_evento=b.id_item AND b.tipo_item='EVENTO' WHERE a.status=1 AND a.nombre_evento LIKE '%".$filtro."%'
		) AS tmp0 LIMIT 50 ) AS tmp
		";
		$r=$this->db->query($sql)->result();
		if(count($r)>0){
			$r=array_map(function($item){
				$det=explode("|",$item->detalle);
				switch ($item->tipo_item) {
					case 'EMPRESA':
						$item->id_empresa=$item->id_item;
						$item->nombre=$item->nombre_item;
						$item->banner=isset($det[1])?$det[1] :"";
						$item->nombre_sucursal=isset($det[0])?$det[0] :"";
					break;
					case 'PRODUCTO':
						$item->id_producto=$item->id_item;
						$item->nombre_producto=$item->nombre_item;
						$item->imagen=isset($det[3])?$det[3] :"";
						$item->precio=isset($det[0])?$det[0] :"";
						$item->descripcion_producto=isset($det[1])?$det[1] :"";
						$item->nombre_empresa=isset($det[2])?$det[2] :"";
					break;
					case 'OFERTA':
						$item->id_oferta=$item->id_item;
						$item->nombre_oferta=$item->nombre_item;
						$item->imagen=isset($det[4])?$det[4] :"";
						$item->precio_original=isset($det[0])?$det[0] :"";
						$item->valor_porcentaje=isset($det[1])?$det[1] :"";
						$item->tipo_oferta=isset($det[2])?$det[2] :"";
						$item->nombre_empresa=isset($det[3])?$det[3] :"";
					break;
					case 'EVENTO':
						$item->id_evento=$item->id_item;
						$item->nombre_evento=$item->nombre_item;
						$item->imagen=isset($det[3])?$det[3] :"";
						$item->fecha_evento=isset($det[0])?$det[0] :"";
						$item->precio_evento=isset($det[1])?$det[1] :"";
						$item->nombre_empresa=isset($det[2])?$det[2] :"";
					break;
					
				}
				unset($item->detalle);
				return $item;
			},$r);
		}
		return $r;
	}

	function obtener_usuarios($filtro,$id){
		$sql="SELECT a.id_usuario, a.email, a.nombre_completo FROM ig_usuarios a WHERE a.email LIKE '%".$filtro."%' OR a.nombre_completo LIKE '%".$filtro."%' AND a.status=1 and a.id_usuario!=".$id." Limit 50 ";
		$r=$this->db->query($sql)->result();
		return $r;
	}
	function empresa_admin_save($admins){
		if(isset($admins[0]["id_empresa"])){
			$id_empresa=$admins[0]["id_empresa"];
			$this->db->delete("ig_administradores_empresas",array("id_empresa"=>$id_empresa));
			$this->db->insert_batch("ig_administradores_empresas",$admins);
		}
	}
	function buscar_puntoventa($filtro){
		$sql="SELECT tmp.* FROM (
		SELECT id_ubicacion id_item, nombre_negocio nombre_item, 'U' tipo FROM ig_ubicaciones a WHERE a.nombre_negocio LIKE '%".$filtro."%'
		UNION
		SELECT b.id_sucursal id_item, CONCAT(a.nombre,' - ',b.nombre_sucursal) nombre_item, 'S' tipo FROM ig_empresas a INNER JOIN ig_sucursales b ON a.id_empresa=b.id_empresa WHERE a.nombre LIKE '%".$filtro."%'
	) AS tmp ORDER BY tmp.nombre_item ASC";
	$r=$this->db->query($sql)->result();
	return $r;
}
function empresa_puntoventa_save($puntoventa){
		if(isset($puntoventa[0]["id_empresa"])){
			$id_empresa=$puntoventa[0]["id_empresa"];
			$this->db->delete("ig_empresas_puntoventa",array("id_empresa"=>$id_empresa));
			$this->db->insert_batch("ig_empresas_puntoventa",$puntoventa);
		}
	}
	function tag_check($tag){
		$tag=strtoupper(trim($tag));
		$existe=$this->db->query("select * from ig_tags where tag=?",array($tag))->row();
		if(isset($existe->id_tag)){
			return $existe->id_tag;
		}else{
			$this->db->insert("ig_tags",array("tag"=>$tag));
			return $this->db->insert_id();
		}
	}
	function tags_save($tags){
		$this->db->delete("ig_tags_items",array("id_item"=>$tags[0]["id_item"],"tipo_item"=>$tags[0]["tipo_item"]));
		
		$insert=array_map(function($item){
			return "'".implode("','",$item)."'";
		},$tags);
		$insert="(".implode("),(",$insert).")";	
		$keys_0=$tags[0];
		$keys=array();
		foreach ($tags[0] as $key => $value) {
			$keys[]=$key;
		}
		$keys=implode(",",$keys);

		$sql=$this->db->query("INSERT IGNORE INTO ig_tags_items(".$keys.") values".$insert);

		
	}
	function existe_negocio($nombre){
		$sql="select * from ig_empresas WHERE trim(nombre)=?";
		$r=$this->db->query($sql,array($nombre))->row();
		if(isset($r->id_empresa)){
			return true;
		}
		return false;
	}
	function exchanger_save($exchanger){
		$existe=$this->db->query("select * from ig_usuarios_exchanger WHERE id_usuario=? AND id_empresa=? AND id_sucursal=?",array($exchanger["id_usuario"],$exchanger["id_empresa"],$exchanger["id_sucursal"]))->row();
		if(count($existe)>0){
			$this->db->update("ig_usuarios_exchanger",$exchanger,array("id_usuario"=>$exchanger["id_usuario"],"id_empresa"=>$exchanger["id_empresa"],"id_sucursal"=>$exchanger["id_sucursal"]));
		}else{
			$this->db->insert("ig_usuarios_exchanger",$exchanger);
		}
	}
	function exchanger_empresa_get($id_empresa){
		$sql="SELECT a.*, b.nombre_completo, c.nombre_sucursal FROM ig_usuarios_exchanger a INNER JOIN ig_usuarios b ON a.id_usuario=b.id_usuario INNER JOIN ig_sucursales c ON a.id_sucursal=c.id_sucursal
				WHERE a.id_empresa=? ORDER BY b.nombre_completo ASC";
		$r=$this->db->query($sql,array($id_empresa))->result();
		return $r;
	}
	function exchanger_delete($exchanger){
		$this->db->delete("ig_usuarios_exchanger",$exchanger);

	}
	function logros_usuario($id_usuario){
		$sql="
		select a.id_logro, a.nombre_logro, a.cantidad, a.imagen, a.descripcion_logro, b.nombre nombre_empresa, ifnull(c.hits,0) hits, f.codigo from ig_logros a
		inner join ig_empresas b on a.id_empresa=b.id_empresa
		left join ig_logros_clientes c on a.id_logro=c.id_logro and c.id_cliente=(select d.id_cliente from ig_clientes d inner join ig_usuarios e on d.telefono=e.telefono WHERE e.id_usuario=?)
		left join ig_logros_codigos f ON f.id_logro=a.id_logro AND f.id_cliente=c.id_cliente AND c.canjes=f.numero_canje
		";
		$r=$this->db->query($sql,array($id_usuario))->result();
		//echo $this->db->last_query();
		return $r;

	}


}

/* End of file Main_model.php */
/* Location: ./application/models/Main_model.php */
