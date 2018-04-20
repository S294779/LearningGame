
var welcome_page_prototype = {
    preload: function () {

        if (phaser_game_with_full_graphic == 1) {
            game.load.image('background_image', background_img_path);
            
            background_color = "#ffffff";
            text_background_color = '#ffffff';
            text_fill_color = "#8ED6FF";
            active_text_fill_color = "#8ED6FF";
            text_fill_color_hoverin = "#00FF00";
            selected_episode_text_fill = '#00dddd';
            congratulation_container_color = '0xe8efeb';
        } else {
            background_color = "#ffffff";
            text_background_color = '#b9af86';
            text_fill_color = "#e4daae";
            active_text_fill_color = "#8ED6FF";
            text_fill_color_hoverin = "#00FF00";
            selected_episode_text_fill = '#00dddd';
            congratulation_container_color = '0xe8efeb';
        }


    },
    create: function () {


        
            game.stage.backgroundColor = background_color;
        


        this.stage.scale.set(0.75, 0.6);
        this.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;//for scaling on window size

        //for header text start
        var start_header = game.world.centerX - 150;
        header_text = game.add.text(start_header + 150, 40, "  Learning Letters  ", {backgroundColor: text_background_color});
        header_text.anchor.setTo(0.5);
        header_text.font = 'Fontdiner Swanky';
        header_text.fontSize = 40;
        header_text.fill = text_fill_color;
        header_text.align = 'center';
        header_text.stroke = '#000000';
        header_text.strokeThickness = 2;
        //for header text end

        //for choose text start
        choose_a_letter = game.add.text(150, 200, "  Choose a letter  ", {backgroundColor: text_background_color});
        choose_a_letter.font = 'Fontdiner Swanky';
        choose_a_letter.anchor.setTo(0.5);
        choose_a_letter.fontSize = 30;
        choose_a_letter.fill = text_fill_color;
        choose_a_letter.align = 'center';
        choose_a_letter.stroke = '#000000';
        choose_a_letter.strokeThickness = 2;
        //for choose text end

        //for draw text start
        choose_a_letter = game.add.text(500, 200, "  Draw a letter  ", {backgroundColor: text_background_color});
        choose_a_letter.font = 'Fontdiner Swanky';
        choose_a_letter.anchor.setTo(0.5);
        choose_a_letter.fontSize = 30;
        choose_a_letter.fill = text_fill_color;
        choose_a_letter.align = 'center';
        choose_a_letter.stroke = '#000000';
        choose_a_letter.strokeThickness = 2;

        //for find text start
        choose_a_letter = game.add.text(850, 200, "  Find a letter  ", {backgroundColor: text_background_color});
        choose_a_letter.font = 'Fontdiner Swanky';
        choose_a_letter.anchor.setTo(0.5);
        choose_a_letter.fontSize = 30;
        choose_a_letter.fill = text_fill_color;
        choose_a_letter.align = 'center';
        choose_a_letter.stroke = '#000000';
        choose_a_letter.strokeThickness = 2;
        choose_a_letter.inputEnabled = true;
        choose_a_letter.input.useHandCursor = true;
        choose_a_letter.events.onInputOver.add(change_color_hover_in, {letter: choose_a_letter});
        choose_a_letter.events.onInputDown.add(choose_a_menu);
        choose_a_letter.events.onInputOut.add(change_color_hover_out, {letter: choose_a_letter});
        //for find text end

        //for Picture sort start
        choose_a_letter = game.add.text(150, 400, "  Picture Sort  ", {backgroundColor: text_background_color});
        choose_a_letter.font = 'Fontdiner Swanky';
        choose_a_letter.anchor.setTo(0.5);
        choose_a_letter.fontSize = 30;
        choose_a_letter.fill = text_fill_color;
        choose_a_letter.align = 'center';
        choose_a_letter.stroke = '#000000';
        choose_a_letter.strokeThickness = 2;
        //for Picture sort end

        //for Matching start
        choose_a_letter = game.add.text(500, 400, "  Matching  ", {backgroundColor: text_background_color});
        choose_a_letter.anchor.setTo(0.5);
        choose_a_letter.font = 'Fontdiner Swanky';
        choose_a_letter.fontSize = 30;
        choose_a_letter.fill = text_fill_color;
        choose_a_letter.align = 'center';
        choose_a_letter.stroke = '#000000';
        choose_a_letter.strokeThickness = 2;
        //for Matching end

        //for Sound start
        choose_a_letter = game.add.text(850, 400, " Sound ", {backgroundColor: text_background_color});
        choose_a_letter.anchor.setTo(0.5);
        choose_a_letter.font = 'Fontdiner Swanky';
        choose_a_letter.fontSize = 30;
        choose_a_letter.fill = text_fill_color;
        choose_a_letter.align = 'center';
        choose_a_letter.stroke = '#000000';
        choose_a_letter.strokeThickness = 2;
        //for Sound end

    },
    update: function () {

    },
    resize: function () {
        this.scale.refresh();
    },

};
function change_color_hover_in() {
    
    var text_obj = this.letter;
    text_obj.fill = text_fill_color_hoverin;
    text_obj.align = 'center';
    text_obj.stroke = '#000000';
    text_obj.strokeThickness = 2;
}
function change_color_hover_out() {
    var text_obj = this.letter;
    text_obj.fill = text_fill_color;
    text_obj.align = 'center';
    text_obj.stroke = '#000000';
    text_obj.strokeThickness = 2;
}
function choose_a_menu() {
    
    game.state.start('student_list');

    //game.state.start(tmp_page);
}



