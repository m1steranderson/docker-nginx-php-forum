;(function($,_,undefined){"use strict";ips.controller.register('core.admin.core.changeTheme',{initialize:function(){$('#elAdminUser,#elThemeLangMenuMob').on('menuItemSelected',_.bind(this.themePreferenceSelected,this));this.setTheme();},setTheme:function(){if(_.isUndefined(ips.utils.cookie.get('acptheme'))||ips.utils.cookie.get('acptheme')=='undefined'){if(window.matchMedia&&window.matchMedia('(prefers-color-scheme: dark)').matches){$('body').addClass('ipsDarkMode');ips.utils.cookie.set('acpthemedefault','dark');}
else{$('body').removeClass('ipsDarkMode');ips.utils.cookie.set('acpthemedefault','light');}}
else{$('body').toggleClass('ipsDarkMode',ips.utils.cookie.get('acptheme')==='dark');}},themePreferenceSelected:function(e,data){if(_.isUndefined(data.selectedItemID)){return;}
e.preventDefault();if(data.selectedItemID=='os'){ips.utils.cookie.unset('acptheme');}
else{var expires=new Date();expires.setFullYear(expires.getFullYear()+1);ips.utils.cookie.set('acptheme',data.selectedItemID,expires.toUTCString());}
$('#elThemeMenu_menu, #elNavThemeMob_menu').find('.ipsMenu_itemChecked').removeClass('ipsMenu_itemChecked');$('#elThemeMenu_menu, #elNavThemeMob_menu').find('[data-ipsMenuValue="'+data.selectedItemID+'"]').addClass('ipsMenu_itemChecked');this.setTheme();}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.core.editable',{_editTimeout:null,_editing:false,initialize:function(){this.on('mousedown',this.editMousedown);this.on('mouseup mouseleave',this.editMouseup);this.on('click',this.editMouseclick);this.on('click','[data-role="edit"]',this.clickEdit);this.setup();},setup:function(){var defaultFill=this.scope.attr('data-default');if(ips.utils.events.isTouchDevice()||(!_.isUndefined(defaultFill)&&defaultFill=='empty')){this.scope.removeClass('ipsType_editable').find('[data-role="edit"]').show();}},clickEdit:function(e){e.preventDefault();this._triggerEdit();},editMousedown:function(e){var self=this;if(e.which!==1){return;}
this._editTimeout=setTimeout(_.bind(this._triggerEdit,this),1000);},editMouseup:function(e){clearTimeout(this._editTimeout);},editMouseclick:function(e){if(this._editing){e.preventDefault();}},_triggerEdit:function(){var self=this;this._editing=true;clearTimeout(this._editTimeout);var span=this.scope;var url=span.attr('data-url');var textField=span.find('[data-role="text"]');var fieldName=span.find('[data-name]').attr('data-name');var defaultFill=span.attr('data-default');span.hide();var defaultText=(_.isUndefined(defaultFill)||defaultFill!='empty')?textField.text().trim():'';var inputNode=$('<input/>').attr({type:'text'}).attr('data-role','editField').val(defaultText);span.after(inputNode);inputNode.focus();inputNode.on('blur',function(){inputNode.addClass('ipsField_loading');if(inputNode.val()==''){inputNode.remove();span.show();self._editing=false;}else{var dataToSend={};dataToSend[fieldName]=inputNode.val();ips.getAjax()(url,{method:'post',data:dataToSend}).done(function(response){textField.text(inputNode.val());}).fail(function(response){ips.ui.alert.show({type:'alert',icon:'warn',message:response.responseJSON,});}).always(function(){inputNode.remove();span.show();self._editing=false;});}});inputNode.on('keypress',function(e){if(e.keyCode==ips.ui.key.ENTER){e.stopPropagation();e.preventDefault();inputNode.blur();return false;}});inputNode.on('keydown',function(e){if(e.keyCode==ips.ui.key.ESCAPE){inputNode.remove();span.show();self._editing=false;return false;}});}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.core.langString',{_url:null,_hideTimeout:null,_currentValue:'',initialize:function(){this.on('change','textarea',this.changeTextarea);this.on('focus','textarea',this.focusTextarea);this.on('blur','textarea',this.blurTextarea);this.on('click','[data-action="saveWords"]',this.saveWords);this.on('click','[data-action="revertWords"]',this.revertWords);this.setup();},setup:function(){this._url=this.scope.attr('data-saveURL');var contents=this.scope.find('a').html();var html=ips.templates.render('languages.translateString',{value:_.unescape(contents)});this._currentValue=_.unescape(contents);this.scope.html(html);this.scope.find('textarea').css({height:this.scope.closest('td').innerHeight()+'px'});},changeTextarea:function(){},focusTextarea:function(){this.scope.addClass('cTranslateTable_field_focus').find('textarea').removeClass('ipsField_success').end().find('[data-action]').show();},blurTextarea:function(){this._saveWords(true);},_hideButtons:function(e){this.scope.removeClass('cTranslateTable_field_focus');},saveWords:function(e){e.preventDefault();this._saveWords(false);},_saveWords:function(hideButtonsImmediately){var self=this;var url=this._url+'&form_submitted=1&csrfKey='+ips.getSetting('csrfKey');var textarea=this.scope.find('textarea');var value=textarea.val();if(this._currentValue==value){this._hideButtons();return;}
if(this._hideTimeout){clearTimeout(this._hideTimeout);}
this.scope.find('[data-action]').addClass('ipsButton_disabled');ips.getAjax()(url,{type:'post',data:{lang_word_custom:encodeURIComponent(value)}}).done(function(){textarea.removeClass('ipsField_loading').addClass('ipsField_success');ips.ui.flashMsg.show(ips.getString('saved'));if(!hideButtonsImmediately){self._hideTimeout=setTimeout(_.bind(self._hideButtons,self),300);}else{self._hideButtons();}
self._currentValue=value;}).fail(function(){window.location=url;});},revertWords:function(e){}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.core.mobileNav',{initialize:function(){this.on('click','[data-action="mobileSearch"]',this.mobileSearch);},mobileSearch:function(e){e.preventDefault();if($('body').hasClass('acpSearchOpen')){$('body').find('.ipsModal').trigger('click');}
$('body').toggleClass('acpSearchOpen');}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.core.newFeatures',{_modal:null,_container:null,_cards:null,_dots:null,_next:null,_prev:null,_data:[],_active:null,_popupActive:false,initialize:function(){this.on(document,'click','[data-action="nextFeature"]',this.next);this.on(document,'click','[data-action="prevFeature"]',this.prev);this.on(document,'click','[data-role="dotFeature"]',this.dot);this.on(document,'click','[data-action="closeNewFeature"]',this.close);this.on(document,'keydown',this.keydown);this.setup();},setup:function(){if(!this.scope.attr('data-newFeatures')){return;}
try{var data=$.parseJSON(this.scope.attr('data-newFeatures'));this._data=data.slice(0,9);}catch(err){Debug.error(err);}
this._buildPopup();this._showPopup();},keydown:function(e){if(!this._popupActive){return;}
switch(event.which){case 27:this.close();break;case 39:this.next();break;case 37:this.prev();break;}},close:function(e){if(e){e.preventDefault();}
this._popupActive=false;this._container.animate({transform:"scale(0.7)",opacity:"0"},'fast');ips.utils.anim.go('fadeOut',this._modal);},_animate:function(from,to,dir){to.css({transform:dir=='forward'?"translateX(100px)":"translateX(-100px)",opacity:"0"}).show();this._next.toggle(!!to.next().length);this._prev.toggle(!!to.prev().length);from.stop(true,true).animate({transform:dir=='forward'?"translateX(-100px)":"translateX(100px)",opacity:"0"},function(){from.hide()});to.stop(true,true).animate({transform:"translateX(0)",opacity:"1"});this._active=this._cards.index(to);this._dots.removeClass('acpNewFeature_active');this._dots.eq(this._active).addClass('acpNewFeature_active');},dot:function(e){if(e){e.preventDefault();}
var dot=$(e.currentTarget).parent();var idx=this._dots.index(dot);Debug.log('idx: '+idx);var current=this._cards.eq(this._active);var next=this._cards.eq(idx);var dir='forward';if(idx<this._active){dir='backward';}
if(idx==this._active){return;}
this._animate(current,next,dir);},next:function(e){if(e){e.preventDefault();}
var current=this._cards.eq(this._active);var next=current.next();if(!next.length){Debug.log('no next');return;}
this._animate(current,next,'forward');},prev:function(e){if(e){e.preventDefault();}
var current=this._cards.eq(this._active);var prev=current.prev();if(!prev.length){Debug.log('no prev');return;}
this._animate(current,prev,'backward');},_buildPopup:function(){var cards=[];var dots=[];this._modal=ips.ui.getModal();_.each(this._data,function(item){cards.push(ips.templates.render('newFeatures.card',{title:item.title,image:item.image,description:item.description,moreInfo:item.more_info||false}));});for(var i=0;i<cards.length;i++){dots.push(ips.templates.render('newFeatures.dot',{i:i}));}
var container=ips.templates.render('newFeatures.wrapper',{cards:cards.join(''),dots:dots.join('')});$('body').append(container);this._container=$('body').find('[data-role="newFeatures"]').css({opacity:"0.001",transform:"scale(0.8)"});this._cards=this._container.find('[data-role="card"]');this._dots=this._container.find('[data-role="dots"] [data-role="dot"]');this._next=this._container.find('[data-action="nextFeature"]').hide();this._prev=this._container.find('[data-action="prevFeature"]').hide();$(document).trigger('contentChange',[this._container]);this._modal.on('click',this._closeModal.bind(this));},_closeModal:function(e){e.preventDefault();this.close();},_showPopup:function(){var self=this;this._cards.not(':first').hide();this._active=0;this._dots.first().addClass('acpNewFeature_active');if(this._data.length>1){this._next.show();}
this._modal.css({zIndex:ips.ui.zIndex()});ips.utils.anim.go('fadeIn',this._modal);var title=self._container.find('[data-role="mainTitle"]');title.css({transform:"scale(1.2)",opacity:"0"});this._popupActive=true;setTimeout(function(){self._container.css({zIndex:ips.ui.zIndex()});self._container.animate({opacity:"1",transform:"scale(1)"},'fast');},500);setTimeout(function(){title.animate({opacity:"1",transform:"scale(1)"},'fast');},800);}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.core.notificationMenu',{initialize:function(){this.on(document,'menuOpened',this.menuOpened);$('body').on('updateNotificationCount',this.updateNotificationCount);this.setup();},setup:function(){var notificationCount=parseInt(this.scope.find('[data-role="notificationCount"]').text());if(isNaN(notificationCount)){notificationCount=0;}
var storedNotificationCount=parseInt(ips.utils.cookie.get('acpNotificationCount'));if(isNaN(storedNotificationCount)){storedNotificationCount=0;}
if(notificationCount>storedNotificationCount){setTimeout(function(){$(this.scope).find('[data-role="notificationIcon"]').addClass('cAcpNotifications_animate');}.bind(this),800);}
ips.utils.cookie.set('acpNotificationCount',notificationCount);},loaded:false,menuOpened:function(e,data){if(!this.loaded){var self=this;var ajaxObj=ips.getAjax();$('[data-role="notificationList"]').html('').css({height:'100px'}).addClass('ipsLoading');ajaxObj('?app=core&module=overview&controller=notifications',{dataType:'json'}).done(function(returnedData){$('[data-role="notificationList"]').css({height:'auto'}).removeClass('ipsLoading').html(returnedData.data);self.loaded=true;$(document).trigger('contentChange',[$('[data-role="notificationList"]')]);});}},updateNotificationCount:function(){ips.getAjax()('?app=core&module=overview&controller=notifications').done(function(response){var count=parseInt(response.count);if(count){$(this).find('[data-role="notificationCount"]').removeClass('ipsHide').text(count).closest('.cAcpNotifications').addClass('cAcpNotifications_active');}else{$(this).find('[data-role="notificationCount"]').addClass('ipsHide').closest('.cAcpNotifications').removeClass('cAcpNotifications_active');}}.bind(this));}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.core.viglink',{initialize:function(){this.on('submit',this._submitForm);},_submitForm:function(e){if($(e.currentTarget).find('input[name="viglink_account_type"]:checked').val()=='create'){window.open($(e.currentTarget).attr('data-viglinkUrl'),'viglink','height=980,width=780');}}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.core.acpSearchKeywords',{initialize:function(){this.on('click','[data-action="save"]',this.saveKeywords);},saveKeywords:function(e){e.preventDefault();var scope=this.scope;var data={url:scope.attr('data-url'),lang_key:scope.find("[data-role='lang_key']").val(),restriction:scope.find("[data-role='restriction']").val(),keywords:[]};scope.find("[data-role='keywords']").each(function(){if($(this).val()){data.keywords.push($(this).val());}});ips.getAjax()(scope.attr('data-action'),{data:data,type:'post',showLoading:true}).done(function(response){scope.trigger('closeMenu');ips.ui.flashMsg.show('Keywords saved');});},});}(jQuery,_));;