<?php



if(!function_exists('training_manage')){ 

 function training_manage($table='',$productID =''){    

 	$ci = @get_instance();

    $ci->load->database();

    $ci->db->from($table);

    $ci->db->where('id',$productID);

    $query = $ci->db->get();

    $row = $query->row();

    $result = array();

    $training ='';

    if(isset($row->product_detail) && !empty($row->product_detail)){

        $unserialize = unserialize($row->product_detail);

    	foreach ($unserialize['training'] as $key => $value){

    		if($key == 'inperson' && $value == 'true'){

    			$result['inperson'] = 'Inperson';

    		}

            if($key == 'liveonline' && $value == 'true'){

                $result['liveonline'] = 'Live Online';

            }

            if($key == 'Webinars' && $value == 'true'){

                $result['Webinars'] = 'Webinars';

            }

            if($key == 'Documentation' && $value == 'true'){

                $result['Documentation'] = 'Documentation';

            }

    		

    	}

        $training = implode(', ', $result);

    }

    return $training;

 }  

}



if(!function_exists('support_manage')){ 

 function support_manage($table='',$productID =''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from($table);

    $ci->db->where('id',$productID);

    $query = $ci->db->get();

    $row = $query->row();

    $result = array();

    $support ='';

    if(isset($row->product_detail) && !empty($row->product_detail)){

        $unserialize = unserialize($row->product_detail);

        foreach ($unserialize['support'] as $key => $value){

            if($key == 'liverep' && $value == 'true'){

                $result['liverep'] = 'Live Rep';

            }

            if($key == 'businesshour' && $value == 'true'){

                $result['businesshour'] = 'Business Hours';

            }

            if($key == 'onLine' && $value == 'true'){

                $result['onLine'] = 'Online Chat';

            }

            if($key == 'onlineresources' && $value == 'true'){

                $result['onlineresources'] = 'Online Resources';

            }

            if($key == 'phone_support' && $value == 'true'){

                $result['phone_support'] = 'Phone Support';

            }

            if($key == 'email_support' && $value == 'true'){

                $result['email_support'] = 'Email Support';

            }            

        }

        $support = implode(', ', $result);

    }

    return $support;

 }  

}



if(!function_exists('deploy_manage')){ 

 function deploy_manage($table='',$productID =''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from($table);

    $ci->db->where('id',$productID);

    $query = $ci->db->get();

    $row = $query->row();

    $result = array();

    $deploys = '';

    if(isset($row->product_detail) && !empty($row->product_detail)){

        $unserialize = unserialize($row->product_detail);

        $explodeData = explode(',', $unserialize['deploy']);

        foreach ($explodeData as $key => $value){

            if($value == 'webbase'){

                $result['webbase'] = 'Web Based';

            }

            if($value == 'windows'){

                $result['windows'] = 'Windows/Installed';

            }

            if($value == 'android'){

                $result['android'] = 'Android';

            }

            if($value == 'ios'){

                $result['ios'] = 'IOS';

            }            

        }        

        $deploys = implode(', ', $result);

    }    

    return $deploys;

 }  

}





if(!function_exists('pricemodel_manage')){ 

 function pricemodel_manage($table='',$productID =''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from($table);

    $ci->db->where('id',$productID);

    $query = $ci->db->get();

    $row = $query->row();

    $result = array();

    $pricemodel = '';

    if(isset($row->product_detail) && !empty($row->product_detail)){

        $unserialize = unserialize($row->product_detail);

        foreach ($unserialize['pricemodel'] as $key => $value){

            if($value == 'free'){

                $result['free'] = 'Free';

            }

            if($value == 'freetrial'){

                $result['freetrial'] = 'Free Trial';

            }

            if($value == 'onetime'){

                $result['onetime'] = 'One Time';

            }

            if($value == 'opensource'){

                $result['opensource'] = 'Open Source';

            }

            if($value == 'subscription'){

                $result['subscription'] = 'Subscription';

            }            

        }

        $pricemodel = implode(', ', $result);

    }

    return $pricemodel;

 }  

}



