;(function($,_,undefined){"use strict";ips.controller.register('core.front.widgets.area',{_areaID:null,_orientation:'',_list:null,_managing:false,_wasUnused:true,_readyForDragging:false,initialize:function(){this.on('prepareForDragging.widgets',this.prepareForDragging);this.on('managingStarted.widgets',this.managingStarted);this.on('managingFinished.widgets',this.managingFinished);this.on('loadedWidget.widgets',this.widgetLoaded);this.on('removeWidget.widgets',this.widgetRemoved);this.setup();},setup:function(){this._areaID=this.scope.attr('data-widgetArea');this._orientation=this.scope.attr('data-orientation');this._list=this.scope.find('> ul');this._registerArea();if(this.scope.find('[data-blockID]').length){this._wasUnused=false;}},managingStarted:function(){this._managing=true;this.scope.addClass('cWidgetContainer_managing');this._setWidgetsToManaging(true);},managingFinished:function(){this._managing=false;this.scope.removeClass('cWidgetContainer_managing');this._setWidgetsToManaging(false);if(this._readyForDragging){this._list.sortable('destroy');}
this.scope.toggleClass('ipsHide',!this.scope.find('[data-blockID]').length);},prepareForDragging:function(e,data){var self=this;this._list.css({zIndex:ips.ui.zIndex(),});this._list.sortable({dragHandle:'.cSidebarBlock_managing',receive:_.bind(self.receiveWidget,self),placeholder:'cSidebarManager_placeholder',update:_.bind(self.updateOrdering,self),connectWith:data.selector,scroll:true});this._readyForDragging=true;},receiveWidget:function(e,ui){var blockID=ui.item.attr('data-blockID');var hasConfig=ui.item.attr('data-blockConfig');var title=ui.item.attr('data-blockTitle');var errormsg=ui.item.attr('data-blockErrorMessage');if(this.scope.find('li[data-blockID='+blockID+']').attr('data-hidden')){this.scope.find('li[data-blockID='+blockID+']').show().removeAttr('data-hidden');}else{this._buildNewWidget(blockID,this.scope.find('> ul > li').index(ui.item.get(0)),hasConfig,title,errormsg);}
ui.sender.sortable('cancel');if(!ui.item.attr('data-allowReuse')){ui.item.hide().attr('data-hidden',true);}},updateOrdering:function(without){if(!this._readyForDragging){Debug.log('trying...');setTimeout(_.bind(this.updateOrdering,this),500);return;}
var body=$('body');var order=this.scope.find('> ul').sortable('toArray',{attribute:'data-blockID'});order=(without)?_.without(_.uniq(order),without):_.uniq(order);var self=this;_.each(order,function(value,key){if(self.scope.find('li[data-blockID='+value+']').attr('data-hidden')=='true'){order=_.without(order,value);}});ips.getAjax()(ips.getSetting('baseURL')+'index.php?app=core&module=system&controller=widgets&do=saveOrder',{method:'POST',data:{order:order,pageApp:body.attr('data-pageApp'),pageModule:body.attr('data-pageModule'),pageController:body.attr('data-pageController'),area:this._areaID}}).fail(function(){ips.ui.alert.show({type:'alert',icon:'warn',message:ips.getString('sidebarError'),callbacks:{}});});},widgetLoaded:function(e,data){if(this._managing){$(e.target).trigger('startManaging.widgets');}},widgetRemoved:function(e,data){this.updateOrdering(data.blockID);},_buildNewWidget:function(blockID,idx,hasConfig,title,errormsg){var bits=blockID.split('_');var newBlockID=blockID;if(_.isUndefined(bits[3])){newBlockID=blockID+'_'+Math.random().toString(36).substr(2,9);}
var newWidget=$('<li/>').attr('data-blockID',newBlockID).attr('data-blockTitle',title).addClass('ipsWidget ipsBox').removeClass('ipsWidget_horizontal ipsWidget_vertical').addClass('ipsWidget_'+this._orientation).attr('data-controller','core.front.widgets.block').attr('data-blockErrorMessage',errormsg);if(hasConfig){newWidget.attr('data-blockConfig',"true");}
var before=$(this.scope.find('> ul > li:not( .cSidebarBlock_placeholder )').get(idx));if(!_.isUndefined(idx)&&before.length){before.before(newWidget);}else{this.scope.find('> ul').prepend(newWidget);}
$(document).trigger('contentChange',[newWidget]);newWidget.trigger('reloadContents.sidebar');},_setWidgetsToManaging:function(status){this.triggerOn('core.front.widgets.block',(status)?'startManaging.widgets':'stopManaging.widgets');},_registerArea:function(){var usedBlocks=this.scope.find('[data-blockID]');var blockIDs=[];if(usedBlocks.length){usedBlocks.each(function(idx,val){var blockID=$(val).attr('data-blockID');if(blockID){blockIDs.push(blockID);}});}
this.trigger('registerArea.widgets',{areaID:this._areaID,areaElem:this.scope,ids:blockIDs});}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.front.widgets.block',{_orientation:'',_blockID:'',_modalOpen:false,initialize:function(){this.setup();this.on('startManaging.widgets',this.startManaging);this.on('stopManaging.widgets',this.stopManaging);this.on('reloadContents.sidebar',this.reloadContent);this.on('click','[data-action="removeBlock"]',this.removeBlock);this.on('menuOpened',this.menuOpened);this.on('menuClosed',this.menuClosed);$(document).on('submitDialog',_.bind(this.submitDialog,this));$(document).on('markAllRead',_.bind(this.markAllRead,this));},setup:function(){this._blockID=this.scope.attr('data-blockID');this._orientation=this.scope.closest('[data-role="widgetReceiver"]').attr('data-orientation');},startManaging:function(e,data){if(this.scope.hasClass('ipsWidgetHide')){this.scope.removeClass('ipsHide');}
if(!this.scope.html()){this.scope.html(ips.templates.render('core.sidebar.blockIsEmpty',{text:this.scope.attr('data-blockerrormessage'),}));}
if(this.scope.find('.ipsWidgetBlank').length){this.scope.show();}
if(this.scope.attr('data-blockconfig')){this.scope.append(ips.templates.render('core.sidebar.blockManage',{id:this.scope.attr('data-blockID'),title:this.scope.attr('data-blockTitle')}));}else{this.scope.append(ips.templates.render('core.sidebar.blockManageNoConfig',{id:this.scope.attr('data-blockID'),title:this.scope.attr('data-blockTitle')}));}
$(document).trigger('contentChange',[this.scope]);},stopManaging:function(e,data){if(this.scope.hasClass('ipsWidgetHide')){this.scope.addClass('ipsHide');}
if(this.scope.find('.ipsWidgetBlank').length){this.scope.hide();}
this.scope.find('.cSidebarBlock_managing').animationComplete(function(){this.remove();});if(this.scope.attr('data-blockBuilder')){var blockID=this.scope.attr('data-blockID');var regex='\.'+blockID;$('style').each(function(){if($(this).text().match(regex)){$(this).text($(this).text().replace(regex,'\.old'+blockID));}});}
ips.utils.anim.go('fadeOut fast',this.scope.find('.cSidebarBlock_managing'));},removeBlock:function(e){e.preventDefault();this.scope.animationComplete(function(){this.remove();});ips.utils.anim.go('zoomOut fast',this.scope);this.trigger('removeWidget.widgets',{blockID:this._blockID});},reloadContent:function(){var self=this;this._setLoading(true);if(this._ajaxObj&&this._ajaxObj.abort){this._ajaxObj.abort();}
var body=$('body');var area=this.scope.closest('[data-widgetArea]').attr('data-widgetArea');var url=ips.getSetting('baseURL')+'index.php?app=core&module=system&controller=widgets&do=getBlock&blockID='+this._blockID+'&pageApp='+body.attr('data-pageApp')+'&pageModule='+body.attr('data-pageModule')+'&pageController='+body.attr('data-pageController')+'&pageArea='+area+'&orientation='+this._orientation;this._ajaxObj=ips.getAjax()(url).done(function(response){self.scope.hide().html(response.html);self.resetResponsiveClasses(response.devices);ips.utils.anim.go('fadeIn',self.scope);self.trigger('loadedWidget.widgets',{blockID:self._blockID});}).fail(function(){self.scope.html('Error');}).always(function(){self._setLoading(false);});},resetResponsiveClasses:function(deviceList){this.scope.removeClass('ipsResponsive_hidePhone').removeClass('ipsResponsive_hideDesktop').removeClass('ipsResponsive_hideTablet');var missing=_.filter(["Phone","Tablet","Desktop"],function(value){return!(deviceList.indexOf(value)!==-1);});self=this;_.each(missing,function(value){self.scope.addClass('ipsResponsive_hide'+value);})},menuOpened:function(e,data){if(!this.scope.closest('[data-widgetArea]').hasClass('cWidgetContainer_managing')){return;}
var body=$('body');var area=this.scope.closest('[data-widgetArea]').attr('data-widgetArea');var block=this._blockID;var self=this;var managerBlock=$('[data-role="availableBlocks"] [data-blockID="'+this._getBlockIDWithoutUniqueKey(this._blockID)+'"]');var menuStyle=managerBlock.attr('data-menuStyle');if(menuStyle=='modal'){var dialogRef=ips.ui.dialog.create({title:managerBlock.find('h4').html(),url:ips.getSetting('baseURL')+'index.php?app=core&module=system&controller=widgets&do=getConfiguration&block='+block+'&pageApp='+body.attr('data-pageApp')+'&pageModule='+body.attr('data-pageModule')+'&pageController='+body.attr('data-pageController')+'&pageArea='+area,forceReload:true,destructOnClose:true,remoteSubmit:true});dialogRef.show();this._modalOpen=block;}
else{data.menu.html($('<div/>').addClass('ipsLoading').css({height:'100px'}));setTimeout(function(){ips.getAjax()(ips.getSetting('baseURL')+'index.php?app=core&module=system&controller=widgets&do=getConfiguration',{data:{block:block,pageApp:body.attr('data-pageApp'),pageModule:body.attr('data-pageModule'),pageController:body.attr('data-pageController'),pageArea:area}}).done(function(response){data.menu.html(response).find('form').on('submit',_.bind(self._configurationForm,self,data.menu));$(document).trigger('contentChange',[data.menu]);});},1000);}},menuClosed:function(e,data){if(data.menu&&data.elemID.substring(data.elemID.length-4)==='edit'){ips.controller.cleanContentsOf(data.menu);data.menu.html('');}},submitDialog:function(e,data){if(this._modalOpen==this._blockID){this._modalOpen=false;this.reloadContent();}},markAllRead:function(){this.scope.find('.ipsDataItem, .ipsDataItem_subList').removeClass('ipsDataItem_unread').find('.ipsItemStatus').addClass('ipsItemStatus_read');},_configurationForm:function(menu,e){var self=this;e.preventDefault();ips.getAjax()($(e.currentTarget).attr('action'),{data:$(e.currentTarget).serialize(),type:'post'}).done(function(response){if(response==='OK'){self.reloadContent();menu.trigger('closeMenu');menu.remove();}else{menu.html(response);}}).fail(function(){ips.ui.alert.show({type:'alert',icon:'warn',message:ips.getString('sidebarConfigError'),callbacks:{}});});},_setLoading:function(status){if(status){this.scope.html('').addClass('ipsLoading cSidebarBlock_loading');}else{this.scope.removeClass('ipsLoading cSidebarBlock_loading');}},_getBlockIDWithoutUniqueKey:function(block){var bits=block.split('_');return bits[0]+'_'+bits[1]+'_'+bits[2];}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.front.widgets.manager',{_loadedManager:false,_loadingManager:false,_dragInitialized:false,_inManagingState:false,_wasUnused:false,_areasInUse:[],_blocksInUse:[],initialize:function(){this.on('click','[data-action="openSidebar"]',this.openSidebarManager);this.on('click','[data-action="closeSidebar"]',this.closeSidebarManager);this.on('removeWidget.widgets',this.widgetRemoved);this.on('registerArea.widgets',this.registerWidgetArea);this.setup();},setup:function(){var self=this;ips.loader.get(['core/front/controllers/widgets/ips.widgets.block.js']).then(function(){if(ips.utils.url.getParam('_blockManager')){self.openSidebarManager();}});if($('body').hasClass('ipsLayout_sidebarUnused')){this._wasUnused=true;}},registerWidgetArea:function(e,data){var self=this;this._areasInUse.push(data.areaID);if(data.ids){for(var i=0;i<data.ids.length;i++){self._blocksInUse.push(data.ids[i]);};}},openSidebarManager:function(e){if(e){e.preventDefault();}
if(this._inManagingState){return;}
if(!this.scope.find('[data-role="manager"]').length){this._buildSidebar();}else{this.scope.find('#elSidebarManager > div:first-child').css({overflow:'',position:'',top:''});}
this.triggerOn('core.front.widgets.area','managingStarted.widgets');this._showManager();this.scope.addClass('cWidgetsManaging');},closeSidebarManager:function(e){e.preventDefault();if(this._inManagingState){this._hideManager();this._cancelDragging();this.triggerOn('core.front.widgets.area','managingFinished.widgets');this.scope.removeClass('cWidgetsManaging');}},widgetRemoved:function(e,data){ips.utils.anim.go('fadeIn',this.scope.find('[data-role="availableBlocks"]').find('[data-blockID="'+this._getBlockIDWithoutUniqueKey(data.blockID)+'"]').removeAttr('data-hidden'));},_setUpDragging:function(){var self=this;var managerList=this.scope.find('[data-role="availableBlocks"] ul');var selectors=self._buildAreaSelector();ips.loader.get(['core/interface/jquery/jquery-ui.js']).then(function(){managerList.css({zIndex:ips.ui.zIndex(),}).sortable({dragHandle:'.cSidebarManager_block',connectWith:selectors,placeholder:'cSidebarManager_placeholder',scroll:true,start:_.bind(self._startDragging,self),stop:_.bind(self._cancelDragging,self)});self.triggerOn('core.front.widgets.area','prepareForDragging.widgets',{selector:selectors});});},_startDragging:function(){var sidebarPanel=this.scope.find('#elSidebarManager > div:first-child');var scrollTop=sidebarPanel.scrollTop();sidebarPanel.css({overflow:'visible',position:'relative',top:'-'+scrollTop+'px'});var managerList=this.scope.find('[data-role="availableBlocks"] ul');managerList.sortable('refresh');},_cancelDragging:function(){this.scope.find('#elSidebarManager > div:first-child').css({overflow:'',position:'',top:''});},_buildAreaSelector:function(){var output=[];for(var i=0;i<this._areasInUse.length;i++){output.push("[data-widgetArea='"+this._areasInUse[i]+"'] > ul");}
return output.join(',');},_showManager:function(){var self=this;this.scope.find('[data-action="openSidebar"]').hide();ips.utils.anim.go('fadeIn',this.scope.find('[data-role="manager"]')).done(function(){$('#elSidebarManager_submit').hide().delay(700).fadeIn('fast');});if(!this._loadedManager&&!this._loadingManager){ips.getAjax()(ips.getSetting('baseURL')+'index.php?app=core&module=system&controller=widgets&do=getBlockList',{data:{pageApp:$('body').attr('data-pageApp')}}).done(function(response){self._loadedManager=true;self.scope.find('[data-role="availableBlocks"]').html(response);self._setUpDragging();self._hideUsedBlocks();$(document).trigger('contentChange',[$('#elSidebarManager')]);}).fail(function(jqXHR,textStatus,errorThrown){ips.ui.alert.show({type:'alert',icon:'warn',message:ips.getString('sidebar_fetch_blocks_error'),callbacks:{}});}).always(function(){self.scope.find('[data-role="availableBlocks"]').removeClass('ipsLoading ipsLoading_dark');self._loadingManager=false;});}else{this._setUpDragging();this._hideUsedBlocks();}
this._inManagingState=true;},_hideManager:function(){var self=this;this.scope.find('[data-action="openSidebar"]').show();this.scope.find('#elSidebarManager').hide();this._inManagingState=false;},_hideUsedBlocks:function(){var self=this;var manager=this.scope.find('[data-role="availableBlocks"]');manager.find('[data-blockID]').show().removeAttr('data-hidden');if(this._blocksInUse.length){for(var i=0;i<this._blocksInUse.length;i++){var listedBlock=manager.find('[data-blockID="'+this._getBlockIDWithoutUniqueKey(self._blocksInUse[i])+'"]');if(!listedBlock.attr('data-allowReuse')){listedBlock.hide().attr('data-hidden',true);}}}},_buildSidebar:function(){this.scope.append(ips.templates.render('core.sidebar.managerWrapper'));this.scope.find('[data-role="availableBlocks"]').css({zIndex:ips.ui.zIndex()});$(document).trigger('contentChange',[this.scope]);},_getBlockIDWithoutUniqueKey:function(block){var bits=block.split('_');return bits[0]+'_'+bits[1]+'_'+bits[2];}});}(jQuery,_));;
;(function($,_,undefined){"use strict";ips.controller.register('core.front.widgets.sidebar',{initialize:function(){this.on('managingStarted.widgets',this.managingStarted);this.on('managingFinished.widgets',this.managingFinished);this.setup();},setup:function(){this._addBodyClass();},managingStarted:function(){var height=this.scope.height()+'px';this.scope.removeClass('ipsLayout_sidebarUnused').find('[data-role="widgetReceiver"], [data-role="widgetReceiver"] > ul').css({minHeight:height});},managingFinished:function(){this._addBodyClass();this.scope.find('[data-role="widgetReceiver"], [data-role="widgetReceiver"] > ul').css({height:'auto'});},_addBodyClass:function(){if(!this.scope.find('[data-blockID]:visible').length&&!$('#elContextualTools').length&&!$('[data-role="sidebarAd"]').length&&!$('#cAnnouncementSidebar').length){$('body').addClass('ipsLayout_sidebarUnused').removeClass('ipsLayout_sidebarUsed');}else{$('body').addClass('ipsLayout_sidebarUsed').removeClass('ipsLayout_sidebarUnused');}}});}(jQuery,_));;