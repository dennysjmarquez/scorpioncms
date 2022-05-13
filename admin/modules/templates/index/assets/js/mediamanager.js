
	
	



		
	$( "body" ).delegate("#tree-media-item", "click", function(e) {
		
		e.preventdefault;
				
		if($(this).data("path")){
			
			var value = $(this).data("path");
			$("input#open_dir").val(value);
			$("input#action_media").val("opendir");
			submit();
					
		}
				
	});
	
	
	$( "body" ).on('click', '[data-dismiss=create-folder]', function(e){
		
		$("input#action_media").val("makedir");
		$("input#name_dir").val($("input#name-folder").val());
		$('[data-dismiss="popup"]').trigger("click");
		submit();
           
    });
	
	
	$( "body" ).delegate("button#create-folder", "click", function(e) {
				
		e.preventdefault;
	
		$('<a/>').popup({
            content: $( "body" ).find('#new-folder-template').html(),
            zIndex: 1200 // Media Manager can be opened in a popup, so this new popup should have a higher z-index
		});
	
	
	

			
	});
	
	
 var $content = $("#template").clone();
    var $span = $content.find("span");
    $span.text(parseInt($span.text()) + 1);

    $content.children().each(function() {
        $("#container").append($(this));
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
		
		$('<input>').attr({
			type: 'hidden',
			id: 'ajax_popup_modal',
			name: 'ajax_popup_modal',
			value: 'none'
		}).appendTo($form);
		
		var url = $form.attr("action");
		var url = url.split("/");
		var adminContainer = false;
		var baseurlajax = "";
		var container = "#content-center";
			
		$.each(url, function(key) {
            
			if(url[key] === "admin") adminContainer = true;
				
			if(adminContainer) {
				
				baseurlajax += "/" + url[key];
					
			}
			
		});
			
		baseurlajax = baseurlajax.replace("/admin", urlbase + "/admin/ajax");
		
		console.log(baseurlajax);
		
		$.ajax({
			url: baseurlajax,
			method: "POST",
			timeout: 30000, // throw an error if not completed after 30 sec.
			data: $form.serialize(),
			cache: true
		}).always( function() {
			
		}).done( function( response, textStatus, jqXHR ) {	
				
			$(container).html(response);
			/*
			$("#list_container").slimscroll({
				height: "auto",
				distance: '2px',
				color: '#aaa',
				borderRadius: "5px",
				railBorderRadius: "5px",
				opacity: 0.7
			});
			*/
			
		}).fail( function( jqXHR, textStatus, error ) {
			
			
			$.sc_cms.ajaxErrorMessage(jqXHR.responseText, error);
			
						
		});
			
	}





