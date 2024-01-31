<!DOCTYPE html>
<html>
<head>
    <title>Lottery Game</title>
</head>
<body>
    <h1>Lottery Game</h1>
    <p>Try your luck and pick up to 5 numbers between 1 and 19.</p>
    <form action="lottery_game.php" method="post">
        <label for="choice1">Choice 1:</label>
        <input type="number" name="choice1" id="choice1" min="1" max="19" required><br>

        <label for="choice2">Choice 2:</label>
        <input type="number" name="choice2" id="choice2" min="1" max="19" required><br>

        <label for="choice3">Choice 3:</label>
        <input type="number" name="choice3" id="choice3" min="1" max="19" required><br>

        <label for="choice4">Choice 4:</label>
        <input type="number" name="choice4" id="choice4" min="1" max="19" required><br>

        <label for="choice5">Choice 5:</label>
        <input type="number" name="choice5" id="choice5" min="1" max="19" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
