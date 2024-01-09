<?php 
namespace App\Helpers;
use Cache;
use CURLFile;

use Session;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;


class helper
{
    public static function get_table_record_field($table,$id)
	{
	    $data = DB::table($table)->where('id',$id)->first();

        return $data;
	}
	
	public static function count_record($table,$field)
	{
		
		$csv_count = DB::table($table)->where('project_id', $field)->count();
		return $csv_count;
	}
	public static function user_max_record_plot($table,$user_id,$field,$project_version_id)
	{
		
		$plot_count = DB::table($table)->where('user_id', $user_id)->where('project_id', $field)->where('project_revision', $project_version_id)->where('parent_id', 0)->count();
		return $plot_count;
	}
	public static function user_max_record($table,$user_id,$project_id,$project_version_id,$parent_host=null)
	{
		
		$plot_count = DB::table($table)->where('user_id', $user_id)->where('project_id', $project_id)->where('project_revision', $project_version_id)->where('parent_host', $parent_host)->count();
		return $plot_count;
	}
	public static function user_max_record_building($table,$user_id,$project_id,$project_version_id,$parent_host)
	{
		
		$plot_count = DB::table($table)->where('user_id', $user_id)->where('project_id', $project_id)->where('project_revision', $project_version_id)->where('parent_host', $parent_host)->where('family', "Building")->count();
		return $plot_count;
	}
	public static function user_max_record_room($table,$user_id,$project_id,$project_version_id)
	{
		
		$plot_count = DB::table($table)->where('user_id', $user_id)->where('project_id', $project_id)->where('project_revision', $project_version_id)->where('family', 'Room')->count();
		return $plot_count;
	}
	
	public static function count_record_csv($table,$user_id,$field)
	{
		
		$csv_count = DB::table($table)->where('project_id', $field)->count();
		return $csv_count;
	}
	public static function count_record_user($table,$field_name,$field)
	{
		
		$csv_count = DB::table($table)->where($field_name, $field)->count();
		return $csv_count;
	}
	public static function count_record_single_user($table,$field_name,$field)
	{
		
		$csv_count = DB::table($table)->where('user_id', $field)->count();
		return $csv_count;
	}

	public static function getRange($value,$total){
		$percent = $value / $total;
		return number_format( $percent * 100, 2 );
	}

	public static function isSelected($id,$proxId){
		if ( DB::table('proximity')->where('cat_id', $id)->where('cat_id_prox', $proxId)->exists()) {
			return true;
		}
		return false;
	}

}
?>