if(!function_exists('business_size_manage')){ 

 function business_size_manage($table='',$productID =''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from($table);

    $ci->db->where('id',$productID);

    $query = $ci->db->get();

    $row = $query->row();

    $result = array();

    $business_size = '';

    if(isset($row->product_detail) && !empty($row->product_detail)){

        $unserialize = unserialize($row->product_detail);

        foreach ($unserialize['business_size'] as $key => $value){

            if($value == 'small'){

                $result['small'] = 'Small';//'Small Business';

            }

            if($value == 'medium'){

                $result['medium'] = 'Medium';

            }

            if($value == 'large'){

                $result['large'] = 'Large';

            }                       

        }

        $business_size = implode(', ', $result);

    }

    return $business_size;

 }  

}





if(!function_exists('getUserDetails')){ 

   function getUserDetails($user_id='',$column=''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('user');

    $ci->db->where('id',$user_id);

    $query = $ci->db->get();

    if($column){

        $row = $query->result_array();

        if($row){

            if($column == 'profile'){

                if($row[0][$column] && file_exists($row[0][$column])){

                    return base_url().$row[0][$column];

                } else {

                    return base_url().'assets/admin/img/user-default.png';

                }

            } else if($column == 'role_manage'){

                return json_decode($row[0][$column],true);

            } else {

                return $row[0][$column];

            }

        } else {

            if($column == 'profile'){

                return base_url().'assets/admin/img/user-default.png';

            } else {

                return false;

            }

            

        }

    } else {

        $row = $query->row();

        return $row;

    }  

}

}



if(!function_exists('getBrandDetails')){ 

   function getBrandDetails($id='',$column=''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('brands');

    $ci->db->where('id',$id);

    $query = $ci->db->get();

    if($column){

        $row = $query->result_array();

        if($row){

            if($column == 'image'){

                if($row[0][$column] && file_exists($row[0][$column])){

                    return base_url().$row[0][$column];

                } else {

                    return base_url().'assets/admin/img/no-image.jpg';

                }

            }  else {

                return $row[0][$column];

            }

        } else {

            if($column == 'image'){

                return base_url().'assets/admin/img/no-image.jpg';

            } else {

                return false;

            }

            

        }

    } else {

        $row = $query->row();

        return $row;

    }  

}

}







if(!function_exists('getCatImage')){ 

    function getCatImage($cat_id='',$column=''){    

        $ci = @get_instance();

        $ci->load->database();

        $ci->db->from('category');

        $ci->db->where('id',$cat_id);

        $query = $ci->db->get();

        if($column){

            $row = $query->result_array();

            if($row){

                if($column == 'logo'){

                    if($row[0][$column] && file_exists($row[0][$column])){

                        return base_url().$row[0][$column];

                    } else {

                        return base_url().'assets/admin/img/no-image.jpg';

                    }

                } else {

                    return $row[0][$column];

                }

            }else{

                if($column == 'logo'){

                    return base_url().'assets/admin/img/no-image.jpg';

                } else {

                    return false;

                }



            }

        }else{

            $row = $query->row();

            return $row;

        }  

    }

}





if(!function_exists('getProductImage')){ 

    function getProductImage($product_id='',$column=''){    

        $ci = @get_instance();

        $ci->load->database();

        $ci->db->from('products');

        $ci->db->where('id',$product_id);

        $query = $ci->db->get();

        if($column){

            $row = $query->result_array();

            if($row){

                if($column == 'logo'){

                    if($row[0][$column] && file_exists($row[0][$column])){

                        return base_url().$row[0][$column];

                    } else {

                        return base_url().'assets/admin/img/no-image.jpg';

                    }

                }  else {

                    return $row[0][$column];

                }

            }else{

                if($column == 'logo'){

                    return base_url().'assets/admin/img/no-image.jpg';

                } else {

                    return false;

                }



            }

        }else{

            $row = $query->row();

            return $row;

        }  

    }

}



