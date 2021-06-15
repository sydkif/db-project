<?php

session_start();

include('../database/DB.php');

$quiz = $_POST['quiz'];
$quizMarks = $_POST['marks'];
$subject = $_POST['subject_code'];
$student = $_POST['student_id'];
$totalQuestions = $_POST['total_questions'];
$count = 0;

// Development testing =====
echo $quiz . '<br>';
echo $subject . '<br>';
echo $student . '<br>';
echo $totalQuestions . '<br>';
echo 'Answers <br>';

while ($count < $totalQuestions) {
    echo $_POST['answer_q' . ($count + 1)] . '<br>';
    $count++;
}
echo '=== <br>';
// =========================

$sql = "SELECT answer FROM $quiz WHERE subject_id = '$subject'";
$result = $conn->query($sql);
$num = 0;
$marks = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        if ($_POST['answer_q' . ($num + 1)] == $row['answer'])
            $marks += 2;
        else
            $marks -= 2;

        echo $row['answer'];

        echo $_POST['answer_q' . ($num + 1)] . '<br>';
        $num++;
    }
} else {
    echo "0 results";
}

echo '<br> total marks : ' . $marks;
// die();
// if ($marks < 0)
//     $marks = 0;
// if ($quiz == 'tf_quiz')
$sql1 = "UPDATE student_subject SET $quizMarks = '$marks' WHERE (subject_id = '$subject' && student_id = '$student');";
// if ($quiz == 'mc_quiz')
//     $sql = "UPDATE $quiz SET mc_marks ='$marks' WHERE (subject_id = '$subject' && student_id = '$student')";

if ($conn->query($sql1) === TRUE) {
    $_SESSION['msg'] = "Quiz submitted successfully";
    $_SESSION['status'] = "Success";
} else {
    $_SESSION['msg'] = "Error updating record: " . $conn->error;
    $_SESSION['status'] = "Fail";
}

$conn->close();

header('Location: dashboard.php');
