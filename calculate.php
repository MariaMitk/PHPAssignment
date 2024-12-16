<?php
session_start(); // Έναρξη Session
if (isset($_SESSION['counter'])) { // Χρήση Session Counter για καταμέτρηση επισκέψεων στη σελίδα
    $_SESSION['counter'] += 1; // Αύξηση του μετρητή αν το session υπάρχει
} else {
    $_SESSION['counter'] = 1; // Αρχικοποίηση μετρητή αν είναι η πρώτη επίσκεψη
}
$visitMessage = "Επισκέψεις σελίδας: " . $_SESSION['counter'];
$visitMessage .= ($_SESSION['counter'] == 1) ? " φορά κατά τη διάρκεια αυτής της συνεδρίας." : " φορές κατά τη διάρκεια αυτής της συνεδρίας.";
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            body { background-color: #f9f9f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
            .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); max-width: 500px; text-align: center; }
            .result { margin-top: 20px; font-size: 18px; font-weight: bold; color: #28a745; }
            .message { margin-top: 20px; font-size: 16px; color: #007bff; }
        </style>
        <title>My first PHP project</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>
<body>
<div class="container">
    <h2 class="text-center text-primary">Υπολογιστής</h2>
    <p class="message">
    <!-- Φόρμα στο calculate.php -->
    <form method="post" action="calculate.php">
        <div class="form-group"><label>Αριθμός 1: <input type="number" name="num1" required></label></div>
        <div class="form-group"><label>Αριθμός 2: <input type="number" name="num2" required></label></div>
        <div class="form-group"><label>Επιλέξτε Πράξη:
            <select name="operation">
                <option value="add">Πρόσθεση</option>
                <option value="subtract">Αφαίρεση</option>
                <option value="multiply">Πολλαπλασιασμός</option>
                <option value="divide">Διαίρεση</option>
            </select>
        </label></div>
        <button type="submit" class="btn btn-primary btn-block">Υπολογισμός</button>
    </form>
    <?php
    function calculate($num1, $num2, $operation) {
        switch ($operation) {
            case 'add':
                return $num1 + $num2; // Πρόσθεση
            case 'subtract':
                return $num1 - $num2; // Αφαίρεση
            case 'divide':
                if ($num2 == 0) {
                    return "Σφάλμα! Διαίρεση με το μηδέν"; // Έλεγχος μηδενικού διαιρέτη
                }
                return $num1 / $num2; // Διαίρεση
            case 'multiply'
                return $num1 * $num2;
            default:
                return "Άγνωστη πράξη"; // Επιστροφή μηνύματος για άγνωστη πράξη
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Ελέγχει αν η μέθοδος υποβολής της φόρμας είναι POST, δηλαδή αν τα δεδομένα έχουν σταλεί μέσω της φόρμας
        $num1 = $_POST["num1"]; // Αποθηκεύει την τιμή του πρώτου αριθμού από τη φόρμα στη μεταβλητή $num1. Οι μεταβλητές στην PHP ξεκινούν πάντα με το σύμβολο του δολαρίου ($)
        $num2 = $_POST["num2"]; // Αποθηκεύει την τιμή του δεύτερου αριθμού από τη φόρμα στη μεταβλητή $num2
        $operation = $_POST["operation"]; // Αποθηκεύει την επιλεγμένη πράξη από τη φόρμα στη μεταβλητή $operation
        $result = calculate($num1, $num2, $operation); // Καλεί τη συνάρτηση calculate() και δέχεται τις τιμές των αριθμών και της πράξης ως παραμέτρους.
        echo "<div class='result'>Αποτέλεσμα: " . htmlspecialchars($result) . "</div>"; // Εκτυπώνει το αποτέλεσμα της πράξης στην οθόνη.
    }
    ?>
    </p>
    <h3><?= $visitMessage ?></h3>
</div>
</body>
</html>