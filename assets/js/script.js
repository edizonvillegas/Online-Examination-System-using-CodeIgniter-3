// document.getElementById("enableUserBtn").disabled = true;

// function enableUserBtn(){
//     document.getElementById("enableUserBtn").disabled = false;
// }


$(function() {

	$( ".autocomplete" ).typeahead({	/*	gawing typeahead yung autocomplete	*/
		items: 10,	//no. of records to display.
		source: function(request, response) {
			$.ajax({ 
				url: "/questions/autocomplete_search",
				data: { term: $(".autocomplete").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		matcher: function() {	/*	search using objects.	*/
			return true;
		}
	});

	$( ".topic" ).on('keyup', function() {
		if ($(this).val() == "") {
			$('.resultMsg').html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please enter a topic!</div>");
			$('#newTopicModal .btn-primary').attr('type', 'button');
		}
	});

	$( ".topic" ).typeahead({	/*	gawing typeahead yung autocomplete	*/
		items: 10,	//no. of records to display.
		source: function(request, response) {
			$.ajax({ 
				url: "http://localhost/questions/ifExist",
				data: { term: $(".topic").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					// response(data);
					if(data) {
						$(window).keydown(function(event){
						    if(event.keyCode == 13) {
						      event.preventDefault();
						      return false;
						    }
						 });
						$('.resultMsg').html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Topic already exist!</div>");
						$('#newTopicModal .btn-primary').attr('type', 'button');
					} else {
						$('.resultMsg').html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Topic available!</div>");
						$('#newTopicModal .btn-primary').attr('type', 'submit');
					}
				
				}
			});
		},
		matcher: function() {	/*	search using objects.	*/
			return true;
		}
	});


	$( ".question" ).on('keyup', function() {
		if ($(this).val() == "") {
			$('.resultMsg').html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please enter a question!</div>");
			$('#newQuestionModal .btn-primary').attr('type', 'button');
		}
	});

	$( ".question" ).typeahead({	/*	gawing typeahead yung autocomplete	*/
		items: 10,	//no. of records to display.
		source: function(request, response) {
			$.ajax({ 
				url: "http://localhost/questions/ifQuestionExist",
				data: { 
					term: $(".question").val(),
					hiddenID: $("#hiddenID").val(),
					hiddenQuestionID: $("#hiddenQuestionID").val()
				},
				dataType: "json",
				type: "POST",
				success: function(data){
					// response(data);
					if(data) {
						$(window).keydown(function(event){
						    if(event.keyCode == 13) {
						      event.preventDefault();
						      return false;
						    }
						 });
						$('.resultMsg').html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Question already exist!</div>");
						$('#newQuestionModal .btn-primary').attr('type', 'button');
					} else {
						$('.resultMsg').html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Question available!</div>");
						$('#newQuestionModal .btn-primary').attr('type', 'submit');
					}
				
				}
			});
		},
		matcher: function() {	/*	search using objects.	*/
			return true;
		}
	});

	$( ".title" ).typeahead({	/*	gawing typeahead yung autocomplete	*/
		items: 10,	//no. of records to display.
		source: function(request, response) {
			$.ajax({ 
				url: "http://localhost/questions/ifTitleExist",
				data: { 
					term: $(".title").val(),
					oldTitle: $("#oldTitle").val()
				},
				dataType: "json",
				type: "POST",
				success: function(data){
					// response(data);
					if(data) {
						$(window).keydown(function(event){
						    if(event.keyCode == 13) {
						      event.preventDefault();
						      return false;
						    }
						 });
						$('.resultMsg').html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Title already exist!</div>");
						$('#titleModal .btn-primary').attr('type', 'button');
					} else {
						$('.resultMsg').html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Title available!</div>");
						$('#titleModal .btn-primary').attr('type', 'submit');
					}
				
				}
			});
		},
		matcher: function() {	/*	search using objects.	*/
			return true;
		}
	});

	$( ".choice" ).on('keyup', function() {
		if ($(this).val() == "") {
			$('.resultMsg').html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please enter a choice!</div>");
			$('#newChoicesModal .btn-primary').attr('type', 'button');
		}
	});

	$( ".choice" ).typeahead({	/*	gawing typeahead yung autocomplete	*/
		items: 10,	//no. of records to display.
		source: function(request, response) {
			$.ajax({ 
				url: "http://localhost/questions/ifChoiceExist",
				data: {
					choiceTerm: $(".choice").val(),
					hiddenID: $("#hiddenID").val(),
					hiddenQuestionID: $("#hiddenQuestionID").val()
				},
				dataType: "json",
				type: "POST",
				success: function(data){
					// response(data);
					if(data) {
						$(window).keydown(function(event){
						    if(event.keyCode == 13) {
						      event.preventDefault();
						      return false;
						    }
						 });
						$('.resultMsg').html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Choice already exist!</div>");
						$('#newChoicesModal .btn-primary').attr('type', 'button');
					} else {
						$('.resultMsg').html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Choice available!</div>");
						$('#newChoicesModal .btn-primary').attr('type', 'submit');
					}
				
				}
			});
		},
		matcher: function() {	/*	search using objects.	*/
			return true;
		}
	});

	$('#choiceType').on('change', function() {
		if($(this).val() == 3) {
			$('#choiceTerm').hide();
			$('#newChoicesModal .btn-primary').attr('type', 'submit');
		} else {
			$('#choiceTerm').show();
		}
	})

	var vals = '';
	$( ".examiner" ).typeahead({	/*	gawing typeahead yung autocomplete	*/
		items: 10,	//no. of records to display.
		source: function(request, response) {
			$.ajax({ 
				url: "/questions/take",
				data: {
					examiner: $(".examiner").val(),
					hiddenID: $("#hiddenID").val()
				},
				dataType: "json",
				type: "POST",
				success: function(data){

					response(data);
					if(data) {
						$(window).keydown(function(event){
						    if(event.keyCode == 13) {
						      event.preventDefault();
						      return false;
						    }
						 });


					} else {
						$('.resultMsg').html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Choice available!</div>");
						$('#newChoicesModal .btn-primary').attr('type', 'submit');
					}
				
				}
			});
		},
		matcher: function() {	/*	search using objects.	*/
			return true;
		},
		updater: function (item) {

			var result = item.split(' - ');
		

			$('#examiners').append('<li><label><input type="checkbox" name="examiner[]" checked value="'+result[0].substring(1)+'"> '+result[1]+'</label></li>');


			uniqueLi = {}; //para hindi maduplicate yung list.

			$("#examiners li").each(function () {
			  var thisVal = $(this).text();

			  if ( !(thisVal in uniqueLi) ) {
			    uniqueLi[thisVal] = "";
			  } else {
			    $(this).remove();
			  }
			})


		}
	});

	function nextChar(c) {
	    return String.fromCharCode(c.charCodeAt(0) + 1);
	}
	var nextChoice = nextChar($('#hiddenChoice').val() );

	if($('#hiddenChoice').val() == "-A") {
		$('#hiddenChoice').val('A')
	} else {
		$('#hiddenChoice').val(nextChoice)
	}

});