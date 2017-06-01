$(function() {
	$('#changePassword').click(function() {
		$("#changePasswordWin").window({
			width: 600,
			height: 400,
			modal: true,
			minimizable: false,
			title: "修改密码"
		});
	});
	$('#form').form({
		ajax: true,
		url: "/Login/changePassword/",
		onSubmit: function() {
			if ($("#oldpassword").val() == "") {
				alert("旧密码不能为空");
				return false;
			}
			if ($("#password").val() == "") {
				alert("新密码不能为空");
				return false;
			}
			if ($("#repassword").val() == "") {
				alert("确认密码不能为空");
				return false;
			}
			return true;
		},
		success: function(data) {
			data = JSON.parse(data);
			if (data.success) {
				alert("修改成功");
				$("#changePasswordWin").window("close");
				$('#form').form("clear");
			} else {
				alert(data.msg);
			}
		}
	});
	$("#oldpassword").textbox({
		iconCls: 'icon-lock',
		iconAlign: 'left',
		width: "70%",
		prompt: "请输入旧密码",
		type: "password"
	});
	$("#password").textbox({
		iconCls: 'icon-lock',
		iconAlign: 'left',
		width: "70%",
		prompt: "请输入新密码",
		type: "password"
	});
	$("#repassword").textbox({
		iconCls: 'icon-lock',
		iconAlign: 'left',
		width: "70%",
		prompt: "请重新输入新密码",
		type: "password"
	});
	$("#submit").linkbutton({
		iconCls: 'icon-ok'
	}).click(function() {
		$('#form').submit();
	});
});