<div class="table">
    <div class="card_title">
        <h1>Administration</h1>
    </div>
    <div class="field button">
        <a href="index.php?controller=articles&task=showAdd"><input class="btnAdd" type="submit" value="Ajouter un livre"></a>
        <a href="index.php?controller=articles&task=getAllArticle"><input class="editCom" type="submit" value="Liste de livres"></a>
        <a href="index.php?controller=pret&task=nonAvailable"><input class="editCom" type="submit" value="Liste des oeuvres empruntées"></a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>EMAIL</th>
            <th>ADRESSE</th>
            <th>VILLE</th>
            <th>CODE-POSTAL</th>
            <th>ROLE</th>
            <th>ACTIONS</th>
        </tr>
        <?php foreach ($usersInfo as $userInfo) : ?>
            <tr>
                <td><?php echo $userInfo['id_user']; ?></td>
                <td><?php echo $userInfo['lname']; ?></td>
                <td><?php echo $userInfo['fname']; ?></td>
                <td><?php echo $userInfo['email']; ?></td>
                <td><?php echo $userInfo['adress']; ?></td>
                <td><?php echo $userInfo['city']; ?></td>
                <td><?php echo $userInfo['zip_code']; ?></td>
                <td><?php echo $userInfo['role']; ?></td>
                <td>
                    <?php if ($userInfo['role'] != "Admin") : ?>
                        <a href="index.php?controller=user&task=getUser&id=<?= $userInfo['id_user']; ?>">
                            <input type="submit" class="edit_btn_user" value="Modifier">
                        </a>
                        <a href="index.php?controller=user&task=deleteUser&id=<?= $userInfo['id_user']; ?>" onclick="return window.confirm('Êtes vous sûr de vouloir supprimer cet utilisateur ?')">
                            <input name="btnDelete" type="submit" class="delete_user" value="Supprimer">
                            <!-- <input name="btnDelete" type="submit" class="btnDelete" value="Supprimer"> -->
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>