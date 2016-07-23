
import * as dom from './../../dom.js';
import {registerPlugin} from './../../plugins.js';

export {TouchScroll};

//registerPlugin('touchScroll', TouchScroll);

/**
 * @class TouchScroll
 * @private
 * @plugin
 */
function TouchScroll() {

}

//TouchScroll.prototype.beforeInit = function(hotInstance) {
//  var _this = this;
//
//  this.instance = hotInstance;
//
//  Handsontable.hooks.add('afterInit', function() {
//    _this.init(this);
//  });
//};

TouchScroll.prototype.init = function(instance) {
  this.instance = instance;
  this.bindEvents();

  this.scrollbars = [
    this.instance.view.wt.wtOverlays.topOverlay,
    this.instance.view.wt.wtOverlays.leftOverlay,
    this.instance.view.wt.wtOverlays.topLeftCornerOverlay
  ];

  this.clones = [
    this.instance.view.wt.wtOverlays.topOverlay.clone.wtTable.holder.parentNode,
    this.instance.view.wt.wtOverlays.leftOverlay.clone.wtTable.holder.parentNode,
    this.instance.view.wt.wtOverlays.topLeftCornerOverlay.clone.wtTable.holder.parentNode
  ];
};

TouchScroll.prototype.bindEvents = function () {
  var that = this;

  this.instance.addHook('beforeTouchScroll', function () {
    Handsontable.freezeOverlays = true;

    for(var i = 0, cloneCount = that.clones.length; i < cloneCount ; i++) {
      dom.addClass(that.clones[i], 'hide-tween');
    }
  });

  this.instance.addHook('afterMomentumScroll', function () {
    Handsontable.freezeOverlays = false;

    for(var i = 0, cloneCount = that.clones.length; i < cloneCount ; i++) {
      dom.removeClass(that.clones[i], 'hide-tween');
    }

    for(var i = 0, cloneCount = that.clones.length; i < cloneCount ; i++) {
      dom.addClass(that.clones[i], 'show-tween');
    }

    setTimeout(function () {
      for(var i = 0, cloneCount = that.clones.length; i < cloneCount ; i++) {
        dom.removeClass(that.clones[i], 'show-tween');
      }
    },400);

    for(var i = 0, cloneCount = that.scrollbars.length; i < cloneCount ; i++) {
      that.scrollbars[i].refresh();
      that.scrollbars[i].resetFixedPosition();
    }
  });
};

var touchScrollHandler = new TouchScroll();

Handsontable.hooks.add('afterInit', function() {
  touchScrollHandler.init.call(touchScrollHandler, this);
});

