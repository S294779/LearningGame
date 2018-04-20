
var student_list = {};
var first_level_of_student_list = 0;
var student_list_prototype = {

    preload: function () {

        load_student_data();

         $.each(student_list, function (key, student) {
            game.load.image('student' + '_' + student.id, public_user_img_path + student.profile_pic);
        })
  
        

    },
    create: function () {
        //for header text start
        var start_header = game.world.centerX - 150;
        header_text = game.add.text(start_header + 150, 40, " Click on your photo to play the game!! ", {backgroundColor: text_background_color});
        header_text.anchor.setTo(0.5);
        header_text.font = 'Fontdiner Swanky';
        header_text.fontSize = 30;
        header_text.fill = text_fill_color;
        header_text.align = 'center';
        header_text.stroke = '#000000';
        header_text.strokeThickness = 2;
        //for header text end 


        
        var container_width = game.world.centerX * 2;

        var container_height = game.world.centerY * 2;

        var num_stdnt_in_horizontal = 5;

        var num_of_h_fragment = num_stdnt_in_horizontal + 1;

        var h_segment_space_backup = container_width / num_of_h_fragment;

        var h_segment_space_first = h_segment_space_backup;

        first_level_of_student_list = 100;
        var varrtical_pos_space_student = first_level_of_student_list;

        var vertical_pos_diff = 140;
        var st_width = 100;
        var st_height = 100;
        var st_cnt = 1;
        var st_level = 1;
        var st_index = 1;
        $.each(student_list, function (key, student) {
            student_sprite_list = game.add.sprite(h_segment_space_first - st_width / 2, varrtical_pos_space_student, 'student' + '_' + student.id);
           
            
            if (st_cnt % num_stdnt_in_horizontal == 0) {
                h_segment_space_first = h_segment_space_backup;
                varrtical_pos_space_student += vertical_pos_diff;
                st_level++;
                st_index = 1;
            } else {
                h_segment_space_first += h_segment_space_backup;
                st_index++;
            }

            st_cnt++;
        })

        

    },
    update: function () {

    },
    resize: function () {
        this.scale.refresh();
    },
};
function load_student_data() {

    $.ajax({
        url: student_list_url,
        type: 'post',
        async: false,
        cache: false,
        data: {
            game_id: tmp_game_id
        },
        dataType: 'json',
        success: function (res) {
            if (res.status == true) {
                prof_img_size = res.image_size;
                $.each(res.datas, function (key, data) {
                    data.profile_pic = res.image_size + '/' + data.profile_pic;
                    student_list[key] = data;
                })
            }
        }
    })
}
