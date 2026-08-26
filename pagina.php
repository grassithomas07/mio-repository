<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "gestioneutenti";

$conn = new mysqli($host, $user, $password, $database);
if($conn->connect_error){
    die("Errore di connessione: " . $conn->connect_error);
}

if(isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email'])){
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $query = "INSERT INTO utente (nome, cognome, email) VALUES ('$nome', '$cognome', '$email')";
    $ris = $conn->query($query);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inserimento utenti via PHP</title>
        <style>
            h1 {
                text-align: center;
                font-weight: bold;
                color: red;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 8px;
            }
        </style>
    </head>
<body>
    <h1>Inserimento dati</h1>

    <form action="" method="post" onsubmit="return validaForm()">
        Nome: <input type="text" id="nome" name="nome" placeholder="Inserisci nome..."><br><br>
        Cognome: <input type="text" id="cognome" name="cognome" placeholder="Inserisci cognome..."><br><br>
        Email: <input type="email" id="email" name="email" placeholder="Inserisci l'email..."><br><br>
        <input type="submit" value="Invia">
    </form>

    <hr>

    <h2>Elenco utenti</h2>
    Cerca: <input type="text" id="ricerca" onkeyup="filtraUtenti()" placeholder="Cerca per nome o cognome..."><br><br>

    <table id="tabellaUtenti">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $risultato = $conn->query("SELECT * FROM utente");
            while($row = $risultato->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['cognome'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
    function validaForm() {
        var nome = document.getElementById("nome").value;
        var cognome = document.getElementById("cognome").value;
        var email = document.getElementById("email").value;

        if (nome === "" || cognome === "" || email === "") {
            alert("Tutti i campi sono obbligatori!");
            return false;
        }

        var posizioneAt = email.indexOf("@");
        var posizionePunto = email.lastIndexOf(".");
        
        if (posizioneAt < 1 || posizionePunto < posizioneAt + 2 || posizionePunto + 2 >= email.length) {
            alert("Inserisci un indirizzo email valido!");
            return false;
        }

        return true;
    }

    function filtraUtenti() {
        var testo = document.getElementById("ricerca").value.toLowerCase();
        var righe = document.querySelectorAll("#tabellaUtenti tbody tr");

        for (var i = 0; i < righe.length; i++) {
            var nome = righe[i].cells[0].innerText.toLowerCase();
            var cognome = righe[i].cells[1].innerText.toLowerCase();

            if (nome.includes(testo) || cognome.includes(testo)) {
                righe[i].style.display = "";
            } else {
                righe[i].style.display = "none";
            }
        }
    }
    </script>
</body>
</html>
