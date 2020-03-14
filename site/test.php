<?php
session_start();
include '../dbConfig.php';
// $query = $db->query("select * from Student s inner join Education m on
// s.student_id = m.student_id inner join Preferences d on 
// d.student_id = m.student_id inner join Experience e on e.student_id=d.student_id where curr_ctc='9';");

// $query1=$db->query("SELECT *, MATCH (tech,cv_parsed) AGAINST ('nodejs' IN NATURAL LANGUAGE MODE) AS score FROM Student WHERE MATCH (tech,cv_parsed) AGAINST ('nodejs' IN NATURAL LANGUAGE MODE);");
                   $insert= $db->query("INSERT INTO Student (id,stud_name, email, contact, address,college_id,college_name,college_location,pass,curr_company,curr_ctc,resume,experience,tech,cv_parsed,turnup_rate,job_seeker,updated_on, modified_on,is_active,Uploaded_by,school_hsc,city_hsc,percent_hsc,yoc_hsc,school_ssc,city_ssc,percent_ssc,yoc_ssc,ug_college,ug_degree,ug_city,ug_agg,ug_yoc,pg_college,pg_degree,pg_city,pg_agg,pg_yoc,add_courses,expected_ctc,preferred_loc,work_segment,industry,total_exp,func_seg,industries_worked,max_teamsize_handled,languages,prev_comp) VALUES ('".$sid."', '".$name."', '".$email."', '".$phone."', '".$address."', '".$cid."', '".$cname."', '".$clocation."', '".$pass."', '".$comp."', '".$cctc."', '".$resume."', '".$experience."','".$tech."','".$cv_parsed.",'".$turnup_rate.",'".$job_seeker."','".$updated_on."', NOW(),'".$is_active.",'".$uploaded_by."','".$school_hsc."', '".$city_hsc."', '".$per_hsc."', '".$yoc_hsc."', '".$school_ssc."', '".$city_ssc."', '".$per_ssc."', '".$yoc_ssc."', '".$ug_college."', '".$ug_degree."', '".$ug_city."', '".$ug_agg."', '".$ug_yoc."','".$pg_college."', '".$pg_degree."', '".$pg_city."', '".$pg_agg."', '".$pg_yoc."', '".$add_courses."','".$expected_ctc."', '".$pre_loc."', '".$work_segment."', '".$industry."','".$total_exp."', '".$func_seg."', '".$industries_worked."', '".$max_teamsize."','".$languages."','".$prev_companies."')");
                            
// $query1=$db->query("SELECT * brazil56;");
if($insert){
  echo "yes";
}
else{
    echo"try again";
}

?>