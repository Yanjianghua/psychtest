function printf() {
	var num = arguments.length;
	var oStr = arguments[0].content;
	for (var i = 1; i < num; i++) {
		var pattern = "\\{" + (i - 1) + "\\}";
		var re = new RegExp(pattern, "g");
		oStr = oStr.replace(re, arguments[i]);
	}
	return oStr;
}

function jsonpcallback(response) {
	if (response && response.success) {
		var data = response.data.data;
		for (var k in data) {
			if (typeof AD[k] == "undefined") {
				continue;
			}
			var varsGroup = [];
			var vars = [AD[k]];
			var ismutiple = false;
			for (var kk in data[k]) {
				if (typeof data[k][kk] != "string") {
					ismutiple = data[k][kk].length;
					break;
				}
				vars.push(data[k][kk]);
			}
			if (ismutiple) {
				for (var i = 0; i < ismutiple; i++) {
					var vars = [AD[k]];
					var iswrrong = false;
					var vardata = "";
					for (var kk in data[k]) {
						if (kk == "pics") {
							vardata = data[k][kk]["a" + i];
						} else {
							vardata = data[k][kk][i];
						}
						if (vardata == "") {
							iswrrong = true;
						}
						vars.push(vardata);
					}
					if (typeof AD[k].staticvar != "undefined") {
						vars.push(AD[k].staticvar[i]);
					}
					if (iswrrong) {
						continue;
					}
					varsGroup.push(vars);
				}
			} else {
				varsGroup.push(vars);
			}
			var html = AD[k].prefix;
			for (var i = 0; i < varsGroup.length; i++) {
				html += printf.apply(this, varsGroup[i]);
			}
			html += AD[k].suffix;
			$(html).appendTo("[adid=" + k + "]");
			if (typeof AD[k].callback == "function") {
				AD[k].callback();
			}
		}
	}
}
var uid = $("#ad").data("uid");
var url = $("#ad").data("url");
var typeid = $("#ad").data("typeid");
var AD = {
	1: {
		prefix: '',
		content: '<div class="wen_zj">\
					<a href="{0}">\
						<input class="wen_zj_sr" type="text" value="请输入问题..." />\
						<input class="wen_zj_ok" type="button" value="问专家">\
					</a>\
				</div>',
		suffix: ''
	},
	2: {
		prefix: '',
		content: '<div class="clear20"></div>\
				<div class="zhuan_jia">\
					<span><a href="{4}" target="_blank"><img alt="广告" src="{5}"></a></span>\
					<div class="zj_xx">\
						<h2><a href="{4}" target="_blank">{0}</a></h2>\
						<p>{1}...<a href="{4}" target="_blank">[详细]</a></p>\
					</div>\
					<div style="width:100%; height:10px;"></div>\
					<div class="zx_gh">\
						<button class="ws_zx" onclick="window.open(\'{2}\',\'_blank\')">网上咨询</button>\
						<button class="ly_gh" onclick="window.open(\'{3}\',\'_blank\')">来院挂号</button>\
					</div>\
				</div>',
		suffix: ''
	},
	3: {
		prefix: '',
		content: '<div class="wzs_ggt">\
						<a href="{0}"><img alt="广告" src="{1}" width="660" height="90"></a>\
					</div>',
		suffix: ""
	},
	4: {
		prefix: '',
		content: '<div class="clear20"></div><div class="my_tuijian">\
					<div class="mytj_pic">\
						<a href="{5}"><img alt="广告" width="90px" height="120px" src="{6}"></a>\
					</div>\
					<div class="mytj_txt">\
						<h3><a href="{5}" target="_blank">{0}</a></h3>\
						<h4>医院电话：{1}</h4>\
						<p>医院地址：{2}...</p>\
						<button class="yu_yue" onclick="window.open(\'{3}\',\'_blank\')" type="button">预约</button>\
						<button class="gua_hao" onclick="window.open(\'{4}\',\'_blank\')" type="button">挂号</button>\
					</div>\
				</div>',
		suffix: ""
	},
	5: {
		prefix: '',
		content: '<div class="clear20"></div>\
				<div class="c_r_gg">\
					<a href="{0}" target="_blank"><img alt="广告" width="300px" height="250px" src="{1}"></a>\
				</div>',
		suffix: ""
	},
	6: {
		prefix: '<div class="clear20"></div>\
				<div class="ks_zx">\
					<h2>快速咨询</h2>\
					<ul>',
		content: '<li><a href="{1}" target="_blank">{0}</a></li>',
		suffix: "</ul>\
				</div>"
	},
	7: {
		prefix: '<ul>',
		content: '<li><a href="{2}" target="_blank" class="ji_bing">{0}</a><b>|</b><a href="{2}" target="_blank" class="biao_ti">{1}</a><span><a href="{2}" target="_blank">提问</a></span></li>',
		suffix: "</ul>",
		callback: function() {
			$(".wzx").show();
		}
	},
	8: {
		prefix: '',
		content: '<a href="{0}" target="_blank"><img alt="广告" src="{1}"></a>',
		suffix: '',
		callback: function() {
			$(".wzx").show();
		}
	},
	9: {
		prefix: '',
		content: '<div class="clear20"></div>\
			<div class="c_r_gg">\
					<a href="{0}" target="_blank"><img alt="广告" width="300px" height="250px" src="{1}"></a>\
				</div>',
		suffix: ''
	},
	11: {
		prefix: '<div class="art_banner">',
		content: '<a href="{0}" target="_blank"><img src="{1}" width="320" height="90"></a>',
		suffix: "</div>"
	},
	12: {
		prefix: '<div class="wzxan">',
		content: '<a href="{0}" target="_blank">免费问专家</a>',
		suffix: "</div>"
	},
	13: {
		prefix: '<div class="clear"></div>\
		<div class="kongxi"></div>\
		<div class="bdfzl">\
			<ul>',
		content: '<li>\
						<a href="{1}" target="_blank">{0}</a>\
					</li>',
		suffix: "</ul>\
		</div>",
		callback: function() {
			$(".bdfzl li").each(function(i) {
				if (i % 3 == 2) {
					$(this).css("margin-right", "auto");
				}
			});
		}
	},
	14: {
		prefix: '',
		content: '<div class="clear"></div>\
		<div style="width:100%; height:24px;"></div>\
			<div class="yyyy">\
			<div class="yyyyl">\
				<a href="{5}" target="_blank"><img src="{6}" width="100" height="120" /></a>\
			</div>\
			<div class="yyyyr">\
				<h3><a href="{5}" target="_blank">{0}</a></h3>\
				<p>医院电话:{1}</p>\
				<p>医院地址:{2}...</p>\
				<div class="yyyygh">\
					<div class="yyyygh1"><a href="{3}" target="_blank">预约</a></div>\
					<div class="yyyygh2"><a href="{4}" target="_blank">挂号</a></div>\
				</div>\
			</div>\
		</div>',
		suffix: ""
	},
	15: {
		prefix: '',
		content: '<div class="clear"></div>\
		<div class="kongxi"></div>\
		<div class="banner">\
			<a href="{0}" target="_blank"><img src="{1}" width="320" height="90" /></a>\
		</div>',
		suffix: ""
	},
	16: {
		prefix: "",
		content: '<div class="clear"></div>\
		<div class="piaofudibu">\
			<div class="piaofudibuz">\
				<a href="{0}" target="_blank"><img src="' + url + 'statics/default/m/images/pfdb_03.jpg" /></a>\
				<a href="{1}" target="_blank"><img src="' + url + 'statics/default/m/images/pfdb_05.jpg" /></a>\
			</div>\
		</div>',
		suffix: ""
	}
}
$(function() {
	if (uid && url) {
		var new_element = document.createElement("script");
		new_element.setAttribute("type", "text/javascript");
		new_element.setAttribute("src", url + "Ad/get/" + uid + "/" + typeid + "/");
		document.body.appendChild(new_element);
	}
});