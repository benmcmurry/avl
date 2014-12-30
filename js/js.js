$(document).ready(function() {

	if (id !== 0) {
		console.log(id);
		updateText();
	}
	
	$(document).keyup(function(e) {
  
		if (e.keyCode == 27) { dismissPopup();dismissVocabPopup(); }   // esc
	});
	$(document).on("click", "#signOut", function(event){
			window.location.href = "logoff.php";
		});
	
	$(document).on("click", "#new_folder, #edit_passage", function() {alert("Feature not yet ready.");});
	$(document).on("click", "#cancel, #faded_background", function() {dismissPopup()});
	$(document).on("click", "#header, #passages, #data, #footer", function() {dismissVocabPopup()});
	// new passage dialog
		$(document).on("click", "#new_passage", function() {
			add_button_position = $("#new_passage").position();
			$("#popup").css("left",add_button_position.left+15);
		dismissVocabPopup();
		$("#popup_content").load("database_functions/add_passage_dialog.php");
		showPopup();
	});
	
	//add new passage to database
	$(document).on("click", "#add_passage", function() {
		user_text = $("#user_text").html();
		
		addToDB($("#text_title").html(), user_text);
		
	});
	
	//delete pasage
	$(document).on("click","#delete_passage", function() {
		if (confirm('Are you sure you want to delete this passage?')) {
		$.ajax({
			type: "POST",   
			url: "database_functions/delete_passage.php",   
			dataType: "html",
			data: "id="+id,
			success : function(phpfile)
			{
				console.log(phpfile);
				window.location.href = "avl.php";
			}
		})
		} else {
		// Do nothing!
		}
	});
	

	
	
	//check words
	$(document).on("click", ".possible_avl, .avl, .word",function(){
		dismissVocabPopup()
		selected_word = this;
		if ($(this).hasClass("avl")) {word = $(this).html().slice(0,-2);}
		else {word = $(this).html();}
		position = $(this).position();
		$("#pos_popup").css({
			"left": position.left,
			"top": position.top+35
		});
		$("#pos_popup_arrow").css({
			"top":"-20px",
			"left":"0px"
		});
		
		$.when(
		$.ajax({
			type: "POST",
			url: "database_functions/search_for_avl_pos.php",
			dataType: "html",
			data: {word: word},
			success: function(phpfile)
			{ 
			  $("#pos_popup_content").html(phpfile);	
			}
		})).then
			(function(){
				numItems = $('.pos').length;
				console.log(numItems);
				$("#pos_popup").css("height", numItems*33);
			});
		$("#pos_popup").show();
		$(document).on("click",".pos",function(){
			if ($(this).hasClass("none")){
				$(selected_word).html(word).removeClass("possible_avl").removeClass("avl").addClass("word");
				updateText();
			}
			else {
				$(selected_word).html($(this).html()).removeClass("possible_avl").addClass("avl"); 													updateText();
			}
			numItems = $('.pos').length;
		
		});
		
	}); //end possible.avl function
	
}); //end document.ready

function showPopup() {
	body_h = $("body").height();
	body_w = $("body").width();
	console.log(body_w);
	$("#faded_background").css({
		"height": body_h,
		"width": body_w
	});
	$("#faded_background, #popup").show();
}

function dismissPopup() {
	$("#faded_background, #popup").fadeOut();
}

function dismissVocabPopup() {
	$("#pos_popup").hide();
	$("#pos_popup_content").html("");
}

function addToDB(title, html) {
// 	html = html.replace(/&nbsp;/gi,''); I don't know if I really need this
	
	$.ajax({ 
	
		type: "POST",   
		url: "database_functions/add_passage_to_db.php",   
		dataType: "html",
		data: {user_text: html, title: title},
		success : function(phpfile)
			{
				console.log(phpfile);
				window.location.href = "avl.php?id="+phpfile;
			}
		});
}

function updateText(){
	text = $("#passage").html();
	$.when($.ajax({ 
	
		type: "POST",   
		url: "database_functions/update_text.php",   
		dataType: "html",
		data: {id: id, text: text},
		success : function(phpfile)
			{
				console.log(phpfile);
				
			}
		})).then(function(){
		updateStats();}
		);
}

function updateStats(){
	$("#stats").load("stats.php?id="+id);
}

