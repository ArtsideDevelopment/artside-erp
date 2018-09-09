<?php
/*   
* libs/shop_func.php 
* File of shop functions  
* Файл функций управления разделом "Магазин"
* @author ArtSide 07.05.2018   
* @copyright © 2018 ArtSide   
*/

/** 
* Функция получения таблицы категорий интернет-магазина
* Function get categories table
* @param
* @return string 
*/ 
function getCategoriesTable($table){
    $table_body=getCategoriesStructTable(0, $table, "", "");
    $table = "<h3>У вас пока нет ни одной категории в интернет-магазине.</h3>";
    if(strlen(trim($table_body))>0){
        $table="
            <table width='100%' border='0' cellspacing='0' cellpadding='0' class='dataTables'>
                <thead>
                    <tr class='tr_header'>
                        <th>Категории интернет-магазина</th>
                        <th>Ссылка</th>                        
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    ".$table_body."
                </tbody>
            </table>";
    }    
    return $table;
}
/** 
* Функция получения таблицы страниц 
* function get table of pages
* @param int $id, string $table, int $hierarchy string $nbsp
* @return string 
*/ 
function getCategoriesStructTable($parent_id, $table, $hierarchy, $nbsp){
    $st="";
    $nbsp.="&nbsp;&nbsp;";
    try{        
        $res = DB::mysqliQuery(AS_DATABASE_SITE,"
            SELECT *   
            FROM `". AS_DBPREFIX .$table."` 
            WHERE `parent_id`='".$parent_id."' 
            ORDER BY `hierarchy` "  
                );        
    }
    catch (ExceptionDataBase $edb){
        throw new ExceptionDataBase("Ошибка в запросе к базе данных",2, $edb);
    }    
    $num_rows = $res->num_rows;
    if($num_rows == 0)  
        return $st;
    else{	     
        while($row = $res->fetch_assoc()){   
            $time_hierarchy="";			
            $time_hierarchy=$hierarchy.$row['hierarchy']."."; 
            $st.="
            <tr>                    
                <td align='left'>".$nbsp.$time_hierarchy." ".$row['name']."</td>
                <td align='left'><a href='".AS_SITE.$row['url_path']."' target='_blank'>".$row['url_path']."</a></td>                    
                <td align='center'>                    
                    <a href='javascript:void(null);' onclick='if (confirm(\"Вы действительно хотите удалить страницу?\")) xajax_Delete_Category(\"type=content&id=".$row['id']."&hierarchy=".$row['hierarchy']."&parent_id=".$row['parent_id']."\"); return false;' class='btn btn-danger'><i class='icon-trash'></i></a>
                    <a href='/shop/catalog/edit-category?category_id=".$row['id']."' class='btn btn-default'><i class='icon-note'></i></a>                   
                </td>
            </tr>
            ";
            $st.=getCategoriesStructTable($row['id'], $table, $time_hierarchy, $nbsp);
        }
        return $st;
    }
}
/** 
* Функция получения таблицы категорий интернет-магазина
* Function get categories table
* @param
* @return string 
*/ 
function getProductsTable(){           
    try{        
        $res = DB::mysqliQuery(AS_DATABASE_SITE,"
            SELECT *   
            FROM `". AS_DBPREFIX ."products` 
            LIMIT 100"
        );        
    }
    catch (ExceptionDataBase $edb){
        throw new ExceptionDataBase("Ошибка в запросе к базе данных",2, $edb);
    }    
    $num_rows = $res->num_rows;
    if($num_rows>0){
        $table="
        <table width='100%' border='0' cellspacing='0' cellpadding='0' class='dataTables'>
            <thead>
                <tr class='tr_header'>
                    <th width='250px'>Товар</th>
                    <th width='150px'>Категория</th>            
                    <th>Цена</th>
                    <th>Код 1С</th>
                    <th>Количество</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>";
        while($row = $res->fetch_assoc()){
            $table.="
                <tr>
                    <td align='left'>
                        ".$row['name']."
                        <div><a href='".AS_SITE.$row['url_path']."' target='_blank'>".$row['url_path']."</a></div>
                    </td>
                    <td align='left'>
                        ".$row['category_name_old']."
                    </td>
                    <td align='left'>
                        ".$row['cost']." <div class='old-cost'>".$row['cost_old']."</div>
                        
                    </td>
                    <td align='left'>
                        ".$row['1c']."                         
                    </td>
                    <td align='left'>
                        ".$row['1c']."                         
                    </td>
                    <td align='center'>                    
                        <a href='javascript:void(null);' onclick='if (confirm(\"Вы действительно хотите удалить товар?\")) xajax_Delete_Category(".$row['id']."); return false;' class='btn btn-danger'><i class='icon-trash'></i></a>
                        <a href='/shop/products/edit-product?product_id=".$row['id']."' class='btn btn-default'><i class='icon-note'></i></a>                   
                    </td>
                </tr>
                ";
        }
        $table.="</tbody>
        </table>";
    } 
    else{
        $table = "<h3>У вас пока нет ни одного товара в интернет-магазине.</h3>"; 
    }
    return $table;
}