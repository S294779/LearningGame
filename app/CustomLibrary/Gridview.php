<?php

namespace App\CustomLibrary;
use Illuminate\Support\Facades\URL;
use Exception;

/**
  From the database $db has to be send to view page and $db variable must be assigned like $db = new Db;
    {!!App\CustomLibrary\Gridview::show([
        'db'=>$db,
        'table_body_id' => 'sortable-container',
        'table_class' => 'table table-bordered table-hover',
        'database_table' => 'menu_items',
        'result_highlight'=>true,
        'display_footer' => true,
        'row_data_properties' => function($model) {
                return [
                    'data-id' => $model->menu_item_id
                ];
        },
        'default_condition'=>function($db)use($menu_id){
                $db->where(['menu_id'=>$menu_id]);
        },
        'default_order' => [
            'menu_item_order' => 'ASC'
        ],
        'global_search_fields' => [
            [
                [
                    'field_name' => 'menu_item_name',
                    'search_query' => 'like',
                ],
                [
                    'field_name' => 'icon',
                    'search_query' => 'like',
                ]
            ],
            [
                [
                    'field_name' => 'navigation',
                    'search_query' => 'like',
                ],
            ]
        ],
        'display_columns' => [
            [
                'field_name' => 'menu_item_id',
                'display' => false
            ],
            [
                'field_name' => 'menu_item_name',
                'search_query' => function($db, $value) {
                    $db->where('menu_item_name', 'like', "%$value%");
                },
                'sort_by' => 'menu_item_name',
                'footer_content' => function($model, $last_value) {
                    return $model->menu_item_id + (int) $last_value;
                },
            ],
            [
                'field_name' => 'icon',
                'value' => function($model) {
                    return '<i class="' . $model->icon . '"></i> ' . $model->icon;
                },
                'search_query' => 'like', // function in the search_query get query and sort field value as parameters
            ],
            [
                'field_name' => 'navigation',
                'search_query' => 'like',
                'sort_by' => 'navigation'//function in the sort_by get query and sort field value as parameters
            ],
            [
                'field_name' => 'parent_id',
                'label' => 'Parent',
                'value' => function($model) {//function in the value get model data as parameters
                    return $model->getParentName($model->parent_id);
                },
                'search_input' => function($current_val)use($parents) {
                    $html = '<select id="sort_decision" data-current="{{$current_val}}" name="parent_id" class="form-control select-by-select2" data-allowclear="1">';
                    $html .= "<option value=''>Select Parent</option>";
                    foreach ($parents as $parent_id => $parent_name) {
                        $selected = '';
                        if ($current_val == '') {

                        } elseif ($current_val == $parent_id) {
                            $selected = 'selected';
                        }
                        $html .= "<option data-current='$current_val' value='$parent_id' $selected>$parent_name</option>";
                    }
                    $html .= '</select>';
                    return $html;
                },
                'search_query' => '=',
                'sort_by' => 'parent_id'
            ],
            [
                'field_name' => 'menu_item_status',
                'label' => 'Status',
                'value' => function($model) {
                    if ($model->menu_item_status == 1) {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
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
                    $editUrl = url('admin/menu-manage/update', $model->menu_id);
                    $deleteUrl = url('admin/menu-manage/delete', $model->menu_id);
                    return "<a href='$editUrl'><i class='fa fa-edit'></i></a>
                            <a href='$deleteUrl' data-method='post'><i class='fa fa-trash'></i></a>";
                }
            ]
        ]
    ])!!}
 */
class Gridview {

    /**
     * class for gridview
     */
    const global_search_field = 'global_value';

    /**
     * Hold partial query
     * For laravel "$db = MenuItems::query();" only which must be passed to show function
     * @var type 
     */
    private static $db = [];
    private static $display_columns = [];
    private static $search_found = false;
    private static $searchItems = [];
    private static $id = 'grid_default_id';
    
    private static $give_only_data = false;
    /**
     * Default Page Size
     * @var type 
     */
    private static $page_size = 20;

    /**
     * serial munber for serial column
     * @var type 
     */
    private static $serial_no = 1;

    /**
     * used to hold joinwith
     * @var type 
     */
    private static $joinWiths = [];

    /**
     * used to hold row url if we want action on clicking table row
     * @var type 
     */
    private static $row_url = false;

