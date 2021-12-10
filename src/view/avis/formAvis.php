<main>
    <form method="POST" action="?controller=avis&action=create&idProduit=<?php echo $_GET['idProduit'] ?>">
        <h2>Votre Avis :</h2>
        <div class="custom-select">
            <label for="note">Note :</label>
            <select name="note">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
      
        <div>
            <label for="commentaire">Commentaire (optionnel) :</label>
            <textarea name="commentaire" class="textarea" rows="4" id="commentaire"></textarea>
        </div>

        <div class = "anonyme">
            <input type="checkbox" id="anonyme" name="anonyme" checked>
            <label for="anonyme">Commentaire anonyme</label>
            
        </div>


        <input type="submit" value="Poster votre avis">
    </form>
</main>