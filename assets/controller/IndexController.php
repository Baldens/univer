<?php
require_once __DIR__ . "/../../db/connectDataBase.php";

class IndexController
{
    /** SELECT */
    public function selectStudents()
    {
        $db = DataBase::getInstance();
        $reqs = $db->getSelectRequest("SELECT * FROM `students`");
        return $reqs;
    }

    public function selectItems()
    {
        $db = DataBase::getInstance();
        $reqs = $db->getSelectRequest("SELECT * FROM `items_academic`");
        return $reqs;
    }

    public function selectGroups()
    {
        $db = DataBase::getInstance();
        $reqs = $db->getSelectRequest("SELECT * FROM `groups`");
        return $reqs;
    }

    public function selectStudentsTheirGradesAndItems()
    {
        $db = DataBase::getInstance();
        $reqs = $db->getSelectRequest("SELECT `students`.`student_name`, `students`.`id`, SUM(`grades`.`grades`), 
                `items_academic`.`item_name`, `grades`.`id_items` FROM `grades` 
                RIGHT JOIN `students` ON `students`.`id` = `grades`.`id_student` 
                JOIN `items_academic` ON `items_academic`.`id` = `grades`.`id_items` 
                GROUP BY `students`.`student_name`, `items_academic`.`item_name` ORDER BY SUM(`grades`.`grades`) DESC");
        return $reqs;
    }
    public function selectGradesStudentsWithParamIdStudentIdGroup($idGroup){
        $stringSql = "SELECT 
            `items_acad-groups`.`id_groups`	,
            `items_acad-groups`.`id_items-academic`,
            `grades`.`id`	,
            SUM(`grades`.`grades`) AS sum_grades,
            `grades`.`id_student`	,
            `grades`.`id_items`,
            `students`.`id_group`,
            `students`.`student_name`
            FROM `grades` INNER JOIN `items_acad-groups` ON `grades`.`id_items` = `items_acad-groups`.`id_items-academic` INNER JOIN `students` ON `students`.`id` = `grades`.`id_student`
            GROUP BY `grades`.`id_items`,`grades`.`id_student`, `students`.`id_group`
            HAVING `students`.`id_group` = ?  
            ORDER BY `grades`.`id_student`, `items_acad-groups`.`id_items-academic` ASC";
        $db = DataBase::getInstance();
        $stringS = "s";
        $arrayRequest = array($idGroup);
        $reqs = $db->getSelectRequestPrepare($stringSql,$stringS,$arrayRequest);
        return $reqs;
    }
    public function selectStudentsAndGrades($requestIdGroups)
    {
        $db = DataBase::getInstance();
        $stringSql = "SELECT `students`.`student_name`, SUM(`grades`.`grades`), `grades`.`id_items`,`students`.`id`
                    FROM `grades` RIGHT JOIN `students` ON `students`.`id` = `grades`.`id_student` 
                    WHERE `id_group` = ? GROUP BY `students`.`student_name`";
        $stringS = "s";
        $arrayRequest = array(intval($requestIdGroups));
        $reqs = $db->getSelectRequestPrepare($stringSql,$stringS,$arrayRequest);
        return $reqs;
    }

    public function selectStudentTheirItems($requestIdGroups)
    {
        $db = DataBase::getInstance();
        $stringSql = "SELECT `items_acad-groups`.`id_items-academic`, 
                    `items_academic`.`item_name` FROM `items_acad-groups` 
                    INNER JOIN `items_academic` ON `items_academic`.`id` = `items_acad-groups`.`id_items-academic` 
                    WHERE `items_acad-groups`.`id_groups` = ?";
        $stringS = "s";
        $arrayRequest = array(intval($requestIdGroups));
        $reqs = $db->getSelectRequestPrepare($stringSql,$stringS,$arrayRequest);
        return $reqs;
    }

    public function selectDataForStudentsAndTheirGrades($idStudent, $idItems)
    {
        $db = DataBase::getInstance();
        $stringSql = "SELECT `students`.`student_name`, `students`.`id`,  
                `items_academic`.`item_name`, `grades`.`id_items`, 
                `grades`.`time_create`, `grades`.`id`, `grades`.`grades`
                FROM `grades` 
                RIGHT JOIN `students` ON `students`.`id` = `grades`.`id_student` 
                JOIN `items_academic` ON `items_academic`.`id` = `grades`.`id_items` 
                WHERE `students`.`id` = ? AND `grades`.`id_items` = ?
                GROUP BY `grades`.`time_create`";
        $stringS = "ss";
        $arrayRequest = array($idStudent,$idItems);
        $reqs = $db->getSelectRequestPrepare($stringSql,$stringS,$arrayRequest);
        return $reqs;
    }
    public function selectDataStudentsInUniqGroup($id){
        $db = DataBase::getInstance();
        $stringSql = "SELECT * FROM `students` WHERE `id_group` = ?";
        $stringS = "s";
        $arrayRequest = array($id);
        $reqs = $db->getSelectRequestPrepare($stringSql,$stringS,$arrayRequest);
        return $reqs;
    }

    public function selectItemsForGroup($idGroup){
        $db = DataBase::getInstance();
        $stringSql = "SELECT `items_acad-groups`.`id_items-academic`, `items_academic`.`item_name` 
                    FROM `items_acad-groups` 
                    INNER JOIN `items_academic` ON `items_academic`.`id` = `items_acad-groups`.`id_items-academic` 
                    WHERE `items_acad-groups`.`id_groups` = ?";
        $stringS = "s";
        $arrayRequest = array($idGroup);
        $reqs = $db->getSelectRequestPrepare($stringSql,$stringS,$arrayRequest);
        return $reqs;
    }

    public function selectStudentForGroup($idGroup){
        $db = DataBase::getInstance();
        $stringSql = "SELECT `id`, `student_name`, `id_group` FROM `students` WHERE `id_group` = ?";
        $stringS = "s";
        $arrayRequest = array($idGroup);
        $reqs = $db->getSelectRequestPrepare($stringSql,$stringS,$arrayRequest);
        return $reqs;
    }

    /** INSERT */
    public function saveDataGradesStudents($array)
    {
        $db = DataBase::getInstance();
        $stringSql = "INSERT INTO `grades` (`id`, `grades`,`id_student`,`id_items`) 
                                VALUES (NULL, ?, ?, ?)";
        $stringS = "sss";
        $arrayRequest = $array;
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    public function saveDataItems($nameItems)
    {
        $db = DataBase::getInstance();
        $stringSql = "INSERT INTO `items_academic`(`item_name`) VALUES ('$nameItems')";
        $stringS = "s";
        $arrayRequest = array($nameItems);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    public function saveDataGroups($nameGroup)
    {
        $db = DataBase::getInstance();
        $stringSql = "INSERT INTO `groups` (`group_name`) 
                                VALUES (?)";
        $stringS = "s";
        $arrayRequest = array($nameGroup);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    public function saveDataItemsInGroup($idGroup,$idItems)
    {
        $db = DataBase::getInstance();
        $stringSql = "INSERT INTO `items_acad-groups`(`id_groups`, `id_items-academic`) 
            VALUES (?,?)";
        $stringS = "ss";
        $arrayRequest = array($idGroup,$idItems);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    public function saveDataNewStudent($nameStudent,$idGroup)
    {
        $db = DataBase::getInstance();
        $stringSql = "INSERT INTO `students` (`student_name`,`id_group`) 
                                VALUES (?,?)";
        $stringS = "ss";
        $arrayRequest = array($nameStudent,$idGroup);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    /** UPDATE */
    public function updateNewDataGradesStudents($array)
    {
        $db = DataBase::getInstance();
        $stringSql = "UPDATE `grades` SET `grades`= ?
                   WHERE `id`= ?";
        $stringS = "ss";
        $arrayRequest = $array;
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    public function updateNameGroup($array)
    {
        $db = DataBase::getInstance();

        $stringSql = "UPDATE `groups` SET `group_name` = ? WHERE `id` = ?";
        $stringS = "ss";
        $arrayRequest = array($array[1],$array[0]);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    public function updateNameStudent($array)
    {
        $db = DataBase::getInstance();

        $stringSql = "UPDATE `students` SET `student_name` = ? WHERE `id` = ?";
        $stringS = "ss";
        $arrayRequest = array($array[1],$array[0]);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    public function updateNameItems($array)
    {
        $db = DataBase::getInstance();

        $stringSql = "UPDATE `items_academic` SET `item_name` = ? WHERE `id` = ?";
        $stringS = "ss";
        $arrayRequest = array($array[1],$array[0]);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    /** DELETE */
    public function deleteAcademicItems($idItems){
        $db = DataBase::getInstance();
        $stringSql = "DELETE FROM `items_academic` WHERE `id` = ?";
        $stringS = "s";
        $arrayRequest = array($idItems);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }
    public function deleteGradesStudent($idStudent, $idItems)
    {
        $db = DataBase::getInstance();
        $stringSql = "DELETE FROM `grades` WHERE `id_student` = ? AND `id_items` = ?";
        $stringS = "ss";
        $arrayRequest = array($idStudent,$idItems);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    public function deleteGroup($id)
    {
        $db = DataBase::getInstance();
        $stringSql = "DELETE FROM `groups` WHERE `id` = ?";
        $stringS = "s";
        $arrayRequest = array($id);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }

    public function deleteStudents($id)
    {
        $db = DataBase::getInstance();
        $stringSql = "DELETE FROM `students` WHERE `id` = ?";
        $stringS = "s";
        $arrayRequest = array($id);
        $db->getInsertRequestPrepare($stringSql,$stringS,$arrayRequest);
    }
    /** OTHER */
    public function checkOnExistenceItems($idItems){
        $db = DataBase::getInstance();
        $stringSql = "SELECT `item_name` FROM `items_academic` WHERE `item_name` = ?";
        $stringS = "s";
        $arrayRequest = array($idItems);
        $reqs = $db->getSelectRequestPrepare($stringSql,$stringS,$arrayRequest);
        $existence = $reqs->num_rows;
        return $existence;
    }
    public function checkOnExistenceItemsInGroup($idItems,$idGroup){
        $db = DataBase::getInstance();
        $stringSql = "SELECT * FROM `items_acad-groups` WHERE `id_groups` = ? AND `id_items-academic` = ?";
        $stringS = "ss";
        $arrayRequest = array($idGroup,$idItems);
        $reqs = $db->getSelectRequestPrepare($stringSql,$stringS,$arrayRequest);
        $existence = $reqs->num_rows;
        return $existence;
    }
}