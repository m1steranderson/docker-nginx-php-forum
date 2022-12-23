;(function($,_,undefined){"use strict";ips.controller.register('core.admin.marketplace.launcher',{_termsAndConditions:false,_termsFromPurchase:false,_install:false,_dialog:null,initialize:function(){this._termsAndConditions=$('#downloadTerms').length?true:false;this.on('click','[data-action="signIn"]',this.signIn);this.on('click','[data-role="update"], [data-role="install"], [data-action="launchWindow"]',this.termsAndConditions);this.on('click','[data-role="renew"]',this.renewFromInvoice);this.on('menuItemSelected','#elFileRenew',this.renewFromInvoice);$(document).on('click','[data-action="acceptDisclaimer"]',_.bind(this.acceptTermsAndConditions,this));$(document).on('searchResultSelected',function(e,data){window.location=data.url;});this.on('click','[data-action="showError"]',this.showError);window.addEventListener('message',this.receivedMessage);},signIn:function(e){window.open(this.scope.data('url'),'_blank','height='+this.scope.attr('data-height')+',width=575,menubar=0,status=0,titlebar=0');},termsAndConditions:function(e){e.preventDefault();var disclaimer=this.scope.data('disclaimer-location');this._termsFromPurchase=$(e.target).data('role')=='purchase'?true:false;this._install=$(e.target).data('role')=='install'?true:false;if(this._termsAndConditions&&(disclaimer=='both'||this._termsFromPurchase==false&&disclaimer=='download'||this._termsFromPurchase==true&&disclaimer=='purchase')){this._dialog=ips.ui.dialog.create({content:'#downloadTerms',title:$('#downloadTerms').data('title')});this._dialog.show();}
else{this.acceptTermsAndConditions(new Event('tAndCs'),this);}},acceptTermsAndConditions:function(e){e.preventDefault();if(this._termsFromPurchase){window.open($('[data-purchase-url]').attr('data-purchase-url')+"&confirm=1",'_blank','height='+$('[data-purchase-url]').attr('data-height')+',width=575,menubar=0,status=0,titlebar=0');}
else{if(!_.isNull(this._dialog)){this._dialog.hide();this._dialog.destruct();}
var dialogRef=ips.ui.dialog.create({url:$('[data-role="install"],[data-role="update"]').attr('href')+"&confirm=1",remoteVerify:true,extraClass:'elMarketplaceInstallerDialog',size:'narrow',close:false,title:ips.getString(this._install?'marketplace_installing':'marketplace_updating')});dialogRef.show();return;}},showError:function(e){ips.ui.alert.show({type:'alert',icon:'warn',message:this.scope.attr('data-error'),});},receivedMessage:function(e){if(e.data==='OK'){$('button[data-action="signIn"]').attr('disabled',true);window.location=window.location;}
else if(e.data.error){switch(e.data.error){case'access_denied':break;case'_not_account_holder':ips.ui.alert.show({type:'alert',icon:'warn',message:ips.getString('marketplace_authentication_bad_account'),});break;default:ips.ui.alert.show({type:'alert',icon:'warn',message:ips.getString('marketplace_communication_error_js'),subText:e.data.error_description?(e.data.error_description+" ("+e.data.error+")"):e.data.error});}}},renewFromInvoice:function(e,data){if(!_.isUndefined(data)){data.originalEvent.preventDefault();var target=$(data.originalEvent.target).attr('href');}else{e.preventDefault();var target=$(e.target).attr('href');}
window.open(target,'_blank','height=900,width=575,menubar=0,status=0,titlebar=0');}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.marketplace.onboard',{initialize:function(){this.on('onboardMatch',this.check);this.check();},check:function(){var haveAllMatches=true;this.scope.find('[data-role="confirm"]').each(function(){if($(this).val()==0){haveAllMatches=false;}});if(haveAllMatches){this.scope.find('[data-role="continueButton"]').removeClass('ipsButton_disabled').prop('disabled',false);}else{this.scope.find('[data-role="continueButton"]').addClass('ipsButton_disabled').prop('disabled',true);}}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.marketplace.onboardRow',{_searchDialogs:[],initialize:function(){this.on('click','[data-action="searchMarketplace"]',this._searchMarketplace);this.on('click','[data-action="confirmMatch"]',this._confirmMatch);this.on('menuItemSelected',this._menuItemSelected);this.on(document,'searchResultSelected',this._searchResultSelected);this.setup();},setup:function(e){if(this.scope.attr('data-marketplaceId')){ips.getAjax()('?app=core&module=marketplace&controller=marketplace&do=apiLookup&id='+this.scope.attr('data-marketplaceId')).done(function(response){this.scope.find('[data-role="onboardLoading"]').hide();if(!_.isUndefined(response.html)){this.scope.find('[data-role="matchedFile"]').html(response.html).show();}else{this.scope.find('[data-role="matchedFile"]').hide();this.scope.find('[data-role="noMatchedFile"]').show();this.scope.find('[data-role="confirmed"]').hide();this.scope.find('[data-role="confirm_nomatch"]').show();}}.bind(this)).fail(function(){this.scope.find('[data-role="onboardLoading"]').hide();this.scope.find('[data-role="noMatchedFile"]').show();this.scope.find('[data-role="confirmed"]').hide();this.scope.find('[data-role="confirm_nomatch"]').show();}.bind(this));}else{ips.getAjax()('?app=core&module=marketplace&controller=marketplace&do=apiSearch&title='+encodeURIComponent('"'+this.scope.attr('data-title')+'"')+"&category="+this.scope.attr('data-category')+"&single=1").done(function(response){this.scope.find('[data-role="onboardLoading"]').hide();if(response){$(this.scope).find('[data-role="id"]').val(response.id);this.scope.find('[data-role="matchedFile"]').html(response.html).show();this.scope.find('[data-role="confirm_match"]').show();}else{this.scope.find('[data-role="noMatchedFile"]').show();this.scope.find('[data-role="confirm_nomatch"]').show();}}.bind(this)).fail(function(response){this.scope.find('[data-role="onboardLoading"]').hide();this.scope.find('[data-role="noMatchedFile"]').show();this.scope.find('[data-role="confirm_nomatch"]').show();}.bind(this));}},_searchMarketplace:function(e){if(e){e.preventDefault();e.stopPropagation();}
this._searchDialogs[this.scope.attr('data-id')]=ips.ui.dialog.create({title:ips.getString('marketplace_search'),url:'?app=core&module=marketplace&controller=marketplace&do=search&category='+this.scope.attr('data-category')});this._searchDialogs[this.scope.attr('data-id')].show();},_searchResultSelected:function(e,data){if(this._searchDialogs[this.scope.attr('data-id')]&&this._searchDialogs[this.scope.attr('data-id')].dialogID==data.dialogId){this._searchDialogs[this.scope.attr('data-id')].destruct();this.scope.find('[data-role="onboardLoading"]').show();this.scope.find('[data-role="confirm_match"]').hide();this.scope.find('[data-role="confirm_nomatch"]').hide();this.scope.find('[data-role="noMatchedFile"]').hide();this.scope.find('[data-role="matchedFile"]').hide();ips.getAjax()('?app=core&module=marketplace&controller=marketplace&do=apiLookup&id='+data.id).done(function(response){this.scope.find('[data-role="onboardLoading"]').hide();if(!_.isUndefined(response.html)){$(this.scope).find('[data-role="id"]').val(data.id);$(this.scope).find('[data-role="confirm"]').val('1');this.scope.find('[data-role="matchedFile"]').html(response.html).show();this.scope.find('[data-role="confirm_match"]').hide();this.scope.find('[data-role="confirmed"]').show();this.trigger('onboardMatch');}else{this.scope.find('[data-role="noMatchedFile"]').show();this.scope.find('[data-role="confirm_nomatch"]').show();}}.bind(this)).fail(function(){this.scope.find('[data-role="onboardLoading"]').hide();this.scope.find('[data-role="noMatchedFile"]').show();this.scope.find('[data-role="confirm_nomatch"]').show();}.bind(this));}},_confirmMatch:function(e){e.preventDefault();e.stopPropagation();$(this.scope).find('[data-role="confirm"]').val('1');this.scope.find('[data-role="confirm_match"]').hide();this.scope.find('[data-role="noMatchedFile"]').hide();this.scope.find('[data-role="confirmed"]').show();this.trigger('onboardMatch');},_menuItemSelected:function(e,data){data.originalEvent.preventDefault();if(data.selectedItemID=='confirmCustom'){this._confirmCustom();}else if(data.selectedItemID=='searchMarketplace'){this._searchMarketplace();}},_confirmCustom:function(){$(this.scope).find('[data-role="id"]').val('0');$(this.scope).find('[data-role="confirm"]').val('1');this.scope.find('[data-role="confirm_match"]').hide();this.scope.find('[data-role="confirm_nomatch"]').hide();this.scope.find('[data-role="matchedFile"]').hide();this.scope.find('[data-role="noMatchedFile"]').show();this.scope.find('[data-role="confirmed"]').show();this.trigger('onboardMatch');}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.admin.marketplace.search',{_timer:null,_textField:null,_lastValue:'',_ajax:null,initialize:function(){this._textField=$(this.scope).find('[data-role="searchBox"]');this.on(document,'focus','[data-role="searchBox"]',this.fieldFocus);this.on(document,'blur','[data-role="searchBox"]',this.fieldBlur);this.on('click','[data-file]',this.selectFile)
this.setup();},setup:function(e){this.scope.find('[data-role="searchBox"]').focus();},selectFile:function(e){e.preventDefault()
e.stopPropagation();this.trigger('searchResultSelected',{id:$(e.currentTarget).attr('data-file'),url:$(e.currentTarget).attr('href'),dialogId:$(e.currentTarget).closest('.ipsDialog').attr('id')});},fieldFocus:function(e){this._timer=setInterval(_.bind(this._timerFocus,this),700);},fieldBlur:function(e){clearInterval(this._timer);},_timerFocus:function(){var currentValue=this._textField.val();if(currentValue==this._lastValue){return;}
this._lastValue=currentValue;this._loadResults();},_loadResults:function(){if(this._ajax){this._ajax.abort();}
if(this._lastValue){this._textField.addClass('ipsField_loading');this.scope.find('[data-role="results"]').html('');var self=this;this._ajax=ips.getAjax()('?app=core&module=marketplace&controller=marketplace&do=apiSearch&title='+encodeURIComponent(this.scope.attr('data-search-literal')?('"'+this._lastValue+'"'):this._lastValue)+'&category='+this.scope.attr('data-category')+'&compatible='+this.scope.attr('data-compatible')).done(function(response){self.scope.find('[data-role="results"]').html(response.html);self.scope.find('[data-role="hideWhenSearching"]').hide();self._textField.removeClass('ipsField_loading');}).fail(function(failResponse){if(!_.isUndefined(failResponse.responseJSON)){self.scope.find('[data-role="results"]').html(failResponse.responseJSON.error);self.scope.find('[data-role="hideWhenSearching"]').hide();self._textField.removeClass('ipsField_loading');}});}else{this.scope.find('[data-role="results"]').html('');this.scope.find('[data-role="hideWhenSearching"]').show();this._textField.removeClass('ipsField_loading');}}});}(jQuery,_));;