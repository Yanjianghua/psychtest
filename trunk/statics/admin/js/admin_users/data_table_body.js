$(function() {
	function checkEdit() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length > 1 || selections.length == 0) {
			$("#pay").linkbutton("disable");
			$("#paylog").linkbutton("disable");
			$("#reset").linkbutton("disable");
			$("#setmedia").linkbutton("disable");
			$("#resetad").linkbutton("disable");
			$("#setinneruser").linkbutton("disable");
			$("#deleteinneruser").linkbutton("disable");
			$("#setgooduser").linkbutton("disable");
			$("#deletegooduser").linkbutton("disable");
		} else {
			$("#pay").linkbutton("enable");
			$("#paylog").linkbutton("enable");
			$("#reset").linkbutton("enable");
			$("#setmedia").linkbutton("enable");
			$("#resetad").linkbutton("enable");
			$("#setinneruser").linkbutton("enable");
			$("#deleteinneruser").linkbutton("enable");
			$("#setgooduser").linkbutton("enable");
			$("#deletegooduser").linkbutton("enable");
		}
	}

	function checkDelete() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length <= 0) {
			$("#deletebar").linkbutton("disable");
			$("#enablebar").linkbutton("disable");
			$("#del").linkbutton("disable");
			$("#edit").linkbutton("disable");
		} else {
			$("#deletebar").linkbutton("enable");
			$("#enablebar").linkbutton("enable");
			$("#del").linkbutton("enable");
			$("#edit").linkbutton("enable");
		}
	}

	function doCallback(callback) {
		var row = $('#data_table_body').datagrid("getSelected");
		var rowindex = $('#data_table_body').datagrid("getRowIndex", row);
		var selections = $('#data_table_body').datagrid("getSelections");
		callback.call(this, row, rowindex, selections);
	}
	$('#data_table_body').datagrid({
		url: '/Admin_Users/get_list/',
		nowrap: true,
		width: 1000,
		pagination: true,
		pagePosition: "bottom",
		pageNumber: 1,
		pageSize: 10,
		pageList: [10, 20, 30, 40, 50],
		striped: true,
		ctrlSelect: true,
		columns: [
			[{
				field: 'id',
				title: 'ID',
				width: 80,
				align: 'center'
			}, {
				field: 'username',
				title: '用户名',
				width: 120,
				align: 'center',
			}, {
				field: 'rolename',
				title: '用户组',
				width: 120,
				align: 'center',
			}, {
				field: 'loginip',
				title: '登录IP',
				width: 120,
				align: 'center'
			}, {
				field: 'logintime',
				title: '登录时间',
				width: 160,
				align: 'center'
			}, {
				field: 'status',
				title: '状态',
				width: 80,
				align: 'center',
				formatter: function(val) {
					if (val == 1) {
						return "启用";
					} else {
						return "禁用";
					}
				}
			}]
		],
		toolbar: [{
			iconCls: "icon-add",
			text: "添加用户",
			id: "add",
			enable: true,
			handler: function() {
				$("#window").window({
					title: "添加用户",
					width: 800,
					height: 500,
					closed: true,
					minimizable: false,
					maximizable: false,
					collapsible: false,
					href: "/Admin_Users/add/",
					doSize: true,
					modal: true
				}).window("open");
			}
		},{
			iconCls: "icon-edit",
			text: "修改用户",
			id: "edit",
			disabled: true,
			handler: function() {
				$("#window").window({
					title: "修改用户",
					width: 800,
					height: 500,
					closed: true,
					minimizable: false,
					maximizable: false,
					collapsible: false,
					href: "/Admin_Users/edit/?id=" + $('#data_table_body').datagrid("getSelections")[0].id,
					doSize: true,
					modal: true
				}).window("open");
			}
		}, {
			iconCls: "icon-cancel",
			text: "删除用户",
			id: "del",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_Users/del/?id=" + id, {
						"id": id,
						"status": 0
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						}
						alert(data.msg);
					});
				});
			}
		}, {
			iconCls: "icon-cancel",
			text: "禁用",
			id: "deletebar",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_Users/disable/", {
						"id": id,
						"status": 0
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						}
						alert(data.msg);
					});
				});
			}
		}, {
			iconCls: "icon-ok",
			text: "启用",
			id: "enablebar",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_Users/enable/", {
						"id": id,
						"status": 1
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						}
						alert(data.msg);
					});
				});
			}
		}],
		onSelect: function(rowIndex, rowData) {
			checkEdit.call(this);
			checkDelete.call(this);
		},
		onUnselect: function(rowIndex, rowData) {
			checkEdit.call(this);
			checkDelete.call(this);
		}
	});
});