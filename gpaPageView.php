<?php


class gpaPageView
{

    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct($get) {
        if (ISSET($get['c'])) {
            $this->classes = $get['c'];
        }

        if (ISSET($get['g'])) {
            $this->gpa = $get['g'];
        }

        if (ISSET($get['d'])) {
            $decision = $get['d'];
            if ($decision == 'a') {
                $this->classes += 1;
            }
            else if ($decision == 'r' && $this->classes > 0) {
                $this->classes -= 1;
            } else if ($decision == 's') {
                $this->calculated = true;
            } else if ($decision == 'm') {
                $this->min = true;
            } else if ($decision == 'sm') {
                $this->calculated = true;
                $this->min = true;
            }
        }

    }

    public function presentForm() {

        $html = <<<HTML
        <p> Weighted GPA Calculator! </p>
<form method="post" action="post-gpa.php">
<input type="hidden" name="classes" value=$this->classes>
    <fieldset>
        <legend>Grade Entry</legend>
        <p>
            <label for="cumulativeGPA">Current Cumulative GPA</label><br>
            <input type="text" id="cumulativeGPA" name="cumulativeGPA" placeholder="Cumulative GPA">
        </p>
        <p>
            <label for="cumulativeCredits">Total Credits (Enter 0 if no classes taken yet) </label><br>
            <input type="text" id="cumulativeCredits" name="cumulativeCredits" placeholder="Total Credits">
        </p>
        <hr>
HTML;

        for ($a = 1; $a <= $this->classes; $a++) {
            $html .= '<p>';
            $html .= '<label for="GPAclass' . $a . '">GPA achieved in class ' .  $a . '</label><br>';
            $html .= '<input type="text" id="GPAclass' . $a . '" name="GPAclass' . $a . '" placeholder="Grade">';
            $html .= '</p>';

            $html .= '<p>';
            $html .= '<label for="Creditclass' . $a . '">Credits for class ' . $a . '</label><br>';
            $html .= '<input type="text" id="Creditclass' . $a . '" name="Creditclass' . $a . '" placeholder="Credits">';
            $html .= '</p>';
            $html .= '<hr>';

        }

        if ($this->min) {
            $html .= '<input type="hidden" name="min2" value="min2">';
            $html .= '<p>';
            $html .= '<label for="GPAmin">Minimum Cumulative GPA you would like</label><br>';
            $html .= '<input type="text" id="GPAmin" name="GPAmin" placeholder="Grade">';
            $html .= '</p>';

            $html .= '<p>';
            $html .= '<label for="CreditMin">Remaining Credits</label><br>';
            $html .= '<input type="text" id="CreditMin" name="CreditMin" placeholder="Credits">';
            $html .= '</p>';
            $html .= '<hr>';
        }


        if ($this->calculated) {
            $html .= '<p> Your calculated GPA is: ' . $this->gpa . '</p>';
        }


        $html .= <<<HTML
        <p>
            <input type="submit" name="add" value="Add Class"> <input type="submit" name="remove" value="Remove Class"> <input type="submit" name="min" value="Min GPA Calc">
        </p>
        <p>
            <input type="submit" value="Calculate">
        </p>
        <p><a href="./">Welcome Page</a></p>

    </fieldset>
</form>
HTML;

        return $html;

    }

    private $classes = 0;
    private $calculated = false;
    private $gpa;
    private $min = false;
}