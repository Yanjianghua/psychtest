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
})($);