if(!function_exists('getBrands')){ 

    function getBrands($column=''){    

        $ci = @get_instance();

        $ci->load->database();

        $ci->db->from('brands');

        $ci->db->where('status',1);

        $ci->db->order_by('ordering','ASC');

        $query = $ci->db->get();

        if($column){

            $row = $query->result_array();

            if($row){

                if($column == 'logo'){

                    if($row[0][$column] && file_exists($row[0][$column])){

                        return base_url().$row[0][$column];

                    } else {

                        return base_url().'assets/admin/img/no-image.jpg';

                    }

                }  else {

                    return $row[0][$column];

                }

            }else{

                if($column == 'logo'){

                    return base_url().'assets/admin/img/no-image.jpg';

                } else {

                    return false;

                }

            }

        }else{

            $row = $query->result();

            return $row;

        }  

    }

}



if(!function_exists('getFeaturedProduct')){ 

    function getFeaturedProduct(){    

        $ci = @get_instance();

        $ci->load->database();

        $ci->db->from('products');

        $ci->db->where('active',1);

        $ci->db->where('featured',1);        

        $query = $ci->db->get();

        $row = $query->result();

        return $row;

    }

}

if(!function_exists('getRelatedProduct')){
    function getRelatedProduct($alias=''){
        $ci = @get_instance();
        $ci->load->database();
        $ci->db->from('products');
        $ci->db->where('active',1);
        if($alias){
            $ci->db->where('alias !=',$alias);
        }
        $query = $ci->db->get();
        $row = $query->result();
        return $row;
    }

}



if(!function_exists('getProducts')){ 

    function getProducts($product_id='',$column=''){    

        $ci = @get_instance();

        $ci->load->database();

        $ci->db->from('products');

        $ci->db->where('id',$product_id);

        $query = $ci->db->get();

        if($column){

            $row = $query->result_array();

            if($row){

                if($column == 'logo'){

                    if($row[0][$column] && file_exists($row[0][$column])){

                        return base_url().$row[0][$column];

                    } else {

                        return base_url().'assets/admin/img/no-image.jpg';

                    }

                }  else {

                    return $row[0][$column];

                }

            }else{

                if($column == 'logo'){

                    return base_url().'assets/admin/img/no-image.jpg';

                } else {

                    return false;

                }



            }

        }else{

            $row = $query->row();

            return $row;

        }  

    }

}



if(!function_exists('getBlogImage')){ 

    function getBlogImage($blog_id='',$column=''){    

        $ci = @get_instance();

        $ci->load->database();

        $ci->db->from('post');

        $ci->db->where('id',$blog_id);

        $query = $ci->db->get();

        if($column){

            $row = $query->result_array();

            if($row){

                if($column == 'logo'){

                    if($row[0][$column] && file_exists('uploads/post/'.$row[0][$column])){

                        return base_url().'uploads/post/'.$row[0][$column];

                    } else {

                        return base_url().'assets/admin/img/no-image.jpg';

                    }

                }  else {

                    return $row[0][$column];

                }

            }else{

                if($column == 'logo'){

                    return base_url().'assets/admin/img/no-image.jpg';

                } else {

                    return false;

                }



            }

        }else{

            $row = $query->row();

            return $row;

        }  

    }

}





if(!function_exists('getBannerImage')){ 

    function getBannerImage($banner_id='',$column=''){    

        $ci = @get_instance();

        $ci->load->database();

        $ci->db->from('banner');

        $ci->db->where('id',$banner_id);

        $query = $ci->db->get();

        if($column){

            $row = $query->result_array();

            if($row){

                if($column == 'image'){

                    if($row[0][$column] && file_exists($row[0][$column])){

                        return base_url().$row[0][$column];

                    } else {

                        return base_url().'assets/admin/img/no-image.jpg';

                    }

                }  else {

                    return $row[0][$column];

                }

            }else{

                if($column == 'image'){

                    return base_url().'assets/admin/img/no-image.jpg';

                } else {

                    return false;

                }



            }

        }else{

            $row = $query->row();

            return $row;

        }  

    }

}