    /**
     * used to hold class for table row
     * @var type 
     */
    private static $row_class = false;

    /**
     * used to hold class for table body
     * @var type 
     */
    private static $table_body_class = '';

    /**
     * used to hold id for table body speciall for table row sorting where table body is needed.
     * @var type 
     */
    private static $table_body_id = ''; //id="sortable-container"

    /**
     * used to hold row style
     * @var type 
     */
    private static $row_style = '';

    /**
     * used to hold row data properties.
     * @var type 
     */
    private static $row_data_properties = false;

    /**
     * used to hold class for table
     * @var type 
     */
    private static $table_class = 'table table-bordered';

    /**
     * default order parameter
     * @var type 
     */
    private static $default_order = [];

    /**
     * This parameter for global search columns
     * @var type 
     */
    private static $global_search_fields = [];

    /**
     * 
     * @var type 
     */
    private static $global_search_columns = [];

    /**
     * used to collect html for grid view
     * @var type 
     */
    private static $htmlCollection = '';

    /**
     * used to give span value for result not found row Not for external use
     * @var type 
     */
    private static $heading_column_count = 1;

    /**
     * used to make decision to display table footer or not
     * @var type boolean
     */
    private static $display_footer = false;
    private static $footer_content = [];
    private static $selected_fields = [];
    private static $gridview_errors = false;
    private static $table_name = '';
    private static $offset = 0;
    private static $total_data = 0;
    private static $result_highlight = false;
    private static $global_search_applied = false;
    private static $global_field_name_tmp_coll = [];
    private static $layout = '{global_search}{summery}{table}{pagination}';
    private static $default_condition = false;
    
    private static $array_values_of_function_called = [];

