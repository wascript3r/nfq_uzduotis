<div class="login-page">
    <center>
        <button type="button" id="apie">Apie mus</button>
        <button type="button" id="galerija">Galerija</button>
        <button type="button" id="uzsakymo_forma">Užsakymo forma</button>
        <button type="button" id="prisijungimas">Prisijungimas</button>
    </center>
    <div class="form order">
        <h3>Apie mus</h3>
        <div>
        Jau nuo 1994 metų Bandelių kepyklėlė tobulina savo asortimentą ir stengiasi jog kiekvienas gaminys būtų pateiktas kokybiškas ir šviežias. Visi gaminiai gaminami iš natūralių žaliavų, naudojami pačios aukščiausios rūšies ingredientai. Pagrindinis mūsų tikslas, jog kiekvienas klientas iš mūsų išeitų patenkintas ir norėtų vėl sugrįžti į mūsų kepyklėlę.
        </div>
    </div>

    <div class="form order">
        <h3>Galerija</h3>
        <div id="slider">
            <div><img src="<?= URL ?>public/images/bandele1.jpg"></div>
            <div><img src="<?= URL ?>public/images/bandele2.jpg"></div>
            <div><img src="<?= URL ?>public/images/bandele3.jpg"></div>
            <div><img src="<?= URL ?>public/images/bandele4.jpg"></div>
            <div><img src="<?= URL ?>public/images/bandele5.jpg"></div>
        </div>
        <button type="button" id="prevSlide">Atgal</button>
        <button type="button" id="nextSlide">Pirmyn</button>
    </div>

    <div class="form order">
        <h3>Užsakymo forma</h3>
        <form method="post" class="order-form">
            <table>
                <tr>
                    <td>
                        <input type="text" name="firstname" placeholder="Vardas" autocomplete="off">
                        <input type="text" name="lastname" placeholder="Pavardė" autocomplete="off">
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
                        <input type="text" name="address" placeholder="Pristatymo adresas" autocomplete="off">
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
            <br><br>
            <i>Užsakymo apmokėjimas atliekamas atvykus kurjeriui</i>
        </form>
    </div>
</div>
