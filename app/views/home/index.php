<div class="login-page">
    <div class="form order">
        <form method="post" class="order-form">
            <table>
                <tr>
                    <td>
                        <input type="text" name="firstname" placeholder="Vardas" autocomplete="off" autofocus>
                        <input type="text" name="lastname" placeholder="Pavardė" autocomplete="off" autofocus>
                        <select name="type" class="soflow" id="type">
                            <option selected disabled>Bandelės rūšis</option>
                            <?php for ($i = 0, $len = count($bandeles); $i < $len; $i++): ?>
                            <option value="<?= $bandeles[$i]->id ?>" price="<?= $bandeles[$i]->price ?>"><?= $bandeles[$i]->type . ' - ' . $bandeles[$i]->price ?>€</option>
                            <?php endfor; ?>
                        </select>
                        <br><br>
                        <select name="amount" class="soflow" id="amount">
                            <option selected disabled>Kiekis</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="address" placeholder="Pristatymo adresas" autocomplete="off" autofocus>
                        <br><br>
                        <label for="date">Pristatymo data:</label>
                        <br><br>
                        <input type="date" name="date">
                    </td>
                </tr>
            </table>
            <br><br>
            <input type="submit" name="order" id="order" value="Užsakyti">
            <br><br>
            <b>Viso: <span id="total">0</span>€</b>
        </form>
    </div>
</div>
