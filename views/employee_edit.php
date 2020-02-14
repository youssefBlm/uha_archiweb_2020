<main role="main" class="container">
    <div class="starter-template">
        <h1>Affichage d'un employé</h1>
    </div>

    <form action="index.php?c=employee&m=edit" method="post">
        <p>ContactID : <input type="text" name="id" value=<?php echo $e->ContactID; ?> /></p>
        <p>Nom : <input type="text" name="nom" value=<?php echo $e->LastName; ?> /></p>
        <p>Prenom : <input type="text" name="prenom" value=<?php echo $e->FirstName; ?>></p>

        <p><input class="btn btn-success btn-sm" type="submit" value="OK"></p>
    </form>





</main>