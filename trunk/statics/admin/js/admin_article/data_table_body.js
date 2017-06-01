$(function() {
	function checkReommand() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length > 1 || selections.length == 0) {
			$("#recommand").linkbutton("disable");
		} else {
			$("#recommand").linkbutton("enable");
		}
	}

	function checkUnreommand() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length > 1 || selections.length == 0) {
			$("#unrecommand").linkbutton("disable");
		} else {
			$("#unrecommand").linkbutton("enable");
		}
	}

	function checkEdit() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length > 1 || selections.length == 0) {
			$("#editbar").linkbutton("disable");
		} else {
			$("#editbar").linkbutton("enable");
		}
	}

	function checkDelete() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length <= 0) {
			$("#deletebar").linkbutton("disable");
		} else {
			$("#deletebar").linkbutton("enable");
		}
	}

	function doCallback(callback) {
		var row = $('#data_table_body').datagrid("getSelected");
		var rowindex = $('#data_table_body').datagrid("getRowIndex", row);
		var selections = $('#data_table_body').datagrid("getSelections");
		callback.call(this, row, rowindex, selections);
	}
	$('#data_table_body').datagrid({
		url: '/Admin_Article/get_list/',
		queryParams: {
			"typeid": 1
		},
		nowrap: true,
		width: 1562,
		pagination: true,
		pagePosition: "bottom",
		pageNumber: 1,
		pageSize: 20,
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
				field: 'title',
				title: '文章标题',
				width: 200,
				align: 'center',
				formatter: function(value, row) {
					if (row.recommand == 1) {
						return "<span style='color:blue'>" + value + "</span>";
					} else {
						return value;
					}
				}
			}, {
				field: 'dir',
				title: '媒体',
				width: 120,
				align: 'center'
			}, {
				field: 'pc_url',
				title: '文章地址',
				width: 200,
				align: 'center',
				formatter: function(value) {
					return "<a href='" + value + "' target='_blank'>" + value + "</a>";
				}
			}, {
				field: 'm_url',
				title: '手机地址',
				width: 200,
				align: 'center',
				formatter: function(value) {
					return "<a href='" + value + "' target='_blank'>" + value + "</a>";
				}
			}, {
				field: 'addtime',
				title: '发布时间',
				width: 180,
				align: 'center'
			}, {
				field: 'status',
				title: '状态',
				width: 80,
				align: 'center'
			}]
		],
		toolbar: [{
			iconCls: "icon-add",
			text: "添加",
			id: "addbar",
			disabled: false,
			handler: function() {
				$("#window").window({
					title: "添加内容",
					width: 800,
					height: 500,
					closed: true,
					minimizable: false,
					maximizable: false,
					collapsible: false,
					href: "/Admin_Article/add/",
					doSize: true,
					modal: true
				}).window("open");
			}
		}, {
			iconCls: "icon-edit",
			text: "修改",
			id: "editbar",
			disabled: true,
			handler: function() {
				var id = $('#data_table_body').datagrid("getSelected").id;
				$("#window").window({
					title: "添加内容",
					width: 800,
					height: 500,
					closed: true,
					minimizable: false,
					maximizable: false,
					collapsible: false,
					href: "/Admin_Article/edit/?id="  + id,
					doSize: true,
					modal: true
				}).window("open");
			}
		}, {
			iconCls: "icon-cancel",
			text: "删除",
			id: "deletebar",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					if (!confirm("真的要删除么？")) {
						return;
					}
					var options = [];
					for (var i = 0; i < selections.length; i++) {
						options.push({
							id: selections[i].id,
							uid: selections[i].uid,
							status: -2
						});
					}
					$.post("/Admin_Article/delete/", {
						"options": options
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						}else{
							alert(data.msg);
						}
					});
				});
			}
		}, {
			iconCls: "icon-ok",
			text: "推荐",
			id: "recommand",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					var uid = selections[0].uid;
					$.post("/Admin_Article/recommand/", {
						id: id,
						uid: uid,
						status: 1
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						} else {
							alert(data.msg);
						}
					});
				});
			}
		}, {
			iconCls: "icon-cancel",
			text: "取消推荐",
			id: "unrecommand",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					var uid = selections[0].uid;
					$.post("/Admin_Article/recommand/", {
						id: id,
						uid: uid,
						status: 0
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						} else {
							alert(data.msg);
						}
					});
				});
			}
		}],
		onSelect: function(rowIndex, rowData) {
			checkReommand.call(this);
			checkUnreommand.call(this);
			checkEdit.call(this);
			checkDelete.call(this);
		},
		onUnselect: function(rowIndex, rowData) {
			checkReommand.call(this);
			checkUnreommand.call(this);
			checkEdit.call(this);
			checkDelete.call(this);
		}
	});
});