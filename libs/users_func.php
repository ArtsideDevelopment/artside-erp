<?php
/*   
* libs/users_func.php 
* File of users functions  
* Файл функций пользователей
* @author Dulebsky A. 29.04.2014   
* @copyright © 2014 ArtSide   
*/
/** 
* Функция получения таблицы пользователей
* Recursion function get table of users
* @param int $id
* @return string 
*/ 

function getUsersHierarchyTable($user_id){
    $users_table_rows = getUsersHierarchyTableRecursion($user_id, "");
    if(strlen(trim($users_table_rows))>0){
    $users_table="
        <table id='dt_tableExport' class='dataTable' cellspacing='0' width='100%'> 
            <thead>
                <tr>   
                    <th>id</th>
                    <th>ФИО</th>
                    <th>Телефон</th>                    
                    <th>e-mail</th> 
                    <th></th>
                    <th></th>
                  </tr>  
              </thead>              
              <tbody>
              ".  getUsersHierarchyTableRecursion($user_id, "")."
              </tbody>
        </table>   
        ";
    }
    else{
        $users_table="<h3>У вас пока нет ни одного пользователя. <a href='/users/add-user/'>Добавьте первого пользователя</a> прямо сейчас</h3>";
    }
    return $users_table;
}
/** 
* Рекурсивная функция получения иерархии пользователей
* Recursion function get hierarchy of users
* @param int $id, string $nbsp
* @return string 
*/ 
function getUsersHierarchyTableRecursion($user_id, $nbsp){
    $users_table="";  
    $nbsp.="&nbsp;&nbsp;";
    try{
        $res = DB::mysqliQuery(AS_DATABASE,"
            SELECT 
                `id`, `name`, `fam`, `patronymic`, `mail`, `phone`, `active`
            FROM 
                `". AS_DBPREFIX ."lk_users` 
            WHERE 
                `parent_id`='".$user_id."'
                "  
        );
    }
    catch (ExceptionDataBase $edb){
        throw new ExceptionDataBase("Ошибка в стеке запросов к базе данных",2, $edb);
    } 
    $num_rows = $res->num_rows;
    if($num_rows == 0)  
        return $users_table;
    else{	     
        while($row = $res->fetch_assoc()){               
            $users_table.="
                <tr>       
                    <td align='left'>".$row['id']."</td>      
                    <td align='left'>".$nbsp." ".$row['fam']." ".$row['name']." ".$row['patronymic']."</td>                    
                    <td align='center'>".$row['phone']."</td>
                    <td align='center'>".$row['mail']."</td> 
                    <td>
                        <div class='as-table-actions'>                            
                            ".getUserStatus($row['id'], $row['active'])."
                            
                        </div>
                    </td>
                    <td>
                        <div class='as-table-actions'>
                            <a href='/users/edit-user?user_id=".$row['id']."' class='ts_remove_row'><i class='icon-note'></i></a> 
                            <a href=\"javascript:void(null);\" onclick=\"if (confirm('Вы действительно хотите удалить пользователя?')) xajax_Delete_User(".$row['id']."); return false;\" class='btn btn-danger'><i class='icon-trash'></i></a>
                        </div>
                    </td>
                </tr>";            
            $users_table.=getUsersHierarchyTableRecursion($row['id'], $nbsp);
        }
        return $users_table;
    }
}
/** 
* Функция получения статуса пользователя
* Function get user status
* @param 
* @return string 
*/
function getUserStatus($user_id, $active){  
    $user_status_link="";
    if($user_id>0){
        if($active*1==1){
            $user_status_link = "<a href='javascript:void(null);' class='ts_remove_row' onclick='xajax_User_Make_Arhive(".$user_id.");'><span class='uk-badge uk-badge-success'>Активный</span></a>";
        }
        else{
            $user_status_link = "<a href='javascript:void(null);' class='ts_remove_row' onclick='xajax_User_Make_Active(".$user_id.");'><span class='uk-badge uk-badge-danger'>Архивный</span></a>";
        }
    }
    return $user_status_link;
}