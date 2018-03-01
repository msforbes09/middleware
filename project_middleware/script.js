$(function(){
	
	function uploadFiles(files,code){
		var fd = new FormData()
		var fileLength = files.length
		for( i = 0; i < fileLength; i++ ) {
			fd.append("files[]",files[i])
		}
		fd.append("code",code)
		$.ajax({
			url: 'file_uploader.php',
			type: 'POST',
			data: fd,
			processData: false,
			contentType: false
		  }).done(function(data){
			//console.log(data)
			$("#images").append(data)
		  }).fail(function(data){
			alert('Failed.')
		  });
	}
	
	function load() {
		$("#loading").html('<img src="loading.gif">')
		$.ajax({
			type: 'post',
			url: 'ajax_table.php',
			data: {
				status: $("#status").val(),
				company: $("#company").val()
			}
		}).done(function(data){
			$("#main").html(data)
		}).fail(function(data){
			alert('Failed.')
		}).always(function(data){
			$("#loading").empty()
		})
	}
	
	load()
	
	$(document).on('change','#status,#company',function(){
		load()
	})
	
	$(document).on('click','#add',function(){
		if( ! $("#company").val() ) {
			alert('You need to choose any company!')
			return false
		}
		$(".modal-title").html('Add new project for '+ $("#company option:selected").text())
		$(".modal-body").html(
			'<div class="row">' +
				'<div class="col-sm-6">' +
					'<input type="text" class="form-control input-sm" id="name" placeholder="Project Name(English)...">' +
				'</div>' +
				'<div class="col-sm-6">' +
					'<input type="text" class="form-control input-sm" id="name_ja" placeholder="Project Name(Japanese)...">' +
				'</div>' +				
			'</div>' +
			'<input type="hidden" id="company_id" value="' + $("#company").val() + '"><br>' +
			'<button class="btn btn-sm btn-danger pull-right" id="insert">Add <span class="glyphicon glyphicon-plus"></span></button><br><br>'
		)
		$(".modal").modal('show')
	})
	
	$(document).on('click','#insert',function(){
		//alert($("#company_id").val())
		if( ! $("#name").val() ) {
			alert('You need to provide project name(English)!')
			return false
		}
		if( ! $("#name_ja").val() ) {
			alert('You need to provide project name(Japanese)!')
			return false
		}
		
		$.ajax({
			type: 'post',
			url: 'ajax_insert.php',
			data: {
				company_id: $("#company_id").val(),
				name: $("#name").val(),
				name_ja: $("#name_ja").val()
			}
		}).done(function(data){
			location.href = './'
		}).fail(function(data){
			alert('Failed.')
		})
	})
	
	$(document).on('click','.cancel', function(){
		var $this = $(this)
		//alert($(this).parent().prevAll('.project_code').text())
		$.ajax({
			type: 'post',
			url: 'ajax_cancel.php',
			data: {
				project_code: $this.parent().prevAll('.project_code').text()
			}
		}).done(function(data){
			$this.parent().parent().remove()
		}).fail(function(data){
			alert('Failed.')
		})
	})
	
	$(document).on('click','.update',function(){
		//alert()
		var $this = $(this)
		$this.parent().parent().css( 'background-color', 'pink' )
		if( ! confirm( 'Is it ok to update?' ) ) {
			$this.parent().parent().css( 'background-color', 'transparent' )
			return false
		}
		$.ajax({
			type: 'post',
			url: 'ajax_update_timestamp.php',
			data: {
				project_code: $this.parent().prevAll('.project_code').text()
			}
		}).done(function(data){
			//$this.parent().parent().css( 'background-color', 'transparent' )
			$this.parent().parent().remove()
			$this.parent().html(data)
		}).fail(function(data){
			alert('Failed.')
		})
	})
	
	function embed_images(code) {
		$.ajax({
			type: 'post',
			url: 'ajax_get_images.php',
			data: {
				code: code
			}
		}).done(function(data){
			$("#images").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
	}

	$(document).on('click','.edit',function(){
		//alert()
		var $this = $(this)
		
		$(".modal-title").html('Edit ProjectCD: <span id="code">' + $this.parent().prevAll('.project_code').text() + '</span>' )
		
		$(".modal-body").html(
			'<div class="row">' +
				'<div class="col-sm-12">' +
					'<input type="text" class="form-control input-sm" id="project" placeholder="project" value="' + $this.parent().prevAll('.project_name').text() + '">' +
				'</div>' +
			'</div><br>' +
			'<div class="row">' +
				'<div class="col-sm-12">' +
					'<input type="text" class="form-control input-sm" id="project_ja" placeholder="project_ja" value="' + $this.parent().prevAll('.project_name_ja').text() + '">' +
				'</div>' +
			'</div><br>' +
			
			'<div class="row">' +
				'<div class="col-sm-12">' +
					'<div id="images"></div>' +
				'</div>' +
			'</div><br>' +
			
			'<div class="row">' +
				'<div class="col-sm-12">' +
					'<button class="btn btn-sm btn-info" id="upload_image">Upload image <span class="glyphicon glyphicon-upload"></span></button>' +
					'<input type="file" class="form-control input-sm" id="picture" style="display: block;" multiple>' +
				'</div>' +
			'</div><br>' +	
			
			'<div class="row">' +
				'<div class="col-sm-12">' +
					'<textarea class="form-control input-sm" id="remarks" placeholder="remarks">' + $this.parent().prevAll('.remarks').text() + '</textarea>' +
				'</div>' +
			'</div><br>' +
			'<button class="btn btn-sm btn-warning pull-right" id="update">Update</button><br>'
		)
		
		$(".modal").modal('show')
		embed_images($this.parent().prevAll('.project_code').text())
	})
	
	$(document).on('click','#update',function(){
		//alert()
		if( ! confirm( 'Is it ok to update this project?' ) ) {
			return 0;
			//return false;
		}
		//alert('You clicked OK.')
		
		if( ! $("#project").val() ) {
			alert( 'Project name is blank!' )
			return false;
		}
		if( ! $("#project_ja").val() ) {
			alert( 'Project name in Japanese is blank!' )
			return false;
		}
		
		$.ajax({
			type: 'post',
			url: 'ajax_update.php',
			data: {
				code: $("#code").text(),
				project: $("#project").val(),
				project_ja: $("#project_ja").val(),
				remarks: $("#remarks").val()
			}
		}).done(function(data){
			location.href = './'
		}).fail(function(data){
			alert('Failed.')
		})
		
	})
	
	$(document).on('click','#upload_image',function(){
		//alert()
		$("#picture").click()
	})
	
	$(document).on('change','#picture',function(){
		uploadFiles(this.files,$("#code").text())
	})
	
	$(document).on('contextmenu','img',function(e){
		e.preventDefault()
		if( confirm('Are you going to remove this image?') ) {
			//alert($(this).attr('title'))
			var $this = $(this)
			$.ajax({
				type: 'post',
				url: 'ajax_delete_image.php',
				data: {
					path: $this.attr('title')
				}
			}).done(function(data){
				$this.remove()
			}).fail(function(data){
				alert('Failed.')
			})
		}
	})
})