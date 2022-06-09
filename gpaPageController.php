<?php


class gpaPageController
{
    public function __construct($post) {
        $root = "/~mill2994/gpa";

        $classes = 0;

        if (ISSET($post['classes'])) {
            $classes = $post['classes'];
        }
        if (ISSET($post[add])) {
            $this->redirect = "$root/gpaPage.php?d=a&c=" . $classes;
            return;
        }
        if (ISSET($post[remove])) {
            $this->redirect = "$root/gpaPage.php?d=r&c=" . $classes;
            return;
        }
        if (ISSET($post['min'])) {
            $this->redirect = "$root/gpaPage.php?d=m&c=0";
            return;
        }

        $startingGPA = $post['cumulativeGPA'];
        $startingCredits = $post['cumulativeCredits'];

        if (ISSET($post['min2'])) {
            $minGPA = $post['GPAmin'];
            $minCredits = $post['CreditMin'];

            $mGPA = (($minGPA * ($startingCredits + $minCredits)) - ($startingGPA * $startingCredits)) / $minCredits;
            $this->redirect = "$root/gpaPage.php?d=sm&c=0&g=" . $mGPA;
            return;
        }

        $TotalCredits = $startingCredits;
        $GPA = $startingGPA * $startingCredits;

        for ($b = 1; $b <= $classes; $b++) {

            $class = 'GPAclass' . $b;
            $credit = 'Creditclass' . $b;

            $GPA = $GPA + $post[$class] * $post[$credit];
            $TotalCredits += $post[$credit];
        }

        $GPA = $GPA / $TotalCredits;

        $this->redirect = "$root/gpaPage.php?d=s&c=" . $classes . '&g=' . $GPA;
    }

    public function getRedirect() {
        return $this->redirect;
    }

    private $redirect;
}