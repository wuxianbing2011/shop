/**
 * Scroll component for yeelink index page
 */
	var Scroller = function(options){
		this.pointer = 0;
		this.lastPointer = 0;
		this.total = 0;
		this.timer = null;
		this.left = 0;
		this.playStatus = true;
		this.options = {
			container: '#partners',
			inset: 'ul',
			navBars: {
				prev: '#partners .navbar .prev',
				next: '#partners .navbar .next'
			},
			trigger: null,
			styles: null,
			contentWidth: 1440,
			containerWidth: 1140,
			stepLength: 100,
			onchange: function(pointer){},
			autoplay: false,
			total: -1
		};
		this.init(options);
	};

	Scroller.prototype = {
		init: function(options){
			for(var key in options){
				this.options[key] = options[key];
			}
			
			if(this.options.total > 0){
				this.total = this.options.total;
			}else{
				this.total = Math.floor(this.options.contentWidth / this.options.containerWidth);
			}
			
			this.panel = $(this.options.container);
			this.initUI();
			this.initEvents();
			if(this.options.autoplay){
				this.play();
			}
		},
		
		play: function(){
			if(!this.playStatus){
				return;
			}
			var self = this;
			if(!this.timer){
				this.timer = setInterval(function(){
					if(!self.next()){
						self.go(0);
					}
				}, 3000);
			}
			
		},
		
		pause: function(){
			clearInterval(this.timer);
			this.timer = null;
		},
		
		stop: function(){
			this.playStatus = false;
			this.pause();
		},
		
		replay: function(){
			this.playStatus = true;
			this.play();
		},
		initUI: function(){
			this.$insetContent = $(this.options.container).find(this.options.inset);
			this.$insetContent.css({position: 'relative', width: this.options.contentWidth, left: 0});
			this.checkNavbarStatus();
			if(this.options.trigger){
				$(this.options.trigger).each(function(index){
					this.sIndex = index;
				});
			}
			
		},
		initEvents: function(){
			var self = this;
			this.panel.find(this.options.navBars.prev).click(function(e){
				self.prev();
				e.preventDefault();
			});

			this.panel.find(this.options.navBars.next).click(function(e){
				self.next();
				e.preventDefault();
			});
			
			if(this.options.trigger){
				this.panel.find(this.options.trigger).click(function(){
					var index = this.sIndex;
					self.go(index);
				});
			}
			
			if(this.options.autoplay){
				this.panel.hover(function(){
					self.pause();
				}, function(){
					self.play();
				});
			}
		},

		show: function(left){
			var self = this;
			this.$insetContent.animate({left: left}, function(){
				self.checkNavbarStatus();
			});
		},
		
		checkNavbarStatus: function(){
			if(!this.canPrev()){
				$(this.options.navBars.prev).addClass('disable');
			}else{
				$(this.options.navBars.prev).removeClass('disable');
			}
			
			if(!this.canNext()){
				$(this.options.navBars.next).addClass('disable');
			}else{
				$(this.options.navBars.next).removeClass('disable');
			}
		},
		
		go: function(index){
			this.left = -this.options.containerWidth * index;
			this.show(this.left);
			this.pointer = index;
			this.options.onchange.call(this, index);
		},

		prev: function(){
			if(this.left < 0){
				this.left += this.options.stepLength;
				(this.left > 0) && (this.left = 0);
				this.show(this.left);
				this.pointer--;
				this.options.onchange.call(this, this.pointer);
				return true;
			}else{
				this.go(this.total - 1);
			}
			
			return false;
		},
		next: function(){
			var width = this.options.contentWidth;
			var boxWidth = this.options.containerWidth;
			if(this.left > - width + boxWidth){
				this.left -= this.options.stepLength;
				(this.left <  boxWidth - width) && (this.left = - width + boxWidth);
				this.show(this.left);
				this.pointer++;
				this.options.onchange.call(this, this.pointer);
				return true;
			}else{
				this.go(0);
			}
			
			return false;
		},
		
		canPrev: function(){
			if(parseInt(this.$insetContent.css('left')) == 0){
				return false;
			}
			return true;
		},
		
		canNext: function(){
			if(parseInt(this.$insetContent.css('left')) <= this.options.containerWidth - this.options.contentWidth){
				return false;
			}
			return true;
		}
	};