    /**
     * used to show table for gridview with requited parameters
     * @param type $params
     * @return type
     */
    public static function show($params = []) {
        self::$htmlCollection = '';
        self::$serial_no = 1;
        self::$heading_column_count = 1;
        self::$offset = 0;
        self::$total_data = 0;
        self::$layout = '{global_search}{summery}{table}{pagination}';
        self::$give_only_data = false;
        self::$default_condition = false;
        
        if (isset($params['db'])) {
            self::$db = $params['db'];
        } else {
            self::displayError('query is missing.');
        }
        if (isset($params['id'])) {
            self::$id = $params['id'];
        }
        if (isset($params['formClass'])) {
            self::$id = $params['formClass'];
        }
        if (isset($params['database_table'])) {
            self::$table_name = $params['database_table'];
        } else {
            self::displayError('database_table name is missing.');
            self::$gridview_errors = true;
        }
        if (isset($params['display_columns'])) {
            self::$display_columns = $params['display_columns'];
        } else {
            self::displayError('display column is missing.');
        }

        if (isset($params['page_size'])) {
            self::$page_size = $params['page_size'];
        }
        if (isset($params['joinWith'])) {
            self::$joinWiths = $params['joinWith'];
        }
        if (isset($params['row_url'])) {
            self::$row_url = true;
        }
        if (isset($params['row_class'])) {
            self::$row_class = true;
        }
        if (isset($params['row_style'])) {
            self::$row_style = true;
        }
        if (isset($params['row_data_properties'])) {
            self::$row_data_properties = true;
        }
        if (isset($params['table_body_id'])) {
            self::$table_body_id = $params['table_body_id'];
        }
        if (isset($params['table_body_class'])) {
            self::$table_body_class = $params['table_body_class'];
        }
        if (isset($params['table_class'])) {
            self::$table_class = $params['table_class'];
        }
        if (isset($params['default_order'])) {
            foreach ($params['default_order'] as $column_name => $order) {
                if (is_numeric($column_name)) {
                    throw new Exception('Default Order must be associative');
                }
            }
            self::$default_order = $params['default_order'];
        }
        if (isset($params['global_search_fields'])) {
            self::$global_search_fields = $params['global_search_fields'];
        }
        if (isset($params['display_footer'])) {
            self::$display_footer = $params['display_footer'];
        }
        if (isset($params['result_highlight'])) {
            self::$result_highlight = $params['result_highlight'];
        }
        if (isset($params['give_only_data'])) {
            self::$give_only_data = $params['give_only_data'];
        }
        if (!self::$gridview_errors) {//execute only if syntax error in gridview
            $layout_str = ltrim(self::$layout,'{');
            $layout_str = rtrim($layout_str,'}');
            $layout = explode('}{', $layout_str);
            
            if (isset($_GET[self::$id]['page'])) {
                if (is_numeric($_GET[self::$id]['page'])) {
                    self::$offset = self::$page_size * ($_GET[self::$id]['page'] - 1);
                }
                
            }
            foreach (self::$display_columns as $display_column) {

                if (isset($display_column['field_name'])) {
                    self::$selected_fields[] = $display_column['field_name'];
                }
            }
            if(in_array('global_search', $layout) != true){
                self::$global_search_fields = [];
            }
            $_query = self::$db;
            $main_query = $_query::table(self::$table_name);
            $main_query->select(self::$selected_fields);
            self::$db = $main_query;
            if (isset($params['default_condition'])) {
                $params['default_condition'](self::$db);
            }
            self::apply_condition();
            self::$db->offset(self::$offset);
            self::$db->limit(self::$page_size);
            
            $models = self::$db->get();
            
            
            $formUrl = self::fullUrlWith_get_parameters(URL::current(), array_merge(self::$searchItems, ['page' => 1]), true);
            
            /*****************Global field section start****************/
            $global_search_field_html = '';
            if(in_array('global_search', $layout) == true){
                    $global_search_field_count = count(self::$global_search_fields);
                    if ($global_search_field_count > 0) {
                        $global_search_field_html .= '<div class="row ' . self::$id . '" data-formurl="' . $formUrl . '">';
                        $column_divide = 12 / $global_search_field_count;
                        if ($column_divide >= 3) {
                            $column_divide = 4;
                        }
                        $global_field_name = self::global_search_field;
                        $_g_field_count = 1;
                        foreach (self::$global_search_fields as self::$global_search_columns) {

                            $__global_val = '';
                            $global_field_name_tmp = $global_field_name . $_g_field_count;
                            self::$global_field_name_tmp_coll[] = $global_field_name_tmp;
                            if (isset($_GET[self::$id][$global_field_name_tmp])) {
                                $__global_val = $_GET[self::$id][$global_field_name_tmp];
                            }
                            if (isset(self::$global_search_columns['search_input'])) {
                                $input_field = self::$global_search_columns($field_val);
                                $f_name = $global_field_name_tmp;
                                $_id = self::$id;
                                $input_field = preg_replace('/name="[a-z0-9_-]+"/','name="'.$_id.'['.$f_name.']"',$input_field);
                                
                                $global_search_field_html .= "<div class='col-md-" . $column_divide . "'>$input_field</div>";
                            } else {
                                $global_search_field_html .= "<div class='col-md-" . $column_divide . "'><input class='form-control' style='font-weight: bold;' type='text' name='" . self::$id . '[' . $global_field_name_tmp . ']' . "' value='" . $__global_val . "'></div>";
                            }
                            $_g_field_count++;
                        }
                        $global_search_field_html .= '</div>';
                    }
            }
            /**********************Global field section end ************************/
            
            $main_query = $_query::table(self::$table_name);
            $main_query->select(self::$selected_fields);
            self::$db = $main_query;
            if (isset($params['default_condition'])) {
                $params['default_condition'](self::$db);
            }
            self::apply_condition();
            
            self::$total_data = self::$db->count();
            
            $summery_html = '';
            if(in_array('summery', $layout) == true){
                $summery_html .= '<p class="summary">Showing ' . (self::$total_data<=0?0:(self::$offset + 1)) . '-' . ((self::$offset + self::$page_size) < self::$total_data ? (self::$offset + self::$page_size) : self::$total_data) . ' of ' . self::$total_data . ' items</p>';
            }
            $table_html = '';
            if(in_array('table', $layout) == true && self::$give_only_data == false){
                $table_html .= '<div class="table-responsive">';
                $table_html .= '<table class="' . self::$table_class . '" style="margin-bottom: 0;">';
                $table_html .= '<thead class="' . self::$id . '" data-formurl="' . $formUrl . '">';
                $table_html .= '<tr>'; //table heading start
                $table_html .= "<th>#</th>";
                foreach (self::$display_columns as $display_column) {
                    if (isset($display_column['display'])) {
                        if ($display_column['display'] === false) {
                            continue;
                        }
                    }
                    self::$heading_column_count++;

                    if (isset($display_column['column_name'])) {
                        if (isset($display_column['label'])) {
                            $label = $display_column['label'];
                        } else {
                            $label = str_replace('_', ' ', $display_column['column_name']);
                            $label = ucwords($label);
                        }
                        $table_html .= "<th><a href='javascript:void(0)'>$label</a></th>";
                    } else {
                        $sort_url = self::fullUrlWith_get_parameters(URL::current(), ['sort' => self::getSort_field($display_column['field_name'])]);
                        if (isset($display_column['label'])) {
                            $label = $display_column['label'];
                        } else {
                            $label = str_replace('_', ' ', $display_column['field_name']);
                            $label = ucwords($label);
                        }
                        $table_html .= "<th><a href='$sort_url'>$label</a></th>";
                    }
                }
                $table_html .= '</tr>'; //table heading end

                if (self::$search_found) {
                    $table_html .= '<tr>'; //table heading search start
                    $table_html .= "<th></th>";
                    foreach (self::$display_columns as $display_column) {
                        if (isset($display_column['display'])) {
                            if ($display_column['display'] === false) {
                                continue;
                            }
                        }
                        if (isset($display_column['search_query']) && isset($display_column['field_name'])) {
                            $field_name = $display_column['field_name'];
                            $field_val = self::getFromUrl($field_name);

                            if (isset($display_column['search_input'])) {
                                $input_field = $display_column['search_input']($field_val);
                                $f_name = $display_column['field_name'];
                                $_id = self::$id;
                                $input_field = preg_replace('/name="[a-z0-9_-]+"/','name="'.$_id.'['.$f_name.']"',$input_field);
                                $table_html .= "<th>$input_field</th>";
                            } else {
                                $table_html .= "<th><input class='form-control' type='text' name='" . self::$id . '[' . $field_name . ']' . "' value='$field_val'></th>";
                            }
                        } else {
                            $table_html .= "<th></th>";
                        }
                    }
                    $table_html .= '</tr>'; //table heading search end
                }
                $table_html .= '</thead>';
                $table_html .= '<tbody class="' . self::$table_body_class . '" id="' . self::$table_body_id . '">';
                foreach ($models as $model) {
                    $r_class = '';
                    if (self::$row_class) {
                        $r_class = $params['row_class']($model);
                    }
                    $r_style = '';
                    if (self::$row_style) {
                        $r_styles = $params['row_style']($model);

                        foreach ($r_styles as $style => $value) {
                            $r_style = ' ' . $style . ':"' . $value . ';"';
                        }
                    }
                    $r_data_properties = '';
                    if (self::$row_data_properties) {
                        $r_data_properties_arr = $params['row_data_properties']($model);

                        foreach ($r_data_properties_arr as $r_data_property => $value) {
                            $r_data_properties = ' ' . $r_data_property . '="' . $value . ';"';
                        }
                    }
                    $table_html .= '<tr class="' . $r_class . '" ' . $r_data_properties . '>';
                    if (self::$row_url) {
                        $r_url = $params['row_url']($model);
                        $table_html .= "<td><a href='$r_url'><div>" . self::$serial_no . "</div></a></td>";
                    } else {
                        $table_html .= "<td>" . self::$serial_no . "</td>";
                    }

                    foreach (self::$display_columns as $display_column) {
                        $value = '';
                        //this may be field name or column name
                        $fieldName = isset($display_column['column_name']) ? $display_column['column_name'] : $display_column['field_name'];

                        if (isset($display_column['footer_content'])) {
                            $f_content = self::$footer_content;
                            if (!isset($f_content[$fieldName])) {
                                $f_content[$fieldName] = '';
                            }
                            $f_content[$fieldName] = $display_column['footer_content']($model, $f_content[$fieldName]);
                            self::$footer_content = $f_content;
                        }
                        if (isset($display_column['value'])) {
                            $value = $display_column['value']($model);
                            self::$array_values_of_function_called[$fieldName][] = $value;
                        } else {
                            if (!isset($display_column['column_name'])) {
                                $field_temp = explode('.', $fieldName);
                                if (isset($field_temp[1])) {
                                    $field_temp = $field_temp[1];
                                    $value = $model->$field_temp;
                                } else {
                                    $value = $model->$fieldName;
                                }
                            }
                        }
                        if (isset($display_column['display'])) {
                            if ($display_column['display'] === false) {
                                continue;
                            }
                        }
                        if (self::$result_highlight) {
                            if (self::$global_search_applied) {

                                $g_f_temp_val = [];
                                $g_f_temp_val_highlight = [];
                                foreach (self::$global_field_name_tmp_coll as $global_field_name_tmp_col) {
                                    if (isset($_GET[self::$id][$global_field_name_tmp_col])) {
                                        preg_match_all('/'.$_GET[self::$id][$global_field_name_tmp_col].'/i', $value,$words_founds);
                                        $g_f_temp_val = array_flatten($words_founds);
                                        if(isset(self::$array_values_of_function_called[$global_field_name_tmp_col])){
                                            if($_GET[self::$id][$global_field_name_tmp_col] != ''){
                                                $g_f_temp_val = array_merge($g_f_temp_val,self::$array_values_of_function_called[$global_field_name_tmp_col]);
                                            }
                                        }
                                        foreach($g_f_temp_val as $g_f_temp){
                                            $g_f_temp_val_highlight[] = '<b>'.$g_f_temp.'</b>';
                                        }
                                    }
                                }
                                $value = str_replace($g_f_temp_val, $g_f_temp_val_highlight, $value);
                            } elseif (isset($display_column['field_name'])) {
                                if (isset($_GET[self::$id][$display_column['field_name']])) {
                                    
                                    preg_match_all('/'.$_GET[self::$id][$display_column['field_name']].'/i', $value,$words_founds);
                                    $words_founds = array_flatten($words_founds);
                                    if(isset(self::$array_values_of_function_called[$display_column['field_name']])){
                                        if($_GET[self::$id][$display_column['field_name']] != ''){
                                            $words_founds = array_merge($words_founds,self::$array_values_of_function_called[$display_column['field_name']]);
                                        }
                                    }
                                    $replacing_words = [];
                                    foreach($words_founds as $words_found){
                                        $replacing_words[] = '<b>'.$words_found.'</b>';
                                    }
                                    
                                    $value = str_replace($words_founds,$replacing_words, $value);
                                }
                            }
                        }
                        if (self::$row_url) {
                            $r_url = $params['row_url']($model);
                            $table_html .= "<td><a href='$r_url'><div>$value</div></a></td>";
                        } else {
                            $table_html .= "<td>$value</td>";
                        }
                    }
                    
                    $table_html .= '</tr>';
                    self::$serial_no++;
                }
                if (self::$serial_no == 1) {
                    $table_html .= '<tr>';
                    $table_html .= '<td colspan="' . self::$heading_column_count . '">';
                    $table_html .= 'No results found.';
                    $table_html .= '</td>';
                    $table_html .= '</tr>';
                }
                $table_html .= '</tbody>';
                if (self::$display_footer) {
                    $f_content = self::$footer_content;
                    $table_html .= '</tfooter>';
                    $table_html .= '<tr>';
                    $table_html .= '<td>';
                    $table_html .= '</td>';
                    foreach (self::$display_columns as $display_column) {
                        if (isset($display_column['display'])) {
                            if ($display_column['display'] === false) {
                                continue;
                            }
                        }
                        $table_html .= '<td>';
                        if (isset($display_column['footer_content'])) {
                            if (isset($f_content[$display_column['field_name']])) {
                                $table_html .= $f_content[$display_column['field_name']];
                            }
                        }
                        $table_html .= '</td>';
                    }
                    $table_html .= '</tr>';
                    $table_html .= '</tfooter>';
                }
                $table_html .= '</table>';
                $table_html .= '</div>';
            }
            if(self::$give_only_data){
                $returning_data = [];
                if(in_array('global_search', $layout) == true){
                    $returning_data['global_search_fields'] = $global_search_field_html;
                }
                if(in_array('summery', $layout) == true){
                    $returning_data['summery_html'] = strip_tags($summery_html);
                }
                $returning_data['datas'] = $models->toArray();
                if(in_array('pagination', $layout) == true){
                    
                    $returning_data['pagination'] = self::generate_links(URL::current());
                }
                $returning_data['js'] = self::getJsScript();
                return $returning_data;
            }
            if(in_array('pagination', $layout) == true){
                return $global_search_field_html.$summery_html.$table_html . self::generate_links(URL::current()) . self::getJsScript();
            }else{
                return $global_search_field_html.$summery_html.$table_html. self::getJsScript();
            }
        }
    }

