$(document).ready(function(){

	$("#showAllFixtures").change(function(){
		if ($(this).val() == "yes") {
			$("div .well").removeClass("hideRow");
		} else {
			$("div .noPredictorRow").addClass("hideRow");
		}
	});
	
	$(".previewCell").click(function(){
		fixtureid = $(this).attr("data-fixtureid");
		
		$('#dialog').dialog({
			width:'90%',
			modal: true,
			position: { my: "center top+25", at: "top+25" }
		});
		
		$.ajax({
			url: "popUp.php",
			type: "POST",
			dataType: "html",
			data: {
				fixtureid: fixtureid
			},
			success: function(data){
				$("#dialog").html(data);
			},
		});
	});
});