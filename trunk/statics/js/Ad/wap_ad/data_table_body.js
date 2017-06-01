$(function() {
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
		url: '/Ad/get_list/',
		queryParams: {
			"typeid": 2
		},
		nowrap: true,
		width: 602,
		pagination: true,
		pagePosition: "bottom",
		pageNumber: 1,
		pageSize: 10,
		pageList: [10, 20, 30, 40, 50],
		striped: true,
		ctrlSelect: true,
		columns: [
			[{
				field: 'name',
				title: '广告位',
				width: 200
			}, {
				field: 'addtime',
				title: '添加时间',
				width: 200
			}, {
				field: 'status',
				title: '状态',
				formatter: function(val, row, index) {
					if (val == 1) {
						return "已添加";
					}
					return "<span style='color:red;'>未添加</span>"
				},
				width: 200
			}]
		],
		toolbar: [{
			iconCls: "icon-edit",
			text: "设置",
			id: "editbar",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					$("#window").window({
						title: "设置广告",
						width: 800,
						height: 500,
						closed: true,
						minimizable: false,
						maximizable: false,
						collapsible: false,
						href: "/Ad/add/",
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
			text: "清除",
			id: "deletebar",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var ids = [];
					for (var i = 0; i < selections.length; i++) {
						ids.push(selections[i].id);
					}
					$.post("/Ad/delete/", {
						"ids": ids
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