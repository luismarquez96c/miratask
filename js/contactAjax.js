function StateOfCountry(country, AddresNumber){

	

	

	

	$.ajax({

		url:  base_app + 'Ajax/getCountryState/'+country,

		type: 'POST',

		dataType: 'html',

		data: { AddresNum: AddresNumber}

	}).done(function (data){

		$('#State'+AddresNumber).html(data);

		

			//alert("seleccionando estados del pais: "+'State'+AddresNumber);

		});

	

	

}



	//Funcion para agregar campos direccion

	//function for add address to form

	//Agregador

	function addBorr(contact,url,tipo){

		

		$.ajax({

			url:  base_app + url,

			type: 'POST',

			dataType: 'html',

			data: { Contact: contact}

		}).done(function (data){

			

			data.trim();

			

			if(data!=""){

				

				if(tipo=='address'){

					addAddressFields(data);

				}

				if(tipo=='phone'){

					

					addPhoneField(data);

				}

				if(tipo=='email'){

					

					addEmailField(data);

				}

				if(tipo=='website'){

					

					addWebsiteField(data);

				}

				

			}

			

		});

		

	}



	function addAddressFields(idAddres){ 



		CountAddAdress=CountAddAdress+1;

		

		$('input[name="totAddressCont"]').val(CountAddAdress);

		

		//alert("Encontramos field "+CountAddAdress);

		

		

		var campos="";

		

		if(idAddres!=undefined){

			campos += '<input type="hidden" name="idAddress_'+CountAddAdress+'" id="idAddress_'+CountAddAdress+'"  value="'+idAddres+'" />';

		}

		

		campos += '<div class="form-group row">';	

		campos +=  	'<label for="" class="col-sm-1 col-form-label">Adress '+CountAddAdress+'</label>';

		campos +=  	'<select name="Country'+CountAddAdress+'" id="Country'+CountAddAdress+'" style="color:#0055a5;"  onchange="StateOfCountry(this.value, '+CountAddAdress+')">';

		campos +=  		'<option>Select One Country</option>';

		campos +=  	'</select>';	

		campos +=  '</div>';

		

		campos +=  '<div class="form-group row">';	

		campos +=  		'<label for="" class="col-sm-1 col-form-label">&nbsp;</label>';

		campos +=  		'<input type="text" name="Street1_'+CountAddAdress+'" placeholder="Street" class="fieldLar" />';

		campos +=  '</div>';

		

		campos +=  '<div class="form-group row">';	

		campos +=  		'<label for="" class="col-sm-1 col-form-label">&nbsp;</label>';

		campos +=  		'<input type="text" name="Street2_'+CountAddAdress+'" placeholder="Street 2" class="fieldLar" />';

		campos +=  '</div>';

		campos +=  '<div class="form-group row">';

		campos +=  		'<input type="text" name="City'+CountAddAdress+'" id="City" placeholder="City" />';

		campos +=  		'<label for="" class="col-sm-1 col-form-label">&nbsp;</label> '; 

		campos +=  		'<select name="State'+CountAddAdress+'" id="State'+CountAddAdress+'" class="fieldR">';

		campos +=  			'<option>Select State</option>';

		campos +=  		'</select>';

		campos +=  '</div>';

		

		campos +=  '<div class="form-group row">';

		campos +=  		'<label for="" class="col-sm-1 col-form-label">&nbsp;</label>'; 

		campos +=  		'<input type="text" name="ZipCode'+CountAddAdress+'" placeholder="Zip Code"  />';

		campos +=  '</div>';

		

		

		$('#AddressExpansor').append(campos);

		

		getCountry(CountAddAdress);

		

	}





	function addPhoneField(idphone){ 

		

		CountAddPhone=CountAddPhone+1;

		

		$('input[name="totPhoneCont"]').val(CountAddPhone);

		

		var phoneFieldHtml ="";

		

		if(idphone!=undefined){

			phoneFieldHtml += '<input type="hidden" name="idPhone_'+CountAddPhone+'" id="idPhone_'+CountAddPhone+'"  value="'+idphone+'" />';

		}

		

		phoneFieldHtml +='<div class="form-group row">';

		phoneFieldHtml +='<label for="" class="col-sm-1 col-form-label">Phone '+CountAddPhone+' </label>';

		phoneFieldHtml +='<input type="text" name="Phone'+CountAddPhone+'" id="Phone'+CountAddPhone+'" placeholder="555-555-5555" maxlength="12" />';

		phoneFieldHtml +='<input type="text" name="Ext'+CountAddPhone+'" id="Ext'+CountAddPhone+'" placeholder="Ext." class="fieldR"/>';

		phoneFieldHtml +='</div>';

		

		$('#PhoneExpansor').append(phoneFieldHtml);

	}



	function addEmailField(idEmail){ 

		

		totEmailCont=totEmailCont+1;

		

		$('input[name="totEmailCont"]').val(totEmailCont);

		

		var EmailFielsHtml =""

		

		if(idEmail!=undefined){

			EmailFielsHtml += '<input type="hidden" name="idEmail_'+totEmailCont+'" id="idEmail_'+totEmailCont+'"  value="'+idEmail+'" />';

		}

		

		EmailFielsHtml += '<div class="form-group row">';

		EmailFielsHtml += '<label for="" class="col-sm-1 col-form-label">Email '+totEmailCont+'</label>';

		EmailFielsHtml += '<input type="text" name="Email'+totEmailCont+'" id="Email'+totEmailCont+'" class="fieldLar" placeholder="sample@hotmail.com" />';

		EmailFielsHtml += '</div>';	

		

		$('#EmailExpansor').append(EmailFielsHtml);



	}

	

	function addWebsiteField(idWebsite){ 

		

		totWebsiteCont=totWebsiteCont+1;

		

		$('input[name="totWebsiteCont"]').val(totWebsiteCont);

		

		var WebsiteFielsHtml ="";

		

		if(idWebsite!=undefined){

			WebsiteFielsHtml += '<input type="hidden" name="idWebsite_'+totWebsiteCont+'" id="idWebsite_'+totWebsiteCont+'"  value="'+idWebsite+'" />';

		}

		

		WebsiteFielsHtml +='<div class="form-group row">';

		WebsiteFielsHtml +='<label for="" class="col-sm-1 col-form-label"> Website '+totWebsiteCont+'</label>';  

		WebsiteFielsHtml +='<input type="text" name="Website'+totWebsiteCont+'" id="Website'+totWebsiteCont+'" placeholder="http://yourwebsite.com" class="fieldLar"/>';

		WebsiteFielsHtml +='</div>';

		

		$('#WebsiteExpansor').append(WebsiteFielsHtml);

		

		

		

	}

	

	function getCountry(actualAddress){

		

		//sera dinamico, php imprimira aqui la lista 

		

		

		$.ajax({

			url:  base_app + 'Ajax/getCountryList',

			type: 'POST',

			dataType: 'html' ,

			data: { ActualNumAdd: actualAddress}

		}).done(function (data) {

			$("#Country"+CountAddAdress).append(data);

		});

		

	}	

	

	function ContactsTo(oper){

		

		$('#contactList').attr('action', base_app+'Ajax/addToGroup');

		

		



		var url = base_app+'Ajax/ToGroup/'+oper; 



		$.ajax({

			type: "POST",

			url: url,

			data: $("#contactList").serialize(), 

			success: function(data)

			{

				data.trim();

				if(data==0){

					

					alert("No saved something wrong!"); 

					$('.itemContact').attr('checked', false); 

					$('.goupID').attr('checked', false);

					

					

				}else if(data==1){

					

					alert("Task completed Succeful!"); 

					$('.itemContact').attr('checked', false);

					$('.goupID').attr('checked', false);

					

					location.reload();

					

				}else if(data==3){

					

					alert("No Groups or Contact selected!");

					

				}

				

			}

		});

		

	}

	

	function addHiddenGroups(Group){

		

		var html='';

		

		html +='<input type="hidden" name="GroupItem[]" value="'+Group+'">';

		

		$('#contactList').append(html);

	}

	

	function updateContact(){ 

		$.ajax({

			url: base_app + 'AjaxContact/Update',

			type: 'POST',

			dataType: 'html',

			data: $("#formNewContact").serialize()

		}).done(function (data) {



			data.trim();

			if(data=="ok"){

				

				$("#atachTo").html(""); 

				$("#atachTo").hide(); 

				$("#fadeBlack").hide();



				alert("Contact has been save!");



				var current_url= window.location.href;



				current_url_tmp = current_url.split('/');



				var tmp = current_url_tmp[6].split('?');



				var url_orig = base_app+'Matters/Details/'+tmp[0];



				if (current_url_tmp[4]=='Matters') {

					current_url = url_orig+'?tab=records';



					window.location.href = current_url;

				}

				



			}else{

				$("#resultErrors").html(data); 

			}





		});	

	}  

	

	

	



	













