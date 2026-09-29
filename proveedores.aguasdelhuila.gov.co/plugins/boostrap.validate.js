/*
 * jQuery Bootstrap Form Validation plugin 0.1
 *
 * http://www.antol.in/labs/boostrapvalidate
 * http://docs.jquery.com/Plugins/shdatacontrol
 *
 * Copyright (c) 2012 Oscar Emilio Antolinez Collazos
 * 
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

(function($) {
	$.widget("ui.boostrapvalidate", {
			 
		_init: function() {			
			var element=this.element; var o = this.options;				
			this._bindEvents();
		},
		
		checkDate: function(val){
			//Formato YYYY-MM-DD HH:MI:SS		
			var arrayDate = val.split(" ")
			var arrayDate1 = arrayDate[0].split("-")
			var day = parseInt(arrayDate1[2],10);
			var month = parseInt(arrayDate1[1],10);
			var year = parseInt(arrayDate1[0],10);
			var mydate = new Date(year,month-1,day);	
			
			year2=(mydate.getYear() < 1000) ? mydate.getYear() + 1900 : mydate.getYear();
			
			//si el array no tiene tres partes, la fecha es incorrecta
			if(arrayDate1.length!=3){
				return false;
			}else if(isNaN(year) || year2 != year){
				return false;
			}else if(isNaN(month) || (month > 12) || (month-1) != mydate.getMonth()){
				return false;
			}else if(isNaN(day) || day != mydate.getDate()){
				return false;
			}
			
			return true;
			
		},

		checkEmail: function(val){
			var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
			
			if(!ck_email.test(val)) {
			  return false;
			}else{
				return true;
			}
		},

		checkOnlyNumbers: function(evt){
			var charCode = evt.which;
			
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		},
		
		thousands: function(val){
			var valor=val;
			var posdecimal=0;
			var cuenta=0;
			var j=0;
			var cadResultado='';
			var regPunto=new RegExp("\\,","g")
			if(valor.length>0){
				valor=valor.replace(regPunto,'');
				posdecimal=valor.indexOf('.');
				if(posdecimal==-1){posdecimal=valor.length;}
				for(j=posdecimal-1;j>=0;j--){
					if(cuenta<3){
						cadResultado=valor.charAt(j)+cadResultado;
					}else{
						cadResultado=valor.charAt(j)+','+cadResultado;
						cuenta=0;
					}
					cuenta++;
				}
				return cadResultado+valor.substring(posdecimal,valor.length);
			}
		},
		
		
		serializeData: function(){
			var element=this.element; var o = this.options;	var self=this;
			
			return dataString;
		},
		
		_unbindEvents: function(){
			var element=this.element; var o = this.options;	var self=this;
			var pos=element.find("tr.shtableheader").find("th").index(element.find("th#chk"));
			
			
		},
		
		_bindEvents: function() {
			var element=this.element; var o = this.options;	var self=this;
			
			$(o.fields).each(function(f, field){

				/* Chequeo restricciones */
				$(element).delegate("[name="+this.name+"]", "click", function(){$(this).focus()});//movemos el foco por los check que lo tomaban  
				
				$(element).delegate("[name="+this.name+"]", "keypress", function(event){
					if(field.maxlength>0 && /^-?((\d+\.?\d?)|(\.\d+))$/.test(field.maxlength)){
						var maxLength = field.maxlength; //alert(field.maxlength);
						var key = event.which;
						//all keys including return.
						//alert(key);
						if(key > 33 || key == 32 || key == 13) {
							var length = $(this).val().length; //alert($(this).val().length);
							if(parseInt(length,10) >= parseInt(maxLength, 10)) {
								$(this).parent().find(".charcount").html((parseInt(maxLength, 10)-parseInt($(this).val().length)));
								event.preventDefault();
							}
						}
					}
					
					
				});
				
				$(element).delegate("[name="+this.name+"]", "keyup", function(event){
					if(field.maxlength>0 && /^-?((\d+\.?\d?)|(\.\d+))$/.test(field.maxlength)){
						var maxLength = field.maxlength; //alert(field.maxlength);
						$(this).siblings(".help-block").find("em").html((parseInt(maxLength, 10)-parseInt($(this).val().length)));
						
					}
				});
				
				$(element).delegate("[name="+field.name+"]", "focusin", function(){
					if(field.label==$(this).val()){
						$(this).val("");
					}
				});
				
				$(element).delegate("[name="+field.name+"]", "focusout", function(){
																	
					$(this).siblings("."+o.errorClass+"").remove();		
					
					$(this).removeClass(o.errorClass);		
					var codeError=0;
					var strError="";
					if(field.required==true){
						if(this.type=="select-one"){
							//alert($(this).val().length);
							if($(this).val().length==0){
								//$(this).parent().append("<div class='"+o.errorClass+"'>Debe escojer un item de la lista</div>");
								codeError=1;
								strError+="<div class='"+o.errorClass+"'>Debe escojer un item de la lista</div>";
							}
						}else if(this.type=="radio"){
							if(!$("[name="+field.name+"]:checked").val()){
								//$(this).parent().append("<div class='"+o.errorClass+"'>Debe escojer una opcion</div>");
								codeError=1;
								strError+="<div class='"+o.errorClass+"'>Debe escojer una opcion</div>";
							}
						}else if(this.type=="checkbox"){
							if(!$("[name="+field.name+"]:checked").val()){
								//$(this).parent().append("<div class='"+o.errorClass+"'>Debe escojer al menos una opcion</div>");
								codeError=1;
								strError+="<div class='"+o.errorClass+"'>Debe escojer al menos una opcion</div>";
							}
						}else{
							if($(this).val().length==0){
								//$(this).parent().append("<div class='"+o.errorClass+"'>Debe diligenciar este campo</div>");
								codeError=1;
								strError+="<div class='"+o.errorClass+"'>Debe diligenciar este campo obligatorio</div>";
							}
						}
					}//Fin para campos obligatorios
					
						if(this.type=="password"){
							if($(element).find(":password").length==2){
								if($(element).find(":password").eq(0).val()!=$(element).find(":password").eq(1).val()){
									codeError=1;
									strError+="<div class='"+o.errorClass+"'>No coinciden las claves</div>";
								}else{
									$(element).find(":password").siblings("."+o.errorClass+"").remove();
								}
							}
						}
					
						
						if(field.datatype=="numeric" || field.datatype=="thousands"){
							//alert(parseInt(($(this).val()).replace(/,/g, ""), 10));
							//alert(field.minvalue);
							if(parseInt(field.minvalue, 10)>0 && /^-?((\d+\.?\d?)|(\.\d+))$/.test(field.minvalue) && $(this).val().length>0){
								if(parseInt(($(this).val()).replace(/,/g, ""), 10)<parseInt(field.minvalue, 10)){
									codeError=1;
									strError+="<div class='"+o.errorClass+"'>El valor no puede ser inferior a "+field.minvalue+"</div>";
								}
							}
							if(parseInt(field.maxvalue, 10)>0 && /^-?((\d+\.?\d?)|(\.\d+))$/.test(field.maxvalue && $(this).val().length>0)){
								if(parseInt(($(this).val()).replace(/,/g, ""), 10)>parseInt(field.maxvalue, 10)){
									codeError=1;
									strError+="<div class='"+o.errorClass+"'>El valor no puede ser mayor de "+field.maxvalue+"</div>";
								}
							}
						}
											
						if(field.minlength>0 && /^-?((\d+\.?\d?)|(\.\d+))$/.test(field.minlength) && $(this).val().length>0){
							if($(this).val().length<field.minlength){
								codeError=1;
								strError+="<div class='"+o.errorClass+"'>Digite al menos "+field.minlength+" caracteres</div>";
							}
						}
						
						if(field.maxlength>0 && /^-?((\d+\.?\d?)|(\.\d+))$/.test(field.maxlength) && $(this).val().length>0){
							if($(this).val().length>field.maxlength){
								codeError=1;
								strError+="<div class='"+o.errorClass+"'>Digite maximo "+field.maxlength+" caracteres</div>";
							}
						}
						
						
						if(field.datatype=="email" && $(this).val().length>0){
							if(!self.checkEmail($(this).val())){
								//$(this).parent().append("<div class='"+o.errorClass+"'>Debe diligenciar un email valido</div>");
								codeError=1;
								strError+="<div class='"+o.errorClass+"'>Debe diligenciar un email valido</div>";
							}else{
								codeError=0;
							}
						}
	
						if(field.datatype=="date" || field.datatype=="datepicker" || field.datatype=="datetimebox"){
							if(!self.checkDate($(this).val())){
								//$(this).parent().append("<div class='"+o.errorClass+"'>Fecha no valida</div>");
								codeError=1;
								strError+="<div class='"+o.errorClass+"'>Fecha no valida</div>";
							}
						}

						if(field.equalto!=""){
							if($("#"+field.equalto).val()!=$(this).val()){
								codeError=1;
								strError+="<div class='"+o.errorClass+"'>No coinciden con el campo "+field.equalto+"</div>";
							}else{
								$("#"+field.equalto).siblings("."+o.errorClass+"").remove();
							}
							
						}							

						if(codeError==1){
							$(this).parents(".form-group").addClass(o.errorClass);
							$(this).addClass(o.errorClass);
							$(this).siblings("label").remove();
							$(this).parent("div").append("<label id='"+field.name+"-error' class='help-block' for='"+field.name+"'>"+strError+"</label>");
							
						}else{
								$(this).parents(".form-group").addClass("control-group success");
								$(this).parents(".form-group").removeClass(o.errorClass);
								$(this).siblings("label").remove();
								$(this).removeClass(o.errorClass);
						}

				});
				
				
				/* Condiciones para entrada de datos */

				if(field.datatype=="numeric"){
					$(element).delegate("[name="+field.name+"]", "keypress", function(i, name){
						return self.checkOnlyNumbers(i);
					});
					//element.find("#"+this.id+"").bind("keypress",function(i, name){return self.chekOnlyNumbers(i)});
				}
				if(field.datatype=="thousands"){
					
					$(element).find("[name="+this.name+"]").css("text-align","right");

					
					$(element).delegate("[name="+field.name+"]", "keypress", function(i, name){
						return self.checkOnlyNumbers(i);
					});
					$(element).delegate("[name="+field.name+"]", "keyup", function(){
						$(this).val(self.thousands($(this).val()));
					});
					//element.find("#"+this.id+"").bind("keypress",function(i, name){return self.chekOnlyNumbers(i)});
				}
				if(field.datatype=="datetimebox"){	//requiere pluggin easyui	
					$(element).find('[name='+field.name+']').datetimebox({  
							showSeconds:false
					});  
					//$(element).find('[name='+field.name+']').siblings("span").children("input").attr("name",field.name);
				}
				if(field.datatype=="ckeditortext"){	//requiere pluggin ckeditor	
				
					$(element).find('#'+field.name+'').ckeditor({height: '100px'});					
					//CKEDITOR.replace(field.name, {toolbar: 'MyToolbar', height: '100px'});
				}
				
				
				if(field.datatype=="datepicker"){	//requiere pluggin 	
					//var now = new Date();
					var mindate = field.minvalue;
					var maxdate = field.maxvalue;
					
					$(element).find('[name='+field.name+']').datepicker({
						format: field.format
					});
				}
				if(field.datatype=="daterangepicker"){	//requiere pluggin 	
					$(element).find('[name='+field.name+']').daterangepicker();
				}

				/* Asignacion de otros pluggins */
				
				/*if(field.mask.length>0){
					$(element).find("[name="+field.name+"]").mask(field.mask);
				}*/
				
				
				/* Adicion de eventos personalizados */
				//alert(field.name);
				$(field.events).each(function(e, ev){
					$(element).find("[name="+field.name+"]").bind(ev.name, function(){ev.code()});
				})
				
			});
						

			$(element).find(":reset").click(function(){
				$(element).find(":submit").removeAttr("disabled");
				$(element).find("div.controls").removeClass("control-group error");
				$(element).find("div.alert").remove();
				$(element).find("input").removeClass(o.errorClass);
			});


			//Evento para el envio del formulario
			element.submit(function(){
				$(element).find("input, select, textarea").trigger("focusout");
				if(element.find("."+o.errorClass+"").length>0){
					return false;
				}else{
					if(o.beforeSubmit()==false){
						return false;
					}
					if(o.sendType=="nosend"){
						return false;
					}else if(o.sendType=="normal"){
						return true;
					}else if(o.sendType=="ajax"){
						self._callURL();
						return false;
					}else{}
				}
			})
			

		},
		
		
		validateForm: function() {
			var element=this.element; var o = this.options;	var self=this;
			$(element).find("input, select, textarea").trigger("focusout");
			if(element.find("."+o.errorClass+"").length>0){
				this.options.valid = false;
			}else{
				this.options.valid= true;
			}
			
			this._trigger('validateForm', null);
		},
		
		_callURL: function() {
			var element=this.element;
			var o = this.options;
			var self=this;
						
			$.ajax({
				type: element.attr("method"),
				url: element.attr("action"),
				async: false,
				//dataTypeString: o.dataType,
				beforeSend: function(XMLHttpRequest){
					$(element).find(":submit").attr("disabled", "disabled");
				},
				data: $.param(element.serializeArray())+"&"+o.extraData,
				success: function(response){
					o.completeSubmit(response);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert("XMLHttpRequest="+XMLHttpRequest.responseText+"\ntextStatus="+textStatus+"\nerrorThrown="+errorThrown);
				},
				complete: function(){
					$(element).find(":submit").removeAttr("disabled");
				}
			});			
		},
		
		
		destroy: function() {
			//$.widget.prototype.apply(this, arguments); // default destroy
			// now do other stuff particular to this widget
		} 
		
		
	});
	$.extend($.ui.bootstrapvalidate, {
		getter: "serializeData",
		defaults: {
			sendType: "ajax",//ajax|normal|nosend
			dataType: "",
			extraData: "",
			valid: true,
			errorClass: "validateError",
			beforeSubmit: function(){},
			beforeSend: function(XMLHttpRequest){},
			completeSubmit: function(response){},
			fields: [] //Sin campos []
		}
	});
})(jQuery);
