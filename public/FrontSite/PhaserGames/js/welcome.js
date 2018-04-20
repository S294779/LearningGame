//var welcome = new Phaser.Game('100%', '100%', Phaser.AUTO, 'welcome-stage');
//var welcomeState = {
//    preload: function () {
//        this.load.image('background_image', 'http://localhost/phaser-game/public/images/welcome_images/welcome.jpg')
//    },
//    create: function () {
//        var background_image = this.game.add.sprite(0, 0, 'background_image');
//        console.log(this.scale.bounds.width);
//        console.log(this.scale.bounds.height);
//        background_image.scale.set(0.75, 0.6);
//        this.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;//for scaling on window size
//        var sprites = this.game.add.group();
//        
//        sprites.add(background_image);
//        
//    },
//    update: function () {
//
//    },
//    resize:function(){
//        
//       this.scale.refresh();
//    }
//};
//welcome.state.add('welcomeState', welcomeState);
//welcome.state.start('welcomeState');

var game;
var pointsArray = [];
var pointColors = ["0x00ff00", "0x00ff00", "0xff0000", "0xff0000"];
var bezierGraphics;
var movingSprite;

window.onload = function () {
    game = new Phaser.Game(1000, 600,Phaser.AUTO);
    //game = new Phaser.Game('100%', '100%',Phaser.AUTO);
    game.state.add("PlayGame", playGame)
    game.state.start("PlayGame");
}

var playGame = function (game) {
    
}
playGame.prototype = {
    preload: function () {
        game.load.image("point", "FrontSite/HtmlGame/images/point.png");
    },
    create: function () {
        this.stage.backgroundColor = "#66d4ff";
        this.stage.scale.set(0.75, 0.6);
        this.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;//for scaling on window size
        
        for (var i = 0; i < 4; i++) {
            var draggablePoint = game.add.sprite(game.rnd.between(100, game.width - 100), game.rnd.between(100, game.height - 100), "point");
            draggablePoint.inputEnabled = true;
            draggablePoint.tint = pointColors[i];
            draggablePoint.input.enableDrag();
            draggablePoint.anchor.set(0.5);
            draggablePoint.events.onDragStart.add(startDrag);
            draggablePoint.events.onDragStop.add(stopDrag);
            draggablePoint.events.onDragUpdate.add(updateDrag);
            pointsArray[i] = draggablePoint;
        }
        
        bezierGraphics = this.game.add.graphics(0, 0);
        updateDrag();
        stopDrag();
    },
    resize:function(){
       this.scale.refresh();
    }
}

function startDrag() {
    movingSprite.destroy();
}

function stopDrag() {
    movingSprite = game.add.sprite(pointsArray[0].x, pointsArray[0].y, "point");
    movingSprite.scale.set(0.5);
    movingSprite.anchor.set(0.5);
    var tween = game.add.tween(movingSprite).to({
        x: [pointsArray[0].x, pointsArray[1].x, pointsArray[2].x, pointsArray[3].x],
        y: [pointsArray[0].y, pointsArray[1].y, pointsArray[2].y, pointsArray[3].y],
    }, 5000, Phaser.Easing.Quadratic.InOut, true, 0, -1).interpolation(function (v, k) {
        return Phaser.Math.bezierInterpolation(v, k);
    });
}

function updateDrag() {
    bezierGraphics.clear();
    bezierGraphics.lineStyle(2, 0x008800, 1);
    bezierGraphics.moveTo(pointsArray[1].x, pointsArray[1].y);
    bezierGraphics.lineTo(pointsArray[0].x, pointsArray[0].y);
    bezierGraphics.lineStyle(2, 0x880000, 1)
    bezierGraphics.moveTo(pointsArray[3].x, pointsArray[3].y);
    bezierGraphics.lineTo(pointsArray[2].x, pointsArray[2].y);
    bezierGraphics.lineStyle(4, 0xffff00, 1);
    bezierGraphics.moveTo(pointsArray[0].x, pointsArray[0].y);
    for (var i = 0; i < 1; i += 0.001) {
        var p = bezierPoint(pointsArray[0], pointsArray[1], pointsArray[2], pointsArray[3], i);
        bezierGraphics.lineTo(p.x, p.y);
    }
}

function bezierPoint(p0, p1, p2, p3, t) {
    var cX = 3 * (p1.x - p0.x);
    var bX = 3 * (p2.x - p1.x) - cX;
    var aX = p3.x - p0.x - cX - bX;
    var cY = 3 * (p1.y - p0.y);
    var bY = 3 * (p2.y - p1.y) - cY;
    var aY = p3.y - p0.y - cY - bY;
    var x = (aX * Math.pow(t, 3)) + (bX * Math.pow(t, 2)) + (cX * t) + p0.x;
    var y = (aY * Math.pow(t, 3)) + (bY * Math.pow(t, 2)) + (cY * t) + p0.y;
    return {x: x, y: y};
}