function adAdd(check, button) {
	$('#form').form({
		url: "/Admin_Users/add/",
		onSubmit: function() {
			if(check() === false){
				return false;
			}
			$("#window").mask();
			return true;
		},
		success: function(data) {
			data = JSON.parse(data);
			if (!data.success) {
				alert(data.msg);
			} else {
				$("#data_table_body").datagrid("reload");
				$("#window").window("close");
			}
			$("#window").unmask();
		}
	});
	button();
}