if(!function_exists('getMenus')){ 

   function getMenus($json=array()){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('admin_menues');

    $ci->db->where_in('codes',$json);

    $ci->db->where('show_sidebar',1);

    $ci->db->where('menu_type','main');

    $ci->db->order_by('ordering','ASC');

    $query = $ci->db->get();

    $row = $query->result_array();

    if($row){

        foreach ($row as $key => $value) {

            $ci->db->from('admin_menues');

            $ci->db->where_in('codes',$json);

            $ci->db->where('parent_id',$value['id']);

            $ci->db->where('show_sidebar',1);

            $ci->db->where('menu_type','sub');

            $ci->db->order_by('ordering','ASC');

            $query = $ci->db->get();

            $row1 = $query->result_array();

            if($row1){

             $row[$key]['submenus'] = $row1; 

            }

             

        }

    }

    return $row;

}

}



if(!function_exists('ManuArrange')){ 

    function ManuArrange()

    {   

        $ci = @get_instance();

        $query = $ci->db->query('Select * from admin_menues order by ordering');

        $prepare_manu = $query->result_array();

        $result_main = array();

        foreach($prepare_manu as $key => $prepare_manues){

            if($prepare_manues['menu_type'] == 'main'){

                $prepare_manues['sub'] = array();

                array_push($result_main,$prepare_manues);

            }

        }







        foreach($prepare_manu as $key => $value){               

            if($value['parent_id']){

                foreach($result_main as $key => $submanue){

                    if($submanue['id'] == $value['parent_id']){

                        array_push($result_main[$key]['sub'],$value);

                    }

                }

            }

        }



        return $result_main;

    }

}



if(!function_exists('getPageDetails')){ 

   function getPageDetails($page_id='',$column=''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('pages');

    $ci->db->where('id',$page_id);

    $query = $ci->db->get();

    if($column){

        $row = $query->result_array();

        if($row){

            return $row[0][$column];

        } else {

            return false;

            

        }

    } else {

        $row = $query->row();

        return $row;

    }  

}

}



// if(!function_exists('getPostDetails')){ 

//    function getPostDetails($post_id='',$column=''){    

//     $ci = @get_instance();

//     $ci->load->database();

//     $ci->db->from('pages');

//     $ci->db->where('id',$post_id);

//     $ci->db->where('active',1);

//     $query = $ci->db->get();

//     if($column){

//         $row = $query->result_array();

//         if($row){

//             return $row[0][$column];

//         } else {

//             return false;

            

//         }

//     } else {

//         $row = $query->row();

//         return $row;

//     }  

// }

// }



if(!function_exists('getBanner')){ 

 function getBanner($array=array()){    

    $ci = @get_instance();

    $ci->load->database();

    if(isset($array['type']) && $array['type'] == 'home'){

        $ci->db->from('banner');

        $ci->db->select('page_type,page_type_id,banner_title,description,image');

        $ci->db->where('banner.home_banner',1);

        $query = $ci->db->get();

        $row = $query->result();

        return $row;

    } else {

        $ci->db->from('banner');

        $ci->db->select('page_type,page_type_id,banner_title,description,image');

        $ci->db->where('banner.page_type',$array['type']);

        $ci->db->where('banner.page_type_id',$array['type_id']);

        $query = $ci->db->get();

        $row = $query->result();

        return $row;

    }



}

}





if(!function_exists('recentPosts')){ 

   function recentPosts($array=array()){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('post');

    $ci->db->select('post.id,post.post_type,post.alias,post.title,post.created_date,post.short_description,post.logo,post.post_like,post.post_dislike,post.post_comment,category.name,category.alias AS cat_alias,category.category_type,category.rootcategoryid,post_like_dislike.like_dislike');

    $ci->db->where('post.active',1);

    if(isset($array['post_type']) && $array['post_type']){

        $ci->db->where('post_type',$array['post_type']);

    }

    if(isset($array['featured']) && $array['featured']){

        $ci->db->where('featured',$array['featured']);

    }

    $ci->db->join('category', 'category.id= (SELECT cat.id FROM category AS cat WHERE cat.activated = 1 AND FIND_IN_SET(cat.id,post.category) != 0 LIMIT 1 )');

    $ci->db->join('post_like_dislike','post_like_dislike.post_id=post.id AND post_like_dislike.user_id = '.(isset($array['user_id'])?$array['user_id']:0),'left');

    if(isset($array['limit']) && $array['limit']){

        $ci->db->limit($array['limit']);

    }

    if(isset($array['rand']) && $array['rand']){

        $ci->db->order_by('post.ordering','RANDOM');

    } else {

        $ci->db->order_by('post.id','DESC');

    }

    $query = $ci->db->get();

    $row = $query->result();

    return $row;

     

}

}





