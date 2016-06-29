/**
 * @author DK
 * @date 2013-5-7 
 */

	var Tab = function(options){
		this._initTab(options);
	}
	
	Tab.prototype = {
		_initTab: function(options){
			this.options = mix({
				s_container: '',
				s_tab: '',
				s_content: '',
				fireevent: 'click',
				ontabselect: function(e){},
				onshow: function(e){},
				selectClass: 'select'
			}, options);
			this.panel = $(this.options.s_container);
			this.selectedIndex = 0;
			this._initTabUI();
			this._initTabEvents();
		},
		
		_initTabUI: function(){
			this.panel.find(this.options.s_tab).each(function(index){
				this.tabindex = index;
			});
			this.panel.find(this.options.s_content).hide();
			this.show(this.selectedIndex);
		},
		
		_initTabEvents: function(){
			var self = this;
			this.panel.find(this.options.s_tab).bind(this.options.fireevent, function(e){
				var index = this.tabindex;
				self.options.ontabselect({index: index});
				self.show(index);
			});
		},
		
		show: function(index){
			this.panel.find(this.options.s_tab + ':eq(' + this.selectedIndex + ')').removeClass(this.options.selectClass);
			this.panel.find(this.options.s_tab + ':eq(' + index + ')').addClass(this.options.selectClass);
			this.panel.find(this.options.s_content + ':eq(' + this.selectedIndex + ')').hide();
			this.panel.find(this.options.s_content + ':eq(' + index + ')').show();
			var event = {
				prevIndex: this.selectedIndex,
				index: index
			}
			this.selectedIndex = index;
			this.options.onshow(event);
		}
	};
	
	var tab = function(options){
		var containers = $(options.s_container);
		containers.each(function(index){
			var newOptions = {};
			for(var key in options){
				newOptions[key] = options[key];
			}
			newOptions.s_container = options.s_container + ':eq(' + index + ')';
			new Tab(newOptions);
		});
	};
	
