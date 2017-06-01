$(function() {
	var doing = false;
	var checkopen = function() {
		if ($("#open").prop("checked")) {
			$("#data_table").unmask();
		} else {
			$("#data_table").mask();
		}
	}
	checkopen();
	$("#open").change(function(e) {
		if (doing) {
			$(this).prop("checked", !$(this).prop("checked"));
			return false;
		}
		doing = true;
		$.post("/Ad/open/", {
			typeid: 1
		}, function() {
			checkopen();
			doing = false;
		});
	});
});