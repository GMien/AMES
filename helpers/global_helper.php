<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_active'))
{
    function is_active($url)
	{
		$ci=& get_instance();
		if( trim(end($ci->uri->segments))==$url )
		{
			return "current";
		}
		else
		   return "";
	}
	
	function page_headers()
	{
		$ci=& get_instance();
		if(!isset($ci->Headers))
		  return "";
		  else
		return $ci->Headers;
	}
	
	function check_access($tag)
	{
		$CI = get_instance();
		$access = ",".$CI->data->getUserInfoRow($CI->session->userdata('uid'))->user_access.",";
		
		$tag=",".$tag.",";
		
		if(strpos($access,$tag)===false)
		return "disabled='disabled'";
		else
		return "";
	}
	
	function has_access($tag)
	{
		$CI = get_instance();
		$access = ",".$CI->data->getUserInfoRow($CI->session->userdata('uid'))->user_access.",";
		
		$tag=",".$tag.",";
		
		if(strpos($access,$tag)===false)
		return false;
		else
		return true;
	}
	
}