    private static function apply_condition() {
        foreach (self::$display_columns as $display_column) {

            if (isset($display_column['field_name'])) {
                if (isset($display_column['search_query'])) {
                    self::$search_found = true;
                    if (!(false === $value = self::getFromUrl($display_column['field_name']))) {
                        if (isset($display_column['display'])) {
                            if ($display_column['display'] === false) {
                                continue;
                            }
                        }
                        if (is_object($display_column['search_query'])) {
                            $display_column['search_query'](self::$db, $value);
                        } elseif ($display_column['search_query'] == 'like') {
                            self::$db->where($display_column['field_name'], 'LIKE', "%$value%");
                        } else {
                            self::$db->where($display_column['field_name'], '=', "$value");
                        }
                    }
                    self::$searchItems[$display_column['field_name']] = '';
                }
            }
            
        }
        
        foreach (self::$joinWiths as $joinWith) {
            
            $result = self::checkJoinWithSyntax($joinWith);

            if ($result['status']) {
                
                if (isset($joinWith['type'])) {
                    if ($joinWith['type'] == 'left') {
                        self::$db->leftJoin($joinWith['table_name'], $joinWith['on']);
                    } elseif ($joinWith['type'] = 'right') {
                        self::$db->rightJoin($joinWith['table_name'], $joinWith['on']);
                    } else {
                        self::$db->join($joinWith['table_name'], $joinWith['on']);
                    }
                } else {
                    self::$db->join($joinWith['table_name'], $joinWith['on']);
                }
            } else {
                self::joinWithHint($result['message']);
            }
        }

        $global_field_name = self::global_search_field;
        $_g_field_count = 1;
        $_g_field_name_count = 1;

        foreach (self::$global_search_fields as self::$global_search_columns) {
            $global_field_name_temp = $global_field_name . $_g_field_count;
            foreach (self::$global_search_columns as $global_search_column) {
                if (isset($global_search_column['search_query'])) {
                    self::$search_found = true;

                    if (!(false === $value = self::getFromUrl($global_field_name_temp))) {
                        if (is_object($global_search_column['search_query'])) {
                            $global_search_column['search_query'](self::$db, $value);
                        } elseif ($global_search_column['search_query'] == 'like') {
                            if ($_g_field_name_count == 1) {
                                self::$global_search_applied = true;
                                self::$db->where($global_search_column['field_name'], 'LIKE', "%$value%");
                            } else {
                                self::$global_search_applied = true;
                                self::$db->orWhere($global_search_column['field_name'], 'LIKE', "%$value%");
                            }
                        } else {
                            if ($_g_field_name_count == 1) {
                                self::$global_search_applied = true;
                                self::$db->where($global_search_column['field_name'], '=', "$value");
                            } else {
                                self::$global_search_applied = true;
                                self::$db->orWhere($global_search_column['field_name'], '=', "$value");
                            }
                        }
                        $_g_field_name_count++;
                    }
                    self::$searchItems[$global_field_name_temp] = '';
                }
            }
            $_g_field_count++;
        }
        
        if (!(false === $value = self::getFromUrl('sort') )) {
            $sortParams = self::getSortValue($value);
            $sort_field_name = $sortParams['field_name'];
            foreach (self::$display_columns as $display_column) {
                if (isset($display_column['sort_by'])) {
                    if (is_object($display_column['sort_by'])) {

                        $display_column['sort_by'](self::$db, $sort_field_name);
                    } else {
                        $sort_field_name = $display_column['sort_by'];

                        self::$db->orderBy($sort_field_name, $sortParams['orderBy']);
                    }
                }
            }
        } else {
            if (!empty(self::$default_order)) {
                foreach (self::$default_order as $column_name => $order) {
                    self::$db->orderBy($column_name, $order);
                }
            }
        }
    }

