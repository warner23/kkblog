<?php


class Valid
{

	function validateUser($user)
{
  
  $errors= array();

   if(empty($user['username'])){
   	array_push($errors,'Username is required');
   }
    
   if(empty($user['email'])){
   	array_push($errors,'Email is required');
   }

    if(empty($user['password'])){
   	array_push($errors,'Password is required');
   }

    if($user['passwordConf'] !== $user['password']){
   	array_push($errors,'Password do not match');
   }

   //$existingUser=selectOne('users',['email'=> $user['email']]);
   //if($existingUser)
   //{
   //array_push($errors,'Email already exists');
   //}

   $existingUser=selectOne('users',['email'=> $user['email']]);
   if($existingUser)
   {
    if(isset($user['update-user']) && $existingUser['id'] != $user['id'])
    {
    array_push($errors,'Email already exists');
   }
   if(isset($user['create-admin']))
   {
    array_push($errors,'Email already exists');
   }
}

	return $errors;
}


function validateLogin($user)
{
  
  $errors= array();

   if(empty($user['username'])){
   	array_push($errors,'Username is required');
   }
    
   
     if(empty($user['password'])){
   	array_push($errors,'Password is required');
   }

    return $errors;
}

// topics
	
	function validateTopic($topic)
	{
	  
	  $errors= array();

	   if(empty($topic['name'])){
	   	array_push($errors,'Name is required');
	   }
	   
	   

	$existingTopic=selectOne('topics',['name'=> $post['name']]);
	   if($existingTopic)
	   {
	    if(isset($post['update-topic']) && $existingTopic['id'] != $post['id'])
	    {
	    array_push($errors,'Post with that title already exists');
	   }
	   if(isset($post['add-topic']))
	   {
	    array_push($errors,'Name already exists');
	   }
	}


		return $errors;
	}

	//posts
	function validatePost($post)
{
  
  $errors= array();

   if(empty($post['title'])){
   	array_push($errors,'Title is required');
   }
    
   if(empty($post['body'])){
   	array_push($errors,'Body is required');
   }

    if(empty($post['topic_id'])){
   	array_push($errors,'Please select a topic');
   }

    
   $existingPost=selectOne('posts',['title'=> $post['title']]);
   if($existingPost)
   {
    if(isset($post['update-post']) && $existingPost['id'] != $post['id'])
    {
    array_push($errors,'Post with that title already exists');
   }
   if(isset($post['add-post']))
   {
    array_push($errors,'Post with that title already exists');
   }
}


	return $errors;
}
	
}