if(!function_exists('relatedPosts')){ 

   function relatedPosts($array=array()){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->select('post.id,post.post_type,post.alias,post.title,post.created_date,post.short_description,post.logo,post_like_dislike.like_dislike,post.post_like,post.post_dislike,post.post_comment');

    $ci->db->from('post');

    $ci->db->join('post_like_dislike','post_like_dislike.post_id=post.id AND post_like_dislike.user_id = '.(isset($array['user_id'])?$array['user_id']:0),'left');

    $ci->db->where('post.active',1);

    if(isset($array['id']) && $array['id']){

        $ci->db->where('post.id !=',$array['id']);    

    }

    if(isset($array['post_type']) && $array['post_type']){

        $ci->db->where('post.post_type',$array['post_type']); 

    }

    if(isset($params['categories']) && $params['categories']){

        $where = '';

        $categories = explode(',', $params['categories']);

        foreach ($categories as $key => $value) {

            $where .= "FIND_IN_SET(".$value.",post.category) OR ";

        }

        $where = rtrim($where,' OR ');

        $this->db->where("(".$where.") !=", 0); 

    }



    if(isset($array['limit']) && $array['limit']){

        $ci->db->limit($array['limit']);

    }

    $query = $ci->db->get();

    $row = $query->result();

    return $row;

     

}

}



if(!function_exists('getCatSubCat')){ 

   function getCatSubCat($array=array()){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('category');

    if(isset($array['post_type']) && $array['post_type']){

        $ci->db->select('category.id,category.name,category.alias,(SELECT COUNT(post.id) AS totalpost FROM post WHERE FIND_IN_SET(category.id,post.category) != 0 AND `post`.`active` = 1 AND `post`.`post_type` = "'.$array['post_type'].'") AS products');

        $ci->db->where('(SELECT COUNT(post.id) AS totalpost FROM post WHERE FIND_IN_SET(category.id,post.category) != 0 AND `post`.`active` = 1 AND `post`.`post_type` = "'.$array['post_type'].'") != ',0);

    } else {

        $ci->db->select('category.id,category.name,category.alias,(SELECT COUNT(post.id) AS totalpost FROM post WHERE FIND_IN_SET(category.id,post.category) != 0 AND `post`.`active` = 1)');

        $ci->db->where('(SELECT COUNT(post.id) AS totalpost FROM post WHERE FIND_IN_SET(category.id,post.category) != 0 AND `post`.`active` = 1) != ',0);

    }

    $ci->db->where('category.activated',1);

    $ci->db->where('category.category_type','main');



    if(isset($array['limit']) && $array['limit']){

        $ci->db->limit($array['limit']);

    }

    $ci->db->order_by('category.name','ASC');



    $query = $ci->db->get();

    $row = $query->result();

    if($row){

        foreach ($row as $key => $value) {

            $ci->db->from('category');

            if(isset($array['post_type']) && $array['post_type']){

                $ci->db->select('category.id,category.name,category.alias,(SELECT COUNT(post.id) AS totalpost FROM post WHERE FIND_IN_SET(category.id,post.category) != 0 AND FIND_IN_SET('.$value->id.',post.category) != 0 AND `post`.`active` = 1 AND `post`.`post_type` = "'.$array['post_type'].'") AS products');

                $ci->db->where('(SELECT COUNT(post.id) AS totalpost FROM post WHERE FIND_IN_SET(category.id,post.category) != 0 AND FIND_IN_SET('.$value->id.',post.category) != 0 AND `post`.`active` = 1 AND `post`.`post_type` = "'.$array['post_type'].'") != ',0);

            } else {

                $ci->db->select('category.id,category.name,category.alias,(SELECT COUNT(post.id) AS totalpost FROM post WHERE FIND_IN_SET(category.id,post.category) != 0 AND FIND_IN_SET('.$value->id.',post.category) != 0 AND `post`.`active` = 1)');

                $ci->db->where('(SELECT COUNT(post.id) AS totalpost FROM post WHERE FIND_IN_SET(category.id,post.category) != 0 AND FIND_IN_SET('.$value->id.',post.category) != 0 AND `post`.`active` = 1) != ',0);

            }

            $ci->db->where('category.activated',1);

            $ci->db->where('category.category_type','sub');

            $ci->db->where('category.rootcategoryid',$value->id);

            $ci->db->order_by('category.name','ASC');



            $query = $ci->db->get();

            $row[$key]->subcategory = $query->result();

        }

    }

    return $row;

     

}

}



