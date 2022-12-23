;(function($,_,undefined){"use strict";ips.controller.register('ips.admin.files.multimod',{initialize:function(){this.on('submit','[data-role="moderationTools"]',this.moderationSubmit);this.on('menuItemSelected',this.itemSelected);},moderationSubmit:function(e){var action=this.scope.find('[data-role="moderationAction"]').val();switch(action){case'delete':this._modActionDelete(e);break;default:$(document).trigger('moderationSubmitted');break;}},_modActionDelete:function(e){var self=this;var form=this.scope.find('[data-role="moderationTools"]');if(self._bypassDeleteCheck){return;}
e.preventDefault();var count=parseInt(this.scope.find('[data-role="moderation"]:checked').length);ips.ui.alert.show({type:'confirm',icon:'warn',message:(count>1)?ips.pluralize(ips.getString('delete_confirm_many'),count):ips.getString('delete_confirm'),callbacks:{ok:function(){$(document).trigger('moderationSubmitted');self._bypassDeleteCheck=true;self.scope.find('[data-role="moderationTools"]').submit();}}});}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.files.form',{initialize:function(){if(this.scope.find('input[name=filestorage_move]')){$('#form_filestorage_move').hide();this.on('submit','form.ipsForm_horizontal',this.submitForm);}},submitForm:function(e){var self=this;if($(e.currentTarget).attr('data-bypassValidation')){return true;}
e.preventDefault();$(e.currentTarget).attr('data-bypassValidation',true);ips.getAjax()($(e.currentTarget).attr('action').replace('do=configurationForm','do=checkMoveNeeded'),{data:$(e.currentTarget).serialize(),type:'post'}).done(function(response){if(response.needsMoving){ips.ui.alert.show({type:'confirm',message:ips.getString('files_overview_move_desc'),icon:'fa fa-warning',buttons:{ok:ips.getString('files_overview_move'),cancel:ips.getString('files_overview_leave')},callbacks:{ok:function(){$('input[name=filestorage_move_checkbox]').prop('checked',true);$(e.currentTarget).submit();},cancel:function(){$('input[name=filestorage_move_checkbox]').prop('checked',false);$(e.currentTarget).submit();}}});}
else{$(e.currentTarget).submit();}});}});}(jQuery,_));;