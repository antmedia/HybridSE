<?php
	//echo "TOKEN: $a_token";

	function startdate($day,$mth,$yr) {
		if($mth==1) {
			$mth=12;
			$yr=$yr-1;
		}
		else {
			$mth=$mth-1;
		}
		if(checkdate($mth,$day,$yr)) {
			return $day."-".$mth."-".$yr;
		}
		else {
			$day=$day-1;
			if($mth==12) $mth=1;
			else $mth=$mth+1;
			return startdate($day,$mth,$yr);
		}
	}
	if(isset($_GET['start'])) {
		$start_date=$_GET['start'];
	} else {
		$start_date=startdate(date('d'),date('m'),date('Y'));
	}
	if(isset($_GET['end'])) {
		$end_date=$_GET['end'];
	} else {
		$end_date=date("d-m-Y");
	}
	$date_query="since=".$start_date."&until=".$end_date."";

	$page_id=$_GET['sel_id'];
	
	if($page_id!="") {
		$insights=array();
		$talk_by_city=array();
		$talk_by_country=array();
		$talk_by_age_gender=array();
		
		// GENERAL INFO //
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_story_adds_unique/day/?'.$date_query.'&access_token='.$a_token);
		$insights=json_decode($xml, TRUE);
		$talk=$insights['data']['0']['values'];
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_impressions_unique/day/?'.$date_query.'&access_token='.$a_token);
		$insights=json_decode($xml, TRUE);
		$reach=$insights['data']['0']['values'];
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_story_adds/day/?'.$date_query.'&access_token='.$a_token);
		$insights=json_decode($xml, TRUE);
		$story=$insights['data']['0']['values'];
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/?access_token='.$a_token);
		$about=json_decode($xml, TRUE);
		// end GENERAL INFO //
		
		// FANS INFO //
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_fan_adds_unique/day/?'.$date_query.'&access_token='.$a_token);
		$insights=json_decode($xml, TRUE);
		$daily_fans=$insights['data']['0']['values'];
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_fans_city/?access_token='.$a_token.'&'.$date_query.'');
		$insights=json_decode($xml, TRUE);
		if(count($insights['data']>0)) {
			$fans_by_city=$insights['data']['0']['values']['0']['value'];
			arsort($fans_by_city);
		}
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_fans_country/?access_token='.$a_token.'&'.$date_query.'');
		$insights=json_decode($xml, TRUE);
		if(count($insights['data']>0)) {
			$fans_country=$insights['data']['0']['values']['0']['value'];
			
		}
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_fans_gender_age/?access_token='.$a_token.'&'.$date_query.'');
		$insights=json_decode($xml, TRUE);
		if(count($insights['data']>0)) {
			$page_fans_by_age_gender=$insights['data']['0']['values']['0']['value'];
			$fans_male=array();
			$fans_male['13-17']=0;
			$fans_male['18-24']=0;
			$fans_male['25-34']=0;
			$fans_male['35-44']=0;
			$fans_male['45-54']=0;
			$fans_male['55-64']=0;
			$fans_male['65+']=0;
			$fans_female=array();
			$fans_female['13-17']=0;
			$fans_female['18-24']=0;
			$fans_female['25-34']=0;
			$fans_female['35-44']=0;
			$fans_female['45-54']=0;
			$fans_female['55-64']=0;
			$fans_female['65+']=0;
			foreach($page_fans_by_age_gender as $key=>$value) {
				$key_arr=explode(".",$key);
				if($key_arr['0']=="M")
					$fans_male[$key_arr['1']]=$value;
				if($key_arr['0']=="F")
					$fans_female[$key_arr['1']]=$value;
			}
		}
		// end FANS INFO //
		
		// Page Posts //
		if(isset($_GET['until'])) {
			$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/feed/?limit=100&until='.$_GET['until'].'&access_token='.$a_token);	
		}
		else if(isset($_GET['since'])) {
			$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/feed/?limit=100&since='.$_GET['since'].'&access_token='.$a_token);	
		} else 
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/feed/?limit=100&access_token='.$a_token);
		$insights=json_decode($xml, TRUE);
		$page_pre=explode("&",$insights['paging']['previous']);
		$page_next=explode("&",$insights['paging']['next']);
		$posts=$insights['data'];
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_impressions_unique/day?'.$date_query.'&access_token='.$a_token);
		$page_reach=json_decode($xml, TRUE);
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_impressions/day?'.$date_query.'&access_token='.$a_token);
		$page_imp=json_decode($xml, TRUE);
		$reach=$page_reach['data']['0']['values'];
		// end Page Posts //
		
		// Reach //
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_impressions_unique/day/?'.$date_query.'&access_token='.$a_token);
		$insights=json_decode($xml, TRUE);
		$daily_reach=$insights['data']['0']['values'];
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_impressions_by_city_unique/days_28/?access_token='.$a_token.'&'.$date_query.'');
		$insights=json_decode($xml, TRUE);
		if(count($insights['data']>0)) {
			$reach_by_city=$insights['data']['0']['values']['0']['value'];
			arsort($reach_by_city);
		}
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_impressions_by_country_unique/days_28/?access_token='.$a_token.'&'.$date_query.'');
		$insights=json_decode($xml, TRUE);
		if(count($insights['data']>0)) {
			$reach_by_country=$insights['data']['0']['values']['0']['value'];
			arsort($reach_by_country);
		}
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_impressions_by_age_gender_unique/days_28/?access_token='.$a_token.'&'.$date_query.'');
		$insights=json_decode($xml, TRUE);
		if(count($insights['data']>0)) {
			$reach_by_age_gender=$insights['data']['0']['values']['0']['value'];
			$reach_male=array();
			$reach_male['13-17']=0;
			$reach_male['18-24']=0;
			$reach_male['25-34']=0;
			$reach_male['35-44']=0;
			$reach_male['45-54']=0;
			$reach_male['55-64']=0;
			$reach_male['65+']=0;
			$reach_female=array();
			$reach_female['13-17']=0;
			$reach_female['18-24']=0;
			$reach_female['25-34']=0;
			$reach_female['35-44']=0;
			$reach_female['45-54']=0;
			$reach_female['55-64']=0;
			$reach_female['65+']=0;
			foreach($reach_by_age_gender as $key=>$value) {
				$key_arr=explode(".",$key);
				if($key_arr['0']=="M")
					$reach_male[$key_arr['1']]=$value;
				if($key_arr['0']=="F")
					$reach_female[$key_arr['1']]=$value;
			}
		}
		// end Reach //
		
		// Talking //
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_story_adds_unique/day/?'.$date_query.'&access_token='.$a_token);
		$insights=json_decode($xml, TRUE);
		$daily_talk=$insights['data']['0']['values'];
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_story_adds_by_city_unique/days_28/?access_token='.$a_token.'&'.$date_query.'');
		$insights=json_decode($xml, TRUE);
		if(count($insights['data']>0)) {
			$talk_by_city=$insights['data']['0']['values']['0']['value'];
			arsort($talk_by_city);
		}
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_story_adds_by_country_unique/days_28/?access_token='.$a_token.'&'.$date_query.'');
		$insights=json_decode($xml, TRUE);
		if(count($insights['data']>0)) {
			$talk_by_country=$insights['data']['0']['values']['0']['value'];
			arsort($talk_by_country);
		}
		$xml=@file_get_contents('https://graph.facebook.com/'.$page_id.'/insights/page_story_adds_by_age_gender_unique/days_28/?access_token='.$a_token.'&'.$date_query.'');
		$insights=json_decode($xml, TRUE);
		if(count($insights['data']>0)) {
			$talk_by_age_gender=$insights['data']['0']['values']['0']['value'];
			$talking_male=array();
			$talking_male['13-17']=0;
			$talking_male['18-24']=0;
			$talking_male['25-34']=0;
			$talking_male['35-44']=0;
			$talking_male['45-54']=0;
			$talking_male['55-64']=0;
			$talking_male['65+']=0;
			$talking_female=array();
			$talking_female['13-17']=0;
			$talking_female['18-24']=0;
			$talking_female['25-34']=0;
			$talking_female['35-44']=0;
			$talking_female['45-54']=0;
			$talking_female['55-64']=0;
			$talking_female['65+']=0;
			foreach($talk_by_age_gender as $key=>$value) {
				$key_arr=explode(".",$key);
				if($key_arr['0']=="M")
					$talking_male[$key_arr['1']]=$value;
				if($key_arr['0']=="F")
					$talking_female[$key_arr['1']]=$value;
			}
		}
		// end Talking //
	}
?>