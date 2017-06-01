$(function() {
	function checkReommand() {
		var selections = $(this).datagrid("getSelections");
		if (selections.length > 1 || selections.length == 0) {
			$("#recommand").linkbutton("disable");
			$("#new").linkbutton("disable");
			$("#hot").linkbutton("disable");
			$("#delete").linkbutton("disable");
		} else {
			$("#recommand").linkbutton("enable");
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
		url: '/Admin_Statistics/get_list/',
		queryParams: {
			time: $("#time").val(),
			mid: $("#media").combobox('getValue')
		},
		nowrap: true,
		width: 1000,
		striped: true,
		ctrlSelect: true,
		pagination: true,
		pagePosition: "bottom",
		pageNumber: 1,
		pageSize: 50,
		pageList: [20, 30, 40, 50],
		columns: [
			[{
				field: 'media',
				title: '媒体名称',
				width: 180,
				align: 'center'
			}, {
				field: 'total',
				title: '发布',
				width: 80,
				align: 'center'
			}, {
				field: 'included',
				title: '收录',
				width: 80,
				align: 'center'
			}, {
				field: 'calc',
				title: '收录率',
				width: 80,
				align: 'center'
			}, {
				field: 'home',
				title: '首页排名',
				width: 80,
				align: 'center'
			}, {
				field: 'homecalc',
				title: '首页排名率',
				width: 80,
				align: 'center'
			}, {
				field: 'recommand',
				title: '推荐',
				width: 80,
				align: 'center',
				formatter: function(value) {
					if (value == 0) {
						return "普通";
					}
					if (value == 1) {
						return "<span style='color:red'>推荐</span>";
					}
				}
			}, {
				field: 'hot',
				title: '热门',
				width: 80,
				align: 'center',
				formatter: function(value) {
					if (value == 0) {
						return "普通";
					}
					if (value == 1) {
						return "<span style='color:red'>热门</span>";
					}
				}
			}, {
				field: 'new',
				title: '最新',
				width: 80,
				align: 'center',
				formatter: function(value) {
					if (value == 0) {
						return "普通";
					}
					if (value == 1) {
						return "<span style='color:red'>最新</span>";
					}
				}
			}, {
				field: 'zero',
				title: '零收录',
				width: 80,
				align: 'center',
				formatter: function(value) {
					if (value == 0) {
						return "普通";
					}
					if (value == 1) {
						return "<span style='color:blue'>零收录</span>";
					}
				}
			}]
		],
		toolbar: [{
			iconCls: "icon-ok",
			text: "推荐",
			id: "recommand",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].cid;
					var mid = selections[0].mid;
					$.post("/Admin_Media/recommand/", {
						id: id,
						mid: mid
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
			iconCls: "icon-ok",
			text: "热门",
			id: "hot",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].cid;
					var mid = selections[0].mid;
					$.post("/Admin_Media/hot/", {
						id: id,
						mid: mid
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
			iconCls: "icon-ok",
			text: "最新",
			id: "new",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].cid;
					var mid = selections[0].mid;
					$.post("/Admin_Media/news/", {
						id: id,
						mid: mid
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
			text: "清除属性",
			id: "delete",
			disabled: true,
			handler: function() {
				doCallback(function(row, rowindex, selections) {
					var id = selections[0].cid;
					var mid = selections[0].mid;
					$.post("/Admin_Media/del_attr/", {
						id: id,
						mid: mid
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
		},
		onUnselect: function(rowIndex, rowData) {
			checkReommand.call(this);
		}
	});
});