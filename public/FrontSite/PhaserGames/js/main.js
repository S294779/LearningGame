var game;
var background_color = '#000000';
var control_icon_size = 60;
var text_background_color = '#ffffff';
window.onload = function () {
    game = new Phaser.Game(1000, 600, Phaser.AUTO);
    game.state.add("welcome_page", welcome_page);
    game.state.add("student_list", student_list);
    
    game.state.start("welcome_page");
    //game.state.start("student_list");

}

var welcome_page = function (game) {

}
var student_list = function (game) {

}

welcome_page.prototype = welcome_page_prototype;
student_list.prototype = student_list_prototype;

//configuration part





