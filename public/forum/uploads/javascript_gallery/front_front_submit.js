ips.templates.set('gallery.submit.imageItem',"  <div class='ipsAttach ipsImageAttach ipsPad_half ipsAreaBackground_light {{#done}}ipsAttach_done{{/done}}' id='{{id}}' data-role='file' data-fileid='{{id}}' data-fullsizeurl='{{imagesrc}}' data-thumbnailurl='{{thumbnail}}' data-isImage='1'>  <ul class='ipsList_inline ipsImageAttach_controls'>   <li data-role='insert' {{#insertable}}style='display: none'{{/insertable}}><a href='#' data-action='insertFile' class='ipsAttach_selection' data-ipsTooltip title='{{#lang}}insertIntoPost{{/lang}}'><i class='fa fa-plus'></i></a></li>   </li>   <li class='ipsPos_right' {{#newUpload}}style='display: none'{{/newUpload}} data-role='deleteFileWrapper'>    <input type='hidden' name='{{field_name}}_keep[{{id}}]' value='1'>    <a href='#' data-role='deleteFile' class='ipsButton ipsButton_verySmall ipsButton_light' data-ipsTooltip title='{{#lang}}attachRemove{{/lang}}'><i class='fa fa-trash-o'></i></a>   </li>  </ul>  <div class='ipsImageAttach_thumb ipsType_center' data-role='preview' data-grid-ratio='65' data-action='insertFile' {{#thumb}}style='background-image: url( \"{{thumbnail}}\" )'{{/thumb}}>   {{#status}}    <span class='ipsImageAttach_status ipsType_light' data-role='status'>{{{status}}}</span>    <span class='ipsAttachment_progress'><span data-role='progressbar'></span></span>   {{/status}}   {{#thumb}}    {{{thumb}}}   {{/thumb}}  </div>  <h2 class='ipsType_reset ipsAttach_title ipsType_medium ipsTruncate ipsTruncate_line cGalleryImageAttach_info' data-role='title'>{{title}}</h2>  <p class='ipsType_light cGalleryImageAttach_info'>{{size}} {{#statusText}}&middot; <span data-role='status'>{{statusText}}</span>{{/statusText}}</p> </div>");ips.templates.set('gallery.submit.imageItemWrapper',"  <div class='cGallerySubmit_fileList'>{{{content}}}</div>");;
;(function($,_,undefined){"use strict";ips.controller.register('gallery.front.submit.chooseCategory',{_chosen:false,_resizeTimer:null,initialize:function(){this.on('nodeItemSelected','[data-name="image_category"]',this.chooseCategory);this.on('nodeSelectedChanged','[data-name="image_category"]',this.chooseCategoryInitially);this.on('click','[data-action="continueNoAlbum"]',this.continueNoAlbum);this.on('click','[data-type]:not([data-disabled])',this.chooseAlbumType);this.setup();this.on(document,'gallery.wrapperInit',this.setup);},setup:function(){if(this.scope.find('[data-role="categoryForm"]').length){this.trigger('gallery.updateTitle',{title:ips.getString('chooseCategory')});}else{this.trigger('gallery.updateTitle',{title:ips.getString('chooseAlbum')});}},chooseAlbumType:function(e){e.preventDefault();var target=$(e.currentTarget);switch(target.attr('data-type')){case'category':target.next('form').submit();break;case'createAlbum':this.trigger('gallery.updateTitle',{title:ips.getString('createAlbum')});this._resizeFormDiv(this.scope.find('[data-role="createAlbumForm"]'));break;case'existingAlbum':this.trigger('gallery.updateTitle',{title:ips.getString('existingAlbum')});this._resizeFormDiv(this.scope.find('[data-role="existingAlbumForm"]'));break;}},destroy:function(){if(this._resizeTimer){clearInterval(this._resizeTimer);}},_resizeFormDiv:function(form){this.scope.find('[data-role="chooseAlbumType"]').hide();var self=this;var resize=function(animate){var height=form.innerHeight()+130;var submitHeight=form.find('.cGalleryDialog_submitBar').height();if(animate){self.scope.closest('.cGalleryDialog').animate({minHeight:(height+submitHeight)+'px'});}else{self.scope.closest('.cGalleryDialog').css({minHeight:(height+submitHeight)+'px'});}}
form.show().css({opacity:"0.001"});if(this.scope.closest('.ipsDialog').length){resize(true);}
form.animate({opacity:"1"},function(){if(self.scope.closest('.ipsDialog').length){self._resizeTimer=setInterval(function(){resize(false);},500);}});},chooseCategoryInitially:function(e,data){if(this._chosen){return;}
if(!_.isArray(data.selectedItems)){return;}
var id=data.selectedItems[0];if(!_.isUndefined(id)){this._chosen=true;this.showAlbumOptions(id);}},chooseCategory:function(e,data){if(this._chosen){return;}
this._chosen=true;this.showAlbumOptions(data.id);},continueNoAlbum:function(e){e.preventDefault();$(e.currentTarget).closest('form').submit();},showAlbumOptions:function(id){var outerWrapper=this.scope.closest('.ipsDialog_content');var self=this;outerWrapper.addClass('ipsLoading');this.scope.hide();ips.getAjax()(ips.getSetting('baseURL')+'index.php?app=gallery&module=gallery&controller=submit&noWrapper=1&category='+id+'&album='+this.scope.attr('data-preselected-album')).done(function(response){if(response){self.trigger('gallery.submit.response',{response:response});}else{self.scope.find('[data-role="continueCategory"]').show();}}).fail(function(err){self.scope.find('[data-role="continueCategory"]').show();}).always(function(){outerWrapper.removeClass('ipsLoading');self.scope.show();});},});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('gallery.front.submit.existingAlbums',{initialize:function(){this.on('click','#elGallerySubmit_albumChooser > li',this.clickAlbum);this._checkSelected();},clickAlbum:function(e){$(e.currentTarget).find('input[type="radio"]').prop('checked',true);this._checkSelected();},_checkSelected:function(){if(this.scope.find('input[name="existing_album"]:checked').length){this.scope.find('button[type="submit"]').prop('disabled',false);}else{this.scope.find('button[type="submit"]').prop('disabled',true);}}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('gallery.front.submit.uploadImages',{initialize:function(){var self=this;this.scope.find('.ipsAttachment_dropZone').on('click',function(e){e.stopPropagation();if(!$(e.target).is('input')){self.scope.find('input[type="file"]').trigger('click');}});this.on('fileAdded','[data-ipsUploader]',this.filesAdded);this.on('uploadComplete','[data-ipsUploader]',this.uploadComplete);this.on('fileDeleted','[data-ipsUploader]',this.fileRemoved);this.setup();},setup:function(){if(!this.scope.find('[data-role="fileList"] [data-role="file"]').length){this.scope.find('[data-role="submitForm"]').prop('disabled',true);}
$('.cGallerySubmit_bottomBar').removeClass('ipsHide');$('[data-role="allowedTypes"]').html(this.scope.find('span.ipsType_light.ipsType_small').html());this.scope.find('span.ipsType_light.ipsType_small').remove();this.scope.find('.ipsAttachment_supportDrag').html(ips.getString('uploader_add_images'));},fileRemoved:function(e,data){if(data.fileElem.attr('data-fileid').indexOf('o_')!=-1){var imageId=$('input[name="images_existing\\['+data.fileElem.attr('data-fileid')+'\\]"').val();}
else{var imageId=data.fileElem.attr('data-fileid');}
if($('#image_details_'+imageId).length){$('#image_details_'+imageId).remove();}},uploadComplete:function(e,data){if(data.success>0){this.trigger('gallery.activateSubmitButton');}
if(data.error>0){this.trigger('gallery.uploadErrors');}
if(!this.sortableInitialized){this.scope.find('[data-role="fileList"] > .cGallerySubmit_fileList').sortable({forcePlaceholderSize:true});this.sortableInitialized=true;}},sortableInitialized:false,filesAdded:function(e,data){this.trigger('gallery.disableSubmitButton');$('[data-role="addFiles"]').removeClass('ipsHide');$('[data-role="imageDetails"]').removeClass('ipsHide');if(!ips.utils.responsive.enabled()||!ips.utils.responsive.currentIs('phone')){this.scope.closest('.cGalleryDialog').addClass('cGalleryDialog_uploadStep');}
$(window).trigger('resize');}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('gallery.front.submit.wrapper',{_expanded:false,_currentErrors:{},initialize:function(){this.on('submit','form',this.submitForm);this.on('click','[data-role="submitForm"]',this.maybeSubmitForm);this.on('gallery.submit.response',this._updateWrapper);this.on('click','[data-role="addFiles"]',this.dropzoneClick);this.on('click','[data-action="closeDialog"]',this.confirmClose);this.on('click','[data-role="file"][data-fileid]',this.setUpImageDetailsForm);this.on('click','[data-role="imageDescriptionUseEditor"]',this.setUpImageDescriptionRich);this.on('click','[data-role="imageDescriptionUseTextarea"]',this.setUpImageDescriptionPlain);this.on('click','[data-role="addCopyrightCredit"]',this.showCopyrightCredit);this.on('click','[data-role="saveDetails"]',this.saveDetails);this.on('click','[data-role="saveInfo"]',this.saveInfo);this.on('gallery.activateSubmitButton',this.activateSubmitButton);this.on('gallery.disableSubmitButton',this.disableSubmitButton);this.on('gallery.uploadErrors',this.uploadErrors);this.on('gallery.enlargeUploader',this.enlargeUploader);this.on('gallery.updateTitle',this.updateTitle);this.setup();this.trigger('gallery.wrapperInit');},setup:function(){ips.ui.editor.destruct(this.scope.find('[data-ipseditor]'));if(this.scope.find('.cGalleryDialog_imageForm').is(':visible')){this._enlargeUploadStep();}},updateTitle:function(e,data){if(data.title){this._updateTitle(data.title);}},_updateTitle:function(title){this.scope.find('[data-role="dialogTitle"]').text(title);},enlargeUploader:function(e,data){this._enlargeUploadStep(data.callback||$.noop);},activateSubmitButton:function(){this.scope.find('[data-role="submitForm"]').prop('disabled',false);},disableSubmitButton:function(){this.scope.find('[data-role="submitForm"]').prop('disabled',true);},uploadErrors:function(){this.scope.find('[data-role="imageErrors"]').show();},dropzoneClick:function(){this.scope.find('.ipsAttachment_dropZone').trigger('click');},showCopyrightCredit:function(e){e.preventDefault();var link=$(e.currentTarget);link.hide().next().slideDown();},saveInfo:function(e){e.preventDefault();$(e.currentTarget).trigger('closeMenu');},saveDetails:function(e){if(e){e.preventDefault();}
this._markActiveImageAsSaved();$(e.currentTarget).next('[data-role="savedMessage"]').fadeIn();setTimeout(function(){$(e.currentTarget).next('[data-role="savedMessage"]').fadeOut();},2000);if(e){$(e.currentTarget).closest('.cGallerySubmit_details').find('[data-errorField]').hide();}
if(ips.utils.responsive.enabled()&&ips.utils.responsive.currentIs('phone')){this._toggleDetailsPanelMobile(false);this.scope.find('.cGallerySubmit_activeFile').removeClass('cGallerySubmit_activeFile');}},confirmClose:function(e){if(!this.scope.find('[data-fileid]').length){this.trigger('closeDialog');return;}
if(e){e.preventDefault();}
var self=this;ips.ui.alert.show({type:'confirm',icon:'question',message:ips.getString('confirmSubmitClose'),callbacks:{ok:function(){self.trigger('closeDialog');}}});},_markActiveImageAsSaved:function(){this.scope.find('.cGallerySubmit_activeFile').removeClass('cGallerySubmit_imageError').addClass('cGallerySubmit_imageSaved');},setUpImageDetailsForm:function(e){this.scope.find('.cGallerySubmit_activeFile').removeClass('cGallerySubmit_activeFile');$(e.currentTarget).addClass('cGallerySubmit_activeFile');if($(e.currentTarget).attr('data-fileid').indexOf('o_')!=-1){var imageId=$('input[name="images_existing\\['+$(e.currentTarget).attr('data-fileid')+'\\]"').val();}
else{var imageId=$(e.currentTarget).attr('data-fileid');}
var imagePreview=$(e.currentTarget).find('.ipsImage').attr('src');var detailsPanel=this.scope.find('[data-role="imageDetails"]');detailsPanel.find('.cGallerySubmit_details, [data-role="submitHelp"]').hide();if($('#image_details_'+imageId).length){$('#image_details_'+imageId+' .cGallerySubmit_details').show();if(ips.utils.responsive.currentIs('phone')){this._toggleDetailsPanelMobile(true);}}else{$('[data-role="defaultImageDetailsForm"]').find('#cke_filedata__image_description_DEFAULT').remove();var htmlToInsert=$('[data-role="defaultImageDetailsForm"]').html();htmlToInsert='<div id="image_details_'+imageId+'">'+htmlToInsert.replace(/name="image_tags_DEFAULT"/g,'name="image_tags_DEFAULT" data-ipsAutocomplete ').replace(/_DEFAULT/g,'_'+imageId)+"</div>";detailsPanel.find('> form').prepend(htmlToInsert);var imageForm=$('#image_details_'+imageId);var filename=$(e.currentTarget).find('[data-role="title"]').text();var filenameWithoutExt=filename.replace(/\.[^/.]+$/,'');$('#elInput_image_title_'+imageId).val(filenameWithoutExt);detailsPanel.find('> form #image_details_'+imageId).find('.ipsToggle').remove();if(!_.isUndefined(imagePreview)){imageForm.find('.cGallerySubmit_preview').removeClass('ipsBox_transparent').removeClass('ipsNoThumb').removeClass('ipsNoThumb_video').html("<img src='"+imagePreview+"' class='ipsImage' />").show();}
else{imageForm.find('.cGallerySubmit_preview').addClass('ipsBox_transparent').addClass('ipsNoThumb').addClass('ipsNoThumb_video').html("").show();}
if(!$(e.currentTarget).attr('data-thumbnailurl')){imageForm.find('.cGalleryThumbField').removeClass('ipsHide');}else{ips.getAjax()(ips.getSetting('baseURL')+'index.php?app=gallery&module=gallery&controller=submit&do=checkGps&imageId='+imageId,{type:'get',bypassRedirect:true}).done(function(response,status,jqXHR){if(parseInt(response.hasGeo)){imageForm.find('.cGalleryMapField').removeClass('ipsHide');}});}
if(ips.utils.responsive.currentIs('phone')){this._toggleDetailsPanelMobile(true);}
$(document).trigger('contentChange',[$('[data-role="imageDetails"] > form')]);if(!_.isUndefined(this._currentErrors[imageId])){this._updateDetailsWithErrors(imageId,this._currentErrors[imageId]);}}},_toggleDetailsPanelMobile:function(show){var detailsPanel=this.scope.find('[data-role="imageDetails"]');if(!show){detailsPanel.animate({opacity:"0",top:'400px'},400,function(){detailsPanel.hide()});}else if(!detailsPanel.is(':visible')){detailsPanel.show().css({opacity:"0",top:'400px'}).animate({opacity:"1",top:'0px'},400);}},setUpImageDescriptionRich:function(e){$(e.currentTarget).closest('[data-role="imageDescriptionTextarea"]').addClass('ipsHide').prev('[data-role="imageDescriptionEditor"]').removeClass('ipsHide');e.preventDefault();},setUpImageDescriptionPlain:function(e){$(e.currentTarget).closest('[data-role="imageDescriptionEditor"]').addClass('ipsHide').next('[data-role="imageDescriptionTextarea"]').removeClass('ipsHide');e.preventDefault();},maybeSubmitForm:function(e){var isIE11=!(window.ActiveXObject)&&"ActiveXObject"in window;if(!$(e.currentTarget).closest('form').length&&$(e.currentTarget).is('[form]')&&isIE11){var form=$('#'+$(e.currentTarget).attr('form'));if(form.length){form.submit();}}},submitForm:function(e){e.preventDefault();var form=$(e.currentTarget);var url=form.attr('action');if(form.attr('id')=='elGallerySubmit'){this.scope.find('[data-ipseditor]').each(function(){try{var editorObj=ips.ui.editor.getObj($(this));var editorInstance=editorObj.getInstance();$(this).find('textarea[data-role="contentEditor"]').val(editorInstance.getData());}catch(err){Debug.error("Couldn't update textarea from editor");}});form.find('textarea[name="credit_all"]').val($('#elTextarea_image_credit_info').val());form.find('textarea[name="copyright_all"]').val($('#elInput_image_copyright').val());if($('#elInput_image_tags_wrapper').length){try{var tags=ips.ui.autocomplete.getObj(this.scope.find('#elInput_image_tags')).getTokens();form.find('textarea[name="tags_all"]').val(tags.join("\n"));form.find('textarea[name="prefix_all"]').val($('[name="image_tags_prefix"]').val());}catch(err){Debug.error("Couldn't update tags");}}
if(ips.getSetting('memberID')){form.find('input[name="images_autofollow_all"]').val($('#check_image_auto_follow_wrapper').hasClass('ipsToggle_on')?1:0);}
var imageOrder=[];form.find('[data-role="file"]').each(function(){if($(this).attr('data-fileid').indexOf('o_')!=-1){imageOrder.push($('input[name="images_existing\\['+$(this).attr('data-fileid')+'\\]"').val());}
else{imageOrder.push($(this).attr('data-fileid'));}});form.find('textarea[name="images_order"]').val(JSON.stringify(imageOrder));form.find('textarea[name="images_info"]').val(JSON.stringify($('#form_imageDetails').serializeArray()));this.scope.find('[data-role="imageDetails"]').addClass('ipsHide');this.scope.find('#elGallerySubmit_toolBar').hide();this.scope.find('[data-role="submitForm"]').prop('disabled',true);this.scope.find('.cGalleryDialog').removeClass('cGalleryDialog_uploadStep');}
e.stopPropagation();this._changeContents(url,form.serialize());},_changeContents:function(url,data){if(_.isUndefined(data)){data={};}
var self=this;var loadingElement=this.scope.closest('.ipsDialog_content');this.scope.find('.cGalleryDialog_container, .cGalleryDialog_imageForm').hide();this.cleanContents();loadingElement.addClass('ipsLoading');ips.getAjax()(url+'&noWrapper=1',{data:data,type:'post',bypassRedirect:true}).done(function(response,status,jqXHR){self._updateContents(response);}).always(function(){loadingElement.removeClass('ipsLoading');});},_updateWrapper:function(e,data){this._updateContents(data.response);},_updateContents:function(response){var wrapper=$('[data-role="submitWrapper"]');var container=wrapper.find('[data-role="container"]');if(response.container){container.html(response.container);container.show();}else{container.hide();}
if(response.containerInfo){wrapper.find('[data-role="containerInfo"]').html(response.containerInfo);}
if(response.images){this._updateTitle(ips.getString('addImages'));if(this.scope.closest('.cGalleryDialog_outer').length&&!this.scope.find('[data-role="imagesForm"]').is(':visible')&&!this._expanded){this._enlargeUploadStep(function(){wrapper.find('[data-role="imageForm"]').html(response.images);});}else{wrapper.find('[data-role="images"]').show();wrapper.find('[data-role="imageForm"]').html(response.images);}}
if(response.imageTags&&wrapper.find('.cGalleryTagsField').hasClass('ipsHide')){wrapper.find('.cGalleryTagsField').removeClass('ipsHide');wrapper.find('.cGalleryTagsField .ipsFieldRow_content').append(response.imageTags);}
if(response.tagsField&&wrapper.find('.cGalleryTagsButton').hasClass('ipsHide')){wrapper.find('.cGalleryTagsButton').removeClass('ipsHide');wrapper.find('[data-role="globalTagsField"]').append(response.tagsField);}
$(document).trigger('contentChange',[wrapper]);if(!_.isUndefined(response.imageErrors)&&_.size(response.imageErrors)>0){this._handleUploaderErrors(response.imageErrors);}},_handleUploaderErrors:function(errors){var self=this;this.scope.find('[data-role="imageDetails"]').removeClass('ipsHide');this.scope.find('#elGallerySubmit_toolBar').show();this.scope.find('[data-role="submitForm"]').prop('disabled',false);this.scope.find('.cGalleryDialog').addClass('cGalleryDialog_uploadStep');this._currentErrors=errors;var errorCount=_.size(errors);var errorIDs=_.keys(errors);var errorFileIDs=_.map(errorIDs,function(id){if(self.scope.find('input[type="hidden"][value="'+id+'"]').attr('name')){return'#'+self.scope.find('input[type="hidden"][value="'+id+'"]').attr('name').replace(/images_existing\[/g,'').replace(/\]/g,'');}});var errorFileThumbs=this.scope.find(errorFileIDs.join(','));this.scope.find('.cGallerySubmit_fileList [data-role="file"]').addClass('cGallerySubmit_imageSaved');errorFileThumbs.addClass('cGallerySubmit_imageError').removeClass('cGallerySubmit_imageSaved');_.each(errorIDs,function(id){if(self.scope.find('#image_details_'+id).length){self._updateDetailsWithErrors(id,errors[id]);}});if(!_.isUndefined(errors[0])&&!_.isUndefined(errors[0]['images'])){ips.ui.alert.show({type:'alert',icon:'warn',message:errors[0]['images'],});}
else{ips.ui.alert.show({type:'alert',icon:'warn',message:ips.pluralize(ips.getString('imageUploadErrors'),errorCount),subText:ips.pluralize(ips.getString('imageUploadErrorsDesc'),errorCount)});}},_updateDetailsWithErrors:function(fileID,errors){var panel=this.scope.find('#image_details_'+fileID);_.each(errors,function(error,field){panel.find('[data-errorField="'+field+'"]').text(error).show();if(field=='image_tags'||field=='image_credit'||field=='image_copyright'){panel.find('[data-errorField="'+field+'"]').closest('.ipsFieldRow').find('[data-role="addCopyrightCredit"]').click();}});},_enlargeUploadStep:function(callback){var wrapper=$('[data-role="submitWrapper"]');var dialogElem=this.scope.closest('.cGalleryDialog_outer > div');if(dialogElem.length){var dialogElemPos=ips.utils.position.getElemPosition(dialogElem);var viewportSize={width:$(window).width(),height:$(window).height()};var left=(viewportSize.width-dialogElem.width())/ 2;this.scope.closest('.cGalleryDialog_outer > div').css({width:'auto',maxWidth:'100%',position:'fixed',margin:0,top:dialogElemPos.absPos.top+'px',left:left+'px',right:viewportSize.width-(left+dialogElem.width())+'px'}).animate({left:'10px',right:'10px',bottom:'10px',top:'10px',},function(){wrapper.find('[data-role="images"]').css({opacity:"0.0001",}).show();if(callback){callback();}
wrapper.find('[data-role="images"]').animate({opacity:"1"});$(document).trigger('contentChange',[wrapper]);});}
else{if(callback){callback();}
$(document).trigger('contentChange',[wrapper]);}
this.scope.find('.cGalleryDialog').css({minHeight:"0",position:'absolute',top:"0",left:"0",right:"0",bottom:"0"});this.scope.closest('.ipsDialog_content').css({position:'absolute',top:"0",left:"0",right:"0",bottom:"0"});if(!wrapper.find('.cGallerySubmit_bottomBar').hasClass('ipsHide')){wrapper.find('.cGallerySubmit_bottomBar').removeClass('ipsHide').fadeIn();}
this._expanded=true;}});}(jQuery,_));;