<?php

function lottery_game() {
    $total_balls = 19;
    $max_choices = 5;
    $num_winners = 3;

    echo "Welcome to the Lottery Game!\n";
    echo "Try your luck and pick up to 5 numbers between 1 and $total_balls.\n";

    // Generate an array of winning numbers
    $winning_numbers = array();
    while (count($winning_numbers) < $max_choices) {
        $random_number = rand(1, $total_balls);
        if (!in_array($random_number, $winning_numbers)) {
            $winning_numbers[] = $random_number;
        }
    }

    // Get user's number choices
    $user_choices = array();
    for ($i = 1; $i <= $max_choices; $i++) {
        $choice = (int) $_POST["choice$i"];
        if ($choice < 1 || $choice > $total_balls) {
            echo "Invalid choice. Number should be between 1 and $total_balls.\n";
            return;
        }

        if (in_array($choice, $user_choices)) {
            echo "You have already chosen $choice. Please pick a different number.\n";
            return;
        } else {
            $user_choices[] = $choice;
        }
    }

    // Display the winning numbers
    echo "The winning numbers are: " . implode(", ", $winning_numbers) . "\n";

    // Check how many numbers the user guessed correctly
    $correct_guesses = array_intersect($user_choices, $winning_numbers);
    $num_correct_guesses = count($correct_guesses);

    // Display the results
    echo "You guessed $num_correct_guesses out of $max_choices numbers correctly.\n";

    if ($num_correct_guesses >= 3) {
        echo "Congratulations! You won a prize!\n";
        switch ($num_correct_guesses) {
            case 5:
                echo "You matched all 5 numbers. You won the first prize!\n";
                break;
            case 4:
                echo "You matched 4 numbers. You won the second prize!\n";
                break;
            case 3:
                echo "You matched 3 numbers. You won the third prize!\n";
                break;
        }
    } else {
        echo "Sorry, you didn't win this time. Better luck next time!\n";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    lottery_game();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lottery Game</title>
</head>
<body>
    <h1>Lottery Game</h1>
    <p>Try your luck and pick up to 5 numbers between 1 and 19.</p>
    <form action="lottery_game.php" method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label for="choice<?php echo $i; ?>">Choice <?php echo $i; ?>:</label>
            <input type="number" name="choice<?php echo $i; ?>" id="choice<?php echo $i; ?>" min="1" max="19" required><br>
        <?php endfor; ?>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