    public static function fullUrlWith_get_parameters($current_url, $append_params = array(), $set_value = false) {
        $url_params = array();
        if (isset($_GET[self::$id])) {
            $url_params = $_GET[self::$id];
        }

        $url_page = '';
        $url_sort = '';
        if (isset($url_params['page'])) {
            $url_page = $url_params['page'];
            unset($url_params['page']);
        }
        if (isset($url_params['sort'])) {
            $url_sort = $url_params['sort'];
            unset($url_params['sort']);
        }
        $url_params_rev = array_reverse($url_params);

        foreach ($append_params as $append_param => $val) {
            if ($append_param != 'page' || $append_param != 'sort') {
                $url_params_rev[$append_param] = $val;
            }
        }
        if (isset($append_params['sort'])) {
            $url_params_rev['sort'] = $append_params['sort'];
        } else {
            if ($url_sort !== '') {
                $url_params_rev['sort'] = $url_sort;
            }
        }
        if (isset($append_params['page'])) {
            $url_params_rev['page'] = $append_params['page'];
        } else {
            if ($url_page !== '') {
                $url_params_rev['page'] = $url_page;
            }
        }
        $url_params = array_reverse($url_params_rev);

        $url_array_new = [];

        foreach ($_GET as $url_key => $url_val) {
            if ($url_key == self::$id) {

                $url_array_new[$url_key] = $url_params;
            } else {
                $url_array_new[$url_key] = $url_val;
            }
        }
        if (!array_key_exists(self::$id, $url_array_new)) {
            $url_array_new[self::$id] = $url_params;
        }
        if ($set_value == true) {
            foreach ($url_array_new[self::$id] as $key => $val) {
                if ($key == 'page' || $key == 'sort') {
                    continue;
                }
                $url_array_new[self::$id][$key] = self::$id . $key;
            }
        }

        return $current_url . '?' . http_build_query($url_array_new);
    }

