	$(document).ready(function(){
	   	 var now = new Date();
	   	 var annee   = now.getFullYear();
	   	 var mois    = now.getMonth() + 1;
	   	 var jour    = now.getDate();
	   	 var heure   = now.getHours();
	   	 var minute  = now.getMinutes();
	   	
	   	 if(jour < 10)
	   		 jour = "0"+jour;
	   	 if(mois <10)
	   		 mois = "0"+mois;
	   	 
	   	 var dateNow  = mois+"/"+jour+"/"+annee;
	   	 var heureNow = heure+":"+minute;
	   	 var dateFinFromNow = (mois)+"/"+(jour+1)+"/"+annee;
	   	 console.log(dateNow);
	   	 $('#dateDebut').val(dateNow);
	   	 $('#dateFin').val(dateFinFromNow);
	   	 $('#heureDebut').val(heureNow);
	   	 $('#heureFin').val(heureNow);
	   	
		 var context = $('#context').text();
		
	     var $error = $('<span class="error"></span>');
	     // Declare the function variables:
	     // Parent form, form URL, email regex and the error HTML
	     var $formId = $('#formConfig');
	     var formAction = $formId.attr('action');		

		 function showError(){
			$('span.error').each(function(){

			   	
			// Set the distance for the error animation
			var distance = 5;
			// Get the error dimensions
			var width = $(this).outerWidth();
			// Calculate starting position
			var start = width + distance;
			// Set the initial CSS
			$(this).show().css({
				display: 'block',
				opacity: 0,
				right: -start+'px'
			})
				// Animate the error message
				.animate({
				right: -width+'px',
				opacity: 1
				}, 'slow');
					    });
		}
			
		
		  // Fade out error message when input field gains focus
		  $('.required').focus(function(){
		    var $parent = $(this).parent();
		    $parent.removeClass('error');
		    $('span.error',$parent).fadeOut();
		  });


		  // lors du soumession du form
		  $('.btn-submit').click(function(e){
		    $('span.error').remove();

		 	var quesVal = $('#ques').val();
		    var rep1Val = $('#rep1').val();
		    var rep2Val = $('#rep2').val();

		      if(quesVal == ''){
		        $('#ques').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
		      }
		     if(rep1Val == ''){
		        $('#rep1').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
		      }
		      if(rep2Val == ''){
		        $('#rep2').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
		      }

		    // All validation complete - Check if any errors exist
		    // If has errors
		    if ($('span.error').length > 0) {
		      showError();
		    }else {    	
           		$('body').oLoader({
           	      backgroundColor:'#F1F1F1',
           	      fadeInTime: 500,
           	      fadeOutTime: 1000,
           	      fadeLevel: 0.5
           	    });
           		
		    	$.post($("#formConfig").attr("action"),
					   $("#formConfig").serialize(),
					   function(data) {
		    			if(data == "ok"){
		    				$('body').oLoader('hide');
		    				$(location).attr('href',context+"/EspaceAdmin/evenements");
		    			}
		    		}
		    	);
		   }
		    	return false;
		  });


		  
		
		
				//cacher le bouton moins 
				$("#remove-reponse").hide();
				
				$("#info-event").show();
				$("#configEvent-body").hide();
				$("#configEtapes-body").hide();
				$("#configQ-body").hide();

				//donner la date d'aujourdhui par defaut au date deb
				$("#versConfigEvent").click(function(){

			    	$('span.error').remove();
    
				 	var nameVal = $('#name').val();
				    var companyVal = $('#company').val();
				    var descriptionVal = $('#desc').val();
				    //les donnes en arabe
				    var nameValAr = $('#nameAr').val();
				    var companyValAr = $('#companyAr').val();
				    var descriptionValAr = $('#descAr').val();
				    



				    if(nameVal == '' || company == '' || descriptionVal == '' || nameValAr == '' || companyAr == '' || descriptionValAr == ''){
				      if(nameVal == ''){
				        $('#name').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
				      }
				     if(companyVal == ''){
				        $('#company').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
				      }
				      if(descriptionVal == ''){
				        $('#desc').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
				      }
				      if(nameValAr == ''){
					        $('#nameAr').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
					      }
					  if(companyValAr == ''){
					        $('#companyAr').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
					      }
					  if(descriptionValAr == ''){
					        $('#descAr').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
					      }
				    }else{
				    	$("#configEvent-body").show();
						$("#info-event").hide(); 
			    		$("#modifInfo").addClass("glyphicon-cog");
			    	}

				    // All validation complete - Check if any errors exist
				    // If has errors
				    if ($('span.error').length > 0) {
				      showError();
				    }

					});

			    $("#modifInfo").click(function(){
			    		$("#configEtapes-body").hide();
						$("#configEvent-body").hide();
						$("#info-event").show(); 
						$("#modifInfo").removeClass("glyphicon-cog");
					});


			    $("#retourConfigInfo").click(function(){
			    		$("#configEvent-body").hide();
						$("#info-event").show(); 
			    });

			    $("#versConfigEtapes").click(function(){
				    
					 	var heureDebut = $('#heureDebut').val();
					   	var heureFin = $('#heureFin').val();
					   	var dateDebut = $('#dateDebut').val();
					   	var dateFin = $('#dateFin').val();
					   	var errorDate = false;
					   	var infNow = false;
					   	

					   	if(dateDebut == dateFin)
					   	{
					   		if(heureDebut>heureFin)
					   			errorDate = true;
					   	}
					   	if(dateDebut < dateNow)
					   	{
					   		infNow = true;
					   		console.log("infNow");
					   	}
					   	
					   	if(dateDebut == '' || dateFin == '' || heureDebut == '' || heureFin == '' || errorDate == true || infNow == true)
					   	{
					   	  if(errorDate == true){
					      	($('#heureDebut').parent()).parent().addClass('error').append($error.clone().text('Date debut doit etre inferieur à celle de fin'));
					      }
					   	  if(infNow == true)
					   		  $('#dateDebut').parent().addClass('error').append($error.clone().text('Date debut doit être égale ou suppèrieure à celle d\'Ajourdui\'hui'));
					      if(dateDebut == ''){
						        $('#dateDebut').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
						  }
						  if(dateFin == ''){
						        $('#dateFin').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
						  }
						  if(heureDebut == ''){
						        $('#heureDebut').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
						  }
						  if(heureFin == ''){
						      	$('#heureFin').parent().addClass('error').append($error.clone().text('Champ obligatoire'));
						  }
						  infNow = false;
					   	}else{
				    		$("#configEtapes-body").show();
							$("#configEvent-body").hide();
							$("#modifconfigEvent").addClass("glyphicon-cog"); 
					   	}
					   	
					 // All validation complete - Check if any errors exist
					    // If has errors
					    if ($('span.error').length > 0) {
					      showError();
					    }
			    });

			    $("#retourConfigEtapes").click(function(){
			    		$("#configEtapes-body").hide();
						$("#configEvent-body").show(); 
			    });

			    $("#modifconfigEvent").click(function(){
			    		$("#configEtapes-body").hide();
						$("#info-event").hide();
						$("#dossier-body").hide();
						$("#configEvent-body").show(); 
						$("#modifconfigEvent").removeClass("glyphicon-cog");
				});

	   		    $("#retourBac").click(function(){
						$("#configEtapes-body").show(); 
			    });


			    $("#modifconfiEtapes").click(function(){
			    		$("#configEtapes-body").show();
						$("#info-event").hide();
						$("#configEvent-body").hide(); 
						$("#configQ-body").hide(); 
						$("#modifconfiEtapes").removeClass("glyphicon-cog");
				});

				$("#versConfigQ").click(function(){
			    		$("#configQ-body").show();
						$("#configEtapes-body").hide(); 
						$("#modifconfiEtapes").addClass("glyphicon-cog");
			    });

			    $("#retourEtapes").click(function(){
			    		$("#configQ-body").hide();
						$("#configEtapes-body").show(); 
			    });

			    var i = 0;
				//boutton plus pour ajouter une nouvelle possiblité de reponse
				$("#add-reponse").click(function(){
					i++;
					if(i == 1)
						$("#remove-reponse").show();
					var inputCloned = $('.reponsetoClone:last').clone();
					
					inputCloned.show();
					$("#reponses").append(inputCloned);
				});			    

				//boutton moins pour suprrimer une possiblité de reponse
				$("#remove-reponse").click(function(){
					i--;
					if(i == 0)
						$("#remove-reponse").hide();
					var dernierInput = $('.reponsetoClone:last');
					dernierInput.remove();
				});			    



				/** compteur de la session **/

				var compteurSession = 60;
				var timer = $("#time");
				setCompteur();
				
				function setCompteur(){
					compteurSession -= 1;
					var minutes = Math.floor(compteurSession/60);
					var secondes = Math.floor(compteurSession-(minutes*60));

					timer.empty();
					timer.append((minutes<10?'0':'')+minutes+':'+(secondes<10?'0':'')+secondes);
					if(compteurSession>0)
						setTimeout(setCompteur,1000);
				}
		});

