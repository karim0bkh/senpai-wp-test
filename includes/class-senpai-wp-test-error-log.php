<?php

/**
 * The file that defines the senpai_log
 *
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

 //Redirect logs to date based files
$now = current_time( 'Y-m-d' );

if(is_child_theme()){
	define( 'SENPAI_LOG_DIR_BASE', get_stylesheet_directory());
}else{
	define( 'SENPAI_LOG_DIR_BASE', get_template_directory());
}

ini_set( 'error_log', SENPAI_LOG_DIR_BASE . "/logs/debug-$now.log" );

if (!function_exists('senpai_log')) {
	//simplified function to log
	function senpai_log($v){
		senpai_log_init_dir(); //recreate log directory if not existed
		$enabled = true;
		if(defined( 'SENPAI_LOG_ENABLED')){
			$enabled = SENPAI_LOG_ENABLED; //default display logs
		}

		if($enabled){
			$bt = debug_backtrace();
			$caller = array_shift($bt);
			$now = current_time( 'mysql' );
			error_log("<=====| Start Logger $now |=====>");
			error_log("File: ".$caller['file']);
			error_log("Line: ".$caller['line']);
			error_log("Type: ".gettype($v));
			error_log("Logger: ".print_r($v,1));
			error_log("<=====| End Logger $now |=====>");
		}



	}


	function senpai_log_cleaner_exec(){
		//error_log('log cleaner runing');
        $log_folder = SENPAI_LOG_DIR_BASE . "/logs";
		$days = 5;//default number of logs
		if(defined( 'SENPAI_LOG_DAYS')){
			$days = SENPAI_LOG_DAYS;
		}
		$enabled = true; //default display logs
		if(defined( 'SENPAI_LOG_ENABLED')){
			$enabled = SENPAI_LOG_ENABLED; 
		}
		if($days != -1){
			senpai_log_delete_expired($log_folder,$days);
		}

	}
	

	add_action( 'senpai_log_cleaner_hook', 'senpai_log_cleaner_exec' );
    add_action('after_switch_theme', 'senpai_log_detect_theme_activation', 10, 2 );
    add_action('switch_theme', 'senpai_log_detect_theme_deactivation');

    function senpai_log_detect_theme_activation(){
        if ( ! wp_next_scheduled( 'senpai_log_cleaner_hook' ) ) {
            wp_schedule_event( time(), 'daily', 'senpai_log_cleaner_hook' );
        }
    }

    function senpai_log_detect_theme_deactivation(){
        if ( wp_next_scheduled( 'senpai_log_cleaner_hook' ) ) {
            wp_clear_scheduled_hook( 'senpai_log_cleaner_hook' );
          }
    }

	function senpai_log_delete_expired($folderName,$days){
		if (file_exists($folderName)) {
			foreach (new \DirectoryIterator($folderName) as $fileInfo) {
				if ($fileInfo->isDot()) {
				continue;
				}
				$filename = $fileInfo->getFilename();
				if ($filename  != '.htaccess' && 
					$filename  != '.gitignore' && 
					$filename  != 'index.php' && 
					$fileInfo->isFile() && 
					time() - filemtime($fileInfo->getRealPath()) >= $days*24*60*60) {
					unlink($fileInfo->getRealPath());
				}
			}
		}
	}

	function senpai_log_init_dir(){

		$log_folder = SENPAI_LOG_DIR_BASE . "/logs";
		if (!file_exists($log_folder)) 
		{
			mkdir($log_folder, 0700, true);

			$f = fopen($log_folder . "/.htaccess", "a+");
			fwrite($f, "deny from all");
			fclose($f);

			$f = fopen($log_folder . "/.gitignore", "a+");
			fwrite($f, "*");
			fclose($f);

			$f = fopen($log_folder . "/index.php", "a+");
			fwrite($f, "<?php // Silence is golden");
			fclose($f);
		}
	}
}