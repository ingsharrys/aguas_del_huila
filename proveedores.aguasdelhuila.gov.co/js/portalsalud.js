function mensajeRegistro(mensaje){
	if(mensaje=="adicionado"){
		$.gritter.add({
			// (string | mandatory) the heading of the notification
			title: 'Registro Adicionado',
			// (string | mandatory) the text inside the notification
			text: 'El registro ha sido adicionado con &eacute;xito',
			// (int | optional) the time you want it to be alive for before fading out
			time: '',
			// (string) specify font-face icon  class for close message
			close_icon: 'entypo-icon-cancel s12',
			// (string) specify font-face icon class for big icon in left. if are specify image this will not show up.
			icon: 'icomoon-icon-thumbs-up-2',
			// (string | optional) the class name you want to apply to that specific message
			class_name: 'info-notice'
		});     
	}
	if(mensaje=="actualizado"){
		$.gritter.add({
			// (string | mandatory) the heading of the notification
			title: 'Registro Actualizado',
			// (string | mandatory) the text inside the notification
			text: 'El registro ha sido actualizado con &eacute;xito',
			// (int | optional) the time you want it to be alive for before fading out
			time: '',
			// (string) specify font-face icon  class for close message
			close_icon: 'entypo-icon-cancel s12',
			// (string) specify font-face icon class for big icon in left. if are specify image this will not show up.
			icon: 'icomoon-icon-thumbs-up-2',
			// (string | optional) the class name you want to apply to that specific message
			class_name: 'info-notice'
		});     
	}
	if(mensaje=="eliminado"){
		$.gritter.add({
			// (string | mandatory) the heading of the notification
			title: 'Registro Eliminado',
			// (string | mandatory) the text inside the notification
			text: 'El registro ha sido eliminado',
			// (int | optional) the time you want it to be alive for before fading out
			time: '',
			// (string) specify font-face icon  class for close message
			close_icon: 'entypo-icon-cancel s12',
			// (string) specify font-face icon class for big icon in left. if are specify image this will not show up.
			icon: 'brocco-icon-trashcan',
			// (string | optional) the class name you want to apply to that specific message
			class_name: 'warning-notice'
		});     
	}
	if(mensaje=="noexiste"){
		$.gritter.add({
			// (string | mandatory) the heading of the notification
			title: 'Registro no encontrado',
			// (string | mandatory) the text inside the notification
			text: 'La consulta no arrojo resultados',
			// (int | optional) the time you want it to be alive for before fading out
			time: '',
			// (string) specify font-face icon  class for close message
			close_icon: 'entypo-icon-cancel s12',
			// (string) specify font-face icon class for big icon in left. if are specify image this will not show up.
			icon: 'icomoon-icon-thumbs-down-2',
			// (string | optional) the class name you want to apply to that specific message
			class_name: 'warning-notice'
		});     
	}

}

function calcular_edad(fecha){ 
		
	var values=fecha.split("-");
	var dia = values[2];
	var mes = values[1];
	var ano = values[0];

	// cogemos los valores actuales
	var fecha_hoy = new Date();
	var ahora_ano = fecha_hoy.getYear();
	var ahora_mes = fecha_hoy.getMonth()+1;
	var ahora_dia = fecha_hoy.getDate();

	// realizamos el calculo
	var edad = (ahora_ano + 1900) - ano;
	if ( ahora_mes < mes )
	{
		edad--;
	}
	if ((mes == ahora_mes) && (ahora_dia < dia))
	{
		edad--;
	}
	if (edad > 1900)
	{
		edad -= 1900;
	}

	// calculamos los meses
	var meses=0;
	if(ahora_mes>mes)
		meses=ahora_mes-mes;
	if(ahora_mes<mes)
		meses=12-(mes-ahora_mes);
	if(ahora_mes==mes && dia>ahora_dia)
		meses=11;

	// calculamos los dias
	var dias=0;
	if(ahora_dia>dia)
		dias=ahora_dia-dia;
	if(ahora_dia<dia)
	{
		ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
		dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
	}
	
	if(edad > 0 && meses > 0){
		valor=edad;
		medida=1; 
	}
	if(edad == 0 && meses > 0){
		valor=meses;
		medida=2; 
	}
	if(edad == 0 && meses == 0){
		valor=dias;
		medida=3; 
	}
	jsonData='{"valor":"'+valor+'","medida":"'+medida+'"}';
    return jsonData;
	
}