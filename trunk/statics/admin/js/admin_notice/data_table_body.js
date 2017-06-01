$(function() {
	function checkEdit() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length > 1 || selections.length == 0) {
			$("#editbar").linkbutton("disable");
			$("#topbar").linkbutton("disable");
			$("#notopbar").linkbutton("disable");
		} else {
			$("#editbar").linkbutton("enable");
			$("#topbar").linkbutton("enable");
			$("#notopbar").linkbutton("enable");
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
		url: '/Admin_Notice/get_list/',
		queryParams: {
			"typeid": 1
		},
		nowrap: true,
		width: 1562,
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
				field: 'title',
				title: '标题',
				width: 80,
				align: 'center'
			}, {
				field: 'addtime',
				title: '添加时间',
				width: 80,
				align: 'center'
			},{
				field: 'top',
				title: '置顶',
				width: 80,
				align: 'center',
				formatter: function(value){
					if(value==1){
							return "是";
					}else{
						return "否";
					}
				}
			}]
		],
		toolbar: [{
			iconCls: "icon-add",
			text: "添加",
			id: "addbar",
			handler: function() {
				$('#addbar').attr('href', '/Admin_Notice/add/');
			}
		}, {
			iconCls: "icon-edit",
			text: "修改",
			id: "editbar",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$('#editbar').attr('href', '/Admin_Notice/edit/?id=' + id);
				});
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
					var ids = [];
					for (var i = 0; i < selections.length; i++) {
						ids.push(selections[i].id);
					}
					$.post("/Admin_Notice/delete/", {
						"ids": ids
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						}
					});
				});
			} 
		},{
			iconCls: "icon-edit",
			text: "置顶",
			id: "topbar",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_Notice/top/", {
						"id": id
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						}
					});
				});
			}
		},{
			iconCls: "icon-edit",
			text: "取消置顶",
			id: "notopbar",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].id;
					$.post("/Admin_Notice/notop/", {
						"id": id
					}, function(data) {
						if (data.success) {
							$("#data_table_body").datagrid("reload");
						}
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