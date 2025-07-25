<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form fields safely
    $name    = htmlspecialchars($_POST['name'] ?? ''); 
    $email   = htmlspecialchars($_POST['mail'] ?? '');
    $surface = htmlspecialchars($_POST['surface'] ?? '');
    $date    = htmlspecialchars($_POST['date'] ?? '');
    $city    = htmlspecialchars($_POST['ville'] ?? '');

    // Retrieve selected checkboxes
    $services = [];
    if (isset($_POST['fenetres']))               $services[] = "fenetres";
    if (isset($_POST['parquets']))               $services[] = "parquets";
    if (isset($_POST['portes']))                 $services[] = "portes";
    if (isset($_POST['placo-faux-plafonds']))    $services[] = "placo-faux-plafonds";
    if (isset($_POST['placo-isolation']))        $services[] = "placo-isolation";
    if (isset($_POST['placo-doublages']))      $services[] = "placo-doublages";
    $servicesList = implode(", ", $services);

    // Compose email
    $to = "adoteakue97@gmail.com";
    $subject = "Demande de Devis";
    $message = "Nom: $name\n";
    $message .= "Email: $email\n";
    $message .= "Services demandés: $servicesList\n";
    $message .= "Ville: $city\n";
    $message .= "Surface: $surface\n";
    $message .= "Période souhaitée: $date\n";

    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "<h2 style='color:green;'>Votre demande a été envoyée avec succès !</h2>";
    } else {
        echo "<h2 style='color:red;'>Erreur : l’envoi du mail a échoué.</h2>";
    }
} else {
    echo "<h2 style='color:red;'>Accès non autorisé.</h2>";
}
?>
