$( document ).ready(function() {
    $(".error").css("display", "none");
});
/*Login alumnes*/
jQuery(document).on('submit','#formlg',function(event){
	event.preventDefault();

	jQuery.ajax({
		url: 'main_app/login.php',
		type:'POST',
		dataType: 'json',
		data: $(this).serialize(),
		beforeSend: function(){
			$('#botonlg').html('Validant...');
		}
	})
	.done(function(resposta){
		console.log(resposta);
		if(!resposta.error){
			location.href = 'main_app/perfil_alumne.php'
		}else{
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');
			},3000);
			$('#botonlg').html('Accés');

		}
	})
	.fail(function(resp){
		console.log(resp.responseText);
	})
	.always(function(){
		console.log("complete");

	});

});

/*Login professors*/
jQuery(document).on('submit','#formpg',function(event){
	event.preventDefault();

	jQuery.ajax({
		url: 'main_app/loginProfessors.php',
		type:'POST',
		dataType: 'json',
		data: $(this).serialize(),
		beforeSend: function(){
			$('#botonlg').html('Validant...');
		}
	})
	.done(function(resposta){
		console.log(resposta);
		if(!resposta.error){
			location.href = 'main_app/perfil_professor.php'
		}else{
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');
			},3000);
			$('#botonlg').html('Accés');

		}
	})
	.fail(function(resp){
		console.log(resp.responseText);
	})
	.always(function(){
		console.log("complete");

	});

});
	
