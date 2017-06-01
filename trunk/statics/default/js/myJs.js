function tabOver1(tabHover,tabCon){
	tabHover.mouseover(function(){
		tabHover.removeClass("hovertab_jb");
		$(this).addClass("hovertab_jb");
		tabCon.hide();
		tabCon.eq($(this).index()).show();
	})	
}
$(function(){
	tabOver1($("#tab_bg li"),$(".zjjs_con1"));
})




$(function(){
	var BUTTON_SHOW_CLASS="on";
	var c_left1=$("#c_left1");
	c_left1.button=c_left1.find("li");
	c_left1.img=c_left1.find("#c_left1_img");
	c_left1.txt=c_left1.find("#c_left1_text");
	c_left1.link=new Array();
	c_left1.link.push(c_left1.find("#c_left1_link"));
	c_left1.link.push(c_left1.img.parent());
	
	c_left1.options={};
	c_left1.options.index=0;
	c_left1.options.timeout=1*1000;
	c_left1.options.timer=null;
	c_left1.options.size=c_left1.button.size();
	
	c_left1.link.update=function(link){
			var len=c_left1.link.length;
			for(var i = 0; i < len ;i++){
				c_left1.link[i].attr('href', link);
				}
		}
	
	c_left1.set=function(index){
		var obj=c_left1.button.eq(index);
		var link=obj.attr("link");
		var txt=obj.attr("text");
		var img=obj.find("img").attr("src");
		
		c_left1.txt.text(txt);
		c_left1.link.update(link);
		c_left1.img.attr("src",img);
		
		c_left1.button.removeClass(BUTTON_SHOW_CLASS);
		obj.addClass(BUTTON_SHOW_CLASS);
		}
	c_left1.mousemove(function(){
		clearInterval(c_left1.options.timer)
		}).mouseout(function(){
			c_left1.setTimer();
			});
		
	c_left1.addEvent=function(){
		c_left1.button.unbind('mousemove');
		c_left1.button.bind('mouseover',function(){
				var index=$(this).index();
				c_left1.set(index);
				c_left1.options.index=index;
			});
		}
	c_left1.setTimer=function(){
		c_left1.options.timer=setInterval(function(){
			c_left1.options.index++;
			if(c_left1.options.index>=c_left1.options.size){
				c_left1.options.index=0;
				}
				c_left1.set(c_left1.options.index);
			},c_left1.options.timeout);
		}
		
	c_left1.set(c_left1.options.index);
	c_left1.setTimer();	
	c_left1.addEvent();
});

