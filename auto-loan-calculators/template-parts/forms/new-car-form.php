<form id="new-car-form">
    <h3 class="form-header"></h3><!--#new-car-form-header-->
    <label class="form-label" for="name-field">Your Name:<br/>
        <input id="name-field" class="form-input" name="name-field" type="text" placeholder="Your Name" data-email-label="Name" /><!--#name-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="email-field">Your Email:<br/>
        <input id="email-field" class="form-input" name="email-field" type="email" placeholder="Your Email" data-email-label="Email" /><!--#email-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="make-field">Please select a make:<br/>
        <select id="make-field" class="form-input" name="make-field" data-email-label="Make">
            <option value="">Please select a make:</option>
            <option data-model-key="acura_models" value="Acura">Acura</option>
            <option data-model-key="alfa_models" value="Alfa Romeo">Alfa Romeo</option>
            <option data-model-key="aston_models" value="Aston Martin">Astin Martin</option>
            <option data-model-key="audi_models" value="Audi">Audi</option>
            <option data-model-key="bently_models" value="Bently">Bently</option>
            <option data-model-key="bmw_models" value="BMW">BMW</option>
            <option data-model-key="buick_models" value="Buick">Buick</option>
            <option data-model-key="cadillac_models" value="Cadillac">Cadillac</option>
            <option data-model-key="chevrolet_models" value="Chevrolet">Chevrolet</option>
            <option data-model-key="chrysler_models" value="Chrysler">Chrysler</option>
            <option data-model-key="dodge_models" value="Dodge">Dodge</option>
            <option data-model-key="fiat_models" value="FIAT">FIAT</option>
            <option data-model-key="ford_models" value="Ford">Ford</option>
            <option data-model-key="gmc_models" value="GMC">GMC</option>
            <option data-model-key="honda_models" value="Honda">Honda</option>
            <option data-model-key="hyundai_models" value="Hyundai">Hyundai</option>
            <option data-model-key="infiniti_models" value="Infiniti">Infiniti</option>
            <option data-model-key="jaguar_models" value="Jaguar">Jaguar</option>
            <option data-model-key="jeep_models" value="Jeep">Jeep</option>
            <option data-model-key="kia_models" value="Kia">Kia</option>
            <option data-model-key="lamborghini_models" value="Lamborghini">Lamborghini</option>
            <option data-model-key="land_rover_models" value="Land Rover">Land Rover</option>
            <option data-model-key="lexus_models" value="Lexus">Lexus</option>
            <option data-model-key="licoln_models" value="Lincoln">Licoln</option>
            <option data-model-key="maserati_models" value="Maserati">Maserati</option>
            <option data-model-key="mazda_models" value="Mazda">Mazda</option>
            <option data-model-key="mclaren_models" value="McLaren">McLaren</option>
            <option data-model-key="mercedes_models" value="Mercedes-Benz">Mercedes-Benz</option>
            <option data-model-key="mini_models" value="MINI">MINI</option>
            <option data-model-key="mitsubishi_models" value="Mitsubishi">Mitsubishi</option>
            <option data-model-key="nissan_models" value="Nissan">Nissan</option>
            <option data-model-key="porsche_models" value="Porsche">Porsche</option>
            <option data-model-key="ram_models" value="Ram">Ram</option>
            <option data-model-key="rolls_models" value="Rolls-Royce">Rolls-Royce</option>
            <option data-model-key="scion_models" value="Scion">Scion</option>
            <option data-model-key="smart_models" value="smart">smart</option>
            <option data-model-key="subaru_models" value="Subaru">Subaru</option>
            <option data-model-key="toyota_models" value="Toyota">Toyota</option>
            <option data-model-key="volkswagen_models" value="Volkswagen">Volkswagen</option>
            <option data-model-key="volvo_models" value="Volvo">Volvo</option>
        </select><!--#make-field.form-input-->
    </label>
    <label class="form-label" for="model-field">Please select a model:<br/>
        <select id="model-field" class="form-input" disabled data-email-label="Model"></select><!--#make-field.form-input-->
    </label>
    <p class="form-disclaimer">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p><!--.form-disclaimer-->
    <input class="form-submit" type="submit" value="Submit">
</form><!--#new-car-form-->