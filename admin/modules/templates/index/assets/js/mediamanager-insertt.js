
	var SwitchInsert = select_object = editorstance ='';
	

		$('.featured-image').click(function(e){
			e.preventdefault;
			
			SwitchInsert = 'featured';
			
			$('<a/>').popup({
				size: 'adaptive',
				adaptiveHeight: true,
				extraData: {types_files: 'image'},
				type: 'POST',
				scrollcontainer: '#list_container',
				title: $.sc_cms.lang.get('INSERT_MEDIA'),
				ajax: urlbase + '/admin/ajax/media/'
			
			});
		
		
		});
		
	$( "body" ).delegate(".upload-remove-button", "click", function(e) {
		e.preventdefault;

		$("input#featured_image").val('');
		$("input#featured_image_new").val('');
		$("#featured-image").css("display", 'none');
		$("#add-image").css("display", '');
		
	
	});		
		
	function action_insert(){
		
		switch(SwitchInsert) {
					
			case "featured":

				html = '<img src="'+ select_object.data("public-Url") + '" />';
				$('.featured-image').html(html);
				$('#filename').html(select_object.data("name"));
				$('p#size').html(select_object.data("size"));
				
				$("input#featured_image_new").val(select_object.data("path"));
				
				
				$('#add-image').css('display', 'none');
				$('#featured-image').css('display', '');
				
				
			
			break;
			
			
			
			case "editor":
			
				
				switch(select_object.data('mime')) {
					
					case "imagen":
						
						html = '<img src="' + select_object.data("public-Url") + '" />';
						CKEDITOR.instances[editorstance].insertHtml(html);
			
					break;
					
					case "video":
					
						html = (
						
							'<video controls="controls">\n' +
								'<source src="' + select_object.data("public-Url") + '" />\n' +
							'</video>'
						
						);

							
						CKEDITOR.instances[editorstance].insertHtml(html);
					
					break;
					
					case "audio":
					
						html = (
						
							'<audio controls="controls" src="' + select_object.data("public-Url") + '">' +
								
							'</audio>'
						
						);
						
						CKEDITOR.instances[editorstance].insertHtml(html);
					
					break;					
					
					case "document":
					break;
					
					case "object":
					break;
					
				}
					
					
					
				
			
			break;			
		
		}
		
	}
	


		$( "body" ).delegate("#popup-insert", "click", function(e) {
			e.preventdefault;
			
			action_insert();
		
			$('[data-dismiss="popup"]').trigger("click");
		
		
		});
	
		
		$( "body" ).delegate("#tree-media-item", "click", function(e) {
		
			e.preventdefault;
				
			if($(this).data("path")){
			
				var value = $(this).data("path");
				$("input#open_dir").val(value);
				$("input#action_media").val("opendir");
				submit();
					
			}
				
		});
			
	
		$( "body" ).delegate("button#create-folder", "click", function(e) {
				
			e.preventdefault;
			
			$("input#action_media").val("makedir");
			$("input#name_dir").val("Viky");
				
			submit();
			
		});
		
	
	
		$( "body" ).delegate("tr#media-item", "click", function(e) {
			
			var click_media_item = $(this);
				
			if (click_media_item.data("type") === "file" && $("#media-description").hasClass("hide") && $(".media-preview-container").hasClass("hide")){
					
				$("#media-description").removeClass("hide");
				$(".media-preview-container").removeClass("hide");
				$(".media-container-text").addClass("hide");
					
			}else if(click_media_item.data("type") === "dir"  && !$("#media-description").hasClass("hide")){
					
				$("#media-description").addClass("hide");
				$(".media-preview-container").addClass("hide");
				$(".media-container-text").removeClass("hide");
					
			}
				
				
			$( "tr#media-item.selected" ).removeClass("selected");
			click_media_item.addClass("selected");
				
			if(click_media_item.data("public-Url") ){
					
				$("p#data-file-name").text(click_media_item.data("name"));
				$("td#data-size").text(click_media_item.data("size"));
				$("td#data-modified").text(click_media_item.data("last-Modified"));
				$("a#public-url").attr("href", click_media_item.data("public-url"))
				
				select_object = click_media_item;
					
				switch(click_media_item.data("mime")) {
					
					case "imagen":
				
						$(".media-preview-container").addClass("loading");
						$(".media-preview-container").html('<div class="sidebar-image-placeholder-container"><div class="sidebar-image-placeholder preview"></div></div>');
							
						var $img = $('<img id="image-placeholder" class="hide" src="' + click_media_item.data("public-Url") + '">');
					
						$img.on('load', function() {
					
							$(".media-preview-container").removeClass("loading");
							$(this).removeClass("hide");
					
						});
					
						$('.sidebar-image-placeholder.preview').append($img);
						

					break;
					
					case "video":
						
						$(".media-preview-container").html('<video src="' + click_media_item.data("public-Url") + '" controls><div class="panel-media media-player-fallback">Your browser not support HTML5 video.</div></video>');
						
						
						
					break;
					
					case "audio":
					
						$(".media-preview-container").html('<div class="panel-media no-padding-bottom"><audio src="' + click_media_item.data("public-Url") + '" controls><div class="media-player-fallback panel-embedded">Your browser not support HTML5 audio.</div></audio></div>');
				
					break;
						
					case "document":
						
						$(".media-preview-container").html("");
						
						
					break;
					
					default: 
						
						mime_type = 'object';
						
						
					break;
						
				} 
						
			}
				
			var list_container = $("#list_container");
			list_container.focus();
				
		}).delegate("tr#media-item", "dblclick", function(e) {
				
			var dblclick_media_item = $(this);
			
			if(dblclick_media_item.data("backfolder") || dblclick_media_item.data("path")){
					
				if(dblclick_media_item.data("type") === "dir"){
						
					var value = (dblclick_media_item.data("backfolder")) ? dblclick_media_item.data("backfolder") : dblclick_media_item.data("path");
					$("input#open_dir").val(value);
					$("input#action_media").val("opendir");
						
					submit();
						
				}
				
			}
			
		});			
		
		
	function submit(){
		
		$form = $("form#form_mediamanager");
		
		var url = $form.attr("action");
		var url = url.split("/");
		var adminContainer = false;
		var baseurl = "";
		var container = ".modal-content";
			
			$.each(url, function(key) {
            
				if(url[key] === "admin") adminContainer = true;
				
				if(adminContainer) {
				
					baseurl += "/" + url[key];
					
				}
			
			});
			
			baseurl = baseurl.replace("/admin", urlbase + "/admin/ajax");
		
			$.ajax({
				url: baseurl,
				method: "POST",
				timeout: 30000, // throw an error if not completed after 30 sec.
				data: $form.serialize(),
				cache: true
			}).always( function() {
			
			}).done( function( response, textStatus, jqXHR ) {
				
				$(container).html(response);
				/*
				$("#list_container").slimscroll({
					height: "auto"

				});
				*/
			}).fail( function( jqXHR, textStatus, error ) {
			
			
				$.sc_cms.ajaxErrorMessage(jqXHR.responseText, error);
			
			
			});
			
		}


	function init_ckeditor_mediamger(editorx){
	
		$('.cke_button__ck_mlib_button_'+editorx).click(function(){
			
			SwitchInsert = 'editor';
			editorstance = editorx;
			
			$('<a/>').popup({
				size: 'adaptive',
				adaptiveHeight: true,
				scrollcontainer: '#list_container',
				title: $.sc_cms.lang.get('INSERT_MEDIA'),
				ajax: urlbase + '/admin/ajax/media/',
				
			
			});
		
		});
	
	
	}


