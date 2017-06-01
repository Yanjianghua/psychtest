$(function() {
	function checkReommand() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length > 1 || selections.length == 0) {
			$("#editbar").linkbutton("disable");
			$("#new").linkbutton("disable");
			$("#hot").linkbutton("disable");
			$("#delete").linkbutton("disable");
		} else {
			$("#editbar").linkbutton("enable");
			$("#new").linkbutton("enable");
			$("#hot").linkbutton("enable");
			$("#delete").linkbutton("enable");
		}
	}

	function doCallback(callback) {
		var row = $('#data_table_body').datagrid("getSelected");
		var rowindex = $('#data_table_body').datagrid("getRowIndex", row);
		var selections = $('#data_table_body').datagrid("getSelections");
		callback.call(this, row, rowindex, selections);
	}
	$('#data_table_body').datagrid({
		url: '/Admin_Media/get_list/',
		nowrap: true,
		width: 1562,
		pagination: true,
		pagePosition: "bottom",
		pageNumber: 1,
		pageList: [10, 20, 30, 40, 50],
		pageSize: 10,
		striped: true,
		ctrlSelect: true,
		columns: [
			[{
				field: 'name',
				title: '栏目名称',
				width: 180,
				align: 'center'
			}, {
				field: 'dir',
				title: 'dir',
				width: 180,
				align: 'center',
			}]
		],
		toolbar: [{
			iconCls: "icon-edit",
			text: "修改",
			id: "editbar",
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
					href: "/Admin_Media/set_attr/?id=" + $('#data_table_body').datagrid("getSelections")[0].id,
					doSize: true,
					modal: true
				}).window("open");
			}
		}],
		onSelect: function(rowIndex, rowData) {
			checkReommand.call(this);
		},
		onUnselect: function(rowIndex, rowData) {
			checkReommand.call(this);
		}
	});
});