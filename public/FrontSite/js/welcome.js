var welcome = new Phaser.Game('100%', '100%', Phaser.AUTO, 'welcome-stage');
var welcomeState = {
    preload: function () {
        this.load.image('background_image', 'images/welcome_images/welcome.jpg')
    },
    create: function () {
        var background_image = this.game.add.sprite(0, 0, 'background_image');
        console.log(this.scale.bounds.width);
        console.log(this.scale.bounds.height);
        background_image.scale.set(0.75, 0.6);
        this.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;//for scaling on window size
        var sprites = this.game.add.group();
        
        sprites.add(background_image);
        
    },
    update: function () {

    },
    resize:function(){
        
       this.scale.refresh();
    }
};
welcome.state.add('welcomeState', welcomeState);
welcome.state.start('welcomeState');

