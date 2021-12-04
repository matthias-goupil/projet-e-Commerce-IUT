  <main>  
    <form <?php if ($_GET['action'] == "update"){
              echo "action= '?controller=Produit&action=updated&idproduit=".$p->get('idproduit')."'";
            } else {
              echo "action = '?controller=Produit&action=created' ";
            } ?> method="post">

        <label for="intitule">intiulé : </label>
        <input type="text" placeholder="Bouteille Perrier" name="intitule" id="intitule" <?php if($_GET['action'] == "update"){
                                                                                                echo "value= '".$p->get('intitule')."'";}?> required/>

        <label for="prix">prix : </label>
        <input type="number" placeholder="44.99" name="prix" id="prix" <?php if($_GET['action'] == "update"){
                                                                                                echo "value= '".$p->get('prix')."'";}?>required/>

        <label for="stock">stock : </label>
        <input type="number" placeholder="10" name="stock" id="stock" <?php if($_GET['action'] == "update"){
                                                                                                echo "value= '".$p->get('stock')."'";}?>required/>

        <label for="description">description : </label>
        <input type="text" placeholder="Ce produit est fabriqué en .." name="description" id="description" <?php if($_GET['action'] == "update"){
                                                                                                echo "value= '".$p->get('description')."'";}?> required/>

        <label for="urlImage1">image : </label>
        <input type="text" placeholder="https://prod.isg.bruneau.media/external/?source=https%3A%2F%2Fbruneau.simpleworkspace.net%2Fphp%2Fscripts%2FgetFile.php%3Ftype%3DpubAssetBase%26s%26key%3DHD4LD9pAsffDHQSnEDqgHDrzwhVsu_PDFjuKii6hT8Z_FoY32wE%26t%3D16234165440000%26name%3D11539.jpg&width=477&height=477&mode=Default&quality=85&scale=upscalecanvas" 
        name="urlImage1" id="urlImage1" <?php if($_GET['action'] == "update"){
                                                             echo "value= '".$p->get('urlImage1')."'";}?>required/>

        <input type="submit" value="Enregistrer" class="submit" />
    </form> 
</main>