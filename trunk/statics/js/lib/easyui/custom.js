function goback() {
	window.history.go(-1);
}

function clearForm(_id) {
	$(_id).form('clear');
}


/**
 * _id: 表单ID
 *
 * success 返回值：
 *			obj.msg: 提示消息
 *			obj.is_jump: 是否跳转,1为跳转,-1为不跳转
 *			obj.redirect: 跳转网址,空为返回上一页
 *			obj.is_clear: 是否清理表单,1为清理,-1为不清理
 *
 */
function submitForm(_id) {
	$(_id).form('submit', {
		success: function(data) {
			try {
				var obj = $.parseJSON(data);
			} catch (e) {
				alert('error');
				return;
			}
			if(obj.msg != '') {
				$.messager.alert('消息', obj.msg, 'info');
			}
			if(obj.is_jump = 1) {
				if(obj.redirect == '') {
					goback();
				} else {
					window.location.href = obj.redirect;
				}
			} else {
				if(obj.is_clear == 1) {
					$(_id).form('clear');
				}
			}
		}
	});
}

