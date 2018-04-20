@extends('AdminSite.layouts.main')
@section('title')
All users
@endsection
@section('breadcrumb')
<li><a class="" href="{{url('/admin')}}">Home</a></li>
<li><a class="disabled" href="#">Student List</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">All Students</h1>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <a class="btn btn-success" href="{{url(Config::get('constants.admin_prefix').'/user-manage/newuser')}}">Create</a>
                        </p>
                        <?php
                            $dir_name = App\Modules\Users\Models\UserManage::FILE_DIR;
                            $image_size = App\Modules\Users\Models\UserManage::PROFILE_ICON_SIZE_MEDIUM;
                        ?>
                        <?=
                        App\CustomLibrary\Gridview::show([
                            'db' => $db,
                            'result_highlight' => true,
                            'database_table' => 'sys_users',
                            'display_columns' => [
                                [
                                    'field_name' => 'id',
                                    'display' => false
                                ],
                                [
                                    'field_name' => 'name',
                                    'search_query' =>'like',
                                    'sort_by' => 'name',
                                ],
                                [
                                    'field_name' => 'profile_pic',
                                    'sort_by' => 'profile_pic',
                                    'value'=>function($model)use($dir_name,$image_size){                            
                                            $file_name = $model->profile_pic?$model->profile_pic:'';
                                            $fle_path = $file_name?url($dir_name.'/'.$image_size.'/'.$file_name):url('/file-source','default-profile.png');
                                            return '<img src="'.$fle_path.'" style="width:100px">';
                                    }
                                ],
                                [
                                    'field_name' => 'email',
                                    'search_query' =>'like',
                                    'sort_by' => 'email',
                                ],                                
                                [
                                    'field_name' => 'status',
                                    'label' => 'Status',
                                    'value' => function($model) {
                                        return ($model->status==1)?'<i class="fa fa-check text-success"></i>':'<i class="fa fa-remove text-danger"></i>';
                                    },
                                    'search_query' => '=',
                                    'search_input' => function($current_val) {
                                        $html = '<select  name="status" class="form-control select-by-select2" data-allowclear="1">';
                                        $html .= "<option value=''>Select Status</option>";
                                        $selected1 = '';
                                        $selected2 = '';
                                        if ($current_val == 1) {
                                            $selected1 = 'selected';
                                        }
                                        if ($current_val == 2) {
                                            $selected2 = 'selected';
                                        }
                                        $html .= "<option value='1' $selected1>Active</option>";
                                        $html .= "<option value='2' $selected2 >Inactive</option>";

                                        $html .= '</select>';
                                        return $html;
                                    }
                                ],
                                [
                                    'column_name' => 'action',
                                    'value' => function($model) {
                                        $viewUrl = url(Config::get('constants.admin_prefix').'/group/view', $model->id);
                                        $editUrl = url(Config::get('constants.admin_prefix').'/user-manage/updateuser', $model->id);
                                        $deleteUrl = url(Config::get('constants.admin_prefix').'/user-manage/deleteuser', $model->id);
                                        return "<a href='$editUrl'><i class='fa fa-edit'></i></a>
                                                <a href='$deleteUrl' data-method='post'><i class='fa fa-trash'></i></a>";
                                    }
                                ]
                            ]
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (e) {
        $('.select-roles').select2({
            placeholder: 'Select Roles'
        })
    })

</script>
@endsection