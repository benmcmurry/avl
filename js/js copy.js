$(document).ready(function() {
	
	$(document).on("click", "#cancel, #faded_background", function() {dismissPopup()});
	// new passage dialog
	$(document).on("click", "#new_passage", function() {
			$("#popup").css({
				"left": "145px",
				"top": "120px"});
			$("#popup_arrow").css({
				"top":"-20px",
				"left":"45px"});
			$("#popup_content").load("add_passage_dialog.php");
			
			showPopup();
		});
	//new passage add to database
	$(document).on("click", "#add_passage", function() {
		$.ajax({
			type: "POST",
			
		})
	});
	
	
	$("#highlight_forms").click(function(){
		highlightForms($("#user_text").html());
	});
	
	$(".possible_avl").on("click", function(){
		console.log("Hello");
		word = $(this).html();
		alert(word);
	});
	
});

function showPopup() {
	
	$("#faded_background, #popup").show();
}

function dismissPopup() {
	$("#faded_background, #popup").hide();
		
	
	
}

function highlightForms(html) {
	html = html.replace(/&nbsp;/gi,'');
	$.ajax({ 
	
		type: "POST",   
		url: "analyze.php",   
		dataType: "html",
		data: "user_text="+html,
		success : function(phpfile)
			{
				$("#user_text").html(phpfile);
			}
		});
	$("#user_text").attr("contenteditable", "false");
	
/*     $("div#user_text .possible_avl").click(function(){alert("hello");});    */  
}

