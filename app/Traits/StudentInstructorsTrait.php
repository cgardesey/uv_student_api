<?php
namespace App\Traits;
trait StudentInstructorsTrait
{
    public function instructors($user)
    {
        $courses = $user->info->courses;
        $instructors = [];
        $course_instructors_arrays = [];
        foreach ($courses as $course) {
            $course_instructors_arrays[] = $course->instructors;
        }
        foreach ($course_instructors_arrays as $course_instructors_array) {
            foreach ($course_instructors_array as $course_instructor) {
//                        return $course_instructor->getRelations();
//                        return $course_instructor->unsetRelation('instructorCourse');
//                        unset($course_instructor['instructor_course']);
                $instructors[] = $course_instructor->unsetRelation('instructorCourse');
            }
        }

        $course_chat_arrays = [];
        foreach ($courses as $course) {
            $course_chat_arrays[] = $course->chats;
        }
        foreach ($course_chat_arrays as $course_chat_array) {
            foreach ($course_chat_array as $course_chat) {
                $sender = $course_chat->sender;
                if ($sender == 'instructor') {
                    $instructors[] = $sender;
                }
            }
        }
        return collect($instructors)->unique('infoid')->values()->all();
    }
}