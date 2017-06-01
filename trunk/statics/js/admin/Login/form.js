$(function() {
	$('#form').form({
		ajax: true,
		url: "/Admin_Login/index/",
		onSubmit: function() {
			if ($("#username").val() == "") {
				alert("用户名不能为空");
				return false;
			}
			if ($("#password").val() == "") {
				alert("密码不能为空");
				return false;
			}
			return true;
		},
		success: function(data) {
			data = JSON.parse(data);
			if (!data.success) {
				alert(data.msg);
			}
		}
	});
	$("#username").textbox({
		iconCls: 'icon-man',
		iconAlign: 'left',
		width: "70%",
		prompt: "请输入用户名",
		type: "text"
	});
	$("#password").textbox({
		iconCls: 'icon-lock',
		iconAlign: 'left',
		width: "70%",
		prompt: "请输入密码",
		type: "password"
	});
	$("#submit").linkbutton({
		iconCls: 'icon-ok'
	}).click(function() {
		$('#form').submit();
	});
});