    public static function generate_links($current_url) {
        $url_params = [];
        if (isset($_GET[self::$id])) {
            $url_params = $_GET[self::$id];
        }

        $current_page = 1;
        if (isset($url_params['page'])) {
            if (is_numeric($url_params['page'])) {
                $current_page = $url_params['page'];
            }
        }
        unset($url_params['page']);
        $num_page = ceil(self::$total_data / self::$page_size);
        if ($num_page <= 1) {
            return '';
        }
        $link_html = '<ul class="pagination">';
        if ($current_page > 1) {//prev link
            $link_html .= '<li class=""><a href="' . self::fullUrlWith_get_parameters($current_url, ['page' => ($current_page - 1)]) . '"><span>«</span></a></li>';
        } else {
            $link_html .= '<li class="disabled"><span>«</span></li>';
        }
        for ($p = 1; $p <= $num_page; $p++) {

            if ($p == $current_page) {
                $link_html .= '<li class="active"><span>' . $p . '</span></li>';
            } else {
                $link_html .= '<li><a href="' . self::fullUrlWith_get_parameters($current_url, ['page' => $p]) . '"><span>' . $p . '</span></a></li>';
            }
        }
        if ($current_page < $num_page) {//next link
            $link_html .= '<li><a href="' . self::fullUrlWith_get_parameters($current_url, ['page' => ($current_page + 1)]) . '" rel="next">»</a></li>';
        } else {
            $link_html .= '<li class="disabled"><span>»</span></li>';
        }
        $link_html .= '</ul>';
        
        return $link_html;
    }

