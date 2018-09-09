<?php
// modules/_novostroiki
/**  
* Controller  
* Контроллер  
* @author IT studio IRBIS-team  
* @copyright © 2009 IRBIS-team  
*/  
/////////////////////////////////////////////////////////  

/**  
* Generation of page of an error at access out of system  
* Генерация страницы ошибки при доступе вне системы  
*/  
    if(!defined('AS_KEY'))  
    {  
       Router::routeErrorPage404();   
    }      
///////////////////////////////////////////////////////////  

/**  
* check user access 
* проверяем права доступа 
*/    
   $PAGE = Page::getInstance(Router::getUrlPath());
   if(Users::checkUserAccess($PAGE::getId())){     
       include_once AS_ROOT .'libs/form_func.php';
       $page_id = 0;
       $CONTENT= DB::getTableArray(AS_DATABASE_SITE, "content");
       $as_content_type = getSelectBlock(AS_DATABASE_SITE, "content_type", "name", "as_content_type_id", 0);
       $as_select_parent = getParentSelect('content');
       $left_menu_set = getCheckBoxSet('left_menu_set', $CONTENT['left_menu_set']); 
       $top_menu_set = getCheckBoxSet('top_menu_set', $CONTENT['top_menu_set']);
   }
   else{
       Router::routeAccessDenied();
   }