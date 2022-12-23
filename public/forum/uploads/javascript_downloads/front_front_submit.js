ips.templates.set('downloads.submit.screenshot',"  <div class='ipsUploader__row ipsUploader__row--withBorder ipsUploader__row--image ipsAttach ipsContained {{#done}}ipsAttach_done{{/done}}' id='{{id}}' data-role='file' data-fileid='{{id}}' data-filesize='{{sizeRaw}}' data-fullsizeurl='{{imagesrc}}' data-thumbnailurl='{{thumbnail}}' data-fileType='image'>  <div class='ipsUploader__rowPreview ipsType_center' data-role='preview'>   <label for='{{field_name}}_primary_screenshot_{{id}}' class='ipsCursor_pointer'>    {{#thumb}}     {{{thumb}}}    {{/thumb}}    <div class='ipsUploader__rowPreview__generic ipsFlex ipsFlex-ai:center ipsFlex-jc:center' {{#thumb}}style='display: none'{{/thumb}}>     <i class='fa fa-{{extIcon}} ipsType_large'></i>    </div>   </label>  </div>  <div class='ipsUploader_rowMeta ipsFlex ipsFlex-fd:column ipsFlex-jc:center ipsFlex-ai:start'>   <h2 class='ipsUploader_rowTitle ipsMargin:none ipsType_reset ipsAttach_title ipsTruncate ipsTruncate_line' data-role='title'>{{title}}</h2>   <p class='ipsDataItem_meta ipsType_medium ipsType_light'>    {{size}} {{#statusText}}&middot; <span class='ipsType_light' data-role='status'>{{statusText}}</span>{{/statusText}}   </p>   {{#status}}<span class='ipsAttachment_progress'><span data-role='progressbar'></span></span>{{/status}}  </div>  <span data-role='insert' {{#insertable}}style='display: none'{{/insertable}}>   <a href='#' class='ipsAttach_selection' data-ipsTooltip title='{{#lang}}insertIntoPost{{/lang}}'>    <i class='fa fa-plus'></i>   </a>  </span>  {{#supportsDelete}}   <div data-role='deleteFileWrapper' {{#newUpload}}style='display: none'{{/newUpload}}>    <input type='hidden' name='{{field_name}}_keep[{{id}}]' value='1'>    <a href='#' data-role='deleteFile' class='ipsUploader__rowDelete' data-ipsTooltip title='{{#lang}}attachRemove{{/lang}}'>     &times;    </a>   </div>  {{/supportsDelete}}  {{^supportsDelete}}   <div data-role='deleteFileWrapper' style='display: none'>    <input type='hidden' name='{{field_name}}_keep[{{id}}]' value='1'>    <a href='#' class='ipsUploader__rowDelete' data-role='deleteFile' data-ipsTooltip title='{{#lang}}attachRemove{{/lang}}'>&times;</a>   </div>  {{/supportsDelete}}  <label for='{{field_name}}_primary_screenshot_{{id}}' class='cDownloadsPrimaryRadio' data-ipsTooltip title='{{#lang}}makePrimaryScreenshot{{/lang}}'>   <span class='ipsCustomInput'>    <input type='radio' name='{{field_name}}_primary_screenshot' id='{{field_name}}_primary_screenshot_{{id}}' value='{{id}}' {{#default}}checked{{/default}}>    <span></span>   </span>   {{#lang}}makePrimary{{/lang}}  </label> </div>");ips.templates.set('downloads.submit.screenshotWrapper',"  <div class='ipsUploader__container ipsUploader__container--images'>{{{content}}}</div>");ips.templates.set('downloads.submit.linkedScreenshot',"  <li class='cDownloadsLinkedScreenshotItem'>  <input type='url' name='{{name}}[{{id}}]' value='{{value}}'>  <div class='cDownloadsLinkedScreenshotItem_block'>   <input type='radio' name='screenshots_primary_screenshot' value='{{id}}' title='{{#lang}}makePrimaryScreenshot{{/lang}}' data-ipsTooltip {{extra}}>  </div>  <div class='cDownloadsLinkedScreenshotItem_block'>   <a href='#' data-action='removeField' title='{{#lang}}removeScreenshot{{/lang}}' data-ipsTooltip><i class='fa fa-times'></i></a>  </div> </li>");;
;(function($,_,undefined){"use strict";ips.controller.register('downloads.front.submit.linkedScreenshots',{initialize:function(){this.on('click','[data-action="addField"]',this.addFieldButton);this.on('click','[data-action="removeField"]',this.removeField);this.setup();},setup:function(){var initialValues=$.parseJSON($(this.scope).attr('data-initialValue'));if(initialValues==null){return;}
var i;for(i in initialValues.values){this.addField(i,initialValues.values[i],i==initialValues.default);}},addField:function(id,value,isDefault){$(this.scope).find('[data-role="fieldsArea"]').append(ips.templates.render('downloads.submit.linkedScreenshot',{'name':$(this.scope).attr('data-name'),'id':id,'value':value,'extra':isDefault?'checked':''}));},removeField:function(e){e.preventDefault();$(e.currentTarget).closest('li').remove();},addFieldButton:function(){this.addField('linked_'+new Date().getTime(),'',false);}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('downloads.front.submit.main',{_progressbarTimeout:null,_requireScreenshots:false,_bulkUpload:false,_ui:{},_hiddenUploader:false,_overriddenUploader:false,_allowMultipleFiles:false,_newVersion:false,_uploadedCount:0,initialize:function(){this.on('uploadedCountChanged',this.uploadCounter);this.on('uploadProgress',this.uploadProgress);this.on('fileAdded',this.fileAdded);this.on('fileDeleted',this.fileDeleted);this.on('click','[data-action="confirmUrls"]',this.confirmURLs);this.on('click','[data-action="confirmImports"]',this.confirmImports);this.on('click','[data-action="confirmScreenshotUrls"]',this.confirmScreenshots);this.on('click','[data-action="uploadMore"]',this.uploadMore);this.setup();},setup:function(){var self=this;if(this.scope.attr('data-screenshotsReq')){this._requireScreenshots=true;}
if(this.scope.attr('data-bulkUpload')){this._bulkUpload=true;}
if(this.scope.attr('data-multipleFiles')){this._allowMultipleFiles=true;}
if(this.scope.attr('data-newVersion')){this._newVersion=true;}
this._ui={progressBar:this.scope.find('#elDownloadsSubmit_progress'),screenshots:this.scope.find('#elDownloadsSubmit_screenshots'),fileInfo:this.scope.find('#elDownloadsSubmit_otherinfo')};var hideProgressBar=function(force=false){if(!_.isUndefined(self._ui.progressBar.attr('data-ipsSticky'))&&!force){self.on('stickyInit',function(){self._ui.progressBar.hide();});}else{self._ui.progressBar.hide();}};if(!this._hasExistingFiles()&&!this._newVersion){hideProgressBar(true);this._ui.screenshots.hide();this._ui.fileInfo.hide();this.scope.find('[data-role="submitForm"]').prop('disabled',true);this._toggleFileImportOptions();}else if(this._newVersion){hideProgressBar(true);this._toggleFileImportOptions(true);}else{if(!this.scope.find('input[name^="files_existing"]').length){hideProgressBar();}else{this._hiddenUploader=true;}
if(!this._hasExistingScreenshots()&&this._requireScreenshots){this._ui.fileInfo.hide();this.scope.find('[data-role="submitForm"]').prop('disabled',true);}}},confirmURLs:function(e){e.preventDefault();var gotURLs=this._confirmMenu('url_files','elURLFiles');if(gotURLs){this._doneUploadStep();}},confirmImports:function(e){e.preventDefault();var gotImports=this._confirmMenu('import_files','elImportFiles');if(gotImports){this._doneUploadStep();}},confirmScreenshots:function(e){e.preventDefault();var gotURLs=this._confirmMenu('url_screenshots','elURLScreenshots');if(gotURLs){this._doneScreenshotStep();}},uploadMore:function(e){e.preventDefault();this._hiddenUploader=false;this._overriddenUploader=true;},fileAdded:function(e,data){if(!this._bulkUpload){if(data.uploader=='files'){this._doneUploadStep();}else if(data.uploader=='screenshots'){this._doneScreenshotStep();}}else{this.scope.find('[data-role="submitForm"]').prop('disabled',false);}},fileDeleted:function(e,data){if(data.uploader!='files'){return;}
if(data.count===0){this.scope.find('#elDownloadsSubmit_progress .ipsProgressBar_progress').attr('data-progress','0%').css({width:'0%'});this._ui.progressBar.hide();this._hiddenUploader=false;this._overriddenUploader=true;}},uploadCounter:function(e,data){if(data.uploader!='files'){return;}
this._uploadedCount=data.count;this._toggleFileImportOptions();},uploadProgress:function(e,data){if(data.uploader!='files'){return;}
var self=this;this._showProgress();this.scope.find('#elDownloadsSubmit_progress .ipsProgressBar_progress').attr('data-progress',data.percent+'%').css({width:data.percent+'%'});if(data.percent===100&&!this._progressbarTimeout){this._progressbarTimeout=setTimeout(function(){self._ui.progressBar.find('.ipsProgressBar').removeClass('ipsProgressBar_animated');self._progressbarTimeout=null;},300);}},_confirmMenu:function(inputName,elemID){var length=0;var invalid=0;this.scope.find('input[name^="'+inputName+'"]').each(function(){if($(this).val().trim()){length++;}
if(!_.isUndefined(this.checkValidity)&&!this.checkValidity()){invalid++;}});if(!invalid){this.scope.find('#'+elemID).trigger('closeMenu');}
this._toggleFileImportOptions();this.scope.find('#'+elemID+' [data-role="fileCount"]').text(length);if(length){this.scope.find('#'+elemID+' [data-role="fileCount"]').show();return true;}else{this.scope.find('#'+elemID+' [data-role="fileCount"]').hide();return false;}},_hasExistingFiles:function(){if(this._uploadedCount||this.scope.find('input[name^="files_existing"]').length){return true;}
var hasURL=[];var hasImport=[];if(this.scope.find('input[name^="url_files"]').length){hasURL=_.filter(this.scope.find('input[name^="url_files"]'),function(item){if($(item).val().trim()!=''){return true;}
return false;});}
if(this.scope.find('input[name^="import_files"]').length){hasImport=_.filter(this.scope.find('input[name^="import_files"]'),function(item){if($(item).val().trim()!=''){return true;}
return false;});}
if(hasURL.length||hasImport.length){return true;}
return false;},_hasExistingScreenshots:function(){if(this.scope.find('input[name^="screenshots_existing"]').length){return true;}
var hasURL=[];if(this.scope.find('input[name^="url_screenshots"]').length){hasURL=_.filter(this.scope.find('input[name^="url_screenshots"]'),function(item){if($(item).val().trim()!=''){return true;}
return false;});if(hasURL.length){return true;}}
return false;},_doneUploadStep:function(){var self=this;if(this._ui.screenshots.length&&!this._ui.screenshots.is(':visible')){ips.utils.anim.go('fadeIn',this._ui.screenshots).done(function(){$(document).trigger('contentChange',[self._ui.screenshots]);});}
if(!this._requireScreenshots&&!this._ui.fileInfo.is(':visible')){ips.utils.anim.go('fadeIn',this._ui.fileInfo).done(function(){$(document).trigger('contentChange',[self._ui.fileInfo]);});}
if(!this._requireScreenshots){this.scope.find('[data-role="submitForm"]').prop('disabled',false);}},_doneScreenshotStep:function(){var self=this;ips.utils.anim.go('fadeIn',this._ui.fileInfo).done(function(){$(document).trigger('contentChange',[self._ui.fileInfo]);});this.scope.find('[data-role="submitForm"]').prop('disabled',false);},_showProgress:function(){if(!this._hiddenUploader&&!this._overriddenUploader){this._ui.progressBar.show().find('.ipsProgressBar').addClass('ipsProgressBar_animated');this._hiddenUploader=true;}},_toggleFileImportOptions:function(force=false){if(this._allowMultipleFiles===true){return;}
this.scope.find('a[data-action="stackAdd"]').hide();if(this._hasExistingFiles()||force){this.scope.find('[data-role="stackItem"] input[name^="url_files"], [data-role="stackItem"] input[name^="import_files"]').each(function(){if($(this).val()==""){$(this).prop('disabled',true);}});}
else{this.scope.find('[data-role="stackItem"] input[name^="url_files"], [data-role="stackItem"] input[name^="import_files"]').each(function(){$(this).prop('disabled',false);});}}});}(jQuery,_));;