    /**
     * Used to show errors
     * @param type $errorMessage
     */
    public static function displayError($errorMessage) {
        echo '<pre style="color:#e64c4c; font-weight:700">';
        print_r($errorMessage);
        echo '</pre>';
    }

    /**
     * used to get parameters from url
     * @param type $key
     * @return boolean
     */
    protected static function getFromUrl($key) {

        if (isset($_GET[self::$id][$key])) {
            if ($_GET[self::$id][$key] == '') {
                return false;
            }
            return $_GET[self::$id][$key];
        } else {

            return false;
        }
    }

    /**
     * used to get proper sort url
     * @param type $field_name
     * @return type
     */
    public static function getSort_field($field_name) {
        if (!(false === $value = self::getFromUrl('sort'))) {//sort params found
            if ($value == '-' . $field_name) {
                return $field_name;
            } else {
                return '-' . $field_name;
            }
        } else {
            return '-' . $field_name;
        }
    }

    /**
     * used to get array with orderBy field and Order type automatically
     * @param type $value
     * @return type
     */
    private static function getSortValue($value) {
        $pos = stripos($value, '-');
        if ($pos === 0) {
            return[
                'field_name' => trim($value, '-'),
                'orderBy' => 'desc'
            ];
        } else {
            return[
                'field_name' => $value,
                'orderBy' => 'asc'
            ];
        }
    }

