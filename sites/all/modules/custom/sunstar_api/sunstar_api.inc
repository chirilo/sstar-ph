<?php

/**
 * register API
 */
function sunstar_api_register() {
	$success = FALSE;
	$token = "";
	$device_id ="";
	$device_type="";
	$response = new stdClass();
	$account = new stdClass();
	$jsonparam = file_get_contents('php://input');
//	watchdog('sunstar_api', 'Register : json data : <pre>%data</pre>', array('%data' => $jsonparam,));
	if(!empty($jsonparam)) {
		$data = json_decode($jsonparam);
		$_uid = db_query("SELECT uid FROM users WHERE name = '{$data->email}'")->fetchField();

		try{
			if(empty($_uid)) {
				$firstname = $data->firstname;
				$lastname = $data->lastname;
				$gender = isset($data->gender) ? $data->gender : 0;
				$birthdate = strtotime($data->birthdate);
				$email = $data->email;
				$password = $data->password;
				if(isset($data->avatar)) {
					$avatar_url = $data->avatar;
					$file = system_retrieve_file($avatar_url, 'public://pictures', TRUE, FILE_EXISTS_RENAME);	
				}
				
				$userapp_rid = db_query("SELECT rid FROM role WHERE name = 'userapp'")->fetchObject();
				$new_user_roles = array(
				  DRUPAL_AUTHENTICATED_RID => 'authenticated user',
				  $userapp_rid->rid => 'userapp',
				);
				$new_user = array(
					'name' => $email,
					'mail' => $email,
					'pass' => $password,
					'status' => 1,
					'field_firstname' => array(LANGUAGE_NONE => array(
						array('value' => $firstname,),
					)),
					'field_lastname' => array(LANGUAGE_NONE => array(
						array('value' => $lastname,),
					)),
					'field_gender' => array(LANGUAGE_NONE => array(
						array('value' => $gender,),
					)),
					'field_birthdate' => array(LANGUAGE_NONE => array(
						array(
							'value' => $birthdate,
							'date_type' => 'datestamp',
						),
					)),
					'force_password_change' => 0,
					'roles' => $new_user_roles,
					'access' => REQUEST_TIME,
				);
				$account->is_new = TRUE;
				user_save($account, $new_user);
				if(isset($file)) {
					user_save($account, array('picture' => $file));
				}
				$device_id = $data->device_id;
				$device_type = $data->device_type;
				$token = generate_userapp_token($account->uid, $device_id, $device_type);
				$success = TRUE;	
			} else {
					$response->status = 500;
					$response->message = 'User already exist';
					print drupal_json_output($response);
					exit();
			}
		} catch (Exception $e) {
				$response->status = 500;
		    $response->message = "Error : " . $e->getMessage();
		    print drupal_json_output($response);
				exit();
			}

	} else {
			return drupal_not_found();
	}
	if($success) {
		$user = user_load($account->uid);
		$response->status = 200;
		$response->message = 'Successfully registered user';
		$response->data->uid = $uid;
		$response->data->token = $token;
		$response->data->firstname = $firstname;
		$response->data->lastname = $lastname;
		$response->data->gender = $gender;
		$response->data->email = $user->mail;
		$response->data->birthdate = date("Y-m-d", $birthdate);
		$response->data->avatar = isset($file) ? file_create_url($file->uri) : "";
	} else {
			$response->status = 500;
			$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

/**
*	API 	
*/
function sunstar_api_login() { 
	$success = FALSE;
	$token = "";
	$response = new stdClass();
	$jsonparam = file_get_contents('php://input');
	watchdog('sunstar_api', 'Login : json data : <pre>%data</pre>', array('%data' => $jsonparam,));
	if(!empty($jsonparam)) {
		$data = json_decode($jsonparam); 
		$username = $data->email;
		$pass = $data->password;

		if ($uid = user_authenticate($username, $pass)) {
     	 $user = user_load($uid);

		$login_array = array ('name' => $username);
		user_login_finalize($login_array);
        $token = check_userapp_token($uid);
	    
	if(empty($token)) {
		  		$device_id = $data->device_id;
		  		$device_type = $data->device_type;
				$token = generate_userapp_token($uid, $device_id, $device_type);

			}
      
		    $response->status = 200;
			$response->message = 'Successfully logged in user';
			$response->data->id = $uid;
			$response->data->token = $token;
			$response->data->firstname = $user->field_firstname['und'][0]['value'];
			$response->data->lastname = $user->field_lastname['und'][0]['value'];
			$response->data->gender = isset($user->field_gender['und'][0]['value']) ? $user->field_gender['und'][0]['value'] : 0;
			$response->data->email = $user->mail;
			$response->data->birthdate = date("Y-m-d", $user->field_birthdate['und'][0]['value']);
			$response->data->avatar = isset($user->picture->uri) ? file_create_url($user->picture->uri) : "";
			$success = TRUE;
    } else {
				$response->status = 500;
				$response->message = 'User not exist.';
		}
	}
	if(!$success) {
		$response->status = 500;
		$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

/**
* logout api
* 
* @return
*/
function sunstar_api_logout($token) {
	$success = FALSE;
	$response = new stdClass();
	$arg0 = arg(0);
	$arg1 = arg(1);
	$token = arg(2);
	if($arg0 == 'api' && $arg1 == 'logout' && !empty($token)) {
		$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
		if(!empty($uid)) {
      $user = user_load($uid);
      
      $response->status = 200;
			$response->message = 'Successfully logout user';
			
			db_query("DELETE FROM userapp WHERE token = '{$token}'");
			
			$success = TRUE;	
		}
	}
	if(!$success) {
		$response->status = 500;
		$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

/**
* return user token
* @param undefined $uid
* 
* @return
*/
function generate_userapp_token($uid = 0,  $device_id, $device_type) {
	$time = time();
//	db_query("INSERT INTO {userapp} (uid, created, device_id, device_type) VALUES ($uid, $time, $device_id,'$device_type')");

	db_query("INSERT INTO {userapp} (uid, created, device_id, device_type) VALUES ('$uid', '$time', '$device_id', '$device_type')");
	$userapp_id = db_query("SELECT MAX(userapp_id) FROM userapp")->fetchField();
	$token = hash('sha1', $userapp_id . $uid);
	db_query("UPDATE userapp SET token = '{$token}' WHERE userapp_id = {$userapp_id}");
	return $token;
}

/**
* check token exist
*/
function check_userapp_token($uid) {
	return db_query("SELECT token FROM userapp WHERE uid = {$uid} ORDER BY created DESC")->fetchField();
}

/**
* decode url
*/
function sunstar_api_decode_url($urlparam) {
	$param = array();
	foreach(explode('&', $urlparam) as $item) {
		$exp = explode('=', $item);
		$param[urldecode($exp[0])] = urldecode($exp[1]);
	}
	return $param;
}

/**
* All cateogries 
*/
function sunstar_api_all_categories($token) { 
	$success = FALSE;
	$response = new stdClass();
	$arg0 = arg(0);
	$arg1 = arg(1);
	if($arg0 == 'api' && $arg1 == 'categories' && !empty($token)) {
		$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
		if(!empty($uid)) {
      $user = user_load($uid);
      
      $response->status = 200;
			$response->message = 'Successfully retrieved categories';
			$dataArr = array();
			sunstar_api_fetch_data($dataArr, taxonomy_get_tree(3), TRUE); // 3 = location
			sunstar_api_fetch_data($dataArr, taxonomy_get_tree(2)); // 2 = post categories
			sunstar_api_fetch_data($dataArr, taxonomy_get_tree(4), FALSE, TRUE); // 4 = seksyon
			$response->data = $dataArr;
			$success = TRUE;	
		}
	}
	if(!$success) {
		$response->status = 500;
		$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

function sunstar_api_fetch_data(&$dataArr, $postcategories, $is_location = FALSE, $is_superbalita = FALSE) {
	foreach($postcategories as $item){
		$data = new stdClass();
		$data->id = $item->tid;
		$data->name = $item->name;
		$data->is_location = $is_location;
		//$data->is_superbalita = $is_superbalita;
		$dataArr[] = $data;
		unset($data);
	}
}

/**
* /feed/news/{token}?category=<category_id>&locations=[location, ids, 1-n]
*/
function sunstar_api_feeds_by_categories($token) {
	$success = FALSE;
	$response = new stdClass();
	$arg0 = arg(0);
	$arg1 = arg(1);
	$arg2 = arg(2);
	if($arg0 == 'api' && $arg1 == 'feed' && $arg2 == 'news' && !empty($token) && (isset($_REQUEST['category']) || isset($_REQUEST['locations']))) {
		$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
		if(!empty($uid)) {
      $user = user_load($uid);
    	
    	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 0;
    	  
      $response->status = 200;
			$response->message = 'Successfully retrieved feeds';
			$dataArr = array();
			
			// count articles
			$locations = isset($_REQUEST['locations']);
            $categories = $_REQUEST['category'];

            if(isset($_REQUEST['category']) && $locations == NULL) {
            $resultcount = db_query("SELECT n.nid FROM {node} n left join field_data_field_mt_post_categories cat on n.nid = cat.entity_id where cat.field_mt_post_categories_tid = $categories AND n.status = 1 AND n.type = 'article' ORDER BY n.created desc limit 500")->fetchAll();
            }

            if(isset($_REQUEST['locations']) && $categories == NULL) {
            $resultcount = db_query("SELECT n.nid FROM {node} n left join field_data_field_location loc on n.nid = loc.entity_id where loc.field_location_tid IN($locations) AND n.status = 1 AND n.type = 'article' ORDER BY n.created desc limit 500")->fetchAll();
            }

            if(isset($_REQUEST['category']) && isset($_REQUEST['locations'])) {
            $resultcount = db_query("SELECT n.nid,n.status,n.created, cat.field_mt_post_categories_tid,  loc.field_location_tid from {node} n left join field_data_field_mt_post_categories cat on n.nid = cat.entity_id left join field_data_field_location loc on n.nid = loc.entity_id left join field_data_field_seksyon sb on n.nid = sb.entity_id where cat.field_mt_post_categories_tid = $categories AND loc.field_location_tid  IN ($locations) AND n.status = 1 AND n.type = 'article' order by n.created DESC LIMIT 500")->fetchAll();
            }

            if (($_REQUEST['category'] == 29 || $_REQUEST['category'] == 30 || $_REQUEST['category'] == 31 || $_REQUEST['category'] == 32) && isset($_REQUEST['locations'])) {
            $resultcount = db_query("SELECT n.nid,n.status,n.created, cat.field_seksyon_tid,  loc.field_location_tid from {node} n left join field_data_field_seksyon cat on n.nid = cat.entity_id left join field_data_field_location loc on n.nid = loc.entity_id where cat.field_seksyon_tid = $categories AND loc.field_location_tid  IN ($locations) AND n.status = 1 AND n.type = 'superbalita' order by n.created DESC LIMIT 500")->fetchAll();
            }

            if ($_REQUEST['category'] == 2924) {
            $resultcount = db_query("SELECT n.nid FROM {node} n left join field_data_field_politics pol on n.nid = pol.entity_id where pol.field_politics_value = 1 AND n.status = 1 AND n.type = 'article' ORDER BY n.created DESC")->fetchAll();
            }

           	$count = count($resultcount);
			
			// get all articles
			 if($_REQUEST['category'] <> 1) {
               $pager = ($page*10);
               $locations = $_REQUEST['locations'];
               $categories = $_REQUEST['category'];
                               
				if(isset($_REQUEST['category']) && $locations == NULL) {
				$result = db_query("SELECT n.nid FROM {node} n left join field_data_field_mt_post_categories cat on n.nid = cat.entity_id where cat.field_mt_post_categories_tid = $categories AND n.status = 1 AND n.type = 'article' ORDER BY n.created desc LIMIT $pager,10")->fetchAll();
				}

				if(isset($_REQUEST['locations']) && $categories == NULL) {
				$result = db_query("SELECT n.nid FROM {node} n left join field_data_field_location loc on n.nid = loc.entity_id where loc.field_location_tid IN($locations) AND n.status = 1 AND n.type = 'article' ORDER BY n.created desc LIMIT $pager,10")->fetchAll();
				}

				if(isset($_REQUEST['category']) && isset($_REQUEST['locations'])) {
				$result = db_query("SELECT n.nid,n.status,n.created, cat.field_mt_post_categories_tid,  loc.field_location_tid from {node} n left join field_data_field_mt_post_categories cat on n.nid = cat.entity_id left join field_data_field_location loc on n.nid = loc.entity_id left join field_data_field_seksyon sb on n.nid = sb.entity_id where cat.field_mt_post_categories_tid = $categories AND loc.field_location_tid  IN ($locations) AND n.status = 1 AND n.type = 'article' order by n.created DESC LIMIT $pager,10")->fetchAll();
				}

				if(($_REQUEST['category'] == 29 || $_REQUEST['category'] == 30 || $_REQUEST['category'] == 31 || $_REQUEST['category'] == 32) && isset($_REQUEST['locations'])) {
				$result = db_query("SELECT n.nid,n.status,n.created, cat.field_seksyon_tid,  loc.field_location_tid from {node} n left join field_data_field_seksyon cat on n.nid = cat.entity_id left join field_data_field_location loc on n.nid = loc.entity_id where cat.field_seksyon_tid = $categories AND loc.field_location_tid  IN ($locations) AND n.status = 1 AND n.type = 'superbalita' order by n.created DESC LIMIT $pager,10")->fetchAll();
				}

				if($_REQUEST['category'] == 2924) {
				$result = db_query("SELECT n.nid FROM {node} n left join field_data_field_politics pol on n.nid = pol.entity_id where pol.field_politics_value = 1 AND n.status = 1 AND n.type = 'article' ORDER BY n.created desc LIMIT $pager,10")->fetchAll();
				}

               } else {
                  
				if($page < 1 ) {
                $result = views_get_view_result('app2', 'services_35');
                } else {
                $result = NULL;
                }
            }
			
			// Data
			$data = array();
			foreach($result as $n) {
				$node = node_load($n->nid);
				$obj = new stdClass();
				
				$obj->id = $node->nid;
				$obj->title = $node->title;
				
				$images = array();
				if(isset($node->field_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_image['und'][0]['uri']);
				}
				if(isset($node->field_mt_teaser_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_mt_teaser_image['und'][0]['uri']);
				}
				if(isset($node->field_mt_banner_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_mt_banner_image['und'][0]['uri']);
				}
				$obj->photos = $images;
				//if(isset($node->body['und'][0]['value'])){	
				$body = strip_tags($node->body['und'][0]['value']);
				//}
				$obj->content = substr($body, 0, 160);
				
				$obj->post_date = date("Y-m-d", $node->created);
				
				$loc = taxonomy_term_load($node->field_location['und'][0]['tid']);
				$obj->locations = array($loc->name);
		
	
				if($_REQUEST['category'] <> 29 && $_REQUEST['category'] <> 30 && $_REQUEST['category'] <> 31 && $_REQUEST['category'] <> 32) {
				$cat = taxonomy_term_load($node->field_mt_post_categories['und'][0]['tid']);
				$obj->category_name = $cat->name;
				} else {
				$cat = taxonomy_term_load($node->field_seksyon['und'][0]['tid']);
				$obj->category_name = $cat->name;
				}
				
				$author = array();
				$authorimage = array();
				if(isset($node->field_author['und'][0]['tid'])) {
					$authorobj = taxonomy_term_load($node->field_author['und'][0]['tid']);
					$author[] = $authorobj->name;
					
					if(isset($authorobj->field_author_image['und'][0]['uri'])) {
						$authorimage[] = file_create_url($authorobj->field_author_image['und'][0]['uri']);
					}
				}
				$obj->authors = $author;
				$obj->author_imgs = $authorimage;
				
				$has_like = db_query("SELECT COUNT(*) FROM userapp_like WHERE uid = {$user->uid} AND nid = {$node->nid}")->fetchField();
				$obj->has_liked = !empty($has_like) ? 1 : 0;
				$obj->like_count = db_query("SELECT COUNT(*) FROM userapp_like WHERE nid = {$node->nid}")->fetchField();
				$obj->comment_count = db_query("SELECT COUNT(*) FROM userapp_comment WHERE nid = {$node->nid}")->fetchField();
				$bookmark = db_query("SELECT COUNT(*) FROM userapp_bookmark WHERE uid = {$user->uid} AND tid = {$node->nid}")->fetchField();
				$obj->has_bookmarked = !empty($bookmark) ? 1 : 0;
				
				$data[] = $obj;
				
				unset($obj);
			}
			
			$response->data = $data;
			if(($count / 10) < 1){
				$response->pager = 0;	
			} else {
				$response->pager = abs($count / 10);
			}
			
			$success = TRUE;
		}
	} else if($arg0 == 'api' && $arg1 == 'feed' && $arg2 == 'news' && !empty($token) && isset($_REQUEST['nid'])) {
			$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
		if(!empty($uid)) {
      $user = user_load($uid);
      
      $response->status = 200;
			$response->message = 'Successfully retrieved feed item';
			$dataArr = array();
			
			$query = new EntityFieldQuery();
			$query->entityCondition('entity_type', 'node');
			$query->propertyCondition('status', 1);
			$query->propertyCondition('nid', $_REQUEST['nid']);
			$result = $query->execute();
			
			// Data
			$data = array();
			foreach($result['node'] as $n) {
				$node = node_load($n->nid);
				$obj = new stdClass();
				
				$obj->id = $node->nid;
				$obj->title = $node->title;
				
				$images = array();
				if(isset($node->field_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_image['und'][0]['uri']);
				}
				if(isset($node->field_mt_teaser_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_mt_teaser_image['und'][0]['uri']);
				}
				if(isset($node->field_mt_banner_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_mt_banner_image['und'][0]['uri']);
				}
				$obj->photos = $images;
				
				//$body = strip_tags($node->body['und'][0]['value']);
				$obj->content = $node->body['und'][0]['value'];
				
				$obj->post_date = date("Y-m-d", $node->created);
				
				$loc = taxonomy_term_load($node->field_location['und'][0]['tid']);
				$obj->locations = array($loc->name);
				
				$cat = taxonomy_term_load($node->field_mt_post_categories['und'][0]['tid']);
				$obj->category_name = $cat->name;
				
				$author = array();
				$authorimage = array();
				if(isset($node->field_author['und'][0]['tid'])) {
					$authorobj = taxonomy_term_load($node->field_author['und'][0]['tid']);
					$author[] = $authorobj->name;
					
					if(isset($authorobj->field_author_image['und'][0]['uri'])) {
						$authorimage[] = file_create_url($authorobj->field_author_image['und'][0]['uri']);
					}
				}
				$obj->authors = $author;
				$obj->author_imgs = $authorimage;
				
				$has_like = db_query("SELECT COUNT(*) FROM userapp_like WHERE uid = {$user->uid} AND nid = {$node->nid}")->fetchField();
				$obj->has_liked = !empty($has_like) ? 1 : 0;
				$obj->like_count = db_query("SELECT COUNT(*) FROM userapp_like WHERE nid = {$node->nid}")->fetchField();
				$obj->comment_count = db_query("SELECT COUNT(*) FROM userapp_comment WHERE nid = {$node->nid}")->fetchField();
				$bookmark = db_query("SELECT COUNT(*) FROM userapp_bookmark WHERE uid = {$user->uid} AND tid = {$node->nid}")->fetchField();
				$obj->has_bookmarked = !empty($bookmark) ? 1 : 0;
				
				$data[] = $obj;
				
				unset($obj);
			}
		}
			
			$response->data = $data;
			$success = TRUE;
	}
	if(!$success) {
		$response->status = 500;
		$response->message = 'There is an error.';
	}else if(empty($response->data)) {
		$response->status = 500;
		$response->message = 'no data';
	}
	print drupal_json_output($response);
	exit();
}



/**
* sunstar_api_feeds_by_services
*/
function sunstar_api_feeds_by_services($services, $token) {
	$success = FALSE;
	$response = new stdClass();
	$arg0 = arg(0);
	$arg1 = arg(1);
	$arg2 = arg(2);
	if($arg0 == 'api' && $arg1 == 'feed' && $arg2 == 'services' && !empty($services) && !empty($token) && !isset($_REQUEST['nid'])) {
		$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
		if(!empty($uid)) {
      $user = user_load($uid);
      
      $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 0;
      
      $service_id = get_services_term_id($services);
      
      $response->status = 200;
			$response->message = 'Successfully retrieved services feeds';
			$dataArr = array();
			
			$query = new EntityFieldQuery();
			$query->entityCondition('entity_type', 'node')->entityCondition('bundle', 'services');
			$query->propertyCondition('status', 1);
			$query->fieldCondition('field_services', 'tid', explode(',', $service_id), 'IN');
			$query->count();
			$count = $query->execute();
			
			$query = new EntityFieldQuery();
			$query->entityCondition('entity_type', 'node')->entityCondition('bundle', 'services');
			$query->propertyCondition('status', 1);
			$query->fieldCondition('field_services', 'tid', explode(',', $service_id), 'IN');
			$query->propertyOrderBy('nid', 'DESC');
			$query->range(($page * 10), 10);
			$result = $query->execute();
			
			// Data
			if(isset($result['node'])) {
			$data = array();
			foreach($result['node'] as $n) {
				$node = node_load($n->nid);
				$obj = new stdClass();
				
				$obj->id = $node->nid;
				$obj->title = $node->title;
				
				$images = array();
				if(isset($node->field_image['und'])) {
					foreach($node->field_image['und'] as $img) {
						$images[] = file_create_url($img['uri']);
					}
				}
				$obj->photos = $images;
				if(isset($node->body['und'][0]['value'])) {
				$body = strip_tags($node->body['und'][0]['value']);
				$obj->content = substr($body, 0, 160);
				 }
				$obj->post_date = date("Y-m-d", $node->created);
				
				$bookmark = db_query("SELECT COUNT(*) FROM userapp_bookmark WHERE uid = {$user->uid} AND tid = {$node->nid}")->fetchField();
				$obj->has_bookmarked = !empty($bookmark) ? 1 : 0;
				
				$data[] = $obj;
				
				unset($obj); }
			}
		        if(isset($data)) {	
			$response->data = $data;
			$response->pager = round($count / 10);
			}
			$success = TRUE;
		}
	} else if($arg0 == 'api' && $arg1 == 'feed' && $arg2 == 'services' && !empty($services) && !empty($token) && isset($_REQUEST['nid'])) {
			$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
		if(!empty($uid)) {
      $user = user_load($uid);
      $service_id = get_services_term_id($services);
      
      $response->status = 200;
			$response->message = 'Successfully retrieved services feeds';
			$dataArr = array();
			
			$query = new EntityFieldQuery();
			$query->entityCondition('entity_type', 'node')->entityCondition('bundle', 'services');
			$query->propertyCondition('status', 1);
			$query->propertyCondition('nid', $_REQUEST['nid']);
			$result = $query->execute();
			
			// Data
			$data = array();
			foreach($result['node'] as $n) {
				$node = node_load($n->nid);
				$obj = new stdClass();
				
				$obj->id = $node->nid;
				$obj->title = $node->title;
				
				$images = array();
				if(isset($node->field_image['und'])) {
					foreach($node->field_image['und'] as $img) {
						$images[] = file_create_url($img['uri']);
					}
				}
				$obj->photos = $images;
				
				//$body = strip_tags($node->body['und'][0]['value']);
				$obj->content = $node->body['und'][0]['value'];
				
				$obj->post_date = date("Y-m-d", $node->created);
				
				$bookmark = db_query("SELECT COUNT(*) FROM userapp_bookmark WHERE uid = {$user->uid} AND tid = {$node->nid}")->fetchField();
				$obj->has_bookmarked = !empty($bookmark) ? 1 : 0;
				
				$data[] = $obj;
				
				unset($obj);
			}
		}
			
			$response->data = $data;
			
			$success = TRUE;
	}
	if(!$success) {
		$response->status = 500;
		$response->message = 'There is an error.';
	} else if(empty($response->data)) {
		$response->status = 500;
		$response->message = 'no data';
	}
	print drupal_json_output($response);
	exit();
}



/**
* Save user categories 
* 
*/
function sunstar_api_save_categories($token) { 
	$success = FALSE;
	$response = new stdClass();
	$arg0 = arg(0);
	$arg1 = arg(1);
	$arg2 = arg(2);
	$jsonparam = file_get_contents('php://input');
	watchdog('sunstar_api', 'Save category : json data : <pre>%data</pre>', array('%data' => $jsonparam,));
	if($arg0 == 'api' && $arg1 == 'categories' && $arg2 == 'save' && !empty($token) && !empty($jsonparam)) {
		$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
		if(!empty($uid)) {
			$catArry = array();
			$data = json_decode($jsonparam);
      $user = user_load($uid);
      
      db_query("DELETE FROM userapp_save_category WHERE uid = {$uid}");
      
      $response->status = 200;
			$response->message = 'Successfully saved categories';
			$jsoncategories = json_decode($data->categories);
      foreach($jsoncategories as $tid) {
				$save_cat = new stdClass();
				
				$save_cat->uid = $uid;
				$save_cat->tid = $tid;
				$save_cat->created = time();
				$time = time();
				//drupal_write_record('userapp_save_category', $save_cat);
				db_query("INSERT INTO userapp_save_category (uid, tid, created) VALUES ($uid, $tid, $time)");
				
				// set data category
				$term = new stdClass();
				$termobj = taxonomy_term_load($tid);
				$term->id = $tid;
				$term->name = $termobj->name;
				switch($termobj->vid) {
					case 2:
						$term->is_location = FALSE;
						//$term->is_superbalita = FALSE;
						break;
					case 3:
						$term->is_location = TRUE;
						//$term->is_superbalita = FALSE;
						break;
					case 4:
						$term->is_location = FALSE;
						//$term->is_superbalita = TRUE;
						break;
				}
				$response->data[] = $term;
				unset($term);
			}
			$success = TRUE;	
		}
	}
	if(!$success) {
		$response->status = 500;
		$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

/**
* retrieve user save categories 
* 
*/
function sunstar_api_retrieve_categories($token) {
	$success = FALSE;
	$response = new stdClass();
	$arg0 = arg(0);
	$arg1 = arg(1);
	$arg2 = arg(2);
	if($arg0 == 'api' && $arg1 == 'categories' && $arg2 == 'me' && !empty($token)) {
		$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
		if(!empty($uid)) {
			$catArry = array();
			$categories = db_query("SELECT tid FROM userapp_save_category WHERE uid = {$uid}")->fetchAll();
      
      $response->status = 200;
			$response->message = 'Successfully retrieved my categories';
      
      foreach($categories as $tid) {
				// set data category
				$term = new stdClass();
				$termobj = taxonomy_term_load($tid->tid);
				$term->id = $tid->tid;
				$term->name = $termobj->name;
				switch($termobj->vid) {
					case 2:
						$term->is_location = FALSE;
						//$term->is_superbalita = FALSE;
						break;
					case 3:
						$term->is_location = TRUE;
						//$term->is_superbalita = FALSE;
						break;
					case 4:
						$term->is_location = FALSE;
						//$term->is_superbalita = TRUE;
						break;
				}
				$response->data[] = $term;
				unset($term);
			}
			$success = TRUE;	
		}
	}
	if(!$success) {
		$response->status = 500;
		$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}
/**
* retrieved user information
*/
function sunstar_api_retrieved_user_info($token) {
	$success = FALSE;
	$response = new stdClass();
	$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
	if (!empty($uid)) {
    $user = user_load($uid);
    
    $response->status = 200;
		$response->message = 'Successfully registered user';
		$response->data->firstname = $user->field_firstname['und'][0]['value'];
		$response->data->lastname = $user->field_lastname['und'][0]['value'];
		$response->data->birthdate = date("Y-m-d", $user->field_birthdate['und'][0]['value']);
		$response->data->avatar = isset($user->picture->uri) ? file_create_url($user->picture->uri) : "";
		$success = TRUE;
  } else {
			$response->status = 500;
			$response->message = 'User not exist.';
	}
	print drupal_json_output($response);
	exit();
}

/**
* API bookmark
*/
function sunstar_api_bookmark($type, $token) {
	$success = FALSE;
	$response = new stdClass();
	$tid = $_REQUEST['nid'];
	$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
	$checkbookmark = db_query("SELECT bookmark_id FROM userapp_bookmark WHERE uid = {$uid} AND tid = {$tid}")->fetchField();
	if (!empty($uid) && !empty($tid) && empty($checkbookmark)) {
		$save_cat = new stdClass();
		switch($type) {
			case 'news':
				$save_cat->type = 'news';
				break;
			case 'service':
				$save_cat->type = 'service';
				break;
		}
		$save_cat->uid = $uid;
		$save_cat->tid = $tid;
		$save_cat->created = time();
		$time = time();
	//	drupal_write_record('userapp_bookmark', $save_cat);
	//	unset($save_cat);
		db_query("INSERT INTO userapp_bookmark (uid, tid, created, type) VALUES ($uid, $tid, $time, '$type')");
    $response->status = 200;
		$response->message = 'Successfully (revoked) bookmarked item';
		$success = TRUE;
  } else if(!empty($uid) && !empty($tid) && !empty($checkbookmark)){
  		db_query("DELETE FROM userapp_bookmark WHERE uid = {$uid} AND tid = {$tid}");
	    $response->status = 200;
			$response->message = 'Successfully (revoked) unbookmarked item';
			$success = TRUE;
	} else {
			$response->status = 500;
			$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

/**
* GET bookmark
* 
* @return
*/
function sunstar_api_get_bookmark($type, $token) {
	$success = FALSE;
	$response = new stdClass();
	
	$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
	if (!empty($uid)) {
		$categories = db_query("SELECT tid,type FROM userapp_bookmark WHERE uid = {$uid} AND type = '{$type}'")->fetchAll();
    $data = array();
    foreach($categories as $tid) {
			// set data category
			/*$term = new stdClass();
			$termobj = taxonomy_term_load($tid->tid);
			$term->id = $tid->tid;
			if(empty($termobj)) {
					$node = node_load($tid->tid);
					if(!empty($node)){
						$term->name = $node->title;
					}
			} else {
					$term->name = $termobj->name;
			}
			
			switch($termobj->vid) {
				case 2:
					$term->is_location = FALSE;
					//$term->is_superbalita = FALSE;
					break;
				case 3:
					$term->is_location = TRUE;
					//$term->is_superbalita = FALSE;
					break;
				case 4:
					$term->is_location = FALSE;
					//$term->is_superbalita = TRUE;
					break;
			}*/
			$node = node_load($tid->tid);
			$user = user_load($uid);
			if(!empty($node)){
				$obj = new stdClass();
				
				$obj->id = $node->nid;
				$obj->title = $node->title;
				
				$images = array();
				if(isset($node->field_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_image['und'][0]['uri']);
				}
				if(isset($node->field_mt_teaser_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_mt_teaser_image['und'][0]['uri']);
				}
				if(isset($node->field_mt_banner_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_mt_banner_image['und'][0]['uri']);
				}
				$obj->photos = $images;
				
				$body = strip_tags($node->body['und'][0]['value']);
				$obj->content = substr($body, 0, 160);
				
				$obj->post_date = date("Y-m-d", $node->created);
				$obj->locations = array($node->field_location['und'][0]['tid']);
				
				$author = array();
				$authorimage = array();
				if(isset($node->field_author['und'][0]['tid'])) {
					$authorobj = taxonomy_term_load($node->field_author['und'][0]['tid']);
					$author[] = $authorobj->name;
					
					if(isset($authorobj->field_author_image['und'][0]['uri'])) {
						$authorimage[] = file_create_url($authorobj->field_author_image['und'][0]['uri']);
					}
				}
				$obj->authors = $author;
				$obj->author_imgs = $authorimage;
				
				$has_like = db_query("SELECT COUNT(*) FROM userapp_like WHERE uid = {$user->uid} AND nid = {$node->nid}")->fetchField();
				$obj->has_liked = !empty($has_like) ? 1 : 0;
				$obj->like_count = db_query("SELECT COUNT(*) FROM userapp_like WHERE uid = {$user->uid} AND nid = {$node->nid}")->fetchField();
				$obj->comment_count = db_query("SELECT COUNT(*) FROM userapp_comment WHERE uid = {$user->uid} AND nid = {$node->nid}")->fetchField();
				$bookmark = db_query("SELECT COUNT(*) FROM userapp_bookmark WHERE uid = {$user->uid} AND tid = {$node->nid}")->fetchField();
				$obj->has_bookmarked = !empty($bookmark) ? 1 : 0;
				
				$data[] = $obj;
				
				unset($obj);
			}
		}
		$response->data = $data;
    $response->status = 200;
		$response->message = 'Successfully retrieved bookmarks';
		$success = TRUE;
  } else {
			$response->status = 500;
			$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

/**
* LIKE
* 
* @return
*/
function sunstar_api_like($type, $token) {
	$success = FALSE;
	$response = new stdClass();
	$nid = $_REQUEST['nid'];
	$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
	$is_like = db_query("SELECT like_id FROM userapp_like WHERE uid = {$uid} AND nid = {$nid}")->fetchField();
	if (!empty($uid) && !empty($nid) && empty($is_like)) {
		$like = new stdClass();
		switch($type) {
			case 'news':
				$like->type = 'news';
				break;
			case 'service':
				$like->type = 'service';
				break;
		}
		$like->uid = $uid;
		$like->nid = $nid;
		$like->created = time();
		$time = time();

//		drupal_write_record('userapp_like', $like);
		db_query("INSERT INTO userapp_like (uid, nid, created, type) VALUES ($uid, $nid, $time, '$type')");
//		unset($like);


    $response->status = 200;
		$response->message = 'Successfully (revoked) liked item';
		$success = TRUE;
  } else if(!empty($uid) && !empty($nid) && !empty($is_like)) {
			db_query("DELETE FROM userapp_like WHERE uid = {$uid} AND nid = {$nid} AND type = '{$type}'");
	    $response->status = 200;
			$response->message = 'Successfully (revoked) unliked item';
			$success = TRUE;
	}else {
			$response->status = 500;
			$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

/**
* SHARE
* 
* @return
*/
function sunstar_api_share($type, $token) {
	$success = FALSE;
	$response = new stdClass();
	$nid = $_REQUEST['nid'];
	$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
	if (!empty($uid) && !empty($nid)) {
		$share = new stdClass();
		switch($type) {
			case 'news':
				$share->type = 'news';
				break;
			case 'service':
				$share->type = 'service';
				break;
		}
		$share->uid = $uid;
		$share->nid = $nid;
		$share->created = time();
		$time = time();
		//drupal_write_record('userapp_share', $share);
	//	unset($share);
		db_query("INSERT INTO userapp_share (uid, nid, created, type) VALUES ($uid, $nid, $time, '$type')");
    $response->status = 200;
		$response->message = 'Successfully (revoked) shared item';
		$success = TRUE;
  } else {
			$response->status = 500;
			$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

/**
* API comment
*/
function sunstar_api_comment($type, $token) {
	$success = FALSE;
	$response = new stdClass();
	$nid = $_REQUEST['nid'];
	$method = $_SERVER['REQUEST_METHOD'];
	$url = $_SERVER['REQUEST_URI'];
	$jsonparam = file_get_contents('php://input');
	watchdog('sunstar_api', 'API Comment : json data : <pre>%data</pre>', array('%data' => $jsonparam));
	$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
	if (!empty($uid) && !empty($nid) && !empty($jsonparam)) {
		$user = user_load($uid);
		$data = json_decode($jsonparam);
		$content = $data->content;
		$userid = isset($data->user_id);
//		$comment = new stdClass();
		switch($type) {
			case 'news':
				$commenttype = isset($comment->type);
				$commenttype = 'news';
				break;
			case 'service':
				$comment->type = 'service';
				break;
		}
//		$comment->uid = $uid;
//		$comment->nid = $nid;
//		$comment->content = $data->content;
//		$comment->created = time();
//		$comment->parent = $data->comment_id;
		$time = time();
		$parent = isset($data->parent_id);

               if(empty($parent)) {

		$commentid = db_insert("userapp_comment")
	        ->fields(array(
	       'uid' => $uid,
   	       'nid' => $nid,
               'comment' => $data->content,
               'created' => $time,
               'type' => $type
               ))
               ->execute();

		} else {

		$commentid = db_insert("userapp_comment") 
                ->fields(array(
               'uid' => $uid,
               'nid' => $nid,
               'comment' => $data->content,
               'created' => $time,
               'parent' => $parent,
               'type' => $type,
               ))
               ->execute();
		
		}
	      
			
	    $response->status = 200;
		$response->message = 'Successfully commented item';
		$response->data->id = isset($commentid);
		$response->data->user_id = $uid;
		$response->data->firstname = $user->field_firstname['und'][0]['value'];
		$response->data->lastname = $user->field_lastname['und'][0]['value'];
		$response->data->avatar = isset($user->picture->uri) ? file_create_url($user->picture->uri) : "";
		$response->data->content = strip_tags($content);
		$response->data->type = $type;
		$response->data->parent_id = $parent;
		$success = TRUE;
		unset($comment);
	   
  } else if(!empty($uid) && !empty($nid) && ($type == 'news' || $type == 'service')) {
  		
  		$data = array();
			$query = db_query("SELECT * FROM userapp_comment WHERE nid = {$nid}")->fetchAll();
			$response->status = 200;
			$response->message = 'Successfully retrieved commented item';
					
				
			foreach($query as $result) {
				$user = user_load($result->uid);
					$obj = new stdClass();
					$obj->id = $result->comment_id;
					$obj->user_id = $result->uid;
					$obj->firstname = $user->field_firstname['und'][0]['value'];
					$obj->lastname = $user->field_lastname['und'][0]['value'];
					$obj->avatar = isset($user->picture->uri) ? file_create_url($user->picture->uri) : "";
					$obj->content = strip_tags($result->comment);
						if($result->parent != 0) {
						$parent_id = $result->parent;
						$obj->parent_id = $result->parent;		
					}
					
				$data[] = $obj;
				unset($obj);	
											
			}
				
			$response->data = $data;
			$success = TRUE;
	} else if(!empty($uid) && $method == 'DELETE') {
		$cidurl = explode('/',$url);
		$commentid = $cidurl[sizeof($cidurl)-2];	
	//	$data = json_decode($jsonparam);
         	$user = user_load($uid);
           //	$commentid = $data->comment_id;
            	$response->status = 200;
            	$response->message = 'Successfully deleted comment';
            	db_query("DELETE from userapp_comment WHERE comment_id = '{$commentid}'");
            	$response->data->comment_id = $commentid;
            	$response->data->user_id = $user->uid;

	
	} else if(!empty($uid) && $method == 'PUT') {
		$cidurl = explode('/',$url);
                $commentid = $cidurl[sizeof($cidurl)-2];
		$data = json_decode($jsonparam);
           	$user = user_load($uid);
        //   	$commentid = $data->comment_id;
		$content = $data->content;
           	$response->status = 200;
           	$response->message = 'Successfully updated comment';
           	db_query("UPDATE userapp_comment set comment = '{$content}' WHERE comment_id = '{$commentid}'");
        	$response->data->comment_id = $commentid;
	        $response->data->user_id = $user->uid;
	    	$response->data->content = strip_tags($content);
		
	} else {

		$response->status = 500;
		$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}

function get_services_term_id($services) {
	switch($services) {
		case 'jobs':
			return 1815;
		case 'lotto':
			return 1985;
		case 'obituary':
			return 1986;
		case 'properties':
			return 1816;
		case 'anniversaries':
			return 3087;
		case 'birthdays':
			return 3088;
	}
}

function sunstar_api_search($token) {
	$success = FALSE;
	$response = new stdClass();
	$arg0 = arg(0);
	$arg1 = arg(1);
	if($arg0 == 'api' && $arg1 == 'search' && isset($_REQUEST['what'])) {
		$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();
		if(!empty($uid)) {
      $user = user_load($uid);
    	
    	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 0;
    	  
      $response->status = 200;
			$response->message = 'Successfully retrieved matching words';
			$dataArr = array();
			
			$query = new EntityFieldQuery();
			$query->entityCondition('entity_type', 'node');
			$query->propertyCondition('status', 1);
			if($_REQUEST['what']) {
				$query->propertyCondition('title', '%' . $_REQUEST['what'] . '%', 'LIKE');	
				$query->fieldCondition('body', 'value', '%' . $_REQUEST['what'] . '%', 'LIKE');	
			}
			$query->count();
			$count = $query->execute();
			
		        $query = db_select('node' , 'n');
			$query->leftjoin('field_data_body', 'b', 'n.nid = b.entity_id');
			$query->leftjoin('field_data_field_author', 'a', 'n.nid = a.entity_id');
			$query->leftjoin('taxonomy_term_data', 't', 'field_author_tid = t.tid');
                       	$query->fields('n', array('nid'));
			$query->where("((n.title LIKE '%{$_REQUEST['what']}%') OR (b.body_value  LIKE '%{$_REQUEST['what']}%') OR  (t.name LIKE '%{$_REQUEST['what']}%'))");
			$query->orderBy('n.title', 'ASC');
			$query->range(($page * 10), 10);
			$result = $query->execute()->fetchAll();
	
			// Data
			$data = array();
			foreach($result as $n) {
				$node = node_load($n->nid);
				$obj = new stdClass();
				
				$obj->id = $node->nid;
				$obj->title = $node->title;
				$cat = $node->type;
				
				$images = array();
				if(isset($node->field_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_image['und'][0]['uri']);
				}
				if(isset($node->field_mt_teaser_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_mt_teaser_image['und'][0]['uri']);
				}
				if(isset($node->field_mt_banner_image['und'][0]['uri'])) {
					$images[] = file_create_url($node->field_mt_banner_image['und'][0]['uri']);
				}
				$obj->photos = $images;
				
				$body = strip_tags($node->body['und'][0]['value']);
				$obj->content = substr($body, 0, 160);
				
				$obj->post_date = date("Y-m-d", $node->created);
				if(isset($node->field_location['und'][0]['tid'])){
				$obj->locations = array($node->field_location['und'][0]['tid']);
				}
				$author = array();
				$authorimage = array();
				if(isset($node->field_author['und'][0]['tid'])) {
					$authorobj = taxonomy_term_load($node->field_author['und'][0]['tid']);
					$author[] = $authorobj->name;
					
					if(isset($authorobj->field_author_image['und'][0]['uri'])) {
						$authorimage[] = file_create_url($authorobj->field_author_image['und'][0]['uri']);
					}
				}
				$obj->authors = $author;
				$obj->author_imgs = $authorimage;
				
				$has_like = db_query("SELECT COUNT(*) FROM userapp_like WHERE uid = {$user->uid} AND nid = {$node->nid}")->fetchField();
				$obj->has_liked = !empty($has_like) ? 1 : 0;
				$obj->like_count = db_query("SELECT COUNT(*) FROM userapp_like WHERE uid = {$user->uid} AND nid = {$node->nid}")->fetchField();
				$obj->comment_count = db_query("SELECT COUNT(*) FROM userapp_comment WHERE uid = {$user->uid} AND nid = {$node->nid}")->fetchField();
				$bookmark = db_query("SELECT COUNT(*) FROM userapp_bookmark WHERE uid = {$user->uid} AND tid = {$node->nid}")->fetchField();
				$obj->has_bookmarked = !empty($bookmark) ? 1 : 0;
				if($cat == 'article') {
			        	$termobj = taxonomy_term_load($node->field_mt_post_categories['und'][0]['tid']);
				} elseif(isset($node->field_seksyon['und'][0]['tid'])) {
					$termobj = taxonomy_term_load($node->field_seksyon['und'][0]['tid']);
				}
				$obj->category_name = isset($termobj->name) ? $termobj->name : "";
				$data[] = $obj;
				
				unset($obj);
			}
			
			$response->data = $data;
			$response->pager = round($count / 10);
			
			$success = TRUE;
		}
	}
	if(!$success) {
		$response->status = 500;
		$response->message = 'There is an error.';
	} else if(empty($response->data)) {
		$response->status = 500;
		$response->message = 'no data';
	}
	print drupal_json_output($response);
	exit();
}

function sunstar_api_social_login($social_network){
	include_once DRUPAL_ROOT . '/' . libraries_get_path('fb') . "/autoload.php"; 
	include_once DRUPAL_ROOT . '/' . libraries_get_path('gplus') . "/autoload.php"; 
	$success = FALSE;
	$token = "";
	$response = new stdClass();
	$account = new stdClass();
	$jsonparam = file_get_contents('php://input');
	watchdog('sunstar_api', 'Social Register : json data : <pre>%data</pre>', array('%data' => $jsonparam,));
	if(!empty($jsonparam)) {
		try{
			$data = json_decode($jsonparam);
			$access_token = $data->access_token;
			if($social_network == 'fb') {
				$fb = new Facebook\Facebook([
				  'app_id' => '170014129740511',
				  'app_secret' => '88b6e564d34a97dd7fe1f25db91935bc',
				  'default_graph_version' => 'v2.2',
			  ]);
			  $fbres = $fb->get('/me?fields=id,name,email,last_name,first_name,birthday,gender', $access_token);
			  $userjson = $fbres->getGraphUser();
			  $user = json_decode($userjson);
			  
			  watchdog('sunstar_api', 'Social Register FB : json data : <pre>%data</pre>', array('%data' => $userjson,));
			  
			  $username = $user->email;
			  $password = ($username .'s0c1@l');
			  
				if($uid = user_authenticate($username, $password)) {
					$user = user_load($uid);
			
		      $login_array = array ('name' => $username);
		      user_login_finalize($login_array);
		      $token = check_userapp_token($uid);
		      if(empty($token)) {
				  		$device_id = $data->device_id;
				  		$device_type = $data->device_type;
						$token = generate_userapp_token($uid, $device_id, $device_type);
					}
		      
		      $response->status = 200;
					$response->message = 'Successfully logged in user';
					$response->data->uid = $uid;
					$response->data->token = $token;
					$response->data->firstname = $user->field_firstname['und'][0]['value'];
					$response->data->lastname = $user->field_lastname['und'][0]['value'];
					$response->data->gender = isset($user->field_gender['und'][0]['value']) ? $user->field_gender['und'][0]['value'] : 0;
					$response->data->email = $user->mail;
					$response->data->birthdate = date("Y-m-d", $user->field_birthdate['und'][0]['value']);
					$response->data->avatar = isset($user->picture->uri) ? file_create_url($user->picture->uri) : "";
					print drupal_json_output($response);
					exit();
					
				} else if(isset($user->email)) {
						$firstname = isset($user->first_name) ? $user->first_name : "";
						$lastname = isset($user->last_name) ? $user->last_name : "";
						$gender = isset($user->gender) ? $user->gender : 2;
						switch($gender){
							case 'female':
							$gender = 0;
							break;
							case 'male':
							$gender = 1;
							break;
							case 'others':
							$gender = 2;
							break;
						}
						$birthdate = isset($user->birthday) ? date("Y-m-d", strtotime($user->birthday)) : "";
						$email = isset($user->email) ? $user->email : "";
						$password = ($username .'s0c1@l');
						$fbpic = "http://graph.facebook.com/" . $user->id . "/picture?type=large";
						if(isset($fbpic)) {
							$avatar_url = $fbpic;
							$file = system_retrieve_file($avatar_url, 'public://pictures', TRUE, FILE_EXISTS_RENAME);	
						}
						
						$userapp_rid = db_query("SELECT rid FROM role WHERE name = 'userapp'")->fetchObject();
						$new_user_roles = array(
						  DRUPAL_AUTHENTICATED_RID => 'authenticated user',
						  $userapp_rid->rid => 'userapp',
						);
						$new_user = array(
							'name' => $email,
							'mail' => $email,
							'pass' => $password,
							'status' => 1,
							'field_firstname' => array(LANGUAGE_NONE => array(
								array('value' => $firstname,),
							)),
							'field_lastname' => array(LANGUAGE_NONE => array(
								array('value' => $lastname,),
							)),
							'field_gender' => array(LANGUAGE_NONE => array(
								array('value' => $gender,),
							)),
							'field_birthdate' => array(LANGUAGE_NONE => array(
								array(
									'value' => strtotime($birthdate),
									'date_type' => 'datestamp',
								),
							)),
							'force_password_change' => 0,
							'roles' => $new_user_roles,
							'access' => REQUEST_TIME,
						);
						$account->is_new = TRUE;
						user_save($account, $new_user);
						if(isset($file)) {
							user_save($account, array('picture' => $file));
						}
						$token = generate_userapp_token($account->uid);
						$success = TRUE;	
				}
			} else if($social_network == 'gplus') {
					$token = array('access_token' => $access_token);
					$apiKey = 'AIzaSyC06vDBi-aVEUxTeAtdnPXRXAfE6PxpgBg';
					
					$client = new Google_Client();
					$client->setClientId('930561315965-ad5610nk7hp42bng9tnsdtqnuhlr9lbq.apps.googleusercontent.com');
					$client->setClientSecret('282Gmy-cnTosHFoTBcsgcAdA');
					$client->setDeveloperKey($apiKey);
					$client->setAccessToken($jsonparam);
					$client->setScopes(array('https://www.googleapis.com/auth/userinfo.profile', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me'));
					if($client->isAccessTokenExpired()) {
				    $client->authenticate($data->auth_code);
				    $NewAccessToken = json_decode($client->getAccessToken());
				    $client->refreshToken($NewAccessToken->refresh_token);
					}
					
					$googlePlus = new Google_Service_Plus($client);
					$user = $googlePlus->people->get('me');
					
					$idtokenobj = $client->verifyIdToken($access_token);
					$artribute = $idtokenobj->getAttributes();
					
					//watchdog('sunstar_api', 'Social gplus : json data : <pre>%data</pre>', array('%data' => json_encode($data1),));
					
					$username = $user['emails'][0]['value'];
					$password = ($username .'s0c1@l');
				  
					if($uid = user_authenticate($username, $password)) {
						$user = user_load($uid);
				
			      $login_array = array ('name' => $username);
			      user_login_finalize($login_array);
			      $token = check_userapp_token($uid);
			      if(empty($token)) {
							$token = generate_userapp_token($uid);
						}
			      
			      $response->status = 200;
						$response->message = 'Successfully logged in user';
						$response->data->uid = $uid;
						$response->data->token = $token;
						$response->data->firstname = $user->field_firstname['und'][0]['value'];
						$response->data->lastname = $user->field_lastname['und'][0]['value'];
						$response->data->gender = isset($user->field_gender['und'][0]['value']) ? $user->field_gender['und'][0]['value'] : 0;
						$response->data->email = $user->mail;
						$response->data->birthdate = date("Y-m-d", $user->field_birthdate['und'][0]['value']);
						$response->data->avatar = isset($user->picture->uri) ? file_create_url($user->picture->uri) : "";
						print drupal_json_output($response);
						exit();
						
					} else if(!empty($username)) {
							$firstname = isset($user['name']['givenName']) ? $user['name']['givenName'] : "";
							$lastname = isset($user['name']['familyName']) ? $user['name']['familyName'] : "";
							$gender = isset($user->gender) ? $user->gender : 2;
							switch($gender){
								case 'female':
								$gender = 0;
								break;
								case 'male':
								$gender = 1;
								break;
								case 'others':
								$gender = 2;
								break;
							}
							$birthdate = !empty($user->birthday) ? date("Y-m-d", strtotime($user->birthday)) : "";
							$email = $username;
							$password = ($username .'s0c1@l');
							if(isset($artribute['payload']['picture'])) {
								$avatar_url = $artribute['payload']['picture'];
								$file = system_retrieve_file($avatar_url, 'public://pictures', TRUE, FILE_EXISTS_RENAME);	
							}
							
							$userapp_rid = db_query("SELECT rid FROM role WHERE name = 'userapp'")->fetchObject();
							$new_user_roles = array(
							  DRUPAL_AUTHENTICATED_RID => 'authenticated user',
							  $userapp_rid->rid => 'userapp',
							);
							$new_user = array(
								'name' => $email,
								'mail' => $email,
								'pass' => $password,
								'status' => 1,
								'field_firstname' => array(LANGUAGE_NONE => array(
									array('value' => $firstname,),
								)),
								'field_lastname' => array(LANGUAGE_NONE => array(
									array('value' => $lastname,),
								)),
								'field_gender' => array(LANGUAGE_NONE => array(
									array('value' => $gender,),
								)),
								'field_birthdate' => array(LANGUAGE_NONE => array(
									array(
										'value' => strtotime($birthdate),
										'date_type' => 'datestamp',
									),
								)),
								'force_password_change' => 0,
								'roles' => $new_user_roles,
								'access' => REQUEST_TIME,
							);
							
							$account->is_new = TRUE;
							user_save($account, $new_user);
							if(isset($file)) {
								user_save($account, array('picture' => $file));
							}
							$token = generate_userapp_token($account->uid);
							$success = TRUE;	
					}
			} else {
					$response->status = 500;
					$response->message = 'User already exist';
					print drupal_json_output($response);
					exit();
			}
		}	catch(Facebook\Exceptions\FacebookResponseException $e) {
				$response->status = 500;	
		  	$response->message = 'Graph returned an error: ' . $e->getMessage();
		  	print drupal_json_output($response);
				exit();
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
				$response->status = 500;
			  $response->message = 'Facebook SDK returned an error: ' . $e->getMessage();
			  print drupal_json_output($response);
				exit();
		}	catch(Exception $e) {
				$response->status = 500;
		    $response->message = "Error : " . $e->getMessage();
		    print drupal_json_output($response);
				exit();
			}

	} else {
			return drupal_not_found();
	}
	if($success) {
		$user = user_load($account->uid);
		$response->status = 200;
		$response->message = 'Successfully registered user';
		$response->data->uid = $uid;
		$response->data->token = $token;
		$response->data->firstname = $firstname;
		$response->data->lastname = $lastname;
		$response->data->gender = $gender;
		$response->data->email = $user->mail;
		$response->data->birthdate = $birthdate;
		$response->data->avatar = isset($file) ? file_create_url($file->uri) : "";
	} else {
			$response->status = 500;
			$response->message = 'There is an error.';
	}
	print drupal_json_output($response);
	exit();
}


function sunstar_api_userapp_update($token)
{
        $success = FALSE;
        $response = new stdClass();
        $jsonparam = file_get_contents('php://input');
        watchdog('sunstar_api', 'Updated : json data : <pre>%data</pre>', array('%data' => $jsonparam,));
        $uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();

        if (!empty($jsonparam) && !empty($uid)) {
                $data = json_decode($jsonparam);
                $account = user_load($uid);
        
	        $edit = array();
                $edit['field_firstname'][LANGUAGE_NONE][0]['value'] = $data->firstname;
				$edit['field_lastname'][LANGUAGE_NONE][0]['value'] = $data->lastname;
				$edit['field_gender'][LANGUAGE_NONE][0]['value'] = $data->gender;
				$edit['field_birthdate'][LANGUAGE_NONE][0]['value'] = strtotime($data->birthdate);

	        user_save($account,$edit);

                $success = TRUE;
                
         } 

	if($success){	
  		$user = user_load($uid);
       		$response->status = 200;
		$response->message = 'Successfully updated user';
		$response->data->firstname = $user->field_firstname['und'][0]['value'];
		$response->data->lastname = $user->field_lastname['und'][0]['value'];
		$response->data->gender = $user->field_gender['und'][0]['value'];
		$response->data->birthdate = date("Y-m-d", $user->field_birthdate['und'][0]['value']);
	} else {
 	        $response->status = 500;
       		$response->message = 'Failed to update';
        }
        
        print drupal_json_output($response);
        exit();
}


function sunstar_api_userapp_privacy($token)
{
	$success = FALSE;
	$response = new stdClass();
	$jsonparam = file_get_contents('php://input');
	watchdog('sunstar_api', 'Updated : json data : <pre>%data</pre>', array('%data' => $jsonparam,));
	$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();

	if (!empty($jsonparam)){
		$data = json_decode($jsonparam);
		$account = user_load($uid);

		$edit = array();
		$edit['field_privacy'][LANGUAGE_NONE][0]['value'] = $data->privacy;

		user_save($account,$edit);

		$success = TRUE;
	}

	if($success){
		$user = user_load($uid);
		$response->status = 200;
		$response->message = 'Successfully updated user privacy';
		$response->data->privacy = isset($user->field_privacy['und'][0]['value']);
	} else {
		$response->status = 500;
		$response->message = 'Failed to update privacy';
	}

	print drupal_json_output($response);
	exit();

}

function sunstar_api_userapp_avatar($token)
{

	$success = FALSE;
	$response = new stdClass();
	//$jsonparam = file_get_contents('php://input');
	watchdog('sunstar_api', 'Uploaded : json data : <pre>%data</pre>', array('%data' => $jsonparam,));
	$uid = db_query("SELECT uid FROM userapp WHERE token = '{$token}'")->fetchField();

		if(isset($_FILES['avatar'])){
			
			 $account = user_load($uid);
			
			 $image = file_get_contents($_FILES['avatar']['tmp_name']);

	
		  	 $file = file_save_data($image, 'public://pictures/'.$_FILES['avatar']['name'], FILE_EXISTS_RENAME);
			 $file->status = FILE_STATUS_PERMANENT;
   			 file_save($file);

			 
			 $edit = array();
       		         $edit['picture'] = $file;

               		 user_save($account,$edit);
			 $success = TRUE;
			
			} else {
                           
			$response->status = 500;
			$response->message = 'Image did not save';
			}
		
        
	

	if($success){
		$user = user_load($uid);
		$response->status = 200;
		$response->message = 'Successfully uploaded avatar';
		$response->data->avatar = isset($user->picture->uri) ? file_create_url($user->picture->uri) : "";; 

	} else {
		$response->status = 500;
		$response->message = 'Failed to upload';
	}
	print drupal_json_output($response);
	exit();

}

function sunstar_api_forgot()
{
        $success = FALSE;
        $response = new stdClass();
	$account = new stdClass();
        $jsonparam = file_get_contents('php://input');
        watchdog('sunstar_api', 'Reset : json data : <pre>%data</pre>', array('%data' => $jsonparam,));
        

        if (!empty($jsonparam)) {
                $data = json_decode($jsonparam);
		$uid = db_query("SELECT uid FROM users WHERE mail = '{$data->email}'")->fetchField();
		
		$account = user_load($uid);
		_user_mail_notify('password_reset', $account);					
                $success = TRUE;
                
         } 

	if($success){
	       	$response->status = 200;
		$response->message = 'An email has been sent to this address. Please check your email and reset your password.';
		
	} else {
 	        $response->status = 500;
       		$response->message = 'Failed to reset password';
        }
        
        print drupal_json_output($response);
        exit();
}

