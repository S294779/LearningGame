<!DOCTYPE html>
<html>
    <head>
        <title>Html Game</title>
        <meta charset="UTF-8">
        <style>
            *{
                margin: 0;
                padding: 0;
                background: #fff;
            }
        </style>
        
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/phaser-ce-2.10/phaser.min.js') }}"></script>
    </head>
    <body>        
        <script>
            var phaser_game_with_full_graphic = 0;
            
            var tmp_page = '';
            var tmp_coll_st_token = '';
            var tmp_game_id = 0;
            var tmp_stdnt_id = 0;
            
            var public_user_img_path = "{{url('/user-profile').'/'}}";
            var public_asset_phaser_path = "{{url('/FrontSite/PhaserGames').'/'}}";
            var public_asset_path = "{{url('').'/'}}";
            var canvas_height = $(document).height(); 
            
            //api urls
            var student_list_url = "{{url('/phaser-game/student-list')}}";            
            
        </script>
        
        <script src="{{ asset('FrontSite/PhaserGames/js/welcome_page_prototype.js') }}"></script>
        <script src="{{ asset('FrontSite/PhaserGames/js/student_list_prototype.js') }}"></script>
        <script src="{{ asset('FrontSite/PhaserGames/js/main.js') }}"></script>
    </body>
</html>