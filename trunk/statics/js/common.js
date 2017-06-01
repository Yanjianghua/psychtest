(function($) {
	$.fn.extend({
		mask: function() {
			this.css("position", "relative");
			return this.each(function() {
				var panel = $(this);
				var mask = $("<div class=\"datagrid-mask\"></div>");
				mask.css({
					display: "block",
					width: "100%",
					height: "100%",
					position: "absolute",
					"z-index": 100000
				}).appendTo(panel);
			});
		},
		unmask: function() {
			this.css("position", "initial");
			return this.each(function() {
				var panel = $(this);
				panel.find("div.datagrid-mask-msg").remove();
				panel.find("div.datagrid-mask").remove();
			});
		}
	});
	String.prototype.strtotime = function() {
		var str = this.replace(/-/g, "/");
		return new Date(str);
	}
	Date.prototype.Format = function(formatStr) {
		var str = formatStr;
		var Week = ['日', '一', '二', '三', '四', '五', '六'];

		str = str.replace(/yyyy|YYYY/, this.getFullYear());
		str = str.replace(/yy|YY/, (this.getYear() % 100) > 9 ? (this.getYear() % 100).toString() : '0' + (this.getYear() % 100));
		var m = this.getMonth() + 1;
		str = str.replace(/MM/, m > 9 ? m.toString() : '0' + m);
		str = str.replace(/M/g, m);

		str = str.replace(/w|W/g, Week[this.getDay()]);

		str = str.replace(/dd|DD/, this.getDate() > 9 ? this.getDate().toString() : '0' + this.getDate());
		str = str.replace(/d|D/g, this.getDate());

		str = str.replace(/hh|HH/, this.getHours() > 9 ? this.getHours().toString() : '0' + this.getHours());
		str = str.replace(/h|H/g, this.getHours());
		str = str.replace(/mm/, this.getMinutes() > 9 ? this.getMinutes().toString() : '0' + this.getMinutes());
		str = str.replace(/m/g, this.getMinutes());

		str = str.replace(/ss|SS/, this.getSeconds() > 9 ? this.getSeconds().toString() : '0' + this.getSeconds());
		str = str.replace(/s|S/g, this.getSeconds());

		return str;
	}
})($);