
	var WindowProperties=function(){};
	WindowProperties.prototype={GetWindowScrollTop:function(){var a=$(window).scrollTop();return a;},GetWindowClientHeight:function(){var a=$(window).height();return a;},GetWindowClientWidth:function(){var a=$(window).width();return a;}};
		
	var PopUp=function(a){this._window=new WindowProperties();
this.SetOptions(a);this.Marks=$(this.options.Marks);this.Wrapper=$("#"+this.options.Wrapper);this.Pointer=$("#"+this.options.Pointer);this._Pointer_width=this.Pointer.outerWidth();this._Marks_height=this.Marks.height();this._Marks_width=this.Marks.outerWidth();this._Wrapper_height=this.Wrapper.outerHeight();
this._Wrapper_width=this.Wrapper.outerWidth();this._img=new Image();this.BigImage=$("#"+this.options.BigImage);this.ImgSrc=[];this.ImgWidth=this.options.ImgWidth;this.ImgHeight=this.options.ImgHeight;this.LoadingSrc=this.options.LoadingSrc;this.loadingImage=$('<img alt="loading..." title="picture loading..." src="'+this.LoadingSrc+'" />');
this.Link=$(this.options.Link);this.ImageLink=$("#"+this.options.ImageLink);};PopUp.prototype={SetOptions:function(a){this.options={Marks:".load_list",Link:".mainright .pro_link",Wrapper:"pop",Pointer:"pointer",BigImage:"BigImage",ImageLink:"ImgLink",ImgWidth:263,ImgHeight:263,LoadingSrc:"loading.gif"};
$.extend(this.options,a||{});},SetPosition:function(){var b=this;for(var a=0;a<this.Marks.length;a++){(function(){var c=a;$(b.Marks[c]).mouseover(function(){var h=b._window.GetWindowScrollTop();var f=b._window.GetWindowClientHeight();var k=b._window.GetWindowClientWidth();var j=$(b.Marks[c]).offset().top;
var l=$(b.Marks[c]).offset().left;var e=f-(j-h);var d=j-(b._Wrapper_height-e);var g=k-l;b.Pointer.css({top:parseInt(j+b._Marks_height/2)+"px"});if(e>b._Wrapper_height){b.Wrapper.css({top:parseInt(j)+"px"});}else{b.Wrapper.css({top:parseInt(d)+"px"});}if(g>b._Wrapper_width){b.Pointer.removeClass("ri");
b.Wrapper.removeClass("ri");b.Pointer.css({left:parseInt(l+b._Marks_width)+"px"});b.Wrapper.css({left:parseInt(l+b._Marks_width)+"px"});}else{b.Pointer.addClass("ri");b.Wrapper.addClass("ri");b.Pointer.css({left:parseInt(l-b._Marks_width/8)+"px"});b.Wrapper.css({left:parseInt(l-b._Wrapper_width-b._Marks_width/8+21)+"px"});
}});b.Marks[c].onclick=function(){};})();}},LoadImage:function(){var b=this;for(var a=0;a<this.Marks.length;a++){this.ImgSrc.push($(this.Marks[a]).attr("name"));(function(){var c=a;$(b.Marks[c]).bind("mouseenter",function(){b.ImageLink.attr("href","#blank");b.BigImage.attr("src","blank.gif");
b.BigImage.hide();b.BigImage.after(b.loadingImage);$(b._img).load(function(){if(b._img.width==0||b._img.height==0){return;}b.PreLoad(b._img.src,$(b.Link[c]).attr("href"));this._img=new Image();});b._img.src=b.ImgSrc[c];});})();}},PreLoad:function(){this.AutoScaling();this.BigImage.attr("src",arguments[0]);
this.loadingImage.remove();this.BigImage.show();this.ImageLink.attr("href",arguments[1]);},AutoScaling:function(){if(this._img.width>0&&this._img.height>0){if(this._img.width/this._img.height>=this.ImgWidth/this.ImgHeight){if(this._img.width>this.ImgWidth){this.BigImage.width(this.ImgWidth);this.BigImage.height((this._img.height*this.ImgWidth)/this._img.width);
}else{this.BigImage.width(this._img.width);this.BigImage.height(this._img.height);}}else{if(this._img.height>this.ImgHeight){this.BigImage.height(this.ImgHeight);this.BigImage.width((this._img.width*this.ImgHeight)/this._img.height);}else{this.BigImage.width(this._img.width);this.BigImage.height(this._img.height);
}}}this._img=new Image();},Start:function(){this.SetPosition();this.LoadImage();var b=this;for(var a=0;a<this.Marks.length;a++){$(this.Marks[a]).bind("mouseenter",function(){b.Wrapper.css({display:"block"});b.Pointer.css({display:"block"});}).bind("mouseleave",function(){b.Wrapper.css({display:"none"});
b.Pointer.css({display:"none"});});}this.Pointer.bind("mouseenter",function(){b.Wrapper.css({display:"block"});b.Pointer.css({display:"block"});}).bind("mouseleave",function(){b.Wrapper.css({display:"none"});b.Pointer.css({display:"none"});});this.Wrapper.bind("mouseenter",function(){b.Wrapper.css({display:"block"});
b.Pointer.css({display:"block"});}).bind("mouseleave",function(){b.Wrapper.css({display:"none"});b.Pointer.css({display:"none"});});}};

function skustyle(){
	var c=new PopUp();
	c.Start();
	if(!!document.getElementById("boxclass"))
	{
		var d=new LazyLoad({container:"boxclass",childs:".lazyload",ImgWidth:104,ImgHeight:104,isZoom:true});
	}

}

$(document).ready(
				  function(){
					  skustyle();
				  });