if(!function_exists('getPopularCat')){ 

   function getPopularCat($array=array()){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('category');

    $ci->db->select('category.id,category.name,category.alias');

    $ci->db->where('category.activated',1);

    $ci->db->where('category.popular',1);



    if(isset($array['limit']) && $array['limit']){

        $ci->db->limit($array['limit']);

    }

    $ci->db->order_by('category.name','ASC');

    $query = $ci->db->get();

    $row = $query->result();

    return $row;

     

}

}



if(!function_exists('getSiteSettings')){ 

   function getSiteSettings($column=''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('site_setting');

    $query = $ci->db->get();

    $row = $query->row();

    if($column){

        $row = $query->result_array();

        if($column == 'logo'){

            if(file_exists($row[0][$column])){

                return base_url().$row[0][$column];

            } else {

                return base_url().'assets/admin/img/no-image.jpg';

            }

            

        } else if($column == 'banner_image'){

            if(file_exists($row[0][$column])){

                return base_url().$row[0][$column];

            } else {

                return base_url().'assets/admin/img/no-image.jpg';

            }

            

        } else {

            return $row[0][$column];

        }

    } else {

        $row = $query->row();

        return $row;

    }

    

     

}

}



if(!function_exists('getPageDetailsByAlias')){ 

   function getPageDetailsByAlias($alias='',$column=''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('pages');

    $ci->db->where('slug',$alias);

    $query = $ci->db->get();

    if($column){

        $row = $query->result_array();

        if($row){

            return $row[0][$column];

        } else {

            return false;

            

        }

    } else {

        $row = $query->row();

        return $row;

    }  

}

}



if(!function_exists('getCatDetailsByAlias')){ 

   function getCatDetailsByAlias($alias='',$column=''){    

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('category');

    $ci->db->where('alias',$alias);

    $query = $ci->db->get();

    if($column){

        $row = $query->result_array();

        if($row){

            return $row[0][$column];

        } else {

            return false;

            

        }

    } else {

        $row = $query->row();

        return $row;

    }  

}

}



if(!function_exists('getPostDetailsByAlias')){ 

    function getPostDetailsByAlias($alias='',$post_type='',$column=''){    

        $ci = @get_instance();

        $ci->load->database();

        $ci->db->from('post');

        $ci->db->where('alias',$alias);

        $ci->db->where('post_type',$post_type);

        $query = $ci->db->get();

        if($column){

            $row = $query->result_array();

            if($row){

                if($column == 'logo'){

                    if($row[0][$column] && file_exists('uploads/post/'.$row[0][$column])){

                        return base_url().'uploads/post/'.$row[0][$column];

                    } else {

                        return base_url().'assets/admin/img/no-image.jpg';

                    }

                }  else {

                    return $row[0][$column];

                }

            }else{

                if($column == 'logo'){

                    return base_url().'assets/admin/img/no-image.jpg';

                } else {

                    return false;

                }



            }

        }else{

            $row = $query->row();

            return $row;

        }  

    }

}



if(!function_exists('postFileExists')){ 

   function postFileExists($file_url='',$file=''){    

    if($file && file_exists($file_url)){

        return base_url().$file_url;

    } else {

        return base_url().'assets/admin/img/no-image.jpg';

    }

}

}



if(!function_exists('bannerFileExists')){ 

   function bannerFileExists($file_url){    

    if($file_url && file_exists($file_url)){

        return base_url().$file_url;

    } else {

        return base_url().'assets/admin/img/no-image.jpg';

    }

}

}



if(!function_exists('userFileExists')){ 

   function userFileExists($file_url=''){    

    if($file_url && file_exists($file_url)){

        return base_url().$file_url;

    } else {

        return base_url().'assets/admin/img/user-default.png';

    }

}

}



if(!function_exists('getSeo')){ 

 function getSeo($array=array()){

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('seo');

    $ci->db->select('seo_title,tags,description,author');

    $ci->db->where('seo.type',$array['type']);

    $ci->db->where('seo.type_id',$array['type_id']);

    $query = $ci->db->get();

    $row = $query->row();

    return $row;



}

}



if(!function_exists('getPostGalleryVideo')){ 

 function getPostGalleryVideo($array=array()){

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('gallery');

    if(isset($array['type']) && $array['type']){

        $ci->db->where('gallery.type',$array['type']);

    }

    if(isset($array['post_id']) && $array['post_id']){

        $ci->db->where('gallery.post_id',$array['post_id']);

    }

    $query = $ci->db->get();

    $row = $query->result();

    return $row;



}

}



if(!function_exists('getPostCommentReply')){ 

 function getPostCommentReply($array=array()){

    $ci = @get_instance();

    $ci->load->database();

    $ci->db->from('post_comment');

    $ci->db->select('post_comment.*,user.name AS user_name,user.profile');

    $ci->db->join('user', 'user.id=post_comment.user_id','left');

    $ci->db->where('post_comment.parent_id',0);

    if(isset($array['post_id']) && $array['post_id']){

        $ci->db->where('post_comment.post_id',$array['post_id']);

    }

    $query = $ci->db->get();

    $row = $query->result();

    if($row){

        foreach ($row as $key => $value) {

            $ci->db->from('post_comment');

            $ci->db->select('post_comment.*,user.name AS user_name,user.profile');

            $ci->db->join('user', 'user.id=post_comment.user_id','left');

            $ci->db->where('post_comment.parent_id',$value->id);

            if(isset($array['post_id']) && $array['post_id']){

                $ci->db->where('post_comment.post_id',$array['post_id']);

            }

            $query = $ci->db->get();

            $row[$key]->reply = $query->result();

        }

    }

    return $row;



}

}



function getVimeoVideoThumbnailByVideoId( $id = '', $thumbType = 'medium' ) {

    $id = trim( $id );

    if ( $id == '' ) {

        return FALSE;

    }



    $ch = curl_init("http://vimeo.com/api/v2/video/".$id.".php");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $data = curl_exec($ch);

    curl_close($ch);

    if($data != 'Video not found.'){

        $apiData = unserialize($data);

        if ( is_array( $apiData ) && count( $apiData ) > 0 ) {

            $videoInfo = $apiData[ 0 ];

            switch ( $thumbType ) {

                case 'small':

                return $videoInfo[ 'thumbnail_small' ];

                break;

                case 'large':

                return $videoInfo[ 'thumbnail_large' ];

                break;

                case 'medium':

                return $videoInfo[ 'thumbnail_medium' ];

                default:

                break;

            }

        }

    }

    

    return FALSE;

}



function curl_get_contents($url)

{

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

  $data = curl_exec($ch);

  curl_close($ch);

  return $data;

}



function videoType($url) {

    if (strpos($url, 'youtube') > 0) {

        return 'youtube';

    } elseif (strpos($url, 'vimeo') > 0) {

        return 'vimeo';

    } else {

        return 'unknown';

    }

}





?>