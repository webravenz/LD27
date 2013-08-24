
(function(TEN, paper, $) {
  
  "use strict";
  
  TEN.Draw = function() {
    
    this.canvas = $('#drawStage');
    paper.setup(this.canvas[0]);
    
    var t = this;
    this.canvas.on('mousedown', function(e) {
      t.startDraw(e);
      return false;
    });
    $('body').on('mouseup', function(e) {
      t.endDraw();
      return false;
    });
    
  }
  
  TEN.Draw.prototype.startDraw = function(e) {
    var pos = this.getEventPos(e);
    
    this.path = new paper.Path({
      segments: [pos],
      strokeColor: '#4083f2',
      strokeWidth: 5,
      strokeCap: 'round'
    });
    
    var t = this;
    this.canvas.on('mousemove', function(e) {
      t.drawTo(e);
      return false;
    });
  }
  
  TEN.Draw.prototype.endDraw = function() {
    if(this.path != null) {
      this.path.simplify(10);
      console.log(this.path.pathData);
      this.path = null;
    }
    
    this.canvas.off('mousemove');
  }
  
  TEN.Draw.prototype.drawTo = function(e) {
    var pos = this.getEventPos(e);
    
    this.path.add(pos);
    paper.view.draw();
  }
  
  TEN.Draw.prototype.stop = function() {
    this.endDraw();
    this.canvas.off('mousedown');
    $('body').off('mouseup');
  }
  
  TEN.Draw.prototype.getEventPos = function(e) {
    
    var x, y;
    
    x = e.pageX - this.canvas.offset().left;
    y = e.pageY - this.canvas.offset().top;
    
    return new paper.Point(x, y);
  }
  
})(TEN, paper, jQuery);
