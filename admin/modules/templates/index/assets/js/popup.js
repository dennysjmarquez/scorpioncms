+function ($) {

    // POPUP CLASS DEFINITION
    // ============================

    var Popup = function(element, options) {
        var self = this
        this.options    = options
        this.$el        = $(element)
        this.$container = null
        this.$modal     = null
        this.$backdrop  = null
        this.isOpen     = false
        this.firstDiv   = null
        this.allowHide  = true

        this.$container = this.createPopupContainer()
        this.$content = this.$container.find('.modal-content:first')
        this.$modal = this.$container.modal({ show: false, backdrop: false, keyboard: this.options.keyboard })

		
		
        /*
         * Duplicate the popup reference on the .control-popup container
         */
        this.$container.data('scorpio.popup', this)
		
		
		

        /*
         * Hook in to BS Modal events
         */
		 
		
		 
        this.$modal.on('hide.bs.modal', function(){
			
            self.triggerEvent('hide.scorpio.popup')
            self.isOpen = false
            
        })

        this.$modal.on('hidden.bs.modal', function(){
            self.triggerEvent('hidden.scorpio.popup')
            self.$container.remove()
            self.$el.data('scorpio.popup', null)
            $(document.body).removeClass('modal-open')
        })

        this.$modal.on('show.bs.modal', function(){
            self.isOpen = true
            
            $(document.body).addClass('modal-open')
			

			
        })

        this.$modal.on('shown.bs.modal', function(){
            self.triggerEvent('shown.scorpio.popup')
        })

        this.$modal.on('close.scorpio.popup', function(){
			
            self.hide()
            return false
        })

		
        this.init()
		
		
		
		
    }

    Popup.DEFAULTS = {
        ajax: null,
        handler: null,
        keyboard: true,
        extraData: {},
        content: null,
        size: null,
        adaptiveHeight: false,
        zIndex: null,
		scrollcontainer: null,
		title: null,
		type: 'GET'
    }

	
	Popup.prototype.ajax = function(url1){

		var self = this
		self.triggerEvent('hide.scorpio.popup');
		
		$.ajax({
			url: url1,
			timeout: 30000, // throw an error if not completed after 30 sec.
			data: self.options.extraData,
			type: self.options.type,
			cache: true
		}).always( function() {
			
		}).done( function( response, textStatus, jqXHR ) {

			self.setContent(response);
			
			if (this.options.title !== null){
				
				$('.modal-title').html(this.options.title);
				
			}
				
		}).fail( function( jqXHR, textStatus, error ) {
			

			$.sc_cms.ajaxErrorMessage(jqXHR.responseText, error);
			
			
		});
	
	
	}

    Popup.prototype.init = function(){
        var self = this
		
        /*
         * Do not allow the same popup to open twice
         */
        if (self.isOpen)
            return

        if (this.options.ajax) {
			
			
			
			$.ajax({
				url: self.options.ajax,
				timeout: 30000, // throw an error if not completed after 30 sec.
				data: self.options.extraData,
				type: self.options.type,
				cache: true
			}).always( function() {
				
				
			
			}).done( function( response, textStatus, jqXHR ) {
				
				var newInterval;

				if ( ! response ) {
					
					return;
				}

				if ( response.nonces_expired ) {
					//$document.trigger( 'heartbeat-nonces-expired' );
				}

				// Change the interval from PHP
				if ( response.heartbeat_interval ) {
					newInterval = response.heartbeat_interval;
					delete response.heartbeat_interval;
				}

				self.setContent(response);
				
				if (self.options.title !== null){
				
					$('.modal-title').html(self.options.title);
				
				}
				
			}).fail( function( jqXHR, textStatus, error ) {
				
				
				$.sc_cms.ajaxErrorMessage(jqXHR.responseText, error);

			
			})
			

        }

        /*
         * Specified content
         */
        else if (this.options.content) {

            var content = typeof this.options.content == 'function'
                ? this.options.content.call(this.$el[0], this)
                : this.options.content

            this.setContent(content)
        }
    }

    Popup.prototype.createPopupContainer = function() {
        var
            modal = $('<div />').prop({
                class: 'control-popup modal fade',
                role: 'dialog',
                tabindex: -1
            }),
            modalDialog = $('<div />').addClass('modal-dialog'),
            modalContent = $('<div />').addClass('modal-content')
			modalHeader = $('<div />').addClass('modal-content')

        if (this.options.size)
            modalDialog.addClass('size-' + this.options.size)

        if (this.options.adaptiveHeight)
            modalDialog.addClass('adaptive-height')

        if (this.options.zIndex !== null)
            modal.css('z-index', this.options.zIndex + 20)

        return modal.append(modalDialog.append(modalContent))
    }

    Popup.prototype.setContent = function(contents) {
		
			
        this.$content.html(contents)
        this.show()
		/*
		var scrollcontainer = this.options.scrollcontainer;
		
			if(scrollcontainer !== null){
					
				$(scrollcontainer).slimscroll({
					height: "auto",
					distance: '2px',
					color: '#aaa',
					borderRadius: "5px",
					railBorderRadius: "5px",
					opacity: 0.7
				});
					
			}
			
			
		var throttled = false;
			
		window.addEventListener('resize', function() {
		 
			if (!throttled) {
			
					$(scrollcontainer).slimscroll({
						height: "auto"
					});
			
				throttled = true;
			
				setTimeout(function() {
					throttled = false;
				}, 250);
		
			
			}
		
		});
			*/
        // Duplicate the popup object reference on to the first div
        // inside the popup. Eg: $('#firstDiv').popup('hide')
        this.firstDiv = this.$content.find('>div:first')
        if (this.firstDiv.length > 0)
            this.firstDiv.data('scorpio.popup', this)

        var $defaultFocus = $('[default-focus]', this.$content)
        if ($defaultFocus.is(":visible"))
        {
            window.setTimeout(function() {
                $defaultFocus.focus()
                $defaultFocus = null
				
            }, 300)
        }
    }

    Popup.prototype.triggerEvent = function(eventName, params) {
        if (!params)
            params = [this.$el, this.$modal]

        var eventObject = jQuery.Event(eventName, { relatedTarget: this.$container.get(0) })

        this.$el.trigger(eventObject, params)

        if (this.firstDiv)
            this.firstDiv.trigger(eventObject, params)
    }

    Popup.prototype.reload = function() {
        this.init()
    }

    Popup.prototype.show = function() {
        this.$modal.modal('show')

        this.$modal.on('click.dismiss.popup', '[data-dismiss="popup"]', $.proxy(this.hide, this))
        this.triggerEvent('popupShow') // Deprecated
        this.triggerEvent('show.scorpio.popup')
    }

    Popup.prototype.hide = function() {
		
        this.triggerEvent('popupHide') // Deprecated
        this.triggerEvent('hide.scorpio.popup')
		
        if (this.allowHide){
			
            this.$modal.modal('hide');
		}
    }

    /*
     * Hide the popup without destroying it,
     * you should call .hide() once finished
     */
    Popup.prototype.visible = function(val) {
        if (val)
            this.$modal.addClass('in')
        else
            this.$modal.removeClass('in')
        
    }

    Popup.prototype.toggle = function() {
        this.triggerEvent('popupToggle', [this.$modal]) // Deprecated
        this.triggerEvent('toggle.scorpio.popup', [this.$modal])

        this.$modal.modal('toggle')
    }

    /*
     * Lock the popup from closing
     */
    Popup.prototype.lock = function(val) {
        this.allowHide = !val
    }
	
    
    var old = $.fn.popup
	var $this2   = $(this);
    $.fn.popup = function (option) {
        
		var args = Array.prototype.slice.call(arguments, 1)
		

		
		
        return this.each(function () {
            
			var $this   = $(this);
            var data    = $this.data('scorpio.popup');
            var options = $.extend({}, Popup.DEFAULTS, $this.data(), typeof option == 'object' && option);
			
            if (!data) {
				
				$this.data('scorpio.popup', (data = new Popup(this, options)))
				
            }else if (typeof option == 'string') {
			
				data[option].apply(data, args)
			
            }else{
				
				data.reload()
			
			} 
		
		 
		
        })
    }

	
	
	
    $.fn.popup.Constructor = Popup

    $.popup = function (option) {

        return $('<a/>').popup(option)
    }
	


    $.fn.popup.noConflict = function () {
        $.fn.popup = old
        return this
    }


}(window.jQuery);