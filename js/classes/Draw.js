
(function(TEN, paper, $, Modenizr) {
  
  "use strict";
  
  TEN.Draw = function() {
    
    this.canvas = $('#drawStage');
    paper.setup(this.canvas[0]);
    this.pathString = '';
    
    this.downEvent = Modenizr.touch ? 'touchstart' : 'mousedown';
    this.upEvent = Modenizr.touch ? 'touchend' : 'mouseup';
    this.moveEvent = Modenizr.touch ? 'touchmove' : 'mousemove';
    this.canDraw = true;
    
    var t = this;
    
    this.canvas.on(this.downEvent, function(e) {
      t.startDraw(e);
      return false;
    });
    $('body').on(this.upEvent, function(e) {
      t.endDraw();
      return false;
    });
    
  }
  
  TEN.Draw.prototype.startDraw = function(e) {
    var pos = this.getEventPos(e);
    
    this.path = new paper.Path({
      segments: [pos],
      strokeColor: '#01abdb',
      strokeWidth: 5,
      strokeCap: 'round'
    });
    
    this.canDraw = true;
    var t = this;
    this.canvas.on(this.moveEvent, function(e) {
      t.drawTo(e);
      return false;
    });
  }
  
  TEN.Draw.prototype.endDraw = function() {
    if(this.path != null) {
      this.path.simplify(10);
      
      if(this.pathString != '') this.pathString += ';';
      this.pathString += this.path.pathData;
      
      this.path = null;
    }
    
    this.canvas.off(this.moveEvent);
    paper.view.draw();
  }
  
  TEN.Draw.prototype.drawTo = function(e) {
    if(this.canDraw) {
      var pos = this.getEventPos(e);

      this.path.add(pos);
      paper.view.draw();

      this.canDraw = false;
      var t = this;
      setTimeout(function() {
        t.canDraw = true;
      }, 10);
    }
  }
  
  TEN.Draw.prototype.stop = function() {
    this.endDraw();
    this.canvas.off(this.downEvent);
    $('body').off(this.upEvent);
  }
  
  TEN.Draw.prototype.getEventPos = function(e) {
    
    var x, y;
    
    x = e.pageX ? e.pageX : e.originalEvent.touches[0].pageX;
    y = e.pageY ? e.pageY : e.originalEvent.touches[0].pageY;
    
    x = x - this.canvas.offset().left;
    y = y - this.canvas.offset().top;
    
    return new paper.Point(x, y);
  }
  
})(TEN, paper, jQuery, Modernizr);