    private static function checkJoinWithSyntax($joinWith) {
        $res = [
            'status' => true,
            'message' => ''
        ];
        if (!is_array($joinWith)) {
            self::$gridview_errors = true;
            $res['status'] = false;
            $res['message'] = 'joinWith must be in array';
        }
        if (!isset($joinWith['table_name'])) {
            self::$gridview_errors = true;
            $res['status'] = false;
            $res['message'] = 'Table Name missing.';
        }
        if (isset($joinWith['on'])) {
            if (!is_array($joinWith['on'])) {
                self::$gridview_errors = true;
                $res['status'] = false;
                $res['message'] = 'on must be in array';
            }
        } else {
            self::$gridview_errors = true;
            $res['status'] = false;
            $res['message'] = 'on Name missing.';
        }
        if (isset($joinWith['type'])) {
            if (!($joinWith['type'] == 'inner' || $joinWith['type'] == 'left' || $joinWith['type'] == 'right')) {
                self::$gridview_errors = true;
                $res['status'] = false;
                $res['message'] = 'Gridview join support only left, inner and right join only.';
            }
        }
      
        return $res;
    }

    private static function joinWithHint($message = '') {
        $err = $message . PHP_EOL;
        $err .= "joinWith syntax error." . PHP_EOL;
        $err .= "Hint:" . PHP_EOL;
        $err .= "'joinWith'=>[" . PHP_EOL;
        $err .= "\t\t[" . PHP_EOL;
        $err .= "\t\t\t'table_name'=>'countries'," . PHP_EOL;
        $err .= "\t\t\t'on'=>['id'=>'country_id']," . PHP_EOL;
        $err .= "\t\t\t'type'=>'right'" . PHP_EOL;
        $err .= "\t\t]" . PHP_EOL;
        $err .= "\t]" . PHP_EOL;
        self::displayError($err);
    }

    /**
     * Used to generate required Js for Gridview
     * @return type
     */
    public static function getJsScript() {
        $gridId = self::$id;
        $unique_ness = preg_replace('/[^a-z0-9_]/','_',$gridId);//for removing the string without alphanumeric and hyphen
        
        $Js = <<< Js
                $.fn.redirectingWithInput$unique_ness = function(options){
                      var formurl = $('.$gridId').data('formurl');
                        var gridViewId = '$gridId';
                        $('.$gridId').each(function(e){
                                $(this).find('input').each(function(e){
                                    if($(this).attr('name')){
                                        var replacing_str = gridViewId+$(this).attr('name').replace(gridViewId+'[','').replace(']','');
                                        if($(this).val() != ''){
                                            formurl = formurl.replace(replacing_str,encodeURIComponent($(this).val()));
                                        }else{
                                            formurl = formurl.replace(replacing_str,'');
                                        }
                                    }else{
                                        alert('name is missing in search field that couses on problem on searching.');    
                                    }
                                })
                                $(this).find('select').each(function(e){
                                    if($(this).attr('name')){
                                        var replacing_str = gridViewId+$(this).attr('name').replace(gridViewId+'[','').replace(']','');
                                        if($(this).val() != ''){
                                            formurl = formurl.replace(replacing_str,encodeURIComponent($(this).val()));
                                        }else{
                                            formurl = formurl.replace(replacing_str,'');
                                        }
                                    }else{
                                        alert('name is missing in search field that couses on problem on searching.');  
                                    }
                                })
                        })
                        
                        window.location.replace(formurl);
                }
                $('.$gridId  input').on('keypress',function (e) {
                    if (e.keyCode == 13) {
                        $().redirectingWithInput$unique_ness({
                        });
                    }
                 });
                 $('.$gridId  input, .$gridId  select').on('change',function (e) {
                     $().redirectingWithInput$unique_ness({
                     });
                 });
Js;
        return '<script> $(document).ready(function(e){' . $Js . '})</script>';
    }

}
