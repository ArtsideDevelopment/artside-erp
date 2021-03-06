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
       include_once AS_ROOT .'libs/shop_func.php';
       include_once AS_ROOT .'libs/form_func.php';
       $as_categories_select= getParentSelect('catalog');
       $as_vendor_select= getSelectBlock(AS_DATABASE_SITE, 'vendor', 'name', 'as_vendor_id');
       $lk_bread_crumbs = $PAGE->getBreadCrumbs();       
       $products_table=  getProductsTable();
       
   }
   else{
       Router::routeAccessDenied();
   }