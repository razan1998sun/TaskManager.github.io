<?php
require "config.php";
function validate_date($date_string)
{
if ( $time = strtotime($date_string)) {return $time ;}
else {return false;}
}

/*	 $_SERVER['REQUEST_METHOD']    
    Returns the request method used to access the page */
if ( $_SERVER['REQUEST_METHOD'] == 'POST') {

    //اختبار عدم فراغ حقلي المهمة و التاريخ 
if ( (!empty($_POST['task_name'])) and (!empty($_POST['due_date'])) ){

        // اختبار صحة التاريخ المدخل
       if ( $due_date = validate_date($_POST['due_date'])) { 
        // تخزين المهمة في قاعدة البيانات 
        $descr = $_POST['task_name'];
        $due_date = date('Y-m-d', $due_date);
        $connection->query("INSERT INTO tasks (description,due_date ,user_id)
        VALUES ('".$descr."' , '". $due_date."', '".$_SESSION['user_id']."')");
    }
    else {
        // ارسال رسالة تطلب ادخال التاريخ بشكل صحيح
        $errors['not_valid_date'] = "must enter the date correctly !";
        $_SESSION['errors'] = $errors ; 

    } }

// احد الحقلين او  كلاهما فارغين
else { 
    echo "it is empty";
    //ارسال رسالة تطلب ادخال الحقلين 
if (empty($_POST['task_name']))
{ $errors['required_name'] = "Enter the description of the task !"; }
if ( empty($_POST['due_date']))
{ $errors['required_date']= " Enter the date of the task ! " ; }

$_SESSION['errors'] = $errors ; 

}
// يرجع يعرض الملف الي فيه HTML 
header('location: ../index.php');
}

?>
