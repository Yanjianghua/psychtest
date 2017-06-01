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
			$("#setUseAdv1").linkbutton("disable");
			$("#setUseAdv2").linkbutton("disable");
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
			$("#setUseAdv1").linkbutton("enable");
			$("#setUseAdv2").linkbutton("enable");
		}
	}

	function checkDelete() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length <= 0) {
			$("#deletebar").linkbutton("disable");
			$("#enablebar").linkbutton("disable");
		} else {
			$("#deletebar").linkbutton("enable");
			$("#enablebar").linkbutton("enable");
		}
	}

	function doCallback(callback) {
		var row = $('#data_table_body').datagrid("getSelected");
		var rowindex = $('#data_table_body').datagrid("getRowIndex", row);
		var selections = $('#data_table_body').datagrid("getSelections");
		callback.call(this, row, rowindex, selections);
	}
	$('#data_table_body').datagrid({
		url: '/Admin_User/get_list/',
		nowrap: true,
		width: "100%",
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
				formatter: function(val, row) {
					var style = "";
					if (row.gooduser == 1) {
						style += "background:blue; color:#FFF;";
					}
					if (row.inneruser == 1) {
						style += "color:red;";
					}
					if (row.uselink == 1) {
						style += "border:3px solid yellow;";
					}
					return "<a href='" + row.loginurl + "' style='" + style + "' target='_blank'>" + val + "</a>";
				}
			}, {
				field: 'truename',
				title: '真实姓名',
				width: 120,
				align: 'center'
			}, {
				field: 'remain',
				title: '剩余文章数',
				width: 80,
				align: 'center'
			}, {
				field: 'added_num',
				title: '已添加文章数',
				width: 80,
				align: 'center'
			}, {
				field: 'published',
				title: '已发布文章数',
				width: 80,
				align: 'center'
			}, {
				field: 'num',
				title: '总文章数',
				width: 80,
				align: 'center'
			}, {
				field: 'time',
				title: '最后登录时间',
				width: 120,
				align: 'center'
			}, {
				field: 'loginip',
				title: '最后登录IP',
				width: 80,
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
			}, {
				field: 'Third_adv',
				title: '第三方广告',
				width: 80,
				align: 'center',
				formatter: function(val) {
					if (val == 0) {
						return "百度";
					} else {
						return "内部";
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
					href: "/Admin_User/add/",
					doSize: true,
					modal: true
				}).window("open");
			}
		}, {
			iconCls: "icon-edit",
			text: "充值",
			id: "pay",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					$("#window").window({
						title: "充值",
						width: 800,
						height: 500,
						closed: true,
						minimizable: false,
						maximizable: false,
						collapsible: false,
						href: "/Admin_User/add_coin/",
						doSize: true,
						modal: true,
						queryParams: {
							id: row.id
						}
					}).window("open");
				});
			}
		}, {
			iconCls: "icon-search",
			text: "充值记录",
			id: "paylog",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					$("#window").window({
						title: "充值记录",
						width: 800,
						height: 500,
						closed: true,
						minimizable: false,
						maximizable: false,
						collapsible: false,
						href: "/Admin_User/add_log/",
						doSize: true,
						modal: true,
						queryParams: {
							id: row.id
						}
					}).window("open");
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
					$.post("/Admin_User/status/", {
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
					$.post("/Admin_User/status/", {
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
		}, {
			iconCls: "icon-cancel",
			text: "取消内部帐号",
			id: "deleteinneruser",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_User/setInneruser/", {
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
			text: "内部账号",
			id: "setinneruser",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_User/setInneruser/", {
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
		}, {
			iconCls: "icon-cancel",
			text: "取消重点帐号",
			id: "deletegooduser",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_User/setGooduser/", {
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
			text: "重点账号",
			id: "setgooduser",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_User/setGooduser/", {
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
		}, {
			iconCls: "icon-cancel",
			text: "取消允许链接",
			id: "deleteUseLink",
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_User/setUseLink/", {
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
			text: "允许链接",
			id: "setUseLink",
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_User/setUseLink/", {
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
		}, {
			iconCls: "icon-reload",
			text: "密码重置",
			id: "reset",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					$("#window").window({
						title: "密码重置",
						width: 800,
						height: 500,
						closed: true,
						minimizable: false,
						maximizable: false,
						collapsible: false,
						href: "/Admin_User/reset/",
						doSize: true,
						modal: true,
						queryParams: {
							id: row.id
						}
					}).window("open");
				});
			}
		}, {
			iconCls: "icon-edit",
			text: "设置媒体",
			id: "setmedia",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					$("#window").window({
						title: "设置媒体",
						width: 1000,
						height: 500,
						closed: true,
						minimizable: false,
						maximizable: false,
						collapsible: false,
						href: "/Admin_User/media/",
						doSize: true,
						modal: true,
						queryParams: {
							id: row.id
						}
					}).window("open");
				});
			}
		},
		//	{
		//	iconCls: "icon-edit",
		//	text: "广告重置",
		//	id: "resetad",
		//	disabled: true,
		//	handler: function() {
		//		doCallback(function(row, rowindex, selections) {
		//			$("#window").window({
		//				title: "广告设置",
		//				width: 800,
		//				height: 500,
		//				closed: true,
		//				minimizable: false,
		//				maximizable: false,
		//				collapsible: false,
		//				href: "/Admin_User/ad/",
		//				doSize: true,
		//				modal: true,
		//				queryParams: {
		//					id: row.id
		//				}
		//			}).window("open");
		//		});
		//	}
		//},
			{
			iconCls: "icon-edit",
				text: "内部广告",
			id: "setUseAdv1",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_User/setUseAdv/", {
						"id": id,
						"Third_adv": 1
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						}
						alert(data.msg);
					});
				});
			}
		}, {
			iconCls: "icon-edit",
			text: "百度广告",
			id: "setUseAdv2",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_User/setUseAdv/", {
						"id": id,
						"Third_adv": 0
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