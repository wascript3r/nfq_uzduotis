<div class="login-page">
    <div class="form orderlist">
        <center>
            <input type="text" id="searchBy" placeholder="Paieškos laukelis" autocomplete="off" autofocus>
            <select class="soflow" id="sortBy">
                <option selected disabled>Rikiuoti pagal</option>
                <option sortBy="id" asc="asc">ID [0-9]</option>
                <option sortBy="id" asc="desc">ID [9-0]</option>
                <option sortBy="firstname" asc="asc">Vardą [0-9]</option>
                <option sortBy="firstname" asc="desc">Vardą [9-0]</option>
                <option sortBy="lastname" asc="asc">Pavardę [0-9]</option>
                <option sortBy="lastname" asc="desc">Pavardę [9-0]</option>
                <option sortBy="type" asc="asc">Bandelės rūšį [0-9]</option>
                <option sortBy="type" asc="desc">Bandelės rūšį [9-0]</option>
                <option sortBy="amount" asc="asc">Kiekį [0-9]</option>
                <option sortBy="amount" asc="desc">Kiekį [9-0]</option>
                <option sortBy="price" asc="asc">Sumą [0-9]</option>
                <option sortBy="price" asc="desc">Sumą [9-0]</option>
                <option sortBy="address" asc="asc">Adresą [0-9]</option>
                <option sortBy="address" asc="desc">Adresą [9-0]</option>
                <option sortBy="date" asc="asc">Pristatymo datą [0-9]</option>
                <option sortBy="date" asc="desc">Pristatymo datą [9-0]</option>
            </select>
            <input type="submit" id="search" value="Ieškoti">
            <input type="submit" id="reset" value="Atšaukti">
        </center>
        <table class="orders">
            <tr>
                <th>ID</th>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Bandelės rūšis</th>
                <th>Kiekis</th>
                <th>Suma</th>
                <th>Pristatymo adresas</th>
                <th>Pristatymo data</th>
            </tr>
            <?php if (count($orders) == 0): ?>
                <tr>
                    <td colspan="8"><center><i>Užsakymų nerasta</i></center></td>
                </tr>
            <?php else: ?>
                <?php for ($i = 0, $len = count($orders); $i < $len; $i++): ?>
                <tr>
                    <td><?= $orders[$i]->id ?></td>
                    <td><?= $orders[$i]->firstname ?></td>
                    <td><?= $orders[$i]->lastname ?></td>
                    <td><?= $orders[$i]->type2 ?></td>
                    <td><?= $orders[$i]->amount ?></td>
                    <td><?= $orders[$i]->price ?>€</td>
                    <td><?= $orders[$i]->address ?></td>
                    <td><?= $orders[$i]->date ?></td>
                </tr>
                <?php endfor; ?>
            <?php endif; ?>
        </table>
        <br>
        <?= $links ?>
        <br>
    